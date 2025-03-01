<?php\n// \app\controllers\shop\AccountController.php\n\n?>
<?php
// app/controllers/shop/AccountController.php

class AccountController extends BaseController
{
    private $userRepository;
    private $orderRepository;
    private $authService;
    
    public function __construct()
    {
        $this->userRepository = new UserRepository();
        $this->orderRepository = new OrderRepository();
        $this->authService = new AuthService();
        
        // Check if user is logged in
        if (!$this->authService->isLoggedIn()) {
            $_SESSION['redirect_after_login'] = $_SERVER['REQUEST_URI'];
            $_SESSION['login_error'] = 'Please login to access your account.';
            header('Location: /login');
            exit;
        }
    }
    
    // Show account dashboard
    public function index()
    {
        $userId = $this->authService->getCurrentUserId();
        $user = $this->userRepository->getById($userId);
        $recentOrders = $this->orderRepository->getRecentByUserId($userId, 5);
        
        $this->render('shop/account/dashboard', [
            'pageTitle' => 'My Account',
            'currentPage' => 'account',
            'showBreadcrumb' => true,
            'breadcrumb' => [
                '#' => 'My Account'
            ],
            'user' => $user,
            'recentOrders' => $recentOrders
        ]);
    }
    
    // Show order history
    public function orders()
    {
        $userId = $this->authService->getCurrentUserId();
        $orders = $this->orderRepository->getAllByUserId($userId);
        
        $this->render('shop/account/orders', [
            'pageTitle' => 'My Orders',
            'currentPage' => 'account',
            'showBreadcrumb' => true,
            'breadcrumb' => [
                '/account' => 'My Account',
                '#' => 'Orders'
            ],
            'orders' => $orders
        ]);
    }
    
    // Show single order details
    public function orderDetail($orderId)
    {
        $userId = $this->authService->getCurrentUserId();
        $order = $this->orderRepository->getByIdAndUserId($orderId, $userId);
        
        if (!$order) {
            $_SESSION['error'] = 'Order not found.';
            $this->redirect('/account/orders');
            return;
        }
        
        $this->render('shop/account/order-detail', [
            'pageTitle' => 'Order #' . $order['order_number'],
            'currentPage' => 'account',
            'showBreadcrumb' => true,
            'breadcrumb' => [
                '/account' => 'My Account',
                '/account/orders' => 'Orders',
                '#' => 'Order #' . $order['order_number']
            ],
            'order' => $order
        ]);
    }
    
    // Show profile edit form
    public function profile()
    {
        $userId = $this->authService->getCurrentUserId();
        $user = $this->userRepository->getById($userId);
        
        $this->render('shop/account/profile', [
            'pageTitle' => 'Edit Profile',
            'currentPage' => 'account',
            'showBreadcrumb' => true,
            'breadcrumb' => [
                '/account' => 'My Account',
                '#' => 'Profile'
            ],
            'user' => $user
        ]);
    }
    
    // Update profile
    public function updateProfile()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/account/profile');
            return;
        }
        
        $userId = $this->authService->getCurrentUserId();
        
        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';
        $currentPassword = $_POST['current_password'] ?? '';
        $newPassword = $_POST['new_password'] ?? '';
        $confirmPassword = $_POST['confirm_password'] ?? '';
        
        // Update name and email
        $this->userRepository->update($userId, [
            'name' => $name,
            'email' => $email
        ]);
        
        // Change password if provided
        if (!empty($currentPassword) && !empty($newPassword)) {
            if ($newPassword !== $confirmPassword) {
                $_SESSION['profile_error'] = 'New passwords do not match.';
                $this->redirect('/account/profile');
                return;
            }
            
            $result = $this->authService->changePassword($userId, $currentPassword, $newPassword);
            
            if (!$result['success']) {
                $_SESSION['profile_error'] = $result['message'];
                $this->redirect('/account/profile');
                return;
            }
        }
        
        $_SESSION['profile_success'] = 'Profile updated successfully.';
        $this->redirect('/account/profile');
    }
    
    // Show addresses
    public function addresses()
    {
        $userId = $this->authService->getCurrentUserId();
        $addresses = $this->userRepository->getAddressesByUserId($userId);
        
        $this->render('shop/account/addresses', [
            'pageTitle' => 'My Addresses',
            'currentPage' => 'account',
            'showBreadcrumb' => true,
            'breadcrumb' => [
                '/account' => 'My Account',
                '#' => 'Addresses'
            ],
            'addresses' => $addresses
        ]);
    }
}