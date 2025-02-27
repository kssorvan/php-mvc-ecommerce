<?php\n// \app\helpers\DatabaseHelper.php\n\n?>
<?php
// app/helpers/DatabaseHelper.php

<?php
class DatabaseHelper
{
    private static $instance = null;
    private $connection;
    
    /**
     * Private constructor - use initialize() and getInstance() instead
     */
    private function __construct($config)
    {
        $this->connection = new mysqli(
            $config['host'],
            $config['username'],
            $config['password'],
            $config['database']
        );
        
        if ($this->connection->connect_error) {
            die("Database connection failed: " . $this->connection->connect_error);
        }
        
        $this->connection->set_charset($config['charset']);
    }
    
    /**
     * Initialize the database connection
     *
     * @param array $config Database configuration
     * @return void
     */
    public static function initialize($config)
    {
        if (self::$instance === null) {
            self::$instance = new self($config);
        }
    }
    
    /**
     * Get the database helper instance
     *
     * @return DatabaseHelper
     */
    public static function getInstance()
    {
        if (self::$instance === null) {
            throw new Exception("Database connection not initialized. Call initialize() first.");
        }
        
        return self::$instance;
    }
    
    /**
     * Get the database connection
     *
     * @return mysqli
     */
    public function getConnection()
    {
        return $this->connection;
    }
    
    /**
     * Execute a query
     *
     * @param string $sql SQL query
     * @return mysqli_result|bool
     */
    public function query($sql)
    {
        return $this->connection->query($sql);
    }
    
    /**
     * Prepare a statement
     *
     * @param string $sql SQL query
     * @return mysqli_stmt
     */
    public function prepare($sql)
    {
        return $this->connection->prepare($sql);
    }
    
    /**
     * Get the last inserted ID
     *
     * @return int
     */
    public function getLastId()
    {
        return $this->connection->insert_id;
    }
}