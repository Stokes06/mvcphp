<?php
namespace Controller;
use Dev\Tool;
use Service\FactoryService;

class ConnexionController extends AbstractController{

    protected $user;
    protected $userService;

    public function __construct()
    {
        $this->userService = $this->getUserService();
    }

    /**
     * Demande l'affichage de la page de connexion
     */
    public function afficherPageConnexion()
    {
        $this->setUrl("/connexion");
        if($this->userService->isConnected())
            header("Location: /");

        $TITLE_PAGE = "Page de connexion";
        $this->render("login",compact("TITLE_PAGE"));
    }

    /**
     * Methode appellée après soumission du formulaire de connexion
     * Si la connexion réussie, on est redirigé vers la page d'accueil /product
     * Sinon renvoie sur la methode afficherPageConnexion()
     */
    public function verifierConnexion(){
        if($this->userService->isConnected())
            header("Location: /");
        //On vérifie la connexion et on redirige si elle a réussie
        if(isset($_POST['login']) && isset($_POST['password'])){
            if($this->userService->connect($_POST['login'], $_POST['password'])){
                header("Location: /product");
            }
        }else{
            $this->afficherPageConnexion();
        }
    }


    public function setRoute($routageTable)
    {
        if(!isset($routageTable[CONNEXION])){
            $this->afficherPageConnexion();
            return;
        }
        switch ($routageTable[CONNEXION]){
            case "login":
                $this->verifierConnexion();
                break;
            case "logout":
                $this->deconnecter();
                break;
            default:
                $this->afficherPageConnexion();
        }
    }

    /**
     * Deconnecte l'utilisateur, change l'url à /connexion
     * renvoie sur la methode afficherPageConnexion()
     */
    private function deconnecter()
    {
        $this->userService->disconnect();
        $this->setUrl("/connexion");
        $this->afficherPageConnexion();
    }
}