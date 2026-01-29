<?php
require_once __DIR__ . '/../config/database.php';

class AuthController {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function login() {
        $error = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['pass'] ?? '';

            // null check
            if (empty($email) || empty($password)) {
                $error = 'Email y contraseña son obligatorios.';
            } else {
                // find user DB
                $stmt = $this->pdo->prepare("SELECT * FROM usuarios WHERE email = ?");
                $stmt->execute([$email]);
                $user = $stmt->fetch();

                // password check
                if (!$user || !password_verify($password, $user['password'])) {
                    $error = 'Email o contraseña incorrectos.';
                } else {
                    // success -> keep session
                    $_SESSION['user_id'] = $user['id_usuario'];
                    $_SESSION['rol'] = $user['rol'];
                    $_SESSION['nombre'] = $user['nombre'];

                    // redirect by role
                    switch ($user['rol']) {
                        case 'entrenador':
                            header('Location: /dashboard');
                            break;
                        case 'familia':
                            header('Location: /mis-nadadores');
                            break;
                        case 'nadador':
                            header('Location: /mi-perfil');
                            break;
                        default:
                            header('Location: /');
                    }
                    exit;
                }
            }
        }


        require_once __DIR__ . '/../views/auth/login_view.php';
    }

    public function logout() {
        // destroy all session data
        session_start();
        session_unset();
        session_destroy();

        header('Location: /');
        exit;
    }

    public function register() {
        $error = '';
        $success = false;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // get form data
            $email = trim($_POST['email'] ?? '');
            $nombre = trim($_POST['name'] ?? '');
            $apellidos = trim($_POST['surname'] ?? '');
            $password = $_POST['pass'] ?? '';
            $confirm_pass = $_POST['confirm_pass'] ?? '';
            $telefono = trim($_POST['phone'] ?? '');
            $dni = trim($_POST['dni'] ?? '');
            $fecha_nacimiento = $_POST['birth'] ?? '';
            $rol = $_POST['role'] ?? 'familia';

            // validation
            if (empty($email) || empty($nombre) || empty($apellidos) || empty($password)) {
                $error = 'Por favor, completa todos los campos obligatorios.';
            } elseif ($password !== $confirm_pass) {
                $error = 'Las contraseñas no coinciden.';
            } elseif (strlen($password) < 8) {
                $error = 'La contraseña debe tener al menos 8 caracteres.';
            } else {
                try {
                    // check email duplicate
                    $stmt = $this->pdo->prepare("SELECT id_usuario FROM usuarios WHERE email = ?");
                    $stmt->execute([$email]);

                    if ($stmt->fetch()) {
                        $error = 'Este email ya está registrado.';
                    } else {
                        // hash password
                        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                        // begin transaction
                        $this->pdo->beginTransaction();

                        try {
                            // insert usuario
                            $stmt = $this->pdo->prepare("
                                INSERT INTO usuarios (email, password, rol, nombre, created_at)
                                VALUES (?, ?, ?, ?, NOW())
                            ");
                            $full_name = $nombre . ' ' . $apellidos;
                            $stmt->execute([$email, $hashed_password, $rol, $full_name]);
                            $user_id = $this->pdo->lastInsertId();

                            // if nadador role and has dni/birth, create nadador record
                            if ($rol === 'nadador' && !empty($dni) && !empty($fecha_nacimiento)) {
                                // check dni duplicate
                                $stmt = $this->pdo->prepare("SELECT id_nadador FROM nadadores WHERE dni = ?");
                                $stmt->execute([$dni]);

                                if ($stmt->fetch()) {
                                    throw new Exception('Este DNI ya está registrado.');
                                }

                                // calculate age and category
                                $edad = $this->calculateAge($fecha_nacimiento);
                                $id_categoria = $this->getCategoryByAge($edad);

                                // insert nadador
                                $stmt = $this->pdo->prepare("
                                    INSERT INTO nadadores (id_usuario, nombre, apellidos, dni, fecha_nacimiento, id_categoria, email, telefono)
                                    VALUES (?, ?, ?, ?, ?, ?, ?, ?)
                                ");
                                $stmt->execute([
                                    $user_id,
                                    $nombre,
                                    $apellidos,
                                    $dni,
                                    $fecha_nacimiento,
                                    $id_categoria,
                                    $email,
                                    $telefono
                                ]);
                            }

                            // commit transaction
                            $this->pdo->commit();

                            // auto login
                            $_SESSION['user_id'] = $user_id;
                            $_SESSION['rol'] = $rol;
                            $_SESSION['nombre'] = $full_name;

                            // redirect by role
                            switch ($rol) {
                                case 'entrenador':
                                    header('Location: /dashboard');
                                    break;
                                case 'nadador':
                                    header('Location: /mi-perfil');
                                    break;
                                case 'familia':
                                    header('Location: /mis-nadadores');
                                    break;
                                default:
                                    header('Location: /');
                            }
                            exit;
                        } catch (Exception $e) {
                            $this->pdo->rollBack();
                            $error = $e->getMessage();
                        }
                    }
                } catch (PDOException $e) {
                    $error = 'Error en el sistema. Por favor, inténtalo de nuevo.';
                }
            }
        }

        // load view
        require_once __DIR__ . '/../views/auth/register_view.php';
    }

    // helper: calculate age from birth date
    private function calculateAge($fecha_nacimiento) {
        $birth = new DateTime($fecha_nacimiento);
        $today = new DateTime('today');
        return $birth->diff($today)->y;
    }

    // helper: get category by age
    private function getCategoryByAge($edad) {
        $stmt = $this->pdo->prepare("
            SELECT id_categoria
            FROM categorias
            WHERE edad_minima <= ? AND edad_maxima >= ?
            LIMIT 1
        ");
        $stmt->execute([$edad, $edad]);
        $result = $stmt->fetch();
        return $result ? $result['id_categoria'] : null;
    }
}
