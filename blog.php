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
            <?php foreach ($articles as $article) : ?>
                <?php if ($article['is_visible']) : ?>
                    <div class="category-box mb-3">
                        <a class="category-cta" href="article.php?id=<?= $article['id']; ?>">
                            <div class="category-image d-flex align-items-center justify-content-center">
                            </div>
                            <div class="category-text">
                                <h4><?= htmlspecialchars($article['title']); ?></h4>
                                <p><?= substr(htmlspecialchars($article['description']), 0, 130) . ' ...'; ?></p>
                                <button class="cta tertiary_button"><?= htmlspecialchars($category['cta']); ?></button>
                            </div>
                        </a>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<?php require_once(__DIR__ . '/includes/footer.php'); ?>