<?php

require_once(__DIR__ . '/../includes/init.php');
$conn = require_once(__DIR__ . '/../includes/db.php');

$authenticated = true;

if (isset($_GET['id'])) {

    $article = Article::getById($conn, $_GET['id']);

    if ($article->user_id !== $_SESSION['user_id']) {
        $authenticated = false;
    }

    if (!$article) {
        die("article not found");
    }
} else {
    die("id not supplied, article not found");
}

if (isMethod('post')) {
    require_once(__DIR__ . '/../includes/csrf_validate.php');

    if ($article->delete($conn)) {
        Url::redirect("/user/articles-overview.php");
    }
}

$_title = 'User - Delete Article';
require_once(__DIR__ . '/../includes/header.php');
require_once(__DIR__ . '/../includes/modal.php');
?>

<?php if (Auth::isLoggedIn()) : ?>
    <div class="container main-content mt-5 pt-4">
        <?php if ($authenticated) : ?>
            <h2>Delete Article</h2>
            <form method="post">
                <p>Are you sure you want to delete this article: <?= $article->title; ?> ?</p>
                <input type="hidden" name="token" value="<?= $_SESSION['token'] ?? ''; ?>">
                <button class="btn primary-btn danger-btn me-2">Delete</button>
                <a class="primary-btn" href="article.php?id=<?= $article->id; ?>">Cancel</a>
            </form>
        <?php else : ?>
            <h2>You don't have permission to edit this article.</h2>
        <?php endif; ?>
    </div>
<?php else :
    Url::redirect('/user/login.php');
endif; ?>

<?php require_once(__DIR__ . '/../includes/footer.php'); ?>