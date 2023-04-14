<?php

require_once(__DIR__ . '/includes/init.php');

$conn = require_once(__DIR__ . '/includes/db.php');
$categories = Category::getAll($conn);
$art = new Article();

if (isset($_GET['id'])) {

    $article = Article::getById($conn, $_GET['id']);
    $comments = Article::getComments($conn, $_GET['id']);
} else {
    $article = null;
}

if (isMethod('post')) {

    $art->user_id = $_SESSION['user_id'];
    $art->article_id = $article->id;
    $art->comment = $_POST['comment'];

    if ($art->validate()) {

        if ($art->createComment($conn)) {
            $art->comment = '';
            $comments = Article::getComments($conn, $art->article_id);
        }
    }
}

$_title = 'Article';
$_bodyClass = 'article-page';
require_once(__DIR__ . '/includes/header.php');
?>

<div class="container overview-container" id="main-sidebar">
    <button class="openbtn d-none-desktop" id="openNav">☰ See more categories</button>
    <div id="mySidebar" class="sidebar d-none-desktop">
        <?php require(__DIR__ . '/includes/sidebar.php');  ?>
    </div>
    <div class="row mt-5 pt-4">
        <div class="col-3 sidebar-desktop d-none-mobile">
            <h3 class="">Categories</h3>
            <?php require(__DIR__ . '/includes/sidebar.php');  ?>
        </div>
        <div class="col-12 col-sm-7 mx-auto main-content ">
            <div class="">
                <?php if ($article) : ?>
                    <article class="row">
                        <h1 class="mb-5"><?= htmlspecialchars($article->title); ?></h1>
                        <?php if ($article->image_file) : ?>
                            <div class="mb-5">
                                <img class="article-img mb-3" src="../uploads/articles/<?= $article->image_file; ?>" alt="articles image">
                            </div>
                        <?php endif; ?>
                        <div class="mb-5">
                            <p class="article-text"><?= htmlspecialchars($article->description); ?></p>
                        </div>
                    </article>
                    <?php if ($comments) : ?>
                        <div class="comments-wrapper mb-5 pb-5">
                            <h3 class="mb-5">All comments in this article <span>(<?= count($comments); ?>)</span></h3>
                            <?php foreach ($comments as $comment) : ?>
                                <div class="comment d-flex align-items-center mb-3">
                                    <div class="user-avatar me-4"><?= strtoupper(substr(htmlspecialchars($comment['username']), 0, 1)); ?></div>
                                    <div class="user-comment">
                                        <p class="mt-2 mb-0"><?= htmlspecialchars($comment['comment']); ?></p>
                                        <span class="small"><?= htmlspecialchars($comment['username']) ?></span>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else : ?>
                        <h5 class="mb-5 pb-5">There are no comments in this article.</h5>
                    <?php endif; ?>
                    <?php if (Auth::isLoggedIn()) : ?>
                        <div class="mb-5 pb-5">
                            <form id="form-comment" class="mt-5" method="POST">
                                <div class="form-group">
                                    <label for="comment">
                                        <h4>Leave a Comment</h4>
                                    </label>
                                    <?php if (!empty($art->errors)) : ?>
                                        <ul>
                                            <?php foreach ($art->errors as $error) : ?>
                                                <li class="error"><?= $error; ?></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    <?php endif; ?>
                                    <textarea class="form-control" name="comment" id="comment" cols="30" rows="4"><?= htmlspecialchars($art->comment); ?></textarea>
                                </div>
                                <button class="btn primary-btn w-10rem my-3">Post</button>
                            </form>
                        </div>
                    <?php endif; ?>
                <?php else : ?>
                    <p>We could not find this article.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>





<?php require_once(__DIR__ . '/includes/footer.php'); ?>