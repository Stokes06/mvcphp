<?php
/**
 * @var \Business\Produit[] $produits
 */
/** @var \Business\TypeProduit[] $types */
/** @var int $page */
/** @var int $pageMax */
/** @var string $sort */
/** @var string $nom */
/** @var string $type */

?>
<div class="container">
    <div class="row">
        <div class="col-sm-12 ">
            <div class="page-header">
                <h1 class="text-center">Liste des produits</h1>
            </div>
            <div class="row">
                <div style="margin-top: 20px" class="col-sm-offset-1 col-sm-2 ">
                    <button type="button" class="btn btn-info" id="btn-filtres" data-toggle="collapse"
                            data-target="#filtres">Afficher les filtres
                    </button>
                </div>
                <!-- PAGINATION -->
                <div class="col-sm-6 ">
                    <ul class="pagination pagination-lg">
                        <li class="<?= $page > 1 ? null : 'disabled' ?>">
                            <a href="/product?page=1<?= $sort ? "&sort=" . $sort : null ?><?= $nom ? "&nom=" . $nom : null ?><?= $type ? "&type=" . $type : null ?><?= $photo?"&photo=".$photo : null?>">
                            <span class="glyphicon glyphicon-fast-backward"></span>
                            </a></li>
                        <li class="<?= $page > 1 ? null : 'disabled' ?>">
                            <a href="/product?page=<?= $page - 1 ?><?= $sort ? "&sort=" . $sort : null ?><?= $nom ? "&nom=" . $nom : null ?><?= $type ? "&type=" . $type : null ?><?= $photo?"&photo=".$photo : null?>">
                            <span class="glyphicon glyphicon-backward"></span>
                            </a></li>
                        <?php $compteur = 0;
                        const NOMBRE_MAX_BOUTONS = 5;
                        $i = ($page < 3) ? 1 : ($page < $pageMax - 2
                            ? $page - 2 : $page - (4 - ($pageMax - $page)));
                        $i = ($i < 1) ? 1 : $i;
                        while ($i <= $pageMax && $compteur < NOMBRE_MAX_BOUTONS) { ?>
                            <li class="<?= $page == $i ? 'active' : null ?>">
                                <a href="/product?page=<?= $i ?><?= $sort ? "&sort=" . $sort : null ?><?= $nom ? "&nom=" . $nom : null ?><?= $type ? "&type=" . $type : null ?><?= $photo?"&photo=".$photo : null?>"><?= $i ?></a>
                            </li>
                            <?php ++$i;
                            ++$compteur;
                        } ?>
                        <li class="<?= $page < $pageMax ? null : 'disabled' ?>">
                            <a class="disabled-link"
                               href="/product?page=<?= $page + 1 ?><?= $sort ? "&sort=" . $sort : null ?><?= $nom ? "&nom=" . $nom : null ?><?= $type ? "&type=" . $type : null ?><?= $photo?"&photo=".$photo : null?>"">
                            <span class="glyphicon glyphicon-step-forward"></span>
                            </a></li>
                        <li class="<?= $page < $pageMax ? null : 'disabled' ?>">
                            <a href="/product?page=<?= $pageMax ?><?= $sort ? "&sort=" . $sort : null ?><?= $nom ? "&nom=" . $nom : null ?><?= $type ? "&type=" . $type : null ?><?= $photo?"&photo=".$photo : null?>"">
                            <span class="glyphicon glyphicon-fast-forward"></span>
                            </a></li>
                    </ul>
                </div>
            </div>

            <div class="row">
                <div id="filtres" class="col-sm-6 col-sm-offset-2 collapse">
                    <div class="col-md-12">
                        <form action="/product" method="get">
                            <div class="form-group">
                                <select name="type" class="form-control">
                                    <option value="0">Selectionnez un type</option>
                                    <?php foreach ($types as $t) : ?>
                                        <option <?= (isset($type) && $type == $t->getId()) ? 'selected' : '' ?>
                                                value="<?= $t->getId() ?>">
                                            <?= $t->getNom() ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group has-feedback has-feedback-left">
                                <i class="glyphicon glyphicon-console form-control-feedback"></i>
                                <input name="nom" value="<?= $nom ?? '' ?>" type="text" class="form-control"
                                       placeholder="Produit commençant par...">
                            </div>
                            <div class="form-group">
                                <input <?= $photo ? "checked":null?> type="checkbox" name="photo" id="photo">
                                <label for="photo">Uniquement avec photo</label>
                            </div>
                            <div>
                                <button class="btn btn-primary btn-lg" type="submit">
                                    <i class="glyphicon glyphicon-search"></i>
                                </button>
                            </div>
                        </form>
                    </div>

                </div>

            </div>
            <table class="table">
                <thead>
                <tr>
                    <td class="col-sm-2">
                        <div class="row">
                            <div class="col-sm-12">
                                Nom
                                <div class="btn-group" role="group">
                                    <a data-toggle="tooltip" title="trier par nom croissant"
                                       href="/product?sort=nom<?= $nom ? "&nom=" . $nom : null ?><?= $type ? "&type=" . $type : null ?><?= $photo?"&photo=".$photo : null?>">
                                        <span class="glyphicon glyphicon-sort-by-attributes"></span>
                                    </a>
                                    <a data-toggle="tooltip" title="trier par nom décroissant"
                                       href="/product?sort=nom,desc<?= $nom ? "&nom=" . $nom : null ?><?= $type ? "&type=" . $type : null ?><?= $photo?"&photo=".$photo : null?>">
                                        <span class="glyphicon glyphicon-sort-by-attributes-alt"></span>
                                    </a>
                                </div>
                            </div>
                    </td>
                    <td class="col-sm-2">
                        <div class="row">
                            <div class="col-sm-12">
                                Prix
                                <div class="btn-group" role="group">
                                    <a data-toggle="tooltip" title="trier par prix croissant"
                                       href="/product?sort=prix<?= $nom ? "&nom=" . $nom : null ?><?= $type ? "&type=" . $type : null ?><?= $photo?"&photo=".$photo : null?>">
                                        <span class="glyphicon glyphicon-sort-by-attributes"></span>
                                    </a>

                                    <a data-toggle="tooltip" title="trier par prix décroissant"
                                       href="/product?sort=prix,desc<?= $nom ? "&nom=" . $nom : null ?><?= $type ? "&type=" . $type : null ?><?= $photo?"&photo=".$photo : null?>">
                                        <span class="glyphicon glyphicon-sort-by-attributes-alt"></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="col-sm-2">
                        <div class="row">
                            <div class="col-sm-12">
                                Type
                                <div class="btn-group" role="group">
                                    <a data-toggle="tooltip" title="trier type nom croissant"
                                       href="/product?sort=idtype<?= $nom ? "&nom=" . $nom : null ?><?= $type ? "&type=" . $type : null ?><?= $photo?"&photo=".$photo : null?>">
                                        <span class="glyphicon glyphicon-sort-by-attributes"></span>
                                    </a>
                                    <a data-toggle="tooltip" title="trier par type décroissant"
                                       href="/product?sort=idtype,desc<?= $nom ? "&nom=" . $nom : null ?><?= $type ? "&type=" . $type : null ?><?= $photo?"&photo=".$photo : null?>">
                                        <span class="glyphicon glyphicon-sort-by-attributes-alt"></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="col-sm-2">
                        <div class="row">
                            <div class="col-sm-12">
                                Saison
                                <div class="btn-group" role="group">
                                    <a data-toggle="tooltip" title="trier par saison croissante"
                                       href="/?sort=mois<?= $nom ? "&nom=" . $nom : null ?><?= $type ? "&type=" . $type : null ?><?= $photo?"&photo=".$photo : null?>">
                                        <span class="glyphicon glyphicon-sort-by-attributes"></span>
                                    </a>
                                    <a data-toggle="tooltip" title="trier par saison décroissante"
                                       href="/?sort=mois,desc<?= $nom ? "&nom=" . $nom : null ?><?= $type ? "&type=" . $type : null ?><?= $photo?"&photo=".$photo : null?>">
                                        <span class="glyphicon glyphicon-sort-by-attributes-alt"></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="col-sm-2">
                        <div class="row">
                            <div class="col-sm-12">
                                Stock
                                <div class="btn-group" role="group">
                                    <a data-toggle="tooltip" title="trier par stock croissant"
                                       href="/?sort=stock<?= $nom ? "&nom=" . $nom : null ?><?= $type ? "&type=" . $type : null ?><?= $photo?"&photo=".$photo : null?>">
                                        <span class="glyphicon glyphicon-sort-by-attributes"></span>
                                    </a>
                                    <a data-toggle="tooltip" title="trier par stock décroissant"
                                       href="/?sort=stock,desc<?= $nom ? "&nom=" . $nom : null ?><?= $type ? "&type=" . $type : null ?><?= $photo?"&photo=".$photo : null?>">
                                        <span class="glyphicon glyphicon-sort-by-attributes-alt"></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td>Image</td>
                    <td>Action</td>
                </tr>
                </thead>


                <tbody>

                <?php
                foreach ($produits as $produit) : ?>
                    <tr class="<?= (isset($last) && $last == $produit->getId()) ? 'lastUpdatedRow' : '' ?>">
                        <td><a data-toggle="tooltip" title="afficher <?= $produit->getNom() ?>"
                               href="/product/look?id=<?= $produit->getId() ?>"><?= $produit->getNom() ?></a></td>
                        <td><?= $produit->getPrix() . " " ?>€</td>
                        <td><?= $produit->getType()->getNom() ?></td>
                        <td><?= $produit->getSaison() ?></td>
                        <td><?= $produit->afficherStock() ?></td>
                        <td><img class="img-responsive icone-produit"
                                 src="<?= (isset($produit) && !empty($produit->getImage())) ? $produit->getPath() : null ?>"
                                 alt="image missing"></td>

                        <td>
                            <div class="btn-group-vertical" role="group">
                                <a title="voir" data-toggle="tooltip" href="/product/look?id=<?= $produit->getId() ?>">
                                    <span class="glyphicon glyphicon-info-sign"></span>
                                </a>
                                <?php if ($user->isAdmin()) : ?>
                                    <a title="modifier" data-toggle="tooltip"
                                       href="/product/update?id=<?= $produit->getId() ?>">
                                        <span class="glyphicon glyphicon-wrench"></span>
                                    </a>
                                    <a title="supprimer" data-toggle="tooltip"
                                       onclick="return confirm('supprimer ce produit ?');"
                                       href="/product/delete?id=<?= $produit->getId() ?>">
                                        <span class="glyphicon glyphicon-remove-circle"></span>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>

            <?php if ($pageMax == 0) : ?>
                <hr>
                <h3 class="text-center">
                    Désolé, aucun résultat
                </h3>
                <hr>

            <?php endif; ?>
        </div>
    </div>
</div>

<script>
    var btn = $('#btn-filtres');
    btn.on('click',function(){
        console.log(btn.text());
        if(btn.text()==='Masquer les filtres'){
            btn.html('Afficher les filtres');
        }else{
            btn.html('Masquer les filtres');
        }
    })
</script>