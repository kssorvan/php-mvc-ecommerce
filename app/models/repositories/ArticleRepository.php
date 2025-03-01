<?php
// app/models/repositories/ArticleRepository.php

class ArticleRepository
{
    private $db;
    
    public function __construct()
    {
        $this->db = DatabaseHelper::getInstance()->getConnection();
    }
    
    // Get all articles/blog posts
    public function getAll($categoryId = null, $limit = null, $page = 1)
    {
        $sql = "SELECT a.*, c.name as category_name, u.username as author_name 
                FROM articles a
                LEFT JOIN article_categories c ON a.category_id = c.id
                LEFT JOIN users u ON a.author_id = u.id
                WHERE a.status = 'published'";
        
        $params = [];
        
        if ($categoryId) {
            $sql .= " AND a.category_id = ?";
            $params[] = $categoryId;
        }
        
        $sql .= " ORDER BY a.created_at DESC";
        
        if ($limit) {
            $offset = ($page - 1) * $limit;
            $sql .= " LIMIT ?, ?";
            $params[] = $offset;
            $params[] = $limit;
        }
        
        $stmt = $this->db->prepare($sql);
        
        if (!empty($params)) {
            $types = str_repeat('i', count($params));
            $stmt->bind_param($types, ...$params);
        }
        
        $stmt->execute();
        $result = $stmt->get_result();
        
        $articles = [];
        while ($row = $result->fetch_assoc()) {
            $articles[] = $row;
        }
        
        return $articles;
    }
    
    // Get a specific article by ID
    public function getById($id)
    {
        $sql = "SELECT a.*, c.name as category_name, u.username as author_name 
                FROM articles a
                LEFT JOIN article_categories c ON a.category_id = c.id
                LEFT JOIN users u ON a.author_id = u.id
                WHERE a.id = ? AND a.status = 'published'";
                
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
    
    // Get recent articles
    public function getRecent($limit = 5)
    {
        $sql = "SELECT a.*, c.name as category_name
                FROM articles a
                LEFT JOIN article_categories c ON a.category_id = c.id
                WHERE a.status = 'published'
                ORDER BY a.created_at DESC
                LIMIT ?";
                
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('i', $limit);
        $stmt->execute();
        
        $result = $stmt->get_result();
        
        $articles = [];
        while ($row = $result->fetch_assoc()) {
            $articles[] = $row;
        }
        
        return $articles;
    }
    
    // Get related articles
    public function getRelated($categoryId, $excludeId, $limit = 3)
    {
        $sql = "SELECT a.*, c.name as category_name
                FROM articles a
                LEFT JOIN article_categories c ON a.category_id = c.id
                WHERE a.status = 'published' 
                  AND a.category_id = ? 
                  AND a.id != ?
                ORDER BY RAND()
                LIMIT ?";
                
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('iii', $categoryId, $excludeId, $limit);
        $stmt->execute();
        
        $result = $stmt->get_result();
        
        $articles = [];
        while ($row = $result->fetch_assoc()) {
            $articles[] = $row;
        }
        
        return $articles;
    }
    
    // Get all article categories
    public function getCategories()
    {
        $sql = "SELECT c.*, COUNT(a.id) as article_count
                FROM article_categories c
                LEFT JOIN articles a ON c.id = a.category_id AND a.status = 'published'
                GROUP BY c.id
                ORDER BY c.name";
                
        $result = $this->db->query($sql);
        
        $categories = [];
        while ($row = $result->fetch_assoc()) {
            $categories[] = $row;
        }
        
        return $categories;
    }
    
    // Get comments for an article
    public function getComments($articleId)
    {
        $sql = "SELECT * FROM article_comments 
                WHERE article_id = ? AND status = 'approved'
                ORDER BY created_at DESC";
                
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('i', $articleId);
        $stmt->execute();
        
        $result = $stmt->get_result();
        
        $comments = [];
        while ($row = $result->fetch_assoc()) {
            $comments[] = $row;
        }
        
        return $comments;
    }
    
    // Add a comment to an article
    public function addComment($articleId, $name, $email, $comment, $status = 'pending')
    {
        $sql = "INSERT INTO article_comments (article_id, name, email, comment, status, created_at)
                VALUES (?, ?, ?, ?, ?, NOW())";
                
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('issss', $articleId, $name, $email, $comment, $status);
        
        return $stmt->execute();
    }
}