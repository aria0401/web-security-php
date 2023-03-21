<?php
require_once(__DIR__ . '/../includes/init.php');

$user = new User();

if (isMethod('post')) {

    $conn = require_once(__DIR__ . '/../includes/db.php');
    $user->username = $_POST['username'];
    $user->password = $_POST['password'];

    if ($user->validate()) {

        if ($user->authenticateLogin($conn, $user->password)) {

            $userObj = User::getByUsername($conn, $user->username);
            Auth::login($userObj);
            Url::redirect('/blog.php');
        } else {
            $error = 'Login incorrect. Make sure you have the right credentials.';
        }
    }
}
?>
<?php $_title = 'User - Log in';
$_headerClass = 'light';
?>
<?php require_once(__DIR__ . '/../includes/header.php');  ?>

<div class="container-form-page mt-4 py-5 main-content">
    <div class="form p-4">
        <h1>Log in</h1>
        <form method="post" id="formUserValidate">
            <?php if (!empty($error)) : ?>
                <p class="error"><?= $error; ?></p>
            <?php endif; ?>
            <?php if (!empty($user->errors)) : ?>
                <ul>
                    <?php foreach ($user->errors as $error) : ?>
                        <li class="error"><?= $error; ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
            <div class="form-group">
                <label for="username">Username</label>
                <input class="form-control" type="text" name="username" id="username" value="<?= htmlspecialchars($user->username); ?>" required autofocus>
            </div>
            <div class="form-group mt-2">
                <label for="password">password</label>
                <input class="form-control" type="password" name="password" id="password" value="<?= htmlspecialchars($user->password); ?>" minlength="2" maxlength="5" required>
            </div>
            <button class="btn primary_button w-100 mt-3">Log in</button>
        </form>
    </div>
    <div class="mt-3">
        <a href="/user/sign-up.php">
            <button class="btn secondary_button w-100">Create your account</button>
        </a>
    </div>
</div>


<?php require_once(__DIR__ . '/../includes/footer.php'); ?>