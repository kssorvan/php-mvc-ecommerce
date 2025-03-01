<?php\n// \routes\web.php\n\n?>
<?php
// routes/web.php

// Home routes
$router->get('', 'shop/HomeController@index');
$router->get('/', 'shop/HomeController@index');

// Shop routes
$router->get('/shop', 'shop/ProductController@index');
$router->get('/shop/category/{id}', 'shop/ProductController@index');
$router->get('/shop/product/{id}', 'shop/ProductController@show');

// Cart routes
$router->get('/cart', 'shop/CartController@index');
$router->post('/cart/add', 'shop/CartController@add');
$router->post('/cart/update', 'shop/CartController@update');
$router->post('/cart/remove', 'shop/CartController@remove');

// Checkout routes
$router->get('/checkout', 'shop/CheckoutController@index');
$router->post('/checkout', 'shop/CheckoutController@process');
$router->get('/confirmation', 'shop/CheckoutController@confirmation');

// Blog routes
$router->get('/blog', 'blog/BlogController@index');
$router->get('/blog/{id}', 'blog/BlogController@show');

// Auth routes
$router->get('/login', 'auth/AuthController@login');
$router->post('/login', 'auth/AuthController@doLogin');
$router->get('/register', 'auth/AuthController@register');
$router->post('/register', 'auth/AuthController@doRegister');
$router->get('/logout', 'auth/AuthController@logout');

// Contact routes
$router->get('/contact', 'shop/ContactController@index');
$router->post('/contact', 'shop/ContactController@send');


// routes/web.php

// Cart routes
$router->get('/cart', 'shop/CartController@index');
$router->get('/cart/add/{id}', 'shop/CartController@add');
$router->post('/cart/update', 'shop/CartController@update');
$router->get('/cart/remove/{id}', 'shop/CartController@remove');
$router->get('/cart/clear', 'shop/CartController@clear');
$router->post('/cart/apply-coupon', 'shop/CartController@applyCoupon');

// Blog routes
$router->get('/blog', 'blog/BlogController@index');
$router->get('/blog/category/{id}', 'blog/BlogController@index');
$router->get('/blog/{id}', 'blog/BlogController@show');
$router->post('/blog/comment', 'blog/BlogController@addComment');
$router->get('/blog/search', 'blog/BlogController@search');