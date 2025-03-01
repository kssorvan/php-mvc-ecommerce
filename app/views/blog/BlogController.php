<?php
// app/controllers/blog/BlogController.php

class BlogController extends BaseController
{
    private $articleRepository;
    
    public function __construct()
    {
        $this->articleRepository = new ArticleRepository();
    }
    
    // Show all blog posts (blog listing page)
    public function index()
    {
        $articles = $this->articleRepository->getAll();
        $categories = $this->articleRepository->getCategories();
        $recentPosts = $this->articleRepository->getRecent(5);
        
        $this->render('blog/index', [
            'pageTitle' => 'Blog',
            'currentPage' => 'blog',
            'showBreadcrumb' => true,
            'breadcrumb' => [
                '#' => 'Blog'
            ],
            'articles' => $articles,
            'categories' => $categories,
            'recentPosts' => $recentPosts
        ]);
    }
    
    // Show single blog post
    public function show($id)
    {
        $article = $this->articleRepository->getById($id);
        
        if (!$article) {
            header('Location: /blog');
            exit;
        }
        
        $categories = $this->articleRepository->getCategories();
        $recentPosts = $this->articleRepository->getRecent(5);
        $relatedPosts = $this->articleRepository->getRelated($article['category_id'], $id, 3);
        $comments = $this->articleRepository->getComments($id);
        
        $this->render('blog/detail', [
            'pageTitle' => $article['title'],
            'currentPage' => 'blog-detail',
            'showBreadcrumb' => true,
            'breadcrumb' => [
                '/blog' => 'Blog',
                '#' => 'Blog Details'
            ],
            'article' => $article,
            'categories' => $categories,
            'recentPosts' => $recentPosts,
            'relatedPosts' => $relatedPosts,
            'comments' => $comments
        ]);
    }
    
    // Add a comment to a blog post
    public function addComment()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /blog');
            exit;
        }
        
        $articleId = isset($_POST['article_id']) ? (int) $_POST['article_id'] : 0;
        $name = isset($_POST['name']) ? trim($_POST['name']) : '';
        $email = isset($_POST['email']) ? trim($_POST['email']) : '';
        $comment = isset($_POST['comment']) ? trim($_POST['comment']) : '';
        
        if (empty($articleId) || empty($name) || empty($email) || empty($comment)) {
            $_SESSION['error'] = 'All fields are required.';
            header('Location: /blog/' . $articleId);
            exit;
        }
        
        $result = $this->articleRepository->addComment($articleId, $name, $email, $comment);
        
        if ($result) {
            $_SESSION['success'] = 'Comment added successfully. It will be visible after approval.';
        } else {
            $_SESSION['error'] = 'Failed to add comment.';
        }
        
        header('Location: /blog/' . $articleId);
        exit;
    }
}