<?php\n// \routes\admin.php\n\n?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle ?? 'Admin Dashboard' ?> - Karma Shop</title>
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- Admin styles -->
    <link rel="stylesheet" href="/assets/css/admin.css">
    
    <?php if (isset($extraCss)): ?>
        <?php foreach ($extraCss as $css): ?>
            <link rel="stylesheet" href="<?= $css ?>">
        <?php endforeach; ?>
    <?php endif; ?>
</head>
<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <?php include 'app/views/components/admin/sidebar.php'; ?>
        
        <!-- Page Content -->
        <div id="content">
            <!-- Top Navbar -->
            <?php include 'app/views/components/admin/header.php'; ?>
            
            <!-- Main Content -->
            <div class="container-fluid">
                <?php if (isset($_SESSION['admin_success'])): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?= htmlspecialchars($_SESSION['admin_success']) ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php unset($_SESSION['admin_success']); ?>
                <?php endif; ?>
                
                <?php if (isset($_SESSION['admin_error'])): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?= htmlspecialchars($_SESSION['admin_error']) ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php unset($_SESSION['admin_error']); ?>
                <?php endif; ?>
                
                <?= $content ?? '' ?>
            </div>
            
            <!-- Footer -->
            <?php include 'app/views/components/admin/footer.php'; ?>
        </div>
    </div>

    <!-- jQuery -->
    <script src="/assets/js/vendor/jquery-2.2.4.min.js"></script>
    <!-- Popper.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="/assets/js/bootstrap.min.js"></script>
    
    <?php if (isset($extraJs)): ?>
        <?php foreach ($extraJs as $js): ?>
            <script src="<?= $js ?>"></script>
        <?php endforeach; ?>
    <?php endif; ?>
    
    <?php if (isset($inlineJs)): ?>
        <script>
            <?= $inlineJs ?>
        </script>
    <?php endif; ?>
</body>
</html>