<?php
namespace Controller;
use Service\Configuration;
use Service\FactoryService;
use Service\ProduitServiceI;

abstract class AbstractController{
    //Tous mes controller héritent de cette class, et notamment de $url
    //$url sera envoyé à mes pages pour faire les traitement, comme par exemple savoir quel onglet activer
    /** @var  string $url */
    protected $url;

    protected function getProduitService(){
        return FactoryService::getService(PRODUCT);
    }

    protected function getTypeProduitService(){
        return FactoryService::getService(TYPE);
    }

    protected function getUserService(){
        return FactoryService::getService(USER);
    }

    /**
     * Appelle la bonne méthode suivant l'action correspondant à la clef (controller)
     * @param array $routageTable
     * @return array
     */
    public abstract function setRoute($routageTable);

    /**
     * Se charge d'afficher la page donnée avec les bonnes variables
     * @param string $viewName nom de la page pour charger le body
     * @param array $variables
     */
    public function render($viewName, $variables=[]){
        $view = Configuration::getConfig()->getLayout();
        //variables communes à toutes les pages
        $url = $this->getUrl();
        $user = $this->getUser();
        //variables passées en paramètres
        extract($variables);

        //Charger le menu
        ob_start();
        require __DIR__."/../views/menu.php";
        $MENU = ob_get_contents();
        ob_clean();

        //Charger le body
        ob_start();
        require __DIR__."/../views/".$viewName.".php";
        $BODY = ob_get_contents();
        ob_clean();
        include $view;
    }
    protected function getUser(){
        return $this->getUserService()->getUser();
    }
    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $url
     * @return AbstractController
     */
    public function setUrl($url)
    {
        $this->url = $url;
        return $this;
    }

}