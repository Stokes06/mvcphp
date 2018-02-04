<?php
namespace Repository;
use Service\Configuration;

class FactoryRepository{

    /**
     * produit for ProduitRepository
     * type for TypeRepository
     * user for UserRepository
     * @param $name
     * @return null|ProduitRepository|TypeProduitRepository|UserRepository
     */
    public static function getRepository($name){

        switch ($name){
            case PRODUCT:
                return (new ProduitRepository())->setConfig(Configuration::getConfig());
            case TYPE:
                return (new TypeProduitRepository())->setConfig(Configuration::getConfig());
            case USER:
                return (new UserRepository())->setConfig(Configuration::getConfig());
            default:
                return null;
        }
    }
}