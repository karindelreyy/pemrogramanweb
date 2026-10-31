<?php
class AuthController extends Controller {

    public function login(): void {
        if (Middleware::isLoggedIn()) {
            $this->redirect('');
        }

        $this->view('auth/login', ['title' => 'Login']);
    }

    public function authenticate(): void {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('auth/login');
        }

        $username = trim($_POST['username'] ?? '');
        $password = $_POST['password'] ?? '';

        $user = $this->model('User')->login($username, $password);

        if ($user) {
            session_regenerate_id(true);
            $_SESSION['user'] = $user;

            $this->flash(
                'success',
                'Selamat datang, ' . ($user['full_name'] ?? $user['username']) . '!'
            );

            $this->redirect('dashboard');
        }

        $this->flash('danger', 'Username atau password salah.');
        $this->redirect('auth/login');
    }

    public function logout(): void {
        $_SESSION = [];

        if (ini_get('session.use_cookies')) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params['path'],
                $params['domain'],
                $params['secure'],
                $params['httponly']
            );
        }

        session_destroy();
        header('Location: ' . BASEURL . '/auth/login');
        exit;
    }
}
