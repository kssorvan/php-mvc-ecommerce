<?php
class LogoController extends BaseController
{
    private $logoRepository;
    private $fileHelper;
    
    public function __construct()
    {
        $this->logoRepository = new LogoRepository();
        $this->fileHelper = new FileUploadHelper();
    }
    
    public function index()
    {
        $logos = $this->logoRepository->getAll();
        $this->render('admin/logo/view', [
            'pageTitle' => 'All Logos',
            'logos' => $logos
        ], 'admin');
    }
    
    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $status = $_POST['status'];
            $thumbnail = $_FILES['thumbnail'];
            
            if (!empty($status) && !empty($thumbnail['name'])) {
                $filename = $this->fileHelper->uploadImage($thumbnail, 'assets/images/admin/');
                
                if ($filename) {
                    $result = $this->logoRepository->add($status, $filename);
                    
                    if ($result) {
                        // Redirect with success message
                        header('Location: /admin/logo?success=Logo added successfully');
                        exit;
                    }
                }
            }
            
            // If we get here, there was an error
            $this->render('admin/logo/add', [
                'pageTitle' => 'Add Logo',
                'error' => 'Failed to add logo'
            ], 'admin');
            return;
        }
        
        $this->render('admin/logo/add', [
            'pageTitle' => 'Add Logo'
        ], 'admin');
    }
    
    public function update($id)
    {
        $logo = $this->logoRepository->getById($id);
        
        if (!$logo) {
            // Logo not found, redirect
            header('Location: /admin/logo');
            exit;
        }
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $status = $_POST['status'];
            $thumbnail = $_FILES['thumbnail'];
            $oldThumbnail = $_POST['old_thumbnail'];
            
            $filename = $oldThumbnail;
            if (!empty($thumbnail['name'])) {
                $filename = $this->fileHelper->uploadImage($thumbnail, 'assets/images/admin/');
                if (!$filename) {
                    $filename = $oldThumbnail;
                }
            }
            
            if (!empty($status)) {
                $result = $this->logoRepository->update($id, $status, $filename);
                
                if ($result) {
                    // Redirect with success message
                    header('Location: /admin/logo?success=Logo updated successfully');
                    exit;
                }
            }
            
            // If we get here, there was an error
            $this->render('admin/logo/update', [
                'pageTitle' => 'Update Logo',
                'error' => 'Failed to update logo',
                'logo' => $logo
            ], 'admin');
            return;
        }
        
        $this->render('admin/logo/update', [
            'pageTitle' => 'Update Logo',
            'logo' => $logo
        ], 'admin');
    }
    
    public function delete()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['remove_id'])) {
            $id = $_POST['remove_id'];
            $result = $this->logoRepository->delete($id);
            
            if ($result) {
                // Return success response
                echo json_encode(['success' => true, 'message' => 'Logo deleted successfully']);
                exit;
            }
        }
        
        // If we get here, there was an error
        echo json_encode(['success' => false, 'message' => 'Failed to delete logo']);
    }
}