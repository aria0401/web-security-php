<?php

require_once(__DIR__ . '/includes/init.php');

$conn = require_once(__DIR__ . '/includes/db.php');

$categories = Category::getAll($conn);

$_title = 'Owasp Top 10';
$_bodyClass = 'owasp-page';
$_owasp = 'active';
require_once(__DIR__ . '/includes/header.php');
?>

<div class="container my-5 py-5 main-content">
    <?php if (empty($categories)) : ?>
        <p>No articles found.</p>
    <?php else : ?>
        <div class="categories-wrapper row">
            <?php foreach ($categories as $category) : ?>
                <div class="category-box mb-3">
                    <a class="category-cta" href="articles-overview.php?category=<?= $category['name']; ?>">
                        <div class="category-image d-flex align-items-center justify-content-center">
                        </div>
                        <div class="category-text">
                            <h4><?= htmlspecialchars($category['title']); ?></h4>
                            <!-- <p><?= substr(htmlspecialchars($category['description']), 0, 130) . ' ...';  ?></p> -->
                            <!-- <button class="cta tertiary_button"><?= htmlspecialchars($category['cta']); ?></button> -->
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<?php require_once(__DIR__ . '/includes/footer.php'); ?>