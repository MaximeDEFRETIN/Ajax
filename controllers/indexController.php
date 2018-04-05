<?php

//On vérifie que nous sommes dans l'appel AJAX pour le login
if (isset($_POST['checkLogin'])) {
    session_start();
    include_once '../configuration.php';
    include_once '../models/database.php';
    include_once '../models/users.php';
    $user = new users();
    $user->login = htmlspecialchars($_POST['checkLogin']);
    $checkLogin = $user->checkLoginUnique();
    //On vérifie que $checkLogin est différent de false mais pas de 0 ou 1
    if ($checkLogin !== false) {
        if ($checkLogin == 1) {
            $_SESSION['formError'] = true;
        }
        echo json_encode($checkLogin);
    }
} else if (isset($_POST['checkMail'])) { //On vérifie que nous sommes dans l'appel AJAX pour le mail
    include_once '../configuration.php';
    include_once '../models/database.php';
    include_once '../models/users.php';
    $user = new users();
    $user->mail = htmlspecialchars($_POST['checkMail']);
    $checkMail = $user->checkMailUnique();
    //On vérifie que $checkMail est différent de false mais pas de 0 ou 1
    if ($checkMail !== false) {
        echo json_encode($checkMail);
    }
} else {
//On instancie l'objet user pour pouvoir enregistrer un nouvel utilisateur.
    $user = new users();
//Tableau contenant les éventuelles erreurs.
    $error = array();

//On vérifie que le champ login a été rempli. Si ce n'est pas le cas on lui met une valeur vide et on rempli le tableau d'erreur.
    if (!empty($_POST['login'])) {
        $login = htmlspecialchars($_POST['login']);
    } else {
        $login = '';
        $error['login'] = ERROR_EMPTYLOGIN;
    }

    if (!empty($_POST['mail']) && filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
        $mail = htmlspecialchars($_POST['mail']);
    } else {
        $mail = '';
        $error['mail'] = ERROR_EMPTYORNOVALIDMAIL;
    }

//On vérifie que les champs mot de passe et confirmation de mot de passe ne sont pas vide.
    if (!empty($_POST['password']) && !empty($_POST['confirmPassword'])) {
        //on vérifie qu'ils sont bien identiques.
        if ($_POST['password'] == $_POST['confirmPassword']) {
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        } else {
            $password = '';
            $confirmPassword = '';
            $error['password'] = ERROR_DIFFERENTPASSWORD;
        }
    } else {
        $password = '';
        $error['password'] = ERROR_EMPTYPASSWORD;
    }

    if (count($error) == 0 && isset($_POST['register']) && (!isset($_SESSION['formError']) || !$_SESSION['formError']) ) {
        $user->login = $login;
        $user->mail = $mail;
        $user->password = $password;
        if (!$user->addUser()) {
            $error['register'] = ERROR_FAILEDREGISTER;
        }
    }
}