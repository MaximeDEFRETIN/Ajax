<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of database
 *
 * @author mickael
 */
class database {

    protected $db;

    protected function __construct() {
        try {
            $this->db = new PDO('mysql:host=' . HOST . ';dbname=' . DBNAME . ';charset=utf8', LOGIN, PASSWORD);
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }

    protected function __destruct() {
        $this->db = NULL;
    }
}
