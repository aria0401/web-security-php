<?php

require_once(__DIR__ . '/../includes/init.php');

$conn = require_once(__DIR__ . '/../includes/db.php');
$categories = Category::getAll($conn);
$articles = Article::getByUserID($conn, $_SESSION['user_id']);

$_title = 'User - Articles Overview';
$_overview = 'filter-overview';
$_bodyClass = 'overview-page';
$_yourArticles = 'active';

require_once(__DIR__ . '/../includes/header.php');
?>

<?php if (Auth::isLoggedIn()) : ?>
    <div class="container overview-container main-content" id="main-sidebar">
        <div class="row mt-5">
            <div class="col-11 col-xl-9 main-content">
                <h1 class="mb-5"> <?= empty($articles) ? 'No articles found' : 'Your Articles'; ?> </h1>
                <div class="d-flex-wrap" id="articlesList">
                    <?php foreach ($articles as $article) : ?>
                        <div class="item  mx-auto p-lg-2 mb-4">
                            <a class="article-a" href="article.php?id=<?= $article['id']; ?>">
                                <article class="row p-3">
                                    <?php if ($article['image_file']) : ?>
                                        <div class="col-md-2 pe-4 ps-0">
                                            <img class="article-img mb-3" src="/uploads/articles/<?= $article['image_file']; ?>" alt="articles image">
                                        </div>
                                    <?php endif; ?>
                                    <div class="col-md-10">
                                        <h3 class="article-name"><?= htmlspecialchars($article['title']); ?></h3>
                                        <p class="article-description"><?= substr(htmlspecialchars($article['description']), 0, 200) . ' ...'; ?></p>
                                    </div>
                                </article>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
<?php else :
    Url::redirect('/user/login.php');
endif; ?>

<?php require_once(__DIR__ . '/../includes/footer.php'); ?>