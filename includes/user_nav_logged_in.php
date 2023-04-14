<div class="header-wrapper header-wrapper__logged-in d-flex align-items-baseline justify-content-between">
    <div class="nav-logo">
        <a class="logo-tx d-flex" href="/"> <img class="logo" src="/media/site-images/logo.svg" alt="">Web Security</a>
    </div>
    <nav>
        <ul class="nav-labels">
            <li><a class="d-none d-lg-block <?= $_blog ?? ' ' ?>" href="/articles-overview.php?category=privilege_escalation">Blog</a></li>
            <li><a class="d-none d-lg-block <?= $_yourArticles ?? ' ' ?>" href="/user/articles-overview.php">Your articles</a></li>
        </ul>
    </nav>
    <div class="menu-icon d-flex justify-content-end">
        <svg width="36" height="26" viewBox="0 0 36 26" fill="none" xmlns="http://www.w3.org/2000/svg">
            <rect width="36" height="4" rx="2" fill="#FEFFFB" />
            <rect y="11" width="36" height="4" rx="2" fill="#FEFFFB" />
            <rect y="22" width="36" height="4" rx="2" fill="#FEFFFB" />
        </svg>
    </div>
</div>

<div class="burger-menu-overlay">
    <div class="container d-flex flex-column align-items-end mt-5">
        <div class="menu-icon burger-menu-close">
            <img src="/media/icons/burger-menu-close.svg" alt="">
        </div>
        <nav class="mt-5">
            <!-- <div><?= $_SESSION['username'] ?></div> -->
            <ul class="d-flex flex-column align-items-end nav-labels burger-menu-labels">
                <li><a class="<?= $_homePage ?? ' ' ?>" href="/">Home</a></li>
                <li class=""><a class="<?= $_blog ?? ' ' ?>" href="/articles-overview.php?category=privilege_escalation">Blog</a></li>
                <li class=""><a class="<?= $_yourArticles ?? ' ' ?>" href="/user/articles-overview.php">Your articles</a></li>
                <li><a class="<?= $_newArticle ?? ' ' ?>" href="/user/new-article.php">Create new article</a></li>
                <?php if ($_SESSION['has_profile']) : ?>
                    <li><a class="<?= $_yourProfile ?? ' ' ?>" href="/user/edit-profile.php?id=<?= $_SESSION['user_id']; ?>">Your Profile</a></li>
                <?php else : ?>
                    <li><a href="/user/create-profile.php?id=<?= $_SESSION['user_id']; ?>">Create Profile</a></li>
                <?php endif; ?>
                <li class="mt-5"><a class="" href="/user/logout.php">Log out</a></li>
            </ul>
        </nav>
    </div>
</div>