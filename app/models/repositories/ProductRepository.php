<?php\n// \app\models\repositories\ProductRepository.php\n\n?>
<?php
// app/models/repositories/ProductRepository.php

// class ProductRepository
// {
//     private $db;
    
//     public function __construct()
//     {
//         $this->db = DatabaseHelper::getInstance()->getConnection();
//     }
    
//     public function getAll($categoryId = null)
//     {
//         $sql = "SELECT * FROM products WHERE 1";
        
//         if ($categoryId) {
//             $sql .= " AND category_id = ?";
//             $stmt = $this->db->prepare($sql);
//             $stmt->bind_param("i", $categoryId);
//         } else {
//             $stmt = $this->db->prepare($sql);
//         }
        
//         $stmt->execute();
//         $result = $stmt->get_result();
        
//         $products = [];
//         while ($row = $result->fetch_assoc()) {
//             $products[] = $row;
//         }
        
//         return $products;
//     }
    
//     public function getById($id)
//     {
//         $sql = "SELECT * FROM products WHERE id = ?";
//         $stmt = $this->db->prepare($sql);
//         $stmt->bind_param("i", $id);
//         $stmt->execute();
        
//         $result = $stmt->get_result();
//         return $result->fetch_assoc();
//     }
    
//     public function getRelated($product)
//     {
//         $sql = "SELECT * FROM products WHERE category_id = ? AND id != ? LIMIT 4";
//         $stmt = $this->db->prepare($sql);
//         $stmt->bind_param("ii", $product['category_id'], $product['id']);
//         $stmt->execute();
        
//         $result = $stmt->get_result();
        
//         $products = [];
//         while ($row = $result->fetch_assoc()) {
//             $products[] = $row;
//         }
        
//         return $products;
//     }
// }

<?php
// app/models/repositories/ProductRepository.php

class ProductRepository
{
    private $db;
    
    public function __construct()
    {
        $this->db = DatabaseHelper::getInstance()->getConnection();
    }
    
    // public function getAll($categoryId = null)
    // {
    //     $sql = "SELECT p.*, c.name as category_name 
    //             FROM products p
    //             JOIN categories c ON p.category_id = c.id
    //             WHERE 1=1";
        
    //     $params = [];
        
    //     if ($categoryId) {
    //         $sql .= " AND p.category_id = ?";
    //         $params[] = $categoryId;
    //     }
        
    //     $sql .= " ORDER BY p.created_at DESC";
        
    //     $stmt = $this->db->prepare($sql);
        
    //     if (!empty($params)) {
    //         $types = str_repeat('i', count($params));
    //         $stmt->bind_param($types, ...$params);
    //     }
        
    //     $stmt->execute();
    //     $result = $stmt->get_result();
        
    //     $products = [];
    //     while ($row = $result->fetch_assoc()) {
    //         $products[] = $row;
    //     }
        
    //     return $products;
    // }
    public function getAll($categoryId = null)
    {
        $sql = "SELECT p.*, c.name as category_name 
                FROM products p
                JOIN categories c ON p.category_id = c.id
                WHERE 1=1";
        
        $params = [];
        
        if ($categoryId) {
            $sql .= " AND p.category_id = ?";
            $params[] = $categoryId;
        }
        
        $sql .= " ORDER BY p.created_at DESC";
        
        $stmt = $this->db->prepare($sql);
        
        if (!empty($params)) {
            $types = str_repeat('i', count($params));
            $stmt->bind_param($types, ...$params);
        }
        
        $stmt->execute();
        $result = $stmt->get_result();
        
        $products = [];
        while ($row = $result->fetch_assoc()) {
            $products[] = $row;
        }
        
        return $products;
    }
    
    public function getById($id)
    {
        $sql = "SELECT p.*, c.name as category_name 
                FROM products p
                JOIN categories c ON p.category_id = c.id
                WHERE p.id = ?";
                
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
    
    public function getRelated($categoryId, $excludeId, $limit = 4)
    {
        $sql = "SELECT p.*, c.name as category_name 
                FROM products p
                JOIN categories c ON p.category_id = c.id
                WHERE p.category_id = ? AND p.id != ?
                ORDER BY RAND()
                LIMIT ?";
                
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('iii', $categoryId, $excludeId, $limit);
        $stmt->execute();
        
        $result = $stmt->get_result();
        
        $products = [];
        while ($row = $result->fetch_assoc()) {
            $products[] = $row;
        }
        
        return $products;
    }
}