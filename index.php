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
                    <a class="primary-btn" href="/user/new-article.php">New Article</a>
                <?php else : ?>
                    <a class="primary-btn" href="/user/sign-up.php">Sign Up</a>
                <?php endif; ?>
            </div>
            <div class="hero-image d-flex justify-content-center justify-content-md-end">
                <img src="/media/site-images/home-illustration.svg">
            </div>
        </div>
    </div>
    <div class="home-categories container my-3 my-lg-5 pt-5 pb-2">
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
                            <div class="category-text p-5 text-center">
                                <h3 class="category-name"><?= htmlspecialchars($category['title']); ?></h3>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
    <div class="home-text container mb-5 pb-5">
        <h3 class="text-center mb-5">Some Header and Some Text</h3>
        <div class="text-wrapper row pb-5">
            <div class="col-left col-lg-6">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec dictum interdum quam, vitae mollis quam ultrices a. Integer consectetur tortor sit amet sagittis pellentesque. Vivamus bibendum posuere nibh eu gravida. Aenean aliquet faucibus convallis. Vivamus vulputate dictum arcu a bibendum. Aliquam suscipit ultrices nisl, scelerisque fringilla libero luctus fringilla. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Suspendisse ultricies, nisl et mattis tristique, leo mauris lobortis neque, eget hendrerit dui lectus ut nunc.</p>
                <p>Phasellus elementum, magna et vestibulum aliquet, nulla dui ullamcorper justo, et efficitur mauris arcu a enim. Curabitur id malesuada ante. Nunc tempor tellus nec dui tincidunt dignissim. Praesent eget erat id elit pharetra egestas eu sit amet leo. Donec sed tempor ante. Ut in ultricies lorem, sit amet mattis ipsum. Suspendisse bibendum pharetra sem vitae iaculis. Fusce sit amet risus rutrum, ullamcorper lorem sed, consequat leo. Nam posuere justo ac lectus rhoncus, ut auctor metus gravida. In hac habitasse platea dictumst. Sed viverra in leo rhoncus laoreet.</p>
            </div>
            <div class="col-right col-lg-6">
                <p>Integer nec tincidunt diam, et faucibus velit. Sed aliquam leo vitae mi facilisis, non aliquam velit porttitor. Morbi vitae vehicula sem. Mauris ipsum magna, fringilla maximus fringilla id, finibus eu risus. In dolor ex, dignissim vel metus in, ultrices efficitur metus. Etiam condimentum sapien quis tempus ornare. Curabitur id tincidunt ante. Phasellus cursus tellus a consectetur faucibus. Mauris accumsan nisl nec sagittis feugiat. Pellentesque convallis feugiat sem, non viverra turpis scelerisque sed. Cras venenatis lorem vitae tristique placerat. Etiam non pulvinar augue, vitae porta dui. Sed ullamcorper dui non sapien aliquam, nec maximus nibh pretium.</p>
                <p>Nullam quis risus et libero commodo vehicula. Praesent pellentesque nisi et luctus venenatis. Curabitur rutrum, libero sed eleifend gravida, massa eros vehicula ante, in pharetra purus eros et quam. Mauris blandit at lectus a ullamcorper. Ut quis porta diam. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nam in iaculis leo. Sed eleifend orci non magna fermentum aliquet. Proin lectus ligula, finibus finibus tortor vitae, venenatis aliquet felis</p>
            </div>
        </div>
    </div>
</div>

<?php require_once(__DIR__ . '/includes/footer.php'); ?>