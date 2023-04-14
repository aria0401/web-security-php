<div class="header-wrapper header-wrapper__logged-out d-flex align-items-baseline justify-content-between">
    <div class="nav-logo">
        <a class="logo-tx d-flex" href="/"> <img class="logo" src="/media/site-images/logo.svg" alt="">Web Security</a>
    </div>
    <nav class="nav-desktop d-none d-lg-flex mt-5">
        <ul class="d-flex nav-labels align-items-end">
            <li><a class="<?= $_blog ?? ' ' ?>" href="/articles-overview.php?category=privilege_escalation">Blog</a></li>
            <li><a class="<?= $_login ?? ' ' ?>" href="/user/login.php">Log in</a></li>
            <li><a class="<?= $_sign_up ?? ' ' ?>" href="/user/sign-up.php">Sign Up</a></li>
        </ul>
    </nav>
    <div class="menu-icon d-flex d-lg-none justify-content-end">
        <svg width="36" height="26" viewBox="0 0 36 26" fill="none" xmlns="http://www.w3.org/2000/svg">
            <rect width="36" height="4" rx="2" fill="#FEFFFB" />
            <rect y="11" width="36" height="4" rx="2" fill="#FEFFFB" />
            <rect y="22" width="36" height="4" rx="2" fill="#FEFFFB" />
        </svg>
    </div>
</div>
<div class="nav-mobile burger-menu-overlay">
    <div class="container d-flex flex-column align-items-end mt-5">
        <div class="menu-icon burger-menu-close">
            <img src="/media/icons/burger-menu-close.svg" alt="">
        </div>
        <nav>
            <ul class="nav-labels burger-menu-labels d-flex flex-column align-items-end">
                <li><a class="<?= $_homePage ?? ' ' ?>" href="/">Home</a></li>
                <li><a class="<?= $_blog ?? ' ' ?>" href="/articles-overview.php?category=privilege_escalation">Blog</a></li>
                <li><a class="<?= $_login ?? ' ' ?>" href="/user/login.php">Log in</a></li>
                <li><a class="<?= $_sign_up ?? ' ' ?>" href="/user/sign-up.php">Sign Up</a></li>
            </ul>
        </nav>
    </div>
</div>