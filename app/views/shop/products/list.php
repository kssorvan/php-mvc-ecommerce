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
                            <span class="number">(<?= $category['product_count'] ?? 0 ?>)</span>
                        </a>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            
            <!-- Filters section -->
            <div class="sidebar-filter mt-50">
                <div class="top-filter-head">Product Filters</div>
                <div class="common-filter">
                    <div class="head">Brands</div>
                    <form action="#">
                        <ul>
                            <li class="filter-list"><input class="pixel-radio" type="radio" id="apple" name="brand"><label for="apple">Apple<span>(29)</span></label></li>
                            <li class="filter-list"><input class="pixel-radio" type="radio" id="asus" name="brand"><label for="asus">Asus<span>(29)</span></label></li>
                            <li class="filter-list"><input class="pixel-radio" type="radio" id="gionee" name="brand"><label for="gionee">Gionee<span>(19)</span></label></li>
                            <li class="filter-list"><input class="pixel-radio" type="radio" id="micromax" name="brand"><label for="micromax">Micromax<span>(19)</span></label></li>
                            <li class="filter-list"><input class="pixel-radio" type="radio" id="samsung" name="brand"><label for="samsung">Samsung<span>(19)</span></label></li>
                        </ul>
                    </form>
                </div>
                <div class="common-filter">
                    <div class="head">Color</div>
                    <form action="#">
                        <ul>
                            <li class="filter-list"><input class="pixel-radio" type="radio" id="black" name="color"><label for="black">Black<span>(29)</span></label></li>
                            <li class="filter-list"><input class="pixel-radio" type="radio" id="balckleather" name="color"><label for="balckleather">Black Leather<span>(29)</span></label></li>
                            <li class="filter-list"><input class="pixel-radio" type="radio" id="blackred" name="color"><label for="blackred">Black with red<span>(19)</span></label></li>
                            <li class="filter-list"><input class="pixel-radio" type="radio" id="gold" name="color"><label for="gold">Gold<span>(19)</span></label></li>
                            <li class="filter-list"><input class="pixel-radio" type="radio" id="spacegrey" name="color"><label for="spacegrey">Spacegrey<span>(19)</span></label></li>
                        </ul>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="col-xl-9 col-lg-8 col-md-7">
            <!-- Filter bar -->
            <div class="filter-bar d-flex flex-wrap align-items-center">
                <div class="sorting">
                    <select>
                        <option value="1">Default sorting</option>
                        <option value="1">Default sorting</option>
			<option value="1">Price: Low to High</option>
                        <option value="1">Price: High to Low</option>
                        <option value="1">Name: A to Z</option>
                        <option value="1">Name: Z to A</option>
                    </select>
                </div>
                <div class="sorting mr-auto">
                    <select>
                        <option value="1">Show 12</option>
                        <option value="1">Show 24</option>
                        <option value="1">Show 48</option>
                    </select>
                </div>
                <div class="pagination">
                    <a href="#" class="prev-arrow"><i class="fa fa-long-arrow-left" aria-hidden="true"></i></a>
                    <a href="#" class="active">1</a>
                    <a href="#">2</a>
                    <a href="#">3</a>
                    <a href="#" class="dot-dot"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>
                    <a href="#">6</a>
                    <a href="#" class="next-arrow"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
                </div>
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
                                        <?php if (!empty($product['old_price'])): ?>
                                        <h6 class="l-through">$<?= number_format($product['old_price'], 2) ?></h6>
                                        <?php endif; ?>
                                    </div>
                                    <div class="prd-bottom">
                                        <a href="/cart/add/<?= $product['id'] ?>" class="social-info add-to-cart">
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
            
            <!-- Pagination -->
            <?php if (!empty($products) && isset($totalPages) && $totalPages > 1): ?>
            <div class="filter-bar d-flex flex-wrap justify-content-center">
                <div class="pagination">
                    <?php if ($currentPage > 1): ?>
                    <a href="?page=<?= $currentPage - 1 ?>" class="prev-arrow"><i class="fa fa-long-arrow-left" aria-hidden="true"></i></a>
                    <?php endif; ?>
                    
                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <?php if ($i == $currentPage): ?>
                        <a href="?page=<?= $i ?>" class="active"><?= $i ?></a>
                        <?php else: ?>
                        <a href="?page=<?= $i ?>"><?= $i ?></a>
                        <?php endif; ?>
                    <?php endfor; ?>
                    
                    <?php if ($currentPage < $totalPages): ?>
                    <a href="?page=<?= $currentPage + 1 ?>" class="next-arrow"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
                    <?php endif; ?>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
    // Add to cart via AJAX
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.add-to-cart').forEach(function(link) {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                
                var url = this.getAttribute('href');
                
                fetch(url, {
                    method: 'GET',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Update cart count
                        let cartCountElement = document.querySelector('.cart-count');
                        if (cartCountElement) {
                            cartCountElement.textContent = data.cartCount;
                        }
                        
                        // Show success message
                        alert(data.message);
                    } else {
                        alert('Failed to add product to cart');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            });
        });
    });
</script>