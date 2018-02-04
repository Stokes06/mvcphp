<?php
namespace Service;
use Business\Produit;
use Business\TypeProduit;
use Repository\FactoryRepository;
use Repository\ProduitRepository;
use Repository\TypeProduitRepository;

class ProduitServiceI implements ProduitService{

    /** @var TypeProduitRepository*/
    protected $typeRepo;
    /** @var  Produit[] $produits */
    protected $produits;
    /** @var ProduitRepository */
    protected $produitRepo;
    /**
     * ProduitServiceI constructor.
     */
    protected $config;
    public function __construct()
    {
        $this->produitRepo = FactoryRepository::getRepository(PRODUCT);
        $this->typeRepo = FactoryRepository::getRepository(TYPE);
    }

    /**
     * @param mixed $config
     * @return $this
     */
    public function setConfig($config)
    {
        $this->config = $config;
        return $this;
    }

    public function delete($id)
    {
      return $this->produitRepo->delete($id);
    }

    /**
     * @param $nom
     * @param $prix
     * @param $stock
     * @param $mois
     * @param $type
     * @param $image
     * @return Produit
     */
    public function create($nom, $prix, $stock, $mois, $idType, $image)
    {
        $type = $this->typeRepo->getById($idType);
        $produit = new Produit($nom, $prix, $type, $mois, $stock, $image, null);

        $produit = $this->produitRepo->create($produit);
        if($produit->getId()!=null && $produit->getImage()!=null){
            $this->downloadImage($produit->getId());
        }
        return $produit;
    }

    public function downloadImage($idProduit){
        $file_upload = substr($this->config->getPath(), 1);
    //    echo exec('whoami');
        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0)
        {
            if ($_FILES['image']['size'] <= 2000000) // < 2mo
            {
                $infosfichier = pathinfo($_FILES['image']['name']);
                $extension_upload = $infosfichier['extension'];
                $extensions_autorisees = array('jpg','jpeg','gif','png','JPG','JPEG','GIF','PNG');
                if(in_array($extension_upload, $extensions_autorisees))
                {
                    $filename = basename($_FILES['image']['name']);
                    if(move_uploaded_file($_FILES['image']['tmp_name'],
                        $file_upload .$idProduit."_". $filename)){
                        echo "L'envoi a bien été effectué !";
                    }
                }
            }else{ 
                echo "fichier trop gros";
            }
        }else{
            echo "\n un probleme ? ";
        }
    }

    /**
     * @param $nom
     * @param $prix
     * @param $stock
     * @param $mois
     * @param $type
     * @param $image
     * @return Produit
     */
    public function update($id, $nom, $prix, $stock, $mois, $idType, $image)
    {
        $this->downloadImage($id);
        $type = $this->typeRepo->getById($idType);
        $produit = new Produit($nom, $prix, $type, $mois, $stock, $image, $id);
        return $this->produitRepo->update($produit);
    }

    /**
     * @param $id
     * @return Produit
     */
    public function getById($id)
    {
        return $this->produitRepo->getById($id);
    }

    /**
     * @param int $page page souhaitée
     * @return Produit[] les produits correspondants à la page
     */
    public function getAll($page=1)
    {
        return  $this->produitRepo->getAll($page);
    }

    /**
     * @param int $idType id tu type que l'on veut
     * @return Produit[]
     */
    public function getProduitsByTypeId($idType, $page=1)
    {
        return $this->produitRepo->getAllByTypeId($idType, $page);
    }

    /**
     * @param $page
     * @param $type
     * @param $nom
     * @param $sort
     * @return \Repository\Page
     */
    public function applyFiltersAndSorting($page, $type, $nom, $sort){
        return $this->produitRepo->applyFiltersAndSorting($page, $type, $nom, $sort);
    }
    public function getProduitsBySort($page, $sort)
    {
       return $this->produitRepo->getBySort($page, $sort);
    }

    public function filtrerParNom($nom)
    {
        return $this->produits = array_filter($this->produits, function (Produit $e) use ($nom) {
            return strpos($e->getNom(), $nom)===0;
        });
    }

    private function sortByNomAsc()
    {
      uasort($this->produits, function(Produit $a, Produit $b){
            return $a->getNom() < $b->getNom() ? -1 : 1;
        });
    }

    private function sortByNomDesc()
    {
         uasort($this->produits, function(Produit $a,Produit $b){
            return $a->getNom() < $b->getNom() ? 1 : -1;
        });
    }

    private function sortByPrixAsc()
    {
       uasort($this->produits, function(Produit $a,Produit $b){
            return $a->getPrix() < $b->getPrix() ? -1 : 1;
        });
    }

    private function sortByPrixDesc()
    {
        uasort($this->produits, function(Produit $a,Produit $b){
            return $a->getPrix() < $b->getPrix() ? 1 : -1;
        });
    }

    private function sortByTypeAsc()
    {
         uasort($this->produits, function(Produit $a,Produit $b){
            return $a->getType() < $b->getType() ? -1 : 1;
        });
    }

    private function sortByTypeDesc()
    {
       uasort($this->produits, function(Produit $a,Produit $b){
            return $a->getType() < $b->getType() ? 1 : -1;
        });
    }

    private function sortByStockAsc()
    {
         uasort($this->produits, function(Produit $a,Produit $b){
            return $a->getStock() < $b->getStock() ? -1 : 1;
        });
    }

    private function sortByStockDesc()
    {
         uasort($this->produits, function(Produit $a,Produit $b){
            return $a->getStock() < $b->getStock() ? 1 : -1;
        });
    }

    private function sortByMoisDesc()
    {
        uasort($this->produits, function(Produit $a,Produit $b){
            return $a->getNumeroMois() < $b->getNumeroMois() ? 1 : -1;
        });
    }

    private function sortByMoisAsc()
    {
        uasort($this->produits, function(Produit $a,Produit $b){
            return $a->getNumeroMois() < $b->getNumeroMois() ? -1 : 1;
        });
    }

    public function count()
    {
        return $this->produitRepo->count();
    }

}