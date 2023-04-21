<?php

require_once(__DIR__ . '/../includes/init.php');
$conn = require_once(__DIR__ . '/../includes/db.php');

if (isset($_GET['id'])) {

    $article = Article::getById($conn, $_GET['id']);

    if (!$article) {
        die("article not found");
    }
} else {
    die("id not supplied, article not found");
}


$image = new Image();

if (isMethod('post')) {
    require_once(__DIR__ . '/../includes/csrf_validate.php');

    $image->file_error = $_FILES['file']['error'];
    $image->file_size = $_FILES['file']['size'];
    $image->file_name = $_FILES['file']['name'];

    $extension = pathinfo($_FILES['file']['name'])['extension'];


    if ($image->validate()) {
        $folder = "../uploads/articles/";
        $destination = $image->fileName($folder)[0];
        $filename = $image->fileName($folder)[1];

        if (move_uploaded_file($_FILES['file']['tmp_name'], $destination)) {

            $previous_image = $article->image_file;

            if ($article->setImageFile($conn, $filename)) {

                if ($previous_image) {
                    unlink($folder . $previous_image); //to delete a file in PHP
                }
                header('Content-Type: image/' . $extension . '');
                Url::redirect("/user/article.php?id={$article->id}");
            }
        } else {
            echo 'Unable to move uploaded file';
        }
    }
}


$_title = 'User - Edit Article Image';
require_once(__DIR__ . '/../includes/header.php');
require_once(__DIR__ . '/../includes/modal.php');
?>

<?php if (Auth::isLoggedIn()) : ?>
    <div class="container my-5 main-content">
        <?php if ($article) : ?>
            <article class="py-lg-5 row">
                <?php if ($article->image_file) : ?>
                    <div class="d-flex flex-column col-lg-3 mb-4 mb-lg-2">
                        <img class="" src="../uploads/articles/<?= $article->image_file; ?>" alt="article image">
                        <a id="deleteBtn" class="primary-btn danger-btn mt-4" href="delete-article-image.php?id=<?= $article->id; ?>">Delete Image</a>
                    </div>
                <?php endif; ?>
                <div class="mb-4 col-lg-7">
                    <h1 class="mb-3"><?= htmlspecialchars($article->title); ?></h1>
                    <p class=""><?= htmlspecialchars($article->description); ?></p>
                </div>
            </article>
        <?php else : ?>
            <p>We could not find this article.</p>
        <?php endif; ?>

        <?php if (!empty($image->errors)) : ?>
            <ul>
                <?php foreach ($image->errors as $error) : ?>
                    <li class="error"><?= $error; ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
        <form method="post" enctype="multipart/form-data">
            <div>
                <label for="file">Image file</label>
                <input class="btn" type="file" name="file" id="file">
            </div>
            <input type="hidden" name="token" value="<?= $_SESSION['token'] ?? ''; ?>">
            <button class="btn primary-btn w-10rem mt-3">Upload</button>
        </form>
    </div>
<?php else :
    Url::redirect('/user/login.php');
endif; ?>

<?php require_once(__DIR__ . '/../includes/footer.php'); ?>