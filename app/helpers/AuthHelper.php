<?php\n// \app\helpers\AuthHelper.php\n\n?>

<?php
// app/helpers/AuthHelper.php

class AuthHelper
{
    private $db;
    
    public function __construct()
    {
        $this->db = DatabaseHelper::getInstance()->getConnection();
    }
    
    // Register a new user
    public function register($username, $email, $password, $profile)
    {
        // Validate input
        if (empty($username) || empty($email) || empty($password) || empty($profile['name'])) {
            return [
                'success' => false,
                'message' => 'All fields are required'
            ];
        }
        
        // Hash password
        $hashed_password = md5($password); // Consider using password_hash() for better security
        
        // Handle file upload
        $fileHelper = new FileUploadHelper();
        $profile_filename = $fileHelper->uploadImage($profile, 'assets/images/users/');
        
        if (!$profile_filename) {
            return [
                'success' => false,
                'message' => 'Failed to upload profile image'
            ];
        }
        
        // Insert user into database
        $sql = "INSERT INTO `user` (`username`, `email`, `password`, `profile`) 
                VALUES (?, ?, ?, ?)";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("ssss", $username, $email, $hashed_password, $profile_filename);
        
        if ($stmt->execute()) {
            return [
                'success' => true,
                'message' => 'Registration successful'
            ];
        }
        
        return [
            'success' => false,
            'message' => 'Registration failed: ' . $this->db->error
        ];
    }
    
    // Login a user
    public function login($name_email, $password)
    {
        // Validate input
        if (empty($name_email) || empty($password)) {
            return [
                'success' => false,
                'message' => 'Username/email and password are required'
            ];
        }
        
        // Hash password for comparison
        $hashed_password = md5($password); // Consider using password_verify() for better security
        
        // Query database
        $sql = "SELECT * FROM `user` WHERE (`email` = ? OR `username` = ?) AND `password` = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("sss", $name_email, $name_email, $hashed_password);
        $stmt->execute();
        
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            
            // Set session
            $_SESSION['user'] = $user['id'];
            
            return [
                'success' => true,
                'message' => 'Login successful',
                'user' => $user
            ];
        }
        
        return [
            'success' => false,
            'message' => 'Invalid username/email or password'
        ];
    }
    
    // Check if user is logged in
    public function isLoggedIn()
    {
        return isset($_SESSION['user']);
    }
    
    // Logout the user
    public function logout()
    {
        unset($_SESSION['user']);
        session_destroy();
    }
}