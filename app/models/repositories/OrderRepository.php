<?php\n// \app\models\repositories\OrderRepository.php\n\n?>
<<<<<<< Updated upstream
=======
<?php
// app/models/repositories/OrderRepository.php

class OrderRepository
{
    private $db;
    
    public function __construct()
    {
        $this->db = DatabaseHelper::getInstance()->getConnection();
    }
    
    // Create a new order
    public function create($data)
    {
        $sql = "INSERT INTO orders (
                order_number, user_id, status, customer_name, customer_email, 
                customer_phone, shipping_address, shipping_city, shipping_state, 
                shipping_postcode, shipping_country, notes, payment_method, 
                subtotal, discount, total, created_at
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $this->db->prepare($sql);
        
        $stmt->bind_param(
            'sisssssssssssddds',
            $data['order_number'],
            $data['user_id'],
            $data['status'],
            $data['customer_name'],
            $data['customer_email'],
            $data['customer_phone'],
            $data['shipping_address'],
            $data['shipping_city'],
            $data['shipping_state'],
            $data['shipping_postcode'],
            $data['shipping_country'],
            $data['notes'],
            $data['payment_method'],
            $data['subtotal'],
            $data['discount'],
            $data['total'],
            $data['created_at']
        );
        
        $stmt->execute();
        
        return $this->db->insert_id;
    }
    
    // Get order by ID
    public function getById($id)
    {
        $sql = "SELECT * FROM orders WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
    
    // Get recent orders by user ID
    public function getRecentByUserId($userId, $limit = 5)
    {
        $sql = "SELECT * FROM orders WHERE user_id = ? ORDER BY created_at DESC LIMIT ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('ii', $userId, $limit);
        $stmt->execute();
        
        $result = $stmt->get_result();
        
        $orders = [];
        while ($row = $result->fetch_assoc()) {
            $orders[] = $row;
        }
        
        return $orders;
    }
    
    // Get all orders by user ID
    public function getAllByUserId($userId)
    {
        $sql = "SELECT * FROM orders WHERE user_id = ? ORDER BY created_at DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('i', $userId);
        $stmt->execute();
        
        $result = $stmt->get_result();
        
        $orders = [];
        while ($row = $result->fetch_assoc()) {
            $orders[] = $row;
        }
        
        return $orders;
    }
    
    // Get order by ID and user ID
    public function getByIdAndUserId($id, $userId)
    {
        $sql = "SELECT * FROM orders WHERE id = ? AND user_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('ii', $id, $userId);
        $stmt->execute();
        
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
    
    // Update order status
    public function updateStatus($id, $status)
    {
        $sql = "UPDATE orders SET status = ? WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('si', $status, $id);
        
        return $stmt->execute();
    }
}
>>>>>>> Stashed changes
