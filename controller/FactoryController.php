<?php
namespace Controller;

class FactoryController
{
    /**
     * Si le nom du controller ne correspond pas:
     * Soit c'est la page à la racine, et dans ce cas le product controller s'en charge avec sa méthode default()
     * Soit c'est une clef inconnue => error 404
     * @param string $key nom du controller recherché
     * @return ConnexionController|ProduitController|null
     */
    public static function getController($key){
        switch ($key){
            case(PRODUCT):
                return new ProduitController();
            case(CONNEXION):
                return new ConnexionController();
            case "":case "index":
            (new ProduitController())->default();
                return NULL;
            default:
                (new ProduitController())->error404();
                return NULL;
        }
    }
}