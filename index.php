<?php
//je te laisse lire, j'ai commenté partout je crois // <3
//Penser à inclure l'autoloader avant session_start() !
require_once "vendor/autoload.php";
session_start();
//Mes constantes
define("ROOT_PATH",__DIR__."/../");
define("PRODUCT","product");
define("TYPE","type");
define("USER","user");
define("CONNEXION","connexion");

use Controller\ConnexionController;
use Controller\FactoryController;
use Service\Router;
$userService = \Service\FactoryService::getService(USER);
//Instanciation du router et récupération de la table de routage
$router = new Router();
$routageTable = $router->getRoute();
//On extrait le nom du controller de la table de routage
reset($routageTable);
$key = key($routageTable); // key() récupère la premiere clef du tableau $routageTable, et donc le nom du controller

//Si l'uilisateur n'est pas connecté, on force le controller Connexion
if(!$userService->isConnected()){
    /** @var ConnexionController $connexionController */
    $connexionController = FactoryController::getController(CONNEXION);
    $connexionController->setRoute($routageTable);
    return;
}
//Sinon on appelle le controller correspondant à la clef
    $controller = FactoryController::getController($key);
/* Le controller peut être nul à cause d'une fausse clef,
ce cas est géré dans la methode ::getController */
    if ($controller != NULL)
        $controller->setRoute($routageTable);