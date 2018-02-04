<?php
namespace Repository;
use Business\User;
use Data\DataConnect;
use PDO;

class UserRepository{

    protected $pdo;
    protected $config;
    /**
     * UserRepository constructor.
     */
    public function __construct()
    {
        $this->pdo = DataConnect::getConnection();
    }

    /**
     * @param mixed $config
     * @return UserRepository
     */
    public function setConfig($config)
    {
        $this->config = $config;
        return $this;
    }

    /**
     * @param $login
     * @param $password
     * @return User|null
     */
    public function connect($login, $password){
        $statement = "select id, login, password, isAdmin from user where login=? and password=?";
        $req = $this->pdo->prepare($statement);
        $req->execute([$login, $password]);
        if($res = $req->fetch(PDO::FETCH_OBJ)){
            return new User($res->id, $res->login, $res->password, $res->isAdmin);
        }
        return null;
    }

}