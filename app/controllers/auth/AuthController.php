<?php\n// \app\controllers\auth\AuthController.php\n\n?>
<?php
// app/controllers/auth/AuthController.php

class AuthController extends BaseController
{
    private $userRepository;
    private $authService;
    
    public function __construct()
    {
        $this->userRepository = new UserRepository();
        $this->authService = new AuthService();
    }
    
    // Show login form
    public function login()
    {
        // Redirect if user is already logged in
        if ($this->authService->isLoggedIn()) {
            $this->redirect('/account');
            return;
        }
        
        $this->render('auth/login', [
            'pageTitle' => 'Login',
            'currentPage' => 'login',
            'showBreadcrumb' => true,
            'breadcrumb' => [
                '#' => 'Login'
            ]
        ]);
    }
    
    // Process login form
    public function doLogin()
    {
        // Redirect if user is already logged in
        if ($this->authService->isLoggedIn()) {
            $this->redirect('/account');
            return;
        }
        
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/login');
            return;
        }
        
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $rememberMe = isset($_POST['remember_me']);
        
        $result = $this->authService->login($email, $password, $rememberMe);
        
        if ($result['success']) {
            // Redirect to intended page or account dashboard
            $redirect = $_SESSION['redirect_after_login'] ?? '/account';
            unset($_SESSION['redirect_after_login']);
            
            $this->redirect($redirect);
        } else {
            // Back to login form with error
            $_SESSION['login_error'] = $result['message'];
            $this->redirect('/login');
        }
    }
    
    // Show registration form
    public function register()
    {
        // Redirect if user is already logged in
        if ($this->authService->isLoggedIn()) {
            $this->redirect('/account');
            return;
        }
        
        $this->render('auth/register', [
            'pageTitle' => 'Register',
            'currentPage' => 'register',
            'showBreadcrumb' => true,
            'breadcrumb' => [
                '#' => 'Register'
            ]
        ]);
    }
    
    // Process registration form
    public function doRegister()
    {
        // Redirect if user is already logged in
        if ($this->authService->isLoggedIn()) {
            $this->redirect('/account');
            return;
        }
        
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/register');
            return;
        }
        
        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $confirmPassword = $_POST['confirm_password'] ?? '';
        
        if ($password !== $confirmPassword) {
            $_SESSION['register_error'] = 'Passwords do not match.';
            $_SESSION['register_data'] = [
                'name' => $name,
                'email' => $email
            ];
            $this->redirect('/register');
            return;
        }
        
        $result = $this->authService->register($name, $email, $password);
        
        if ($result['success']) {
            $_SESSION['login_success'] = 'Registration successful. You can now log in.';
            $this->redirect('/login');
        } else {
            $_SESSION['register_error'] = $result['message'];
            $_SESSION['register_data'] = [
                'name' => $name,
                'email' => $email
            ];
            $this->redirect('/register');
        }
    }
    
    // Process logout
    public function logout()
    {
        $this->authService->logout();
        $this->redirect('/login');
    }
    
    // Show password reset request form
    public function forgotPassword()
    {
        $this->render('auth/forgot-password', [
            'pageTitle' => 'Forgot Password',
            'showBreadcrumb' => true,
            'breadcrumb' => [
                '/login' => 'Login',
                '#' => 'Forgot Password'
            ]
        ]);
    }
    
    // Process password reset request
    public function sendResetLink()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/forgot-password');
            return;
        }
        
        $email = $_POST['email'] ?? '';
        
        $result = $this->authService->sendPasswordResetLink($email);
        
        if ($result['success']) {
            $_SESSION['reset_success'] = 'Password reset link has been sent to your email.';
        } else {
            $_SESSION['reset_error'] = $result['message'];
        }
        
        $this->redirect('/forgot-password');
    }
}