<?php

require_once(__DIR__ . '/includes/init.php');

$conn = require_once(__DIR__ . '/includes/db.php');
$categories = Category::getAll($conn);

if (isMethod('get')) {

    $articles = Article::getByCategory($conn, $_GET['category']);

    foreach ($categories as $category) {
        if ($category['name'] == $_GET['category']) {
            $categoryTitle = $category['title'];
        }
    }
}


$_title = 'Articles Overview';
$_risks = 'active';
$_overview = 'filter-overview';
$_bodyClass = 'overview-page';
require_once(__DIR__ . '/includes/header.php');
?>

<div class="container overview-container" id="main-sidebar">
    <button class="openbtn d-none-desktop" id="openNav">☰ See more categories</button>
    <div id="mySidebar" class="sidebar d-none-desktop">
        <?php require(__DIR__ . '/includes/sidebar.php');  ?>
    </div>
    <div class="row mt-5 pt-4">
        <div class="col-3 sidebar-desktop d-none-mobile">
            <h3>Categories</h3>
            <?php require(__DIR__ . '/includes/sidebar.php');  ?>
        </div>
        <div class="col-lg-7 mx-auto main-content">
            <h1 class="category-title mb-5"> <?= htmlspecialchars($categoryTitle); ?> </h1>
            <p class="not-found"> <?= empty($articles) ? 'No articles found' : null; ?> </p>

            <div class="d-flex-wrap mb-5 pb-5" id="articlesList">
                <?php foreach ($articles as $article) : ?>
                    <?php if ($article['is_visible']) : ?>
                        <div class="item mb-4">
                            <a class="article-a" href="article.php?id=<?= $article['id']; ?>">
                                <article class="d-flex flex-row p-2">
                                    <div>
                                        <h3 class="article-name"><?= htmlspecialchars($article['title']); ?></h3>
                                        <p class="article-description"><?= substr(htmlspecialchars($article['description']), 0, 200) . '...'; ?></p>
                                    </div>
                                </article>
                            </a>
                        </div>
                <?php endif;
                endforeach; ?>
            </div>
            <template class="article-template">
                <div class="item mb-4">
                    <a class="article-a" href="">
                        <article class="d-flex flex-row p-2">
                            <div>
                                <h3 class="article-name"></h3>
                                <p class="article-description"></p>
                            </div>
                        </article>
                    </a>
                </div>
            </template>
        </div>
    </div>
</div>

<?php require_once(__DIR__ . '/includes/footer.php'); ?>