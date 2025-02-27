<!DOCTYPE html>
<html lang="zxx" class="no-js">
<head>
    <!-- Mobile Specific Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon-->
    <link rel="shortcut icon" href="/assets/img/fav.png">
    <!-- Author Meta -->
    <meta name="author" content="CodePixar">
    <!-- Meta Description -->
    <meta name="description" content="">
    <!-- Meta Keyword -->
    <meta name="keywords" content="">
    <!-- meta character set -->
    <meta charset="UTF-8">
    <!-- Site Title -->
    <title><?= $pageTitle ?? 'Karma Shop' ?></title>

    <!--
    CSS
    ============================================= -->
    <link rel="stylesheet" href="/assets/css/linearicons.css">
    <link rel="stylesheet" href="/assets/css/owl.carousel.css">
    <link rel="stylesheet" href="/assets/css/themify-icons.css">
    <link rel="stylesheet" href="/assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="/assets/css/nice-select.css">
    <link rel="stylesheet" href="/assets/css/nouislider.min.css">
    <link rel="stylesheet" href="/assets/css/bootstrap.css">
    <link rel="stylesheet" href="/assets/css/main.css">
    <?php if (isset($extraCss)): ?>
        <?php foreach ($extraCss as $css): ?>
            <link rel="stylesheet" href="<?= $css ?>">
        <?php endforeach; ?>
    <?php endif; ?>
</head>

<body class="<?= $bodyClass ?? '' ?>">

    <!-- Start Header Area -->
    <?php include 'app/views/components/shop/header.php'; ?>
    <!-- End Header Area -->

    <?php if (isset($showBreadcrumb) && $showBreadcrumb): ?>
    <!-- Start Banner Area -->
    <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1><?= $pageTitle ?? 'Shop' ?></h1>
                    <nav class="d-flex align-items-center">
                        <a href="/">Home<span class="lnr lnr-arrow-right"></span></a>
                        <?php if (isset($breadcrumb)): ?>
                            <?php foreach ($breadcrumb as $link => $title): ?>
                                <?php if ($link === '#'): ?>
                                    <a href="#"><?= $title ?></a>
                                <?php else: ?>
                                    <a href="<?= $link ?>"><?= $title ?><span class="lnr lnr-arrow-right"></span></a>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- End Banner Area -->
    <?php endif; ?>

    <!-- Main Content -->
    <?= $content ?? '' ?>
    <!-- End Main Content -->

    <!-- Start footer Area -->
    <?php include 'app/views/components/shop/footer.php'; ?>
    <!-- End footer Area -->

    <script src="/assets/js/vendor/jquery-2.2.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="/assets/js/vendor/bootstrap.min.js"></script>
    <script src="/assets/js/jquery.ajaxchimp.min.js"></script>
    <script src="/assets/js/jquery.nice-select.min.js"></script>
    <script src="/assets/js/jquery.sticky.js"></script>
    <script src="/assets/js/nouislider.min.js"></script>
    <script src="/assets/js/jquery.magnific-popup.min.js"></script>
    <script src="/assets/js/owl.carousel.min.js"></script>
    <!--gmaps Js-->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjCGmQ0Uq4exrzdcL6rvxywDDOvfAu6eE"></script>
    <script src="/assets/js/gmaps.min.js"></script>
    <script src="/assets/js/main.js"></script>
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