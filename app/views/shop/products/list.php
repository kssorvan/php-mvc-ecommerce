<div class="container">
    <div class="row">
        <div class="col-xl-3 col-lg-4 col-md-5">
            <!-- Sidebar Categories -->
            <div class="sidebar-categories">
                <div class="head">Browse Categories</div>
                <ul class="main-categories">
                    <?php foreach ($categories as $category): ?>
                    <li class="main-nav-list">
                        <a href="/shop/category/<?= $category['id'] ?>" class="<?= ($selectedCategory == $category['id']) ? 'active' : '' ?>">
                            <span class="lnr lnr-arrow-right"></span>
                            <?= htmlspecialchars($category['name']) ?>
                            <span class="number">(<?= $category['product_count'] ?>)</span>
                        </a>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            
            <!-- Filters section from original template -->
            <div class="sidebar-filter mt-50">
                <!-- Add filters here -->
            </div>
        </div>
        
        <div class="col-xl-9 col-lg-8 col-md-7">
            <!-- Filter bar from original template -->
            <div class="filter-bar d-flex flex-wrap align-items-center">
                <!-- Add filter options here -->
            </div>
            
            <!-- Product List -->
            <section class="lattest-product-area pb-40 category-list">
                <div class="row">
                    <?php if (empty($products)): ?>
                    <div class="col-12">
                        <div class="alert alert-info">No products found.</div>
                    </div>
                    <?php else: ?>
                        <?php foreach ($products as $product): ?>
                        <div class="col-lg-4 col-md-6">
                            <div class="single-product">
                                <img class="img-fluid" src="/assets/img/product/<?= htmlspecialchars($product['image']) ?>" alt="">
                                <div class="product-details">
                                    <h6><?= htmlspecialchars($product['name']) ?></h6>
                                    <div class="price">
                                        <h6>$<?= number_format($product['price'], 2) ?></h6>
                                        <?php if ($product['old_price']): ?>
                                        <h6 class="l-through">$<?= number_format($product['old_price'], 2) ?></h6>
                                        <?php endif; ?>
                                    </div>
                                    <div class="prd-bottom">
                                        <a href="/cart/add/<?= $product['id'] ?>" class="social-info">
                                            <span class="ti-bag"></span>
                                            <p class="hover-text">add to bag</p>
                                        </a>
                                        <a href="/wishlist/add/<?= $product['id'] ?>" class="social-info">
                                            <span class="lnr lnr-heart"></span>
                                            <p class="hover-text">Wishlist</p>
                                        </a>
                                        <a href="/compare/add/<?= $product['id'] ?>" class="social-info">
                                            <span class="lnr lnr-sync"></span>
                                            <p class="hover-text">compare</p>
                                        </a>
                                        <a href="/shop/product/<?= $product['id'] ?>" class="social-info">
                                            <span class="lnr lnr-move"></span>
                                            <p class="hover-text">view more</p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </section>
            
            <!-- Pagination from original template if needed -->
        </div>
    </div>
</div>