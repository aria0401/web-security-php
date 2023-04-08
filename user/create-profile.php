<?php

require_once(__DIR__ . '/../includes/init.php');

$user = new User();

if (isMethod('post')) {
    $conn = require_once(__DIR__ . '/../includes/db.php');

    $user->ocupation = $_POST['ocupation'];
    $user->description = $_POST['description'];
    $user->id = $_SESSION['user_id'];


    if ($user->validate()) {

        if ($user->createProfile($conn)) {
            $_SESSION['has_profile'] = true;
            Url::redirect('/user/account-management.php');
        }
    }
}

$_title = 'User - Create Profile';

require_once(__DIR__ . '/../includes/header.php');
?>

<?php if (Auth::isLoggedIn()) : ?>
    <div class="container">
        <div class="container-form-page mt-4">
            <div class=" form p-4">
                <h1 class="">Profile</h1>
                <form method="post" id="formUserValidate">
                    <?php if (!empty($user->errors)) : ?>
                        <ul>
                            <?php foreach ($user->errors as $error) : ?>
                                <li class="error"><?= $error; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                    <div class="form-group">
                        <label for="ocupation">Ocupation</label>
                        <input class="form-control" name="ocupation" type="text" id="ocupation" placeholder="Your Ocupation" value="<?= htmlspecialchars($user->ocupation); ?>">
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" name="description" id="" cols="30" rows="10" placeholder="Tell us about you"><?= htmlspecialchars($user->description); ?></textarea>
                    </div>
                    <button class="btn primary_button w-100 mt-3">Create</button>
                </form>
                <div class="mt-3">
                    <p>Already have a profile? <a href="">Edit Profile</a></p>
                </div>
            </div>
        </div>
    </div>
<?php else :
    Url::redirect('/user/login.php');
endif; ?>
<?php require_once(__DIR__ . '/../includes/footer.php'); ?>