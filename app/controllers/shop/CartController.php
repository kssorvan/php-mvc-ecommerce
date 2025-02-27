<?php\n// \app\controllers\shop\CartController.php\n\n?>
<?php
// app/controllers/shop/CartController.php

class CartController extends BaseController
{
    private $cartService;
    private $productRepository;
    
    public function __construct()
    {
        $this->cartService = new CartService();
        $this->productRepository = new ProductRepository();
    }
    
    // Display the shopping cart
    public function index()
    {
        $cartItems = $this->cartService->getCart();
        $cartTotal = $this->cartService->getTotal();
        
        $this->render('shop/cart/index', [
            'pageTitle' => 'Shopping Cart',
            'currentPage' => 'cart',
            'showBreadcrumb' => true,
            'breadcrumb' => [
                '#' => 'Shopping Cart'
            ],
            'cartItems' => $cartItems,
            'cartTotal' => $cartTotal
        ]);
    }
    
    // Add a product to the cart
    public function add($productId, $quantity = 1)
    {
        $productId = (int) $productId;
        $quantity = (int) $quantity;
        
        if ($quantity <= 0) {
            $quantity = 1;
        }
        
        $product = $this->productRepository->getById($productId);
        
        if (!$product) {
            // Product not found, redirect to cart with error
            $_SESSION['error'] = 'Product not found.';
            $this->redirect('/cart');
            return;
        }
        
        $this->cartService->addItem($product, $quantity);
        
        // Check if the request is Ajax
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest') {
            // Return JSON response
            $this->json([
                'success' => true,
                'message' => 'Product added to cart.',
                'cartTotal' => $this->cartService->getTotal(),
                'cartCount' => $this->cartService->getCount()
            ]);
        } else {
            // Regular request, redirect to cart
            $_SESSION['success'] = 'Product added to cart.';
            $this->redirect('/cart');
        }
    }
    
    // Update item quantity in cart
    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/cart');
            return;
        }
        
        $productId = isset($_POST['product_id']) ? (int) $_POST['product_id'] : 0;
        $quantity = isset($_POST['quantity']) ? (int) $_POST['quantity'] : 0;
        
        if ($productId <= 0 || $quantity <= 0) {
            $_SESSION['error'] = 'Invalid product or quantity.';
            $this->redirect('/cart');
            return;
        }
        
        $this->cartService->updateItem($productId, $quantity);
        
        $_SESSION['success'] = 'Cart updated.';
        $this->redirect('/cart');
    }
    
    // Remove an item from the cart
    public function remove($productId)
    {
        $productId = (int) $productId;
        
        if ($productId <= 0) {
            $_SESSION['error'] = 'Invalid product.';
            $this->redirect('/cart');
            return;
        }
        
        $this->cartService->removeItem($productId);
        
        $_SESSION['success'] = 'Product removed from cart.';
        $this->redirect('/cart');
    }
    
    // Clear the entire cart
    public function clear()
    {
        $this->cartService->clearCart();
        
        $_SESSION['success'] = 'Cart cleared.';
        $this->redirect('/cart');
    }
    
    // Apply a coupon to the cart
    public function applyCoupon()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/cart');
            return;
        }
        
        $couponCode = isset($_POST['coupon_code']) ? trim($_POST['coupon_code']) : '';
        
        if (empty($couponCode)) {
            $_SESSION['error'] = 'Please enter a coupon code.';
            $this->redirect('/cart');
            return;
        }
        
        $success = $this->cartService->applyCoupon($couponCode);
        
        if ($success) {
            $_SESSION['success'] = 'Coupon applied successfully.';
        } else {
            $_SESSION['error'] = 'Invalid coupon code.';
        }
        
        $this->redirect('/cart');
    }
}