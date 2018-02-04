<?php
/**
 * Created by PhpStorm.
 * User: HB1
 * Date: 01/02/2018
 * Time: 14:42
 */

namespace Repository;


use Business\TypeProduit;
use Data\DataConnect;
use PDO;

class TypeProduitRepository implements AbstractRepository
{
    protected $pdo;
    protected $config;
    public function __construct()
    {
        $this->pdo = DataConnect::getConnection();
    }

    /**
     * @param mixed $config
     * @return TypeProduitRepository
     */
    public function setConfig($config)
    {
        $this->config = $config;
        return $this;
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

    /**
     * @param $id
     * @return TypeProduit
     */
    public function getById($id) : TypeProduit
    {
        $statement = "select id, nom from typeproduit where id=?";
        $req = $this->pdo->prepare($statement);
        $req->execute([$id]);
        if($res = $req->fetch(PDO::FETCH_OBJ)){
            return new TypeProduit($res->nom, $id);
        }
        return null;
    }

    /**
     * @return TypeProduit[]
     */
    public function getAll()
    {
        $types = [];
        $statement = "select id from typeproduit";
        $req = $this->pdo->query($statement);
        while($res = $req->fetch(PDO::FETCH_OBJ)){
            $types[] = $this->getById($res->id);
        }
        return $types;
    }

    public function count()
    {
        $statement = "select count(*) nb from typeproduit";
        $req = $this->pdo->query($statement);
        return $req->fetch(PDO::FETCH_OBJ)->nb;
    }
}