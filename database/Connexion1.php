<?php
/**
 * Created by PhpStorm.
 * User: Kevin
 * Date: 13/07/2021
 * Time: 21:27
 */

    define('DB_HOST','localhost');
    define('DB_USER','root');
    define('DB_PASS','');
    define('DB_NAME','annuaire');
    try {
        $db_con = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME,DB_USER,DB_PASS);
    } catch(PDOException $e) {
        echo 'ERREUR DB CONNEXION';die();
    }