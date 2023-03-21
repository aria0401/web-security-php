<?php

require_once(__DIR__ . '/../includes/init.php');

?>
<?php
$_title = 'User Account';
$_headerClass = 'dark';
?>
<?php require_once(__DIR__ . '/../includes/header.php');  ?>



<?php if (Auth::isLoggedIn()) : ?>
    <div class="main-content">
        <?php require_once(__DIR__ . '/../includes/user_nav.php'); ?>
    </div>
<?php require_once(__DIR__ . '/../includes/footer.php');
endif; ?>