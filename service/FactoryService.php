<?php
namespace Service;
class FactoryService{

    public static function getService($name){

        $conf = Configuration::getConfig();
        switch ($name){
            case PRODUCT:
                return (new ProduitServiceI())->setConfig($conf);
            case TYPE:
                return (new TypeProduitServiceI())->setConfig($conf);
            case USER:
                return (new UserServiceI())->setConfig($conf);
            default:
                return null;
        }
    }
}