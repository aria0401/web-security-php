<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Arya&family=Roboto:wght@100;300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/../styles/css/main.css">
    <title><?= $_title ?? 'Web Security' ?></title>
</head>

<body class="<?= $_bodyClass ?? null ?>">
    <div class="site-content">
        <header class="dark-header">
            <div class="container p-0 d-flex">
                <nav class="navbar mt-4">
                    <div class="nav-logo">
                        <a class="logo-tx d-flex" href="/"> <img class="logo" src="/media/site-images/logo.svg" alt="">Web Security</a>
                    </div>
                    <div class="nav-labels d-flex justify-content-end">
                        <a class="d-none d-lg-block <?= $_owasp ?? ' ' ?>" href="/owasp-top-10.php">OWASP Top 10</a>
                        <a class="d-none d-lg-block <?= $_blog ?? ' ' ?>" href="/blog.php">Blog</a>
                        <?php if (Auth::isLoggedIn()) : ?>
                            <div class="container">
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
                                        <img src="media/icons/burger-menu-close.svg" alt="">
                                    </div>
                                    <?php require_once(__DIR__ . '/user_nav.php'); ?>
                                </div>
                            </div>
                        <?php else : ?>
                            <a class="<?= $_login ?? ' ' ?>" href="/user/login.php">Log in</a>
                            <a class="<?= $_sign_up ?? ' ' ?>" href="/user/sign-up.php">Sign Up</a>
                        <?php endif; ?>
                    </div>
                </nav>
            </div>
        </header>