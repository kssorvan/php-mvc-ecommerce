<section class="blog_area single-post-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 posts-list">
                <div class="single-post">
                    <div class="feature-img">
                        <img class="img-fluid" src="/assets/img/blog/<?= htmlspecialchars($article['image']) ?>" alt="<?= htmlspecialchars($article['title']) ?>">
                    </div>
                    <div class="blog_details">
                        <h2><?= htmlspecialchars($article['title']) ?></h2>
                        <ul class="blog-info-link mt-3 mb-4">
                            <li><i class="fa fa-user"></i> <?= htmlspecialchars($article['author_name']) ?></li>
                            <li><i class="fa fa-folder"></i> <?= htmlspecialchars($article['category_name']) ?></li>
                        </ul>
                        <div class="article-content">
                            <?= $article['content'] ?>
                        </div>
                    </div>
                </div>
                
                <div class="navigation-top">
                    <div class="d-sm-flex justify-content-between text-center">
                        <p class="like-info"><span class="align-middle"><i class="fa fa-heart"></i></span> <?= $article['likes'] ?? 0 ?> people like this</p>
                        <div class="col-sm-4 text-center my-2 my-sm-0">
                            <!-- <p class="comment-count"><span class="align-middle"><i class="fa fa-comment"></i></span> <?= count($comments) ?> Comments</p> -->
                        </div>
                        <ul class="social-icons">
                            <li><a href="#"><i class="fa fa-facebook-f"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-pinterest-p"></i></a></li>
                            <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                        </ul>
                    </div>
                </div>
                
                <div class="blog-author">
                    <div class="media align-items-center">
                        <img src="/assets/img/blog/author.png" alt="">
                        <div class="media-body">
                            <a href="#">
                                <h4><?= htmlspecialchars($article['author_name']) ?></h4>
                            </a>
                            <p><?= htmlspecialchars($article['author_bio'] ?? 'Author at Karma Shop') ?></p>
                        </div>
                    </div>
                </div>
                
                <div class="comments-area">
                    <h4><?= count($comments) ?> Comments</h4>
                    <?php foreach ($comments as $comment): ?>
                        <div class="comment-list">
                            <div class="single-comment justify-content-between d-flex">
                                <div class="user justify-content-between d-flex">
                                    <div class="thumb">
                                        <img src="/assets/img/comment/comment_1.png" alt="">
                                    </div>
                                    <div class="desc">
                                        <p class="comment"><?= htmlspecialchars($comment['comment']) ?></p>
                                        <div class="d-flex justify-content-between">
                                            <div class="d-flex align-items-center">
                                                <h5><a href="#"><?= htmlspecialchars($comment['name']) ?></a></h5>
                                                <p class="date"><?= date('M d, Y \a\t g:i a', strtotime($comment['created_at'])) ?></p>
                                            </div>
                                            <div class="reply-btn">
                                                <a href="#" class="btn-reply text-uppercase">reply</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                
                <div class="comment-form">
                    <h4>Leave a Comment</h4>
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
                    <form class="form-contact comment_form" action="/blog/comment" method="POST" id="commentForm">
                        <input type="hidden" name="article_id" value="<?= $article['id'] ?>">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <textarea class="form-control w-100" name="comment" id="comment" cols="30" rows="9" placeholder="Write Comment" required></textarea>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input class="form-control" name="name" id="name" type="text" placeholder="Name" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input class="form-control" name="email" id="email" type="email" placeholder="Email" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="button button-contactForm btn_1 boxed-btn">Send Comment</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="blog_right_sidebar">
                    <aside class="single_sidebar_widget search_widget">
                        <form action="/blog/search" method="GET">
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="q" placeholder="Search Keyword" required>
                                    <div class="input-group-append">
                                        <button class="btn" type="submit"><i class="fa fa-search"></i></button>
                                    </div>
                                </div>
                            </div>
                            <button class="button rounded-0 primary-bg text-white w-100 btn_1 boxed-btn" type="submit">Search</button>
                        </form>
                    </aside>

                    <aside class="single_sidebar_widget post_category_widget">
                        <h4 class="widget_title">Category</h4>
                        <ul class="list cat-list">
                            <?php foreach ($categories as $category): ?>
                                <li>
                                    <a href="/blog/category/<?= $category['id'] ?>" class="d-flex">
                                        <p><?= htmlspecialchars($category['name']) ?></p>
                                        <p>(<?= $category['article_count'] ?>)</p>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </aside>

                    <aside class="single_sidebar_widget popular_post_widget">
                        <h3 class="widget_title">Recent Posts</h3>
                        <?php foreach ($recentPosts as $post): ?>
                            <div class="media post_item">
                                <img src="/assets/img/blog/small/<?= htmlspecialchars($post['image']) ?>" alt="post" width="80">
                                <div class="media-body">
                                    <a href="/blog/<?= $post['id'] ?>">
                                        <h3><?= htmlspecialchars($post['title']) ?></h3>
                                    </a>
                                    <p><?= date('M d, Y', strtotime($post['created_at'])) ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </aside>

                    <aside class="single_sidebar_widget tag_cloud_widget">
                        <h4 class="widget_title">Tag Clouds</h4>
                        <ul class="list">
                            <li><a href="#">fashion</a></li>
                            <li><a href="#">technology</a></li>
                            <li><a href="#">sport</a></li>
                            <li><a href="#">lifestyle</a></li>
                            <li><a href="#">design</a></li>
                            <li><a href="#">illustration</a></li>
                        </ul>
                    </aside>
                </div>
            </div>
        </div>
    </div>
</section>