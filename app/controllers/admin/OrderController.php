<?php\n// \app\controllers\admin\OrderController.php\n\n?>
<<<<<<< Updated upstream
=======

<?php
// app/controllers/admin/OrderController.php

class OrderController extends BaseController
{
    private $orderRepository;
    private $orderItemRepository;
    private $authService;
    
    public function __construct()
    {
        $this->orderRepository = new OrderRepository();
        $this->orderItemRepository = new OrderItemRepository();
        $this->authService = new AuthService();
        
        // Check if user is admin
        if (!$this->authService->isAdmin()) {
            header('Location: /login');
            exit;
        }
    }
    
    // Show all orders
    public function index()
    {
        $status = isset($_GET['status']) ? $_GET['status'] : null;
        $orders = $this->orderRepository->getAll($status);
        
        $this->render('admin/orders/index', [
            'pageTitle' => 'Manage Orders',
            'orders' => $orders,
            'currentStatus' => $status
        ], 'admin');
    }
    
    // Show single order details
    public function show($orderId)
    {
        $order = $this->orderRepository->getById($orderId);
        
        if (!$order) {
            $_SESSION['admin_error'] = 'Order not found.';
            $this->redirect('/admin/orders');
            return;
        }
        
        $orderItems = $this->orderItemRepository->getByOrderId($orderId);
        
        $this->render('admin/orders/show', [
            'pageTitle' => 'Order #' . $order['order_number'],
            'order' => $order,
            'orderItems' => $orderItems
        ], 'admin');
    }
    
    // Update order status
    public function updateStatus($orderId)
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/admin/orders/' . $orderId);
            return;
        }
        
        $status = $_POST['status'] ?? '';
        
        if (empty($status)) {
            $_SESSION['admin_error'] = 'Please select a status.';
            $this->redirect('/admin/orders/' . $orderId);
            return;
        }
        
        $result = $this->orderRepository->updateStatus($orderId, $status);
        
        if ($result) {
            $_SESSION['admin_success'] = 'Order status updated successfully.';
        } else {
            $_SESSION['admin_error'] = 'Failed to update order status.';
        }
        
        $this->redirect('/admin/orders/' . $orderId);
    }
}
>>>>>>> Stashed changes
