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
                    $_SESSION['user_id'] = $user['id'];
                    header('Location: /dashboard');
                    exit;
                }
            }
        }

        // $error 변수를 view에 전달
        require_once __DIR__ . '/../views/auth/login_view.php';
    }
}
