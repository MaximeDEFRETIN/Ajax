<?php
session_start();
include_once 'configuration.php';
include_once 'assets/lang/'. (isset($_GET['lang'])? $_GET['lang']: 'FR_FR').'.php';
include_once 'models/database.php';
include_once 'models/users.php';
include_once 'controllers/indexController.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <link href="assets/css/style.css" rel="stylesheet" type="text/css" />
        <script src="vendor/components/jquery/jquery.min.js" type="text/javascript"></script>
        <title><?= HEAD_REGISTERTITLE ?></title>
    </head>
    <body>
        <div>
            <a href="/FR_FR.html">Français</a>
            <a href="/EN_EN.html">English</a>
        </div>
        <form action="index.php" method="POST">
            <p><label for="login"><?= FORM_LOGIN ?></label><input type="text" name="login" id="login" onblur="checkLoginUnique()" />
                <span id="errorCheckLoginUnique"><?= ERROR_LOGINUNIQUE ?></span></p>
            <p><label for="mail"><?= FORM_MAIL ?></label><input type="mail" name="mail" id="mail" onblur="checkMailUnique()" />
                <span id="errorCheckMailUnique"><?= ERROR_MAILUNIQUE ?></span></p>
            <p><label for="password"><?= FORM_PASSWORD ?></label><input type="password" name="password" id="password" /></p>
            <p><label for="confirmPassword"><?= FORM_CONFIRMPASSWORD ?></label><input type="password" name="confirmPassword" id="confirmPassword" /></p>
            <p><input type="submit" value="<?= FORM_REGISTER ?>" name="register" /></p>
        </form>
        <?php if (isset($_POST['register'])) {
            foreach ($error as $errorDetail) {
                ?>
                <p> <?= $errorDetail; ?> </p> <?php }
}
        ?>
        <script src="assets/js/checkUnique.js" type="text/javascript"></script>
    </body>
</html>
