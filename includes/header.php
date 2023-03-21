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

<body class=<?= $_bodyClass ?? null ?>>
    <div class="site-content">
        <!-- <header class=<?= $_headerClass ?? null ?>> -->
        <header class="dark-header">
            <div class="container p-0 d-flex">
                <nav class="navbar mt-4">
                    <div class="nav-logo">
                        <a class="logo-tx d-flex" href="/"> <img class="logo" src="/media/site-images/logo.svg" alt="">Web Security</a>
                    </div>
                    <div><?= $_SESSION['username'] ?></div>
                    <div class="nav-labels d-flex justify-content-end">
                        <a class="" href="/owasp-top-10.php">OWASP Top 10</a>
                        <a class="" href="/blog.php">Blog</a>
                        <?php if (Auth::isLoggedIn()) : ?>
                            <a class="" href="/user/account-management.php?id=<?= $_SESSION['user_id']; ?>">Your Account</a>
                            <a class="" href="/user/logout.php">Log out</a>
                        <?php else : ?>
                            <a class="" href="/user/login.php">Log in</a>
                            <a class="" href="/user/sign-up.php">Sign Up</a>
                        <?php endif; ?>
                    </div>
                </nav>
            </div>
        </header>