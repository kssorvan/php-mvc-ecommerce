<?php\n// \app\helpers\FileUploadHelper.php\n\n?>
<?php
// app/helpers/FileUploadHelper.php

class FileUploadHelper
{
    // Upload an image file
    public function uploadImage($file, $directory = 'assets/images/')
    {
        // Check if file has a name (was uploaded)
        if (empty($file['name'])) {
            return false;
        }
        
        // Generate a unique filename
        $filename = $this->generateUniqueFilename($file['name']);
        
        // Ensure the directory exists
        if (!is_dir($directory)) {
            mkdir($directory, 0755, true);
        }
        
        // Create full path
        $path = $directory . $filename;
        
        // Move uploaded file
        if (move_uploaded_file($file['tmp_name'], $path)) {
            return $filename;
        }
        
        return false;
    }
    
    // Generate a unique filename to prevent overwriting files
    private function generateUniqueFilename($original_filename)
    {
        $extension = pathinfo($original_filename, PATHINFO_EXTENSION);
        $filename = rand(1, 99999) . '_' . time() . '.' . $extension;
        
        return $filename;
    }
    
    // Delete a file
    public function deleteFile($filename, $directory = 'assets/images/')
    {
        $path = $directory . $filename;
        
        if (file_exists($path)) {
            return unlink($path);
        }
        
        return false;
    }
}