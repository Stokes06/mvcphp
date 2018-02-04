<?php
namespace Repository;

use Data\DataConnect;
use PDO;

abstract class  AppRepository implements RepositoryInterface {

    protected $pdo;
    protected $config;
    public static $NUMBER_PER_PAGE = 10;
    public function __construct()
    {
        $this->pdo = DataConnect::getConnection();
    }

    /**
     * @param mixed $config
     * @return AppRepository
     */
    public function setConfig($config)
    {
        $this->config = $config;
        return $this;
    }


    public function getPage($page, $query, $params=[], $sort=null){
        $req = $this->pdo->prepare($query);

        foreach ($params as $key=> &$param) {
            $req->bindParam($key, $param);
        }
        $req->execute();
        $count = $req->rowCount();
        if($count==0) {
            return new Page([], 0);
        }
        $order = null;
        $direction = null;
        if($sort){
            $a = explode(",", $sort);
            $order = $a[0];
            $direction = !isset($a[1]) ?  'ASC': (strtolower($a[1])=="desc" ? 'DESC' : 'ASC');
        }else{
            $order = "id";
            $direction = "desc";
        }
        $query .= " order by $order ".$direction;

        $pageMax = (int)floor($count / self::$NUMBER_PER_PAGE) + ($count % self::$NUMBER_PER_PAGE == 0 ? 0 : 1);
        $page = $page > $pageMax ? $pageMax : ($page > 0 ? $page : 1);
        $offset = ($page - 1) * self::$NUMBER_PER_PAGE;
        $statement = $query . " limit :offset, :limit";


        $req = $this->pdo->prepare($statement);

        foreach ($params as $key => &$param) {
            $req->bindParam($key, $param);
        }
        $req->bindValue("offset", (int)$offset, PDO::PARAM_INT);
        $req->bindValue("limit", (int)self::$NUMBER_PER_PAGE, PDO::PARAM_INT);

        $req->execute();
        $res = $req->fetchAll(PDO::FETCH_OBJ);
        $produits = [];
        foreach ($res as $row) {
            $produits[] = $this->getById($row->id);
        }
        return new Page($produits, $count);
    }

    public abstract function delete($id);

    public abstract function create($object);

    public abstract function update($object);

    public abstract function getById($id);

    public abstract function getAll();

    public abstract function count();
}