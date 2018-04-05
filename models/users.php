<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of users
 *
 * @author mickael
 */
class users extends database {

    public $id = 0;
    public $login = '';
    public $mail = '';
    public $password = '';
    private $tablename = TABLEPREFIX . 'users';

    public function __construct() {
        parent::__construct();
    }

    public function addUser() {
        $query = 'INSERT INTO `' . $this->tablename . '` (`login`,`mail`,`password`) VALUES (:login, :mail, :password)';
        $addUser = $this->db->prepare($query);
        $addUser->bindValue(':mail', $this->mail, PDO::PARAM_STR);
        $addUser->bindValue(':login', $this->login, PDO::PARAM_STR);
        $addUser->bindValue(':password', $this->password, PDO::PARAM_STR);
        return $addUser->execute();
    }

    /**
     * Méthode permettant de savoir si un login est déjà pris
     * @return boolean
     */
    public function checkLoginUnique() {
        $query = 'SELECT COUNT(`login`) AS nbLogin'
                . ' FROM ' . $this->tablename
                . ' WHERE `login` = :login';
        $checkLoginUnique = $this->db->prepare($query);
        $checkLoginUnique->bindValue(':login', $this->login, PDO::PARAM_STR);
        if ($checkLoginUnique->execute()) {
            //return $checkLoginUnique->fetch(PDO::FETCH_OBJ)->nbLogin;
            $checkLoginUniqueResult = $checkLoginUnique->fetch(PDO::FETCH_OBJ);
            return $checkLoginUniqueResult->nbLogin;
        } else {
            return false;
        }
    }

    /**
     * Méthode permettant de savoir si une adresse mail est déjà prise
     * @return boolean
     */
    public function checkMailUnique() {
        $query = 'SELECT COUNT(`mail`) AS nbMail'
                . ' FROM ' . $this->tablename
                . ' WHERE `mail` = :mail';
        $checkMailUnique = $this->db->prepare($query);
        $checkMailUnique->bindValue(':mail', $this->mail, PDO::PARAM_STR);
        if ($checkMailUnique->execute()) {
            //return $checkMailUnique->fetch(PDO::FETCH_OBJ)->nbMail;
            $checkMailUniqueResult = $checkMailUnique->fetch(PDO::FETCH_OBJ);
            return $checkMailUniqueResult->nbMail;
        } else {
            return false;
        }
    }

    public function __destruct() {
        parent::__destruct();
    }

}
