<?php
// app/views/shop/cart/index.php
?>
<section class="cart_area">
    <div class="container">
        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success">
                <?= htmlspecialchars($_SESSION['success']) ?>
                <?php unset($_SESSION['success']); ?>
            </div>
        <?php endif; ?>
        
        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger">
                <?= htmlspecialchars($_SESSION['error']) ?>
                <?php unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>
        
        <div class="cart_inner">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Product</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Total</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($cartItems)): ?>
                            <tr>
                                <td colspan="5" class="text-center">
                                    <p>Your cart is empty.</p>
                                    <a href="/shop" class="primary-btn">Continue Shopping</a>
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($cartItems as $item): ?>
                                <tr>
                                    <td>
                                        <div class="media">
                                            <div class="d-flex">
                                                <img src="/assets/img/product/<?= htmlspecialchars($item['image']) ?>" alt="<?= htmlspecialchars($item['name']) ?>" width="100">
                                            </div>
                                            <div class="media-body">
                                                <p><?= htmlspecialchars($item['name']) ?></p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <h5>$<?= number_format($item['price'], 2) ?></h5>
                                    </td>
                                    <td>
                                        <form action="/cart/update" method="post" class="quantity-form">
                                            <input type="hidden" name="product_id" value="<?= $item['id'] ?>">
                                            <div class="product_count">
                                                <input type="text" name="quantity" id="qty_<?= $item['id'] ?>" maxlength="12" value="<?= $item['quantity'] ?>" 
                                                    title="Quantity:" class="input-text qty">
                                                <button type="button" class="increase items-count" data-id="<?= $item['id'] ?>">
                                                    <i class="lnr lnr-chevron-up"></i>
                                                </button>
                                                <button type="button" class="reduced items-count" data-id="<?= $item['id'] ?>">
                                                    <i class="lnr lnr-chevron-down"></i>
                                                </button>
                                            </div>
                                        </form>
                                    </td>
                                    <td>
                                        <h5>$<?= number_format($item['subtotal'], 2) ?></h5>
                                    </td>
                                    <td>
                                        <a href="/cart/remove/<?= $item['id'] ?>" class="btn btn-sm btn-danger cart-remove">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            
                            <tr class="bottom_button">
                                <td>
                                    <a class="gray_btn" href="/cart/clear">Clear Cart</a>
                                </td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                    <div class="cupon_text d-flex align-items-center">
                                        <form action="/cart/apply-coupon" method="post" class="d-flex">
                                            <input type="text" name="coupon_code" placeholder="Coupon Code">
                                            <button type="submit" class="primary-btn">Apply</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            
                            <tr>
                                <td></td>
                                <td></td>
                                <td>
                                    <h5>Subtotal</h5>
                                </td>
                                <td>
                                    <h5>$<?= number_format($cartTotal['subtotal'], 2) ?></h5>
                                </td>
                                <td></td>
                            </tr>
                            
                            <?php if ($cartTotal['discount'] > 0): ?>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <h5>Discount</h5>
                                    </td>
                                    <td>
                                        <h5>-$<?= number_format($cartTotal['discount'], 2) ?></h5>
                                    </td>
                                    <td></td>
                                </tr>
                            <?php endif; ?>
                            
                            <tr>
                                <td></td>
                                <td></td>
                                <td>
                                    <h5>Total</h5>
                                </td>
                                <td>
                                    <h5>$<?= number_format($cartTotal['total'], 2) ?></h5>
                                </td>
                                <td></td>
                            </tr>
                            
                            <tr class="out_button_area">
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                    <div class="checkout_btn_inner d-flex align-items-center">
                                        <a class="gray_btn" href="/shop">Continue Shopping</a>
                                        <a class="primary-btn" href="/checkout">Proceed to checkout</a>
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<script>
    // Script to handle quantity buttons
    document.addEventListener('DOMContentLoaded', function() {
        // Increase quantity button
        document.querySelectorAll('.increase').forEach(function(button) {
            button.addEventListener('click', function() {
                var id = this.getAttribute('data-id');
                var input = document.getElementById('qty_' + id);
                var value = parseInt(input.value);
                
                if (!isNaN(value)) {
                    input.value = value + 1;
                    document.querySelector('.quantity-form input[name="product_id"][value="' + id + '"]')
                        .closest('form').submit();
                }
            });
        });
        
        // Decrease quantity button
        document.querySelectorAll('.reduced').forEach(function(button) {
            button.addEventListener('click', function() {
                var id = this.getAttribute('data-id');
                var input = document.getElementById('qty_' + id);
                var value = parseInt(input.value);
                
                if (!isNaN(value) && value > 1) {
                    input.value = value - 1;
                    document.querySelector('.quantity-form input[name="product_id"][value="' + id + '"]')
                        .closest('form').submit();
                }
            });
        });
        
        // Confirm cart removal
        document.querySelectorAll('.cart-remove').forEach(function(link) {
            link.addEventListener('click', function(e) {
                if (!confirm('Are you sure you want to remove this item from your cart?')) {
                    e.preventDefault();
                }
            });
        });
    });
</script>