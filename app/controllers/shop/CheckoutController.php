<?php\n// \app\controllers\shop\CheckoutController.php\n\n?>
<?php
// app/controllers/shop/CheckoutController.php

class CheckoutController extends BaseController
{
    private $cartService;
    private $orderService;
    private $authService;
    private $userRepository;
    
    public function __construct()
    {
        $this->cartService = new CartService();
        $this->orderService = new OrderService();
        $this->authService = new AuthService();
        $this->userRepository = new UserRepository();
        
        // Redirect to cart if it's empty
        if ($this->cartService->isEmpty()) {
            $_SESSION['error'] = 'Your cart is empty. Please add products before checkout.';
            header('Location: /cart');
            exit;
        }
    }
    
    // Show checkout form
    public function index()
    {
        $cartItems = $this->cartService->getCart();
        $cartTotal = $this->cartService->getTotal();
        
        // Check if user is logged in
        $user = null;
        $addresses = [];
        
        if ($this->authService->isLoggedIn()) {
            $userId = $this->authService->getCurrentUserId();
            $user = $this->userRepository->getById($userId);
            $addresses = $this->userRepository->getAddressesByUserId($userId);
        }
        
        $this->render('shop/checkout/index', [
            'pageTitle' => 'Checkout',
            'currentPage' => 'checkout',
            'showBreadcrumb' => true,
            'breadcrumb' => [
                '/cart' => 'Cart',
                '#' => 'Checkout'
            ],
            'cartItems' => $cartItems,
            'cartTotal' => $cartTotal,
            'user' => $user,
            'addresses' => $addresses
        ]);
    }
    
    // Process checkout
    public function placeOrder()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/checkout');
            return;
        }
        
        // Get form data
        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';
        $phone = $_POST['phone'] ?? '';
        $address = $_POST['address'] ?? '';
        $city = $_POST['city'] ?? '';
        $state = $_POST['state'] ?? '';
        $postcode = $_POST['postcode'] ?? '';
        $country = $_POST['country'] ?? '';
        $notes = $_POST['notes'] ?? '';
        $paymentMethod = $_POST['payment_method'] ?? '';
        
        // Validate form data
        if (empty($name) || empty($email) || empty($phone) || empty($address) || empty($city) || empty($state) || empty($postcode) || empty($country) || empty($paymentMethod)) {
            $_SESSION['checkout_error'] = 'Please fill in all required fields.';
            $this->redirect('/checkout');
            return;
        }
        
        // Create order data
        $orderData = [
            'customer_name' => $name,
            'customer_email' => $email,
            'customer_phone' => $phone,
            'shipping_address' => $address,
            'shipping_city' => $city,
            'shipping_state' => $state,
            'shipping_postcode' => $postcode,
            'shipping_country' => $country,
            'notes' => $notes,
            'payment_method' => $paymentMethod,
            'user_id' => $this->authService->isLoggedIn() ? $this->authService->getCurrentUserId() : null
        ];
        
        // Get cart data
        $cart = $this->cartService->getCart();
        $cartTotal = $this->cartService->getTotal();
        
        // Create order
        $result = $this->orderService->createOrder($orderData, $cart, $cartTotal);
        
        if ($result['success']) {
            // Clear cart after successful order
            $this->cartService->clearCart();
            
            // Redirect to confirmation page
            $this->redirect('/checkout/confirmation/' . $result['order_id']);
        } else {
            // Back to checkout with error
            $_SESSION['checkout_error'] = $result['message'];
            $this->redirect('/checkout');
        }
    }
    
    // Show order confirmation
    public function confirmation($orderId)
    {
        $order = $this->orderService->getOrderById($orderId);
        
        if (!$order) {
            $this->redirect('/');
            return;
        }
        
        $this->render('shop/checkout/confirmation', [
            'pageTitle' => 'Order Confirmation',
            'currentPage' => 'confirmation',
            'showBreadcrumb' => true,
            'breadcrumb' => [
                '/checkout' => 'Checkout',
                '#' => 'Confirmation'
            ],
            'order' => $order
        ]);
    }
}