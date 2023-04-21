<?php

require_once(__DIR__ . '/../includes/init.php');
$conn = require_once(__DIR__ . '/../includes/db.php');

if (isset($_GET['id'])) {

    $article = Article::getWithCategories($conn, $_GET['id']);
} else {
    $article = null;
}

$_title = 'User - Article';

require_once(__DIR__ . '/../includes/header.php');
require_once(__DIR__ . '/../includes/modal.php');
?>

<?php if (Auth::isLoggedIn()) : ?>
    <div class="container py-lg-5 main-content">
        <?php if ($article) : ?>
            <article class="row py-5">
                <?php if ($article[0]['image_file']) : ?>
                    <img class="col-md-4 mb-4 mb-md-2" src="../uploads/articles/<?= $article[0]['image_file']; ?>" alt="articles image">
                <?php endif; ?>
                <div class="col-md-8">
                    <h2 class=""><?= htmlspecialchars($article[0]['title']); ?></h2>
                    <p class=""><?= htmlspecialchars($article[0]['description']); ?></p>
                    <?php if ($article[0]['category_name']) : ?>
                        <h5 class="">Categories:</h5>
                        <ul>
                            <?php foreach ($article as $a) : ?>
                                <li><?= htmlspecialchars($a['category_title']); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </article>

        <?php else : ?>
            <p>We could not find this article.</p>
        <?php endif; ?>
        <div class="mt-4">
            <a class="btn primary-btn w-14rem mb-2" href="edit-article.php?id=<?= $article[0]['id']; ?>">Edit Article</a>
            <a class="btn primary-btn w-14rem mb-2" href="edit-article-image.php?id=<?= $article[0]['id']; ?>"><?= $article[0]['image_file'] ? 'Edit Image' : 'Add Image'; ?></a>
            <!-- <a id="" class="btn primary-btn danger-btn w-10rem" href="delete-article.php?id=<?= $article[0]['id']; ?>">Delete</a> -->
            <a id="deleteBtn" class="btn primary-btn danger-btn w-14rem mb-2" href="delete-article.php?id=<?= $article[0]['id']; ?>">Delete</a>
        </div>
    </div>
<?php else :
    Url::redirect('/user/login.php');
endif; ?>

<?php require_once(__DIR__ . '/../includes/footer.php'); ?>