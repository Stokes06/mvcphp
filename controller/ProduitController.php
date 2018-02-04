<?php

namespace Controller;

use Data\DataConnect;
use Dev\Tool;
use Repository\ProduitRepository;
use Service\FactoryService;
use Service\ProduitServiceI;
use Service\TypeProduitServiceI;
use Service\UserServiceI;
use Service\Validator;

class ProduitController extends AbstractController
{
    protected $types;
    /** @var ProduitServiceI produitService */
    protected $produitService;
    /** @var TypeProduitServiceI typeService */
    protected $typeService;
    /** @var  UserServiceI $userService */
    protected $userService;

    /**
     * ProduitController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->produitService = FactoryService::getService(PRODUCT);
        $this->typeService = FactoryService::getService(TYPE);
        $this->userService = FactoryService::getService(USER);
    }

    public function setRoute($routageTable)
    {
        if ($routageTable["product"] == NULL) {
            $this->default();
            return;
        }
        switch ($routageTable["product"]) {
            case "update":
                $this->update();
                break;
            case "create":
                $this->create();
                break;
            case "delete":
                $this->delete();
                break;
            case "submit":
                $this->submit();
                break;
            case "look":
                $this->look();
                break;
            default:
                $this->error404();
        }
    }

    /**
     * Controller lorsqu'on arrive sur la page d'accueil toute simple,
     * sans action
     */

    public function default()
    {
        $TITLE_PAGE = "Accueil"; $this->setUrl("/");
        $page = $_GET['page'] ?? 1;
        $nom = $_GET['nom'] ?? null;
        $sort = $_GET['sort'] ?? null;
        $type = isset($_GET['type']) && $_GET['type']!=0 ? $_GET['type'] : null;

        $last = $_GET['last'] ?? null;
        $types = $this->types = $this->typeService->getAll();
        $produits = null;
        $numberOfProducts = null;
        $pageMax = null;

        $pageable = $this->produitService->applyFiltersAndSorting($page, $type, $nom, $sort);
        $produits = $pageable->getContent();
        $numberOfProducts = $pageable->getNumberTotalOfRows();

        $pageMax = (int)floor($numberOfProducts / ProduitRepository::$NUMBER_PER_PAGE)
            + ($numberOfProducts % ProduitRepository::$NUMBER_PER_PAGE == 0 ? 0 : 1);

        $this->render("index", compact("produits", "types", "TITLE_PAGE",
            "type", "last", "pageMax", "page", "numberOfProducts",
            "nom", "sort"));
    }

    public function create($produit = null, $errors = [])
    {
        $TITLE_PAGE = $produit == null ? "Ajouter un produit" : "Modifier un produit";
        $mois = [
            "janvier","février","mars","avril","mai","juin","juillet","août","septembre","octobre","novembre","décembre"
        ];
        $types = $this->typeService->getAll();
        $action = $produit == null ? "create" : "update";
        $this->setUrl("/product/" . $action);
        $this->render("create", compact("TITLE_PAGE", "produit", "types","mois", "errors"));
    }

    public function update()
    {
        $produit = null;
        //produit qu'on va mettre à jour
        if (!empty($_GET['id']))
            $produit = $this->produitService->getById($_GET['id']);
        $this->create($produit);
    }

    public function delete()
    {
        if (isset($_GET['id'])) {
            $this->produitService->delete($_GET['id']);
        }
        header("Location: /");
    }

    public function submit()
    {
        if (!empty($_POST)) {
            extract($_POST);
            $validator = new Validator($_POST);
            $errors = $validator->getErrors();
            if (empty($errors)) {
                $image = $_FILES['image']['name'] ?? null;
                $id = $_POST['id'];
                if (!empty($id)) {
                    $this->produitService->update($id, $nom, $prix, $stock, $mois, $type, $image);
                } else {
                    if ($this->produitService->create($nom, $prix, $stock, $mois, $type, $image)) {
                        $id = DataConnect::getConnection()->lastInsertId();
                    }
                }
                header("Location: /?last=" . $id ?? null);
            } else {
                $this->create(null, $errors);
            }
        }
    }

    /**
     * Aucune action disponible
     */
    public function error404()
    {
        $this->setUrl("/error");
        $TITLE_PAGE = "Oups!";
        $this->render("error404", compact("TITLE_PAGE"));
    }

    private function look()
    {
        $this->setUrl("product/look");
        if (!isset($_GET['id']) || empty($_GET['id'])) {
            $this->error404();
            return;
        }
        $produit = $this->produitService->getById($_GET['id']);
        $TITLE_PAGE = "Affichage de " . $produit->getNom();
        //Afficher tout ça
        $this->render("produit", compact("TITLE_PAGE", "produit"));
    }

}