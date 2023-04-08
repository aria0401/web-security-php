<div class="mt-5">
    <div><?= $_SESSION['username'] ?></div>
    <ul class="d-flex flex-column align-items-end">
        <li><a class="<?= $_homePage ?? ' ' ?>" href="/">Home</a></li>
        <li class="d-lg-none"><a class="<?= $_owasp ?? ' ' ?>" href="/owasp-top-10.php">OWASP Top 10</a></li>
        <li class="d-lg-none"><a class="<?= $_blog ?? ' ' ?>" href="/blog.php">Blog</a></li>
        <li><a class="<?= $_yourArticles ?? ' ' ?>" href="/user/articles-overview.php">Your articles</a></li>
        <li><a class="<?= $_newArticle ?? ' ' ?>" href="/user/new-article.php">Create new article</a></li>
        <?php if ($_SESSION['has_profile']) : ?>
            <li><a class="<?= $_yourProfile ?? ' ' ?>" href="/user/edit-profile.php?id=<?= $_SESSION['user_id']; ?>">Your Profile</a></li>
        <?php else : ?>
            <li><a href="/user/create-profile.php?id=<?= $_SESSION['user_id']; ?>">Create Profile</a></li>
        <?php endif; ?>
        <li><a class="" href="/user/logout.php">Log out</a></li>
    </ul>
</div>