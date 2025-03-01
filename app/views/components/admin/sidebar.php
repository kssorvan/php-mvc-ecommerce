<?php\n// \app\views\components\admin\sidebar.php\n\n?>
<nav id="sidebar">
    <div class="sidebar-header">
        <h3>Karma Admin</h3>
    </div>

    <ul class="list-unstyled components">
        <li class="<?= ($currentPage ?? '') === 'dashboard' ? 'active' : '' ?>">
            <a href="/admin/dashboard">
                <i class="fas fa-tachometer-alt"></i> Dashboard
            </a>
        </li>
        <li>
            <a href="#productSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                <i class="fas fa-box"></i> Products
            </a>
            <ul class="collapse list-unstyled <?= in_array($currentPage ?? '', ['products', 'add-product', 'edit-product']) ? 'show' : '' ?>" id="productSubmenu">
                <li class="<?= ($currentPage ?? '') === 'products' ? 'active' : '' ?>">
                    <a href="/admin/products">All Products</a>
                </li>
                <li class="<?= ($currentPage ?? '') === 'add-product' ? 'active' : '' ?>">
                    <a href="/admin/products/add">Add New</a>
                </li>
                <li class="<?= ($currentPage ?? '') === 'categories' ? 'active' : '' ?>">
                    <a href="/admin/categories">Categories</a>
                </li>
            </ul>
        </li>
        <li class="<?= ($currentPage ?? '') === 'orders' ? 'active' : '' ?>">
            <a href="/admin/orders">
                <i class="fas fa-shopping-cart"></i> Orders
            </a>
        </li>
        <li class="<?= ($currentPage ?? '') === 'customers' ? 'active' : '' ?>">
            <a href="/admin/customers">
                <i class="fas fa-users"></i> Customers
            </a>
        </li>
        <li>
            <a href="#siteSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                <i class="fas fa-cog"></i> Site Settings
            </a>
            <ul class="collapse list-unstyled <?= in_array($currentPage ?? '', ['logo', 'about', 'follow', 'news']) ? 'show' : '' ?>" id="siteSubmenu">
                <li class="<?= ($currentPage ?? '') === 'logo' ? 'active' : '' ?>">
                    <a href="/admin/logo">Logo</a>
                </li>
                <li class="<?= ($currentPage ?? '') === 'about' ? 'active' : '' ?>">
                    <a href="/admin/about">About Us</a>
                </li>
                <li class="<?= ($currentPage ?? '') === 'follow' ? 'active' : '' ?>">
                    <a href="/admin/follow">Follow Us</a>
                </li>
                <li class="<?= ($currentPage ?? '') === 'news' ? 'active' : '' ?>">
                    <a href="/admin/news">News</a>
                </li>
            </ul>
        </li>
        <li class="<?= ($currentPage ?? '') === 'feedback' ? 'active' : '' ?>">
            <a href="/admin/feedback">
                <i class="fas fa-comments"></i> Feedback
            </a>
        </li>
        <li class="<?= ($currentPage ?? '') === 'reports' ? 'active' : '' ?>">
            <a href="/admin/reports">
                <i class="fas fa-chart-bar"></i> Reports
            </a>
        </li>
        <li class="<?= ($currentPage ?? '') === 'profile' ? 'active' : '' ?>">
            <a href="/admin/profile">
                <i class="fas fa-user"></i> Profile
            </a>
        </li>
    </ul>
</nav>