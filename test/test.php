<?php
require __DIR__."/../vendor/autoload.php";
define("PRODUCT","product");
define("TYPE","type");
define("USER","user");
define("CONNEXION","connexion");
$produitRepo = \Repository\FactoryRepository::getRepository(PRODUCT);
$typeRepo = \Repository\FactoryRepository::getRepository(TYPE);
$produitService = \Service\FactoryService::getService(PRODUCT);
// var_dump($produitRepo->getAll()); //ok pour sans page
//var_dump($produitRepo->getAll(+2)); //ok
/*var_dump(
    $produitRepo->getBySort(1, "nom, asc")
);*/

//var_dump($produitRepo->applyFiltersAndSorting(1,null, null,"mois,desc"));
var_dump($produitRepo->getPage(2,
    "where nom like :nom ",
    [
        "nom" => "%e%"
    ],
    "prix"
));