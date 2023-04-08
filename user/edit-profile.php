<?php
require_once(__DIR__ . '/../includes/init.php');

$conn = require_once(__DIR__ . '/../includes/db.php');
$newUser = new User();

$ocupation;
$description;
$authenticated = true;

if (isMethod('get')) {
    if ($_GET['id'] == $_SESSION['user_id']) {
        $current_user = User::getById($conn, $_GET['id']);

        //display current values in the form
        $ocupation = $current_user->ocupation;
        $description = $current_user->description;
    } else {
        $authenticated = false;
    }
}


if (isMethod('post')) {

    $newUser->ocupation = $_POST['ocupation'];
    $newUser->description = $_POST['description'];
    // $newUser->password = $_POST['password'];
    $newUser->id = $_SESSION['user_id'];

    //display new values in the form
    $ocupation = $newUser->ocupation;
    $description = $newUser->description;


    if ($newUser->validate()) {

        if ($newUser->authenticateUser($conn)) {
            if ($newUser->updateProfile($conn)) {

                $message = 'Your profile has been updated';
            }
        }
    }
}

$_title = 'User - Edit Profile';
$_headerClass = 'dark';
$_yourProfile = 'active';
?>

<?php require_once(__DIR__ . '/../includes/header.php'); ?>
<?php if (Auth::isLoggedIn()) : ?>
    <?php require_once(__DIR__ . '/../includes/user_nav.php'); ?>
    <?php if ($message) : ?>
        <div class="container-form-page send-message mt-4">
            <div class="form p-4">
                <h4 class=""><?= $message; ?></h4>
            </div>
        </div>
    <?php else : ?>
        <div class="container-form-page mt-4 py-5 main-content">
            <?php if ($authenticated) : ?>
                <div class=" form p-4 py-5">
                    <h1 class="">Edit profile when you have one.</h1>
                    <?php if (!empty($user_not_found)) : ?>
                        <p class="mt-3" class="error"><?= $user_not_found; ?></p>
                    <?php endif; ?>
                    <form method="post">

                        <?php if (!empty($newUser->errors)) : ?>
                            <ul>
                                <?php foreach ($newUser->errors as $error) : ?>
                                    <li class="error"><?= $error; ?></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                        <div class="form-group">
                            <label for="ocupation">Ocupation</label>
                            <input class="form-control" type="text" name="ocupation" id="ocupation" value="<?= htmlspecialchars($ocupation); ?>" placeholder="New username">
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" name="description" id="" cols="30" rows="10" placeholder="Tell us about you"><?= htmlspecialchars($description); ?></textarea>
                        </div>
                        <!-- <div class="form-group mt-2">
                            <label for="password">Password</label>
                            <input class="form-control" type="password" name="password" id="password" value="<?= htmlspecialchars($newUser->password); ?>" placeholder="New password">
                        </div> -->
                        <button class="btn primary_button w-100 mt-3">Edit Profile</button>
                    </form>
                </div>
            <?php else : ?>
                <h2>You don't have permission to edit this user.</h2>
            <?php endif; ?>
        </div>
    <?php endif; ?>
<?php else :
    Url::redirect('/user/login.php');
endif; ?>
<?php require_once(__DIR__ . '/../includes/footer.php'); ?>