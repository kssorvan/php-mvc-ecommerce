<!-- Start Single Product Area -->
<div class="product_image_area">
    <div class="container">
        <div class="row s_product_inner">
            <div class="col-lg-6">
                <div class="s_Product_carousel">
                    <div class="single-prd-item">
                        <img class="img-fluid" src="/assets/img/product/<?= htmlspecialchars($product['image']) ?>" alt="">
                    </div>
                    <?php if (!empty($product['image_2'])): ?>
                    <div class="single-prd-item">
                        <img class="img-fluid" src="/assets/img/product/<?= htmlspecialchars($product['image_2']) ?>" alt="">
                    </div>
                    <?php endif; ?>
                    <?php if (!empty($product['image_3'])): ?>
                    <div class="single-prd-item">
                        <img class="img-fluid" src="/assets/img/product/<?= htmlspecialchars($product['image_3']) ?>" alt="">
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-lg-5 offset-lg-1">
                <div class="s_product_text">
                    <h3><?= htmlspecialchars($product['name']) ?></h3>
                    <h2>$<?= number_format($product['price'], 2) ?></h2>
                    <ul class="list">
                        <li><a class="active" href="/shop/category/<?= $product['category_id'] ?>"><span>Category</span> : <?= htmlspecialchars($product['category_name']) ?></a></li>
                        <li><span>Availability</span> : <?= $product['stock_quantity'] > 0 ? 'In Stock' : 'Out of Stock' ?></li>
                    </ul>
                    <p><?= htmlspecialchars($product['description']) ?></p>
                    <div class="product_count">
                        <label for="qty">Quantity:</label>
                        <input type="text" name="qty" id="sst" maxlength="12" value="1" title="Quantity:" class="input-text qty">
                        <button onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst )) result.value++;return false;"
                         class="increase items-count" type="button"><i class="lnr lnr-chevron-up"></i></button>
                        <button onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst ) && sst > 0 ) result.value--;return false;"
                         class="reduced items-count" type="button"><i class="lnr lnr-chevron-down"></i></button>
                    </div>
                    <div class="card_area d-flex align-items-center">
                        <a class="primary-btn" href="#" id="add-to-cart-btn">Add to Cart</a>
                        <a class="icon_btn" href="/wishlist/add/<?= $product['id'] ?>"><i class="lnr lnr-heart"></i></a>
                        <a class="icon_btn" href="/compare/add/<?= $product['id'] ?>"><i class="lnr lnr-sync"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Single Product Area -->

<!-- Start Product Description Area -->
<section class="product_description_area">
    <div class="container">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Description</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile"
                 aria-selected="false">Specification</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact"
                 aria-selected="false">Comments</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="review-tab" data-toggle="tab" href="#review" role="tab" aria-controls="review"
                 aria-selected="false">Reviews</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <p><?= nl2br(htmlspecialchars($product['description'])) ?></p>
            </div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <div class="table-responsive">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td>
                                    <h5>Width</h5>
                                </td>
                                <td>
                                    <h5><?= $product['width'] ?? 'N/A' ?></h5>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h5>Height</h5>
                                </td>
                                <td>
                                    <h5><?= $product['height'] ?? 'N/A' ?></h5>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h5>Weight</h5>
                                </td>
                                <td>
                                    <h5><?= $product['weight'] ?? 'N/A' ?></h5>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h5>Material</h5>
                                </td>
                                <td>
                                    <h5><?= $product['material'] ?? 'N/A' ?></h5>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="comment_list">
                            <?php if (empty($comments)): ?>
                                <p>No comments yet. Be the first to comment!</p>
                            <?php else: ?>
                                <?php foreach ($comments as $comment): ?>
                                <div class="review_item">
                                    <div class="media">
                                        <div class="d-flex">
                                            <img src="/assets/img/product/review-1.png" alt="">
                                        </div>
                                        <div class="media-body">
                                            <h4><?= htmlspecialchars($comment['name']) ?></h4>
                                            <h5><?= date('M d, Y', strtotime($comment['created_at'])) ?></h5>
                                        </div>
                                    </div>
                                    <p><?= htmlspecialchars($comment['content']) ?></p>
                                </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="review_box">
                            <h4>Post a comment</h4>
                            <form class="row contact_form" action="/product/comment" method="post" id="contactForm">
                                <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Your Full name" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Email Address" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <textarea class="form-control" name="message" id="message" rows="1" placeholder="Message" required></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 text-right">
                                    <button type="submit" value="submit" class="btn primary-btn">Submit Now</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="review" role="tabpanel" aria-labelledby="review-tab">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="review_list">
                            <?php if (empty($reviews)): ?>
                                <p>No reviews yet. Be the first to review this product!</p>
                            <?php else: ?>
                                <?php foreach ($reviews as $review): ?>
                                <div class="review_item">
                                    <div class="media">
                                        <div class="d-flex">
                                            <img src="/assets/img/product/review-1.png" alt="">
                                        </div>
                                        <div class="media-body">
                                            <h4><?= htmlspecialchars($review['name']) ?></h4>
                                            <div class="star-rating">
                                                <?php for ($i = 1; $i <= 5; $i++): ?>
                                                    <?php if ($i <= $review['rating']): ?>
                                                        <i class="fa fa-star"></i>
                                                    <?php else: ?>
                                                        <i class="fa fa-star-o"></i>
                                                    <?php endif; ?>
                                                <?php endfor; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <p><?= htmlspecialchars($review['comment']) ?></p>
                                </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="review_box">
                            <h4>Add a Review</h4>
                            <p>Your Rating:</p>
                            <ul class="list">
                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                            </ul>
                            <form class="row contact_form" action="/product/review" method="post" id="reviewForm">
                                <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                                <input type="hidden" name="rating" id="rating" value="5">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Your Full name" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Email Address" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <textarea class="form-control" name="review" id="review" rows="1" placeholder="Review" required></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 text-right">
                                    <button type="submit" value="submit" class="primary-btn">Submit Now</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Product Description Area -->

<!-- Start related-product Area -->
<section class="related-product-area section_gap_bottom">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 text-center">
                <div class="section-title">
                    <h1>Related Products</h1>
                    <p>Browse these related products that you might also like.</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <?php foreach ($relatedProducts as $relProduct): ?>
                    <div class="col-lg-3 col-md-6">
                        <div class="single-product">
                            <img class="img-fluid" src="/assets/img/product/<?= htmlspecialchars($relProduct['image']) ?>" alt="">
                            <div class="product-details">
                                <h6><?= htmlspecialchars($relProduct['name']) ?></h6>
                                <div class="price">
                                    <h6>$<?= number_format($relProduct['price'], 2) ?></h6>
                                    <?php if (!empty($relProduct['old_price'])): ?>
                                    <h6 class="l-through">$<?= number_format($relProduct['old_price'], 2) ?></h6>
                                    <?php endif; ?>
                                </div>
                                <div class="prd-bottom">
                                    <a href="/cart/add/<?= $relProduct['id'] ?>" class="social-info">
                                        <span class="ti-bag"></span>
                                        <p class="hover-text">add to bag</p>
                                    </a>
                                    <a href="/wishlist/add/<?= $relProduct['id'] ?>" class="social-info">
                                        <span class="lnr lnr-heart"></span>
                                        <p class="hover-text">Wishlist</p>
                                    </a>
                                    <a href="/compare/add/<?= $relProduct['id'] ?>" class="social-info">
                                        <span class="lnr lnr-sync"></span>
                                        <p class="hover-text">compare</p>
                                    </a>
                                    <a href="/shop/product/<?= $relProduct['id'] ?>" class="social-info">
                                        <span class="lnr lnr-move"></span>
                                        <p class="hover-text">view more</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End related-product Area -->

<script>
// Handle add to cart button click
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('add-to-cart-btn').addEventListener('click', function(e) {
        e.preventDefault();
        
        var quantity = document.getElementById('sst').value;
        var productId = <?= $product['id'] ?>;
        
        // Add to cart via AJAX
        fetch('/cart/add/' + productId + '?quantity=' + quantity, {
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
    
    // Handle star rating in review form
    document.querySelectorAll('.review_box .list a').forEach(function(star, index) {
        star.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Set rating value
            document.getElementById('rating').value = index + 1;
            
            // Update star display
            document.querySelectorAll('.review_box .list a i').forEach(function(starIcon, starIndex) {
                if (starIndex <= index) {
                    starIcon.className = 'fa fa-star';
                } else {
                    starIcon.className = 'fa fa-star-o';
                }
            });
        });
    });
});
</script>