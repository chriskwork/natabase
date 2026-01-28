<!-- 
// controllers/AuthController.php
public function login() {
    $error = '';
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = $_POST['email'] ?? '';
        $password = $_POST['pass'] ?? '';
        
        // 1. 빈 값 체크
        if (empty($email) || empty($password)) {
            $error = 'Email y contraseña son obligatorios.';
        } else {
            // 2. DB에서 사용자 조회
            $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = ?");
            $stmt->execute([$email]);
            $user = $stmt->fetch();
            
            // 3. 비밀번호 확인
            if (!$user || !password_verify($password, $user['password'])) {
                $error = 'Email o contraseña incorrectos.';
            } else {
                // 로그인 성공 → 세션 저장 후 리다이렉트
                $_SESSION['user_id'] = $user['id'];
                header('Location: /dashboard');
                exit;
            }
        }
    }
    
    // $error 변수를 view에 전달
    require_once 'views/auth/login.php';
} -->