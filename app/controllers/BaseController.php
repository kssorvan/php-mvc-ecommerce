<?php\n// \app\controllers\BaseController.php\n\n?>
<?php
class BaseController
{
    /**
     * Render a view with data
     *
     * @param string $view Path to the view file
     * @param array $data Data to pass to the view
     * @param string $layout Layout to use (default: main)
     * @return void
     */
    protected function render($view, $data = [], $layout = 'main')
    {
        // Extract data into variables
        extract($data);
        
        // Start output buffering
        ob_start();
        
        // Include the view file
        include APP_PATH . "app/views/{$view}.php";
        
        // Get the view content
        $content = ob_get_clean();
        
        // Include the layout with the content
        include APP_PATH . "app/views/layouts/{$layout}.php";
    }
    
    /**
     * Redirect to a URL
     *
     * @param string $url URL to redirect to
     * @return void
     */
    protected function redirect($url)
    {
        header("Location: {$url}");
        exit;
    }
    
    /**
     * Return a JSON response
     *
     * @param array $data Data to return as JSON
     * @param int $status HTTP status code
     * @return void
     */
    protected function json($data, $status = 200)
    {
        http_response_code($status);
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }
}