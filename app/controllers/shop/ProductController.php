<?php\n// \app\controllers\shop\ProductController.php\n\n?>
<?php
// app/controllers/shop/ProductController.php

// class ProductController extends BaseController
// {
//     private $productRepository;
//     private $categoryRepository;
    
//     public function __construct()
//     {
//         $this->productRepository = new ProductRepository();
//         $this->categoryRepository = new CategoryRepository();
//     }
    
//     // Show product listing page (category.php)
//     public function index($categoryId = null)
//     {
//         $products = $this->productRepository->getAll($categoryId);
//         $categories = $this->categoryRepository->getAll();
        
//         $this->render('shop/products/list', [
//             'pageTitle' => 'Shop Category',
//             'showBreadcrumb' => true,
//             'breadcrumb' => [
//                 '#' => 'Shop Category'
//             ],
//             'products' => $products,
//             'categories' => $categories
//         ]);
//     }
    
//     // Show single product page (single-product.php)
//     public function show($id)
//     {
//         $product = $this->productRepository->getById($id);
//         $relatedProducts = $this->productRepository->getRelated($product);
        
//         $this->render('shop/products/detail', [
//             'pageTitle' => $product->name,
//             'showBreadcrumb' => true,
//             'breadcrumb' => [
//                 '/shop' => 'Shop',
//                 '#' => 'Product Details'
//             ],
//             'product' => $product,
//             'relatedProducts' => $relatedProducts
//         ]);
//     }
// }

<?php
// app/controllers/shop/ProductController.php

class ProductController extends BaseController
{
    private $productRepository;
    private $categoryRepository;
    
    public function __construct()
    {
        $this->productRepository = new ProductRepository();
        $this->categoryRepository = new CategoryRepository();
    }
    
    // Show all products or filtered by category
    public function index($categoryId = null)
    {
        $products = $this->productRepository->getAll($categoryId);
        $categories = $this->categoryRepository->getAll();
        
        $this->render('shop/products/list', [
            'pageTitle' => 'Shop Category',
            'currentPage' => 'shop',
            'showBreadcrumb' => true,
            'breadcrumb' => [
                '#' => 'Shop Category'
            ],
            'products' => $products,
            'categories' => $categories,
            'selectedCategory' => $categoryId
        ]);
    }
    
    // Show single product details
    public function show($id)
    {
        $product = $this->productRepository->getById($id);
        
        if (!$product) {
            // Product not found
            header('Location: /shop');
            exit;
        }
        
        $relatedProducts = $this->productRepository->getRelated($product['category_id'], $id);
        
        $this->render('shop/products/detail', [
            'pageTitle' => $product['name'],
            'currentPage' => 'product',
            'showBreadcrumb' => true,
            'breadcrumb' => [
                '/shop' => 'Shop',
                '#' => 'Product Details'
            ],
            'product' => $product,
            'relatedProducts' => $relatedProducts
        ]);
    }
}