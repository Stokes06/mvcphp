<?php
namespace Service;
use Dev\Tool;

class Router{

    /**
     * @return string[]
     */
    public function getRoute(){
        //On récupère l'url (sans le nom de domaine)
        $url = $_SERVER['REQUEST_URI'];
        $actions = null;
        $controller = null;

          //Recupérer les action demandées au controller ("/..." sauf le premier)
        preg_match_all("/(?<=\S\/)(\b\w+\b)/",
            $url, $actions);
        //Récupérer le nom du controller
        preg_match_all("/^\/(\b\w+\b)/",
            $url, $controller);

        //Get the controller => first action
        return [$controller[1][0] ?? null => $actions[0][0] ?? null];
    }
}