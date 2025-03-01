<section class="blog_area">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="blog_left_sidebar">
                    <?php if (empty($articles)): ?>
                        <div class="alert alert-info">No articles found.</div>
                    <?php else: ?>
                        <?php foreach ($articles as $article): ?>
                            <article class="blog_item">
                                <div class="blog_item_img">
                                    <img class="card-img rounded-0" src="/assets/img/blog/<?= htmlspecialchars($article['image']) ?>" alt="<?= htmlspecialchars($article['title']) ?>">
                                    <a href="#" class="blog_item_date">
                                        <h3><?= date('d', strtotime($article['created_at'])) ?></h3>
                                        <p><?= date('M', strtotime($article['created_at'])) ?></p>
                                    </a>
                                </div>
                                <div class="blog_details">
                                    <a class="d-inline-block" href="/blog/<?= $article['id'] ?>">
                                        <h2><?= htmlspecialchars($article['title']) ?></h2>
                                    </a>
                                    <p><?= htmlspecialchars(substr(strip_tags($article['content']), 0, 200)) ?>...</p>
                                    <ul class="blog-info-link">
                                        <li><i class="fa fa-user"></i> <?= htmlspecialchars($article['author_name']) ?></li>
                                        <li><i class="fa fa-folder"></i> <?= htmlspecialchars($article['category_name']) ?></li>
                                    </ul>
                                </div>
                            </article>
                        <?php endforeach; ?>
                    <?php endif; ?>

                    <nav class="blog-pagination justify-content-center d-flex">
                        <ul class="pagination">
                            <li class="page-item">
                                <a href="#" class="page-link" aria-label="Previous">
                                    <i class="fa fa-angle-left"></i>
                                </a>
                            </li>
                            <li class="page-item active">
                                <a href="#" class="page-link">1</a>
                            </li>
                            <li class="page-item">
                                <a href="#" class="page-link">2</a>
                            </li>
                            <li class="page-item">
                                <a href="#" class="page-link" aria-label="Next">
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </li>
                        </ul>
                    </nav>
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