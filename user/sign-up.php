<?php

require_once(__DIR__ . '/../includes/init.php');

$user = new User();
$sent = false;
$accountExists = false;

if (isMethod('post')) {

    $conn = require_once(__DIR__ . '/../includes/db.php');

    $user->username = $_POST['username'];
    $user->password = $_POST['password'];
    $userId;

    if ($user->validate()) {

        if (!$user->authenticateUser($conn)) {
            if ($user->create($conn)) {

                $message = 'Thank you for signing up!';
                $newUser = User::getById($conn, $user->id);
            }
        } else {
            $accountExists = true;
        }
    }
}

$_title = 'User - Sign up';
$_bodyClass = 'sign-up-page';
$_sign_up = 'active';
require_once(__DIR__ . '/../includes/header.php');
?>

<?php if ($message) : ?>
    <div class="container send-message mt-5 py-5 main-content">
        <p class=""><?= $message; ?></p>
    </div>
<?php else : ?>
    <div class="container">
        <div class="container-form-page mt-4 py-5 main-content">
            <h1 class="form-heading mb-4">Sign up</h1>
            <div class=" form p-4 px-lg-5">
                <form method="post" id="formUserValidate">
                    <?php if ($accountExists) : ?>
                        <p class="error">An account with these credentials already exists.</p>
                    <?php endif; ?>
                    <?php if (!empty($user->errors)) : ?>
                        <ul>
                            <?php foreach ($user->errors as $error) : ?>
                                <li class="error"><?= $error; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                    <div class="form-group my-4">
                        <label for="username">username</label>
                        <input class="form-control" type="text" name="username" id="username" value="<?= htmlspecialchars($user->username); ?>" required autofocus>
                    </div>
                    <div class="form-group my-4">
                        <label for="password">Password</label>
                        <input class="form-control" type="password" name="password" id="password" value="<?= htmlspecialchars($user->password); ?>" minlength="2" maxlength="5" required>
                    </div>
                    <button class="btn primary-btn w-100 my-4">Sign up</button>
                </form>
            </div>
            <div class="mt-3">
                <p class="text-center">Already have an account? <a class="secondary-btn mx-3" href="/user/login.php">Log in</a></p>
            </div>
        </div>
    </div>

<?php endif; ?>
<?php require_once(__DIR__ . '/../includes/footer.php'); ?>