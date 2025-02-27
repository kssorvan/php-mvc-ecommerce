<?php
class LogoRepository
{
    private $db;
    
    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }
    
    public function getAll()
    {
        $sql = "SELECT * FROM `logo` ORDER BY `id` DESC";
        $result = $this->db->query($sql);
        
        $logos = [];
        while ($row = $result->fetch_assoc()) {
            $logos[] = $row;
        }
        
        return $logos;
    }
    
    public function getById($id)
    {
        $sql = "SELECT * FROM `logo` WHERE `id` = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
    
    public function add($status, $thumbnail)
    {
        $sql = "INSERT INTO `logo` (`status`, `thumbnail`) VALUES (?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("ss", $status, $thumbnail);
        
        return $stmt->execute();
    }
    
    public function update($id, $status, $thumbnail)
    {
        $sql = "UPDATE `logo` SET `status` = ?, `thumbnail` = ? WHERE `id` = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("ssi", $status, $thumbnail, $id);
        
        return $stmt->execute();
    }
    
    public function delete($id)
    {
        $sql = "DELETE FROM `logo` WHERE `id` = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $id);
        
        return $stmt->execute();
    }
}