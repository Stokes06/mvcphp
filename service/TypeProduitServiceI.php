<?php
/**
 * Created by PhpStorm.
 * User: HB1
 * Date: 01/02/2018
 * Time: 14:40
 */

namespace Service;


use Business\TypeProduit;
use Repository\FactoryRepository;

class TypeProduitServiceI implements TypeProduitService
{

    protected $typeRepository;
    protected $config;
    public function __construct()
    {
        $this->typeRepository = FactoryRepository::getRepository("type");
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



    /**
     * @param $id
     * @return TypeProduit
     */
    public function getById($id)
    {
        return $this->typeRepository->getById($id);
    }

    /**
     * @return TypeProduit[]
     */
    public function getAll()
    {
        return $this->typeRepository->getAll();
    }
}