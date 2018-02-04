<?php

namespace Business;

require(__DIR__ . "/../classes/Produit.php");
require(__DIR__ . "/../classes/TypeProduit.php");
$produits = [

    new Produit("tomate", 1, new TypeProduit("fruit"), 5, 4),
    new Produit("carotte", 2.5, new TypeProduit("légume"), 11, 48)


];
//je sais pas si ca marche. ok