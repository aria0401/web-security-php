<?php

require_once(__DIR__ . '/includes/init.php');

$conn = require_once(__DIR__ . '/includes/db.php');

$articles = Article::getAll($conn);


$_title = 'Blog';
$_bodyClass = 'blog-page';
$_blog = 'active';
require_once(__DIR__ . '/includes/header.php');
?>

<div class="container my-5 py-5 main-content">
    <?php if (empty($articles)) : ?>
        <p>No articles found.</p>
    <?php else : ?>
        <div class="articles-wrapper row">
            <h1>Blog</h1>
            <?php foreach ($articles as $article) : ?>
                <?php if ($article['is_visible']) : ?>
                    <div class="item mb-4">
                        <a class="article-a" href="article.php?id=<?= $article['id']; ?>">
                            <article class="d-flex flex-row">
                                <div>
                                    <h3 class="article-name"><?= htmlspecialchars($article['title']); ?></h3>
                                    <p class="article-description"><?= substr(htmlspecialchars($article['description']), 0, 200) . ' ...'; ?></p>
                                </div>
                            </article>
                        </a>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<?php require_once(__DIR__ . '/includes/footer.php'); ?>