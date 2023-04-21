<?php

require_once(__DIR__ . '/../includes/init.php');

$article = new Article();
$conn = require_once(__DIR__ . '/../includes/db.php');

$category_ids = [];
$categories = Category::getAll($conn);
$has_profile = $_SESSION['has_profile'];

if (isMethod('post')) {
    require_once(__DIR__ . '/../includes/csrf_validate.php');

    $article->title = $_POST['title'];
    $article->description = $_POST['description'];
    $article->user_id = $_SESSION['user_id'];

    $category_ids = $_POST['category'] ?? [];

    if ($article->validate()) {

        if ($article->userCreateArticle($conn)) {

            $article->setCategories($conn, $category_ids);

            Url::redirect("/user/article.php?id={$article->id}");
        }
    }
}

$_title = 'User - New Article';
$_newArticle = 'active';
require_once(__DIR__ . '/../includes/header.php');
?>

<?php if (Auth::isLoggedIn()) : ?>
    <div class="container my-5 py-4 main-content">
        <?php if ($has_profile) : ?>
            <h1 class="mb-5">New Article</h1>
            <?php require_once(__DIR__ . '/../includes/article-form.php'); ?>
        <?php else : ?>
            <h2>You need to have a profile to create an article</h2>
            <button class="btn primary-btn w-10rem"><a class="btn" href="create-profile.php?id=<?= $_SESSION['user_id']; ?>">Create Profile</a></button>
        <?php endif; ?>
    </div>
<?php else :
    Url::redirect('/user/login.php');
endif; ?>

<?php require_once(__DIR__ . '/../includes/footer.php'); ?>