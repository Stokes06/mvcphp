<?php

namespace Business;

use Service\Configuration;

class Produit{
    private $id;
    private $nom;
    private $prix;
    private $type;
    private $numero_mois;
    private $stock;
    protected $image;

    /**
     * Produit constructor.
     * @param null|string $nom
     * @param int|float $prix
     * @param TypeProduit|null $type
     * @param null|int $numero_mois
     * @param int|int $stock
     * @param null|string $image
     * @param null|int $id
     */
    public function __construct($nom = null, $prix = 0, TypeProduit $type=null, $numero_mois=null, $stock=0, $image=null, $id=null)
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->prix = $prix;
        $this->type = $type;
        $this->numero_mois = $numero_mois;
        $this->stock = $stock;
        $this->image = $image;
    }


    /**
     * @return string Nom de la saison correspondante au mois de semis du produit
     */
    public function getSaison() : string {
        return $this->numero_mois <= 3 ? "hiver"
            : ($this->numero_mois <= 6 ? "printemps"
                : ($this->numero_mois<= 9 ? "été"
                    : "automne"));
    }

    public function afficherStock() : string{
        return $this->stock > 5 ? "<span class=\"label label-success\">produit en stock</span>"
            : ($this->stock > 0 ? "<span class=\"label label-warning\">bientôt plus de stock</span>"
                : "<span class=\" label label-danger\">en attente de livraison</span>");
    }

    /**
     * @return integer
     */
    public function getId() : int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Produit $this
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }


    /**
     * @return string nom
     */
    public function getNom() : string
    {
        return $this->nom;
    }


    /**
     * @param $nom
     * @return $this
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
        return $this;
    }

    /**
     * @return float
     */
    public function getPrix(): float
    {
        return $this->prix;
    }

    /**
     * @param float $prix
     * @return $this
     */
    public function setPrix(float $prix)
    {
        $this->prix = $prix;
        return $this;
    }

    /**
     * @return TypeProduit
     */
    public function getType()
    {
        return $this->type;
    }


    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return null
     */
    public function getNumeroMois()
    {
        return $this->numero_mois;
    }


    public function setNumeroMois($numero_mois)
    {
        if($numero_mois > 12 || $numero_mois < 1)
            throw new \InvalidArgumentException("le numéro du mois doit être compris entre 1 et 12.");
        $this->numero_mois = $numero_mois;
        return $this;
    }

    /**
     * @return int
     */
    public function getStock(): int
    {
        return $this->stock;
    }

    /**
     * @param int $stock
     * @return $this;
     */
    public function setStock(int $stock)
    {
        $this->stock = $stock;
        return $this;
    }

    public function __toString()
    {
        return $this->getNom()."\n".$this->getSaison()."\n".$this->getType()->getNom();
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * @return string path to the image of the product, which is unique
     */
    public function getPath(){
        $dir = Configuration::getConfig()->getPath();
        return $dir.$this->getId()."_".$this->getImage();
    }
    public function getMois(){
        $months = [
            1 => "janvier",
            2 => "février",
            3 => "mars",
            4 => "avril",
            5 => "mai",
            6 => "juin",
            7 => "juillet",
            8 => "aout",
            9 => "septembre",
            10 => "octobre",
            11 => "novembre",
            12 => "décembre"
        ];
        return $months[$this->getNumeroMois()];
    }
}