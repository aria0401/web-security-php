<?php

require_once(__DIR__ . '/includes/init.php');

$conn = require_once(__DIR__ . '/includes/db.php');

$categories = Category::getAll($conn);


$_title = 'Web Security | Home';
$_bodyClass = 'index-page';
$_homePage = 'active';
require_once(__DIR__ . '/includes/header.php');
?>

<div class="main-content">
    <div class="hero-banner py-3 py-lg-5">
        <div class="hero-banner-wrapper container px-lg-0 py-3 pb-md-5 my-3 my-md-5">
            <div class="pe-lg-5 py-3 py-md-0">
                <h1 class="header-1 mb-3 mb-lg-5">Security for Web Developers</h1>
                <p class="txt mb-5 pe-lg-5">Share your knowledge about common security risks and defence methods.</p>
                <?php if (Auth::isLoggedIn()) : ?>
                    <a class="primary-btn" href="/user/articles-overview.php">Your Articles</a>
                <?php else : ?>
                    <a class="primary-btn" href="/user/sign-up.php">Sign Up</a>
                <?php endif; ?>
            </div>
            <div class="hero-image d-flex justify-content-center justify-content-md-end">
                <img src="/media/site-images/home-illustration.svg">
            </div>
        </div>
    </div>
    <div class="container my-3 my-lg-5 py-5">
        <?php if (empty($categories)) : ?>
            <p>No articles found.</p>
        <?php else : ?>
            <h2 class="grid-header text-center mb-5 pb-4">Security Risks</h2>
            <div class="categories-wrapper py-lg-5 my-5">
                <?php foreach ($categories as $category) : ?>
                    <div class="category-item">
                        <a class="category-cta" href="articles-overview.php?category=<?= $category['name']; ?>">
                            <div class="category-image d-flex align-items-center justify-content-center">
                                <img src="media/category-icons/<?= $category['name'] . '.svg'; ?>" alt="<?= $category['title']; ?>">
                            </div>
                            <div class="category-text py-5 text-center">
                                <h3><?= htmlspecialchars($category['title']); ?></h3>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php require_once(__DIR__ . '/includes/footer.php'); ?>