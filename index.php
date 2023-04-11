<?php

require_once(__DIR__ . '/includes/init.php');

$conn = require_once(__DIR__ . '/includes/db.php');

$categories = Category::getAll($conn);


$_title = 'Web Security | Home';
$_bodyClass = 'index-page';
$_homePage = 'active';
require_once(__DIR__ . '/includes/header.php');
?>

<div class="container p-0 main-content mt-5 pt-5">
    <div class="hero-banner mt-4">
        <div class="pe-5">
            <h1 class="header-1">Security for Web Developers</h1>
            <?php if (Auth::isLoggedIn()) : ?>
                <div class="dots mt-5">
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                </div>
            <?php else : ?>
                <p class="txt mb-5 pe-5">Share your knowledge about common security risks and defence methods.</p>
                <a class="primary-btn" href="/user/sign-up.php">Sign Up</a>
            <?php endif; ?>
        </div>
        <div class="hero-image">
            <img src="/media/site-images/home-illustration.svg">
        </div>
    </div>
    <div class="my-5 py-5">
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
</div>

<?php require_once(__DIR__ . '/includes/footer.php'); ?>