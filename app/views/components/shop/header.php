<?php
// Instantiate the CartService to get the cart count
$cartService = new CartService();
$cartCount = $cartService->getCount();
?>

<header class="header_area sticky-header">
    <div class="main_menu">
        <nav class="navbar navbar-expand-lg navbar-light main_box">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <a class="navbar-brand logo_h" href="/"><img src="/assets/img/logo.png" alt=""></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                    <ul class="nav navbar-nav menu_nav ml-auto">
                        <li class="nav-item <?= ($currentPage ?? '') === 'home' ? 'active' : '' ?>">
                            <a class="nav-link" href="/">Home</a>
                        </li>
                        <li class="nav-item submenu dropdown <?= in_array($currentPage ?? '', ['shop', 'product', 'cart', 'checkout']) ? 'active' : '' ?>">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                                aria-expanded="false">Shop</a>
                            <ul class="dropdown-menu">
                                <li class="nav-item <?= ($currentPage ?? '') === 'shop' ? 'active' : '' ?>">
                                    <a class="nav-link" href="/shop">Shop Category</a>
                                </li>
                                <li class="nav-item <?= ($currentPage ?? '') === 'product' ? 'active' : '' ?>">
                                    <a class="nav-link" href="/shop/product/1">Product Details</a>
                                </li>
                                <li class="nav-item <?= ($currentPage ?? '') === 'checkout' ? 'active' : '' ?>">
                                    <a class="nav-link" href="/checkout">Product Checkout</a>
                                </li>
                                <li class="nav-item <?= ($currentPage ?? '') === 'cart' ? 'active' : '' ?>">
                                    <a class="nav-link" href="/cart">Shopping Cart</a>
                                </li>
                                <li class="nav-item <?= ($currentPage ?? '') === 'confirmation' ? 'active' : '' ?>">
                                    <a class="nav-link" href="/confirmation">Confirmation</a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item submenu dropdown <?= in_array($currentPage ?? '', ['blog', 'blog-detail']) ? 'active' : '' ?>">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                                aria-expanded="false">Blog</a>
                            <ul class="dropdown-menu">
                                <li class="nav-item <?= ($currentPage ?? '') === 'blog' ? 'active' : '' ?>">
                                    <a class="nav-link" href="/blog">Blog</a>
                                </li>
                                <li class="nav-item <?= ($currentPage ?? '') === 'blog-detail' ? 'active' : '' ?>">
                                    <a class="nav-link" href="/blog/1">Blog Details</a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item submenu dropdown <?= in_array($currentPage ?? '', ['login', 'tracking', 'elements']) ? 'active' : '' ?>">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                                aria-expanded="false">Pages</a>
                            <ul class="dropdown-menu">
                                <li class="nav-item <?= ($currentPage ?? '') === 'login' ? 'active' : '' ?>">
                                    <a class="nav-link" href="/login">Login</a>
                                </li>
                                <li class="nav-item <?= ($currentPage ?? '') === 'tracking' ? 'active' : '' ?>">
                                    <a class="nav-link" href="/tracking">Tracking</a>
                                </li>
                                <li class="nav-item <?= ($currentPage ?? '') === 'elements' ? 'active' : '' ?>">
                                    <a class="nav-link" href="/elements">Elements</a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item <?= ($currentPage ?? '') === 'contact' ? 'active' : '' ?>">
                            <a class="nav-link" href="/contact">Contact</a>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="nav-item">
                            <a href="/cart" class="cart">
                                <span class="ti-bag"></span>
                                <?php if ($cartCount > 0): ?>
                                    <span class="cart-count"><?= $cartCount ?></span>
                                <?php endif; ?>
                            </a>
                        </li>
                        <li class="nav-item">
                            <button class="search"><span class="lnr lnr-magnifier" id="search"></span></button>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <div class="search_input" id="search_input_box">
        <div class="container">
            <form class="d-flex justify-content-between" action="/search" method="GET">
                <input type="text" class="form-control" id="search_input" name="q" placeholder="Search Here">
                <button type="submit" class="btn"></button>
                <span class="lnr lnr-cross" id="close_search" title="Close Search"></span>
            </form>
        </div>
    </div>
</header>

