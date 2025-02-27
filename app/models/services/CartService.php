<?php\n// \app\models\services\CartService.php\n\n?>
<?php
// app/models/services/CartService.php

class CartService
{
    private $productRepository;
    private $couponRepository;
    
    public function __construct()
    {
        $this->productRepository = new ProductRepository();
        
        // Initialize cart in session if it doesn't exist
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [
                'items' => [],
                'coupon' => null,
                'discount' => 0
            ];
        }
    }
    
    // Get the entire cart contents
    public function getCart()
    {
        $cart = $_SESSION['cart'];
        $items = [];
        
        foreach ($cart['items'] as $productId => $item) {
            // Get the latest product details
            $product = $this->productRepository->getById($productId);
            
            if ($product) {
                $items[] = [
                    'id' => $productId,
                    'name' => $product['name'],
                    'price' => $product['price'],
                    'image' => $product['image'],
                    'quantity' => $item['quantity'],
                    'subtotal' => $product['price'] * $item['quantity']
                ];
            }
        }
        
        return $items;
    }
    
    // Get the total price of the cart
    public function getTotal()
    {
        $cart = $_SESSION['cart'];
        $items = $this->getCart();
        $subtotal = 0;
        
        foreach ($items as $item) {
            $subtotal += $item['subtotal'];
        }
        
        $discount = $cart['discount'];
        $total = $subtotal - $discount;
        
        return [
            'subtotal' => $subtotal,
            'discount' => $discount,
            'total' => $total
        ];
    }
    
    // Get the total number of items in the cart
    public function getCount()
    {
        $cart = $_SESSION['cart'];
        $count = 0;
        
        foreach ($cart['items'] as $item) {
            $count += $item['quantity'];
        }
        
        return $count;
    }
    
    // Add an item to the cart
    public function addItem($product, $quantity = 1)
    {
        $productId = $product['id'];
        
        if (isset($_SESSION['cart']['items'][$productId])) {
            // Product already in cart, increase quantity
            $_SESSION['cart']['items'][$productId]['quantity'] += $quantity;
        } else {
            // Add new product to cart
            $_SESSION['cart']['items'][$productId] = [
                'quantity' => $quantity,
                'date_added' => time()
            ];
        }
        
        return true;
    }
    
    // Update the quantity of an item in the cart
    public function updateItem($productId, $quantity)
    {
        if (!isset($_SESSION['cart']['items'][$productId])) {
            return false;
        }
        
        if ($quantity <= 0) {
            // Remove item if quantity is zero or negative
            return $this->removeItem($productId);
        }
        
        $_SESSION['cart']['items'][$productId]['quantity'] = $quantity;
        
        return true;
    }
    
    // Remove an item from the cart
    public function removeItem($productId)
    {
        if (!isset($_SESSION['cart']['items'][$productId])) {
            return false;
        }
        
        unset($_SESSION['cart']['items'][$productId]);
        
        return true;
    }
    
    // Clear the entire cart
    public function clearCart()
    {
        $_SESSION['cart'] = [
            'items' => [],
            'coupon' => null,
            'discount' => 0
        ];
        
        return true;
    }
    
    // Apply a coupon to the cart
    public function applyCoupon($couponCode)
    {
        // Here you would validate the coupon code against your database
        // For now, we'll use a simple example:
        
        if ($couponCode === 'DISCOUNT10') {
            // 10% discount on the cart total
            $total = $this->getTotal();
            $_SESSION['cart']['coupon'] = $couponCode;
            $_SESSION['cart']['discount'] = $total['subtotal'] * 0.1;
            
            return true;
        }
        
        return false;
    }
}