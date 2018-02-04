<?php

namespace Business;

class TypeProduit{
    private $id;
    private $nom;

    /**
     * TypeProduit constructor.
     * @param $nom
     * @param $id
     */
    public function __construct($nom, $id=null)
    {
        $this->id = $id;
        $this->nom = $nom;
    }

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }


    public function __toString()
    {
        return $this->getNom();
    }


}