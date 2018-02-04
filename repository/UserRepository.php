<?php
namespace Repository;
use Business\User;
use Data\DataConnect;
use PDO;

class UserRepository extends AppRepository {

    /**
     * UserRepository constructor.
     */
    public function __construct()
    {
        parent::__construct();
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

    public function delete($id)
    {
        // TODO: Implement delete() method.
    }

    public function create($object)
    {
        // TODO: Implement create() method.
    }

    public function update($object)
    {
        // TODO: Implement update() method.
    }

    public function getById($id)
    {
        // TODO: Implement getById() method.
    }

    public function getAll()
    {
        // TODO: Implement getAll() method.
    }

    public function count()
    {
        // TODO: Implement count() method.
    }
}