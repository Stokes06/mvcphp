<?php

namespace Repository;

use Business\Produit;
use Business\TypeProduit;
use Data\DataConnect;
use Dev\Tool;
use PDO;
use Service\TypeProduitServiceI;

class ProduitRepository implements AbstractRepository
{
    const NUMBER_PER_PAGE = 6;
    protected $config;
    protected $pdo;
    /** @var TypeProduitRepository */
    protected $typeRepository;

    /**
     * ProduitRepository constructor.
     */
    public function __construct()
    {
        $this->pdo = DataConnect::getConnection();
        $this->typeRepository = FactoryRepository::getRepository(TYPE);
    }

    /**
     * @param mixed $config
     * @return ProduitRepository
     */
    public function setConfig($config)
    {
        $this->config = $config;
        return $this;
    }

    /**
     * @param $idType
     * @param int $page
     * @return array
     */
    public function getAllByTypeId($idType, $page = 1)
    {
        return $this->getPage($page, "where idType=?", $idType);
    }

    /**
     * @param $id
     * @return bool
     */
    public function delete($id): bool
    {

        $produit = $this->getById($id);
        if ($produit == NULL)
            return false;
        try {
            if (unlink(substr($produit->getPath(), 1))) {
                echo "fichier supprimé";
            }
        } catch (\Exception $exceptione) {
            echo $exceptione->getMessage();
        }

        $sql = "delete from produit where id=?";
        $req = $this->pdo->prepare($sql);
        $req->execute([$id]);
        return $req->columnCount() > 0;
    }

    /**
     * @param Produit $produit
     * @return Produit|null
     */
    public function create($produit)
    {
        $statement = "insert into produit(nom, prix, mois, stock, image, idType)  value(?,?,?,?,?,?)";
        $req = $this->pdo->prepare($statement);
        return ($req->execute([
            $produit->getNom(),
            $produit->getPrix(),
            $produit->getNumeroMois(),
            $produit->getStock(),
            $produit->getImage(),
            $produit->getType()->getId()
        ])) ? $produit->setId($this->pdo->lastInsertId())
            : null;
    }

    /**
     * @param Produit $produit
     * @return Produit|null
     */
    public function update($produit)
    {
        $statement = "update produit 
                       set nom=?, prix=?, mois=?, stock=?, image=?, idType=?
                      where id=?";
        $req = $this->pdo->prepare($statement);
        return ($req->execute([
            $produit->getNom(),
            $produit->getPrix(),
            $produit->getNumeroMois(),
            $produit->getStock(),
            $produit->getImage(),
            $produit->getType()->getId(),
            $produit->getId()
        ])) ? $produit
            : null;
    }

    /**
     * @param $id
     * @return Produit|null
     */
    public function getById($id): Produit
    {
        $statement = "select nom, prix, mois, stock, image, idType 
                      from produit
                      where id=?";
        $req = $this->pdo->prepare($statement);
        $req->execute([$id]);
        return ($res = $req->fetch(PDO::FETCH_OBJ)) ?
            new Produit($res->nom,
                $res->prix,
                $this->typeRepository->getById($res->idType),
                $res->mois,
                $res->stock,
                $res->image,
                $id
            ) : null;
    }

    /**
     * @param int $page
     * @return array
     */
    public function getAll($page = 1)
    {
        return $this->getPage($page);
    }
    public function getBySort($page, $sort){
        $sort = str_replace(",", " ", $sort);
        $query = "order by $sort";
        return $this->getPage($page, $query);
    }

    /**
     * @param $page
     * @param string $query
     * @param array $params
     * @param string|null $sort
     * @return Page
     */
    public function getPage($page, $query="",  $params = [], $sort=null)
    {
        $query = "select id from produit ".$query;
       // Tool::debug($params);
        $req = $this->pdo->prepare($query);
       // Tool::debug($req);
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
            $direction = isset($a[1]) ? 'DESC': 'ASC';
            $query .= " order by $order ".$direction;
        }

        $pageMax = (int)floor($count / self::NUMBER_PER_PAGE) + ($count % self::NUMBER_PER_PAGE == 0 ? 0 : 1);
        $page = $page > $pageMax ? $pageMax : ($page > 0 ? $page : 1);
        $offset = ($page - 1) * self::NUMBER_PER_PAGE;
        $statement = $query . " limit :offset, :limit";


        $req = $this->pdo->prepare($statement);

        foreach ($params as $key => &$param) {
            $req->bindParam($key, $param);
        }
        $req->bindValue("offset", (int)$offset, PDO::PARAM_INT);
        $req->bindValue("limit", (int)self::NUMBER_PER_PAGE, PDO::PARAM_INT);

        $req->execute();
        $res = $req->fetchAll(PDO::FETCH_OBJ);
        $produits = [];
        foreach ($res as $row) {
            $produits[] = $this->getById($row->id);
        }
        return new Page($produits, $count);
    }

    /**
     * @param int $page
     * @param null $type
     * @param null $nom
     * @param null $sort
     * @return Page
     */
    public function applyFiltersAndSorting($page=1, $type=null, $nom=null, $sort=null){
        if($nom) $nom .= "%";
        $query = "";
        if($type){
            $query .= "where idType = :type ";
            if($nom)
                $query .= "and nom LIKE :nom ";
        }else if($nom){
            $query .= "where nom LIKE :nom ";
        }

        $params = compact("type","nom");
        $params =  array_filter($params, function($param){ return $param != null;});

        return $this->getPage($page, $query, $params, $sort);
    }
    public function count()
    {
        $statement = "select count(*) nb from produit";
        $req = $this->pdo->query($statement);
        return $req->fetch(PDO::FETCH_OBJ)->nb;
    }
}