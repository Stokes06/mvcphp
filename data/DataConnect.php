<?php
namespace Data;
use Dev\Tool;
use PDO;
use PDOException;
use Service\Configuration;
class DataConnect{

    public static $pdo;

    /**
     * get the connexion with database epicerie
     * @return PDO
     */
    public static function getConnection(){
        $config = Configuration::getConfig();
        $host =      $config->getHost();
        $db =        $config->getDatabase();
        $user =      $config->getUsername();
        $password =  $config->getPassword();

        if(self::$pdo) return self::$pdo;
        try {
            self::$pdo = new PDO("mysql:host=$host;dbname=$db", "$user", "$password",array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
//Pour voir les erreurs
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            Tool::debug($e);
            die();//not sure about that
        }

        return self::$pdo;
    }
}