<div class=" user-nav d-flex">
    <div class="d-flex">
        <a href="new-article.php">Create new article</a>
        <a href="articles-overview.php">View your articles</a>
        <?php if ($_SESSION['has_profile']) : ?>
            <a href="edit-profile.php?id=<?= $_SESSION['user_id']; ?>">Edit Profile</a>
        <?php else : ?>
            <a href="create-profile.php?id=<?= $_SESSION['user_id']; ?>">Create Profile</a>
        <?php endif; ?>
    </div>
</div>