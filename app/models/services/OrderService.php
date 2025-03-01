<?php\n// \app\models\services\OrderService.php\n\n?>
<?php
// app/models/services/OrderService.php

class OrderService
{
    private $orderRepository;
    private $orderItemRepository;
    private $productRepository;
    
    public function __construct()
    {
        $this->orderRepository = new OrderRepository();
        $this->orderItemRepository = new OrderItemRepository();
        $this->productRepository = new ProductRepository();
    }
    
    // Create a new order
    public function createOrder($orderData, $cartItems, $cartTotal)
    {
        // Start transaction
        $db = DatabaseHelper::getInstance()->getConnection();
        $db->begin_transaction();
        
        try {
            // Generate unique order number
            $orderNumber = 'ORD-' . strtoupper(uniqid());
            
            // Create order record
            $orderId = $this->orderRepository->create([
                'order_number' => $orderNumber,
                'user_id' => $orderData['user_id'],
                'status' => 'pending',
                'customer_name' => $orderData['customer_name'],
                'customer_email' => $orderData['customer_email'],
                'customer_phone' => $orderData['customer_phone'],
                'shipping_address' => $orderData['shipping_address'],
                'shipping_city' => $orderData['shipping_city'],
                'shipping_state' => $orderData['shipping_state'],
                'shipping_postcode' => $orderData['shipping_postcode'],
                'shipping_country' => $orderData['shipping_country'],
                'notes' => $orderData['notes'],
                'payment_method' => $orderData['payment_method'],
                'subtotal' => $cartTotal['subtotal'],
                'discount' => $cartTotal['discount'],
                'total' => $cartTotal['total'],
                'created_at' => date('Y-m-d H:i:s')
            ]);
            
            // Add order items
            foreach ($cartItems as $item) {
                $product = $this->productRepository->getById($item['id']);
                
                if ($product) {
                    $this->orderItemRepository->create([
                        'order_id' => $orderId,
                        'product_id' => $item['id'],
                        'product_name' => $product['name'],
                        'price' => $product['price'],
                        'quantity' => $item['quantity'],
                        'subtotal' => $item['subtotal']
                    ]);
                }
            }
            
            // Process payment based on payment method
            // This is just a placeholder - in a real application, you would integrate with a payment gateway
            $paymentSuccess = $this->processPayment($orderData['payment_method'], $orderId, $cartTotal['total']);
            
            if (!$paymentSuccess) {
                // If payment fails, roll back transaction
                $db->rollback();
                return [
                    'success' => false,
                    'message' => 'Payment processing failed. Please try again.'
                ];
            }
            
            // Commit transaction
            $db->commit();
            
            // Send order confirmation email
            $this->sendOrderConfirmationEmail($orderId);
            
            return [
                'success' => true,
                'order_id' => $orderId,
                'order_number' => $orderNumber
            ];
            
        } catch (Exception $e) {
            // Roll back transaction on error
            $db->rollback();
            
            return [
                'success' => false,
                'message' => 'An error occurred while processing your order: ' . $e->getMessage()
            ];
        }
    }
    
    // Get order by ID
    public function getOrderById($orderId)
    {
        $order = $this->orderRepository->getById($orderId);
        
        if (!$order) {
            return null;
        }
        
        // Get order items
        $order['items'] = $this->orderItemRepository->getByOrderId($orderId);
        
        return $order;
    }
    
    // Process payment (placeholder)
    private function processPayment($method, $orderId, $amount)
    {
        // In a real application, this would integrate with a payment gateway
        switch ($method) {
            case 'credit_card':
                // Process credit card payment
                return true;
                
            case 'paypal':
                // Process PayPal payment
                return true;
                
            case 'cod':
                // Cash on delivery - no processing needed
                return true;
                
            default:
                return false;
        }
    }
    
    // Send order confirmation email (placeholder)
    private function sendOrderConfirmationEmail($orderId)
    {
        $order = $this->getOrderById($orderId);
        
        if (!$order) {
            return false;
        }
        
        // In a real application, this would send an actual email
        // For now, we'll just return true to simulate success
        return true;
    }
}