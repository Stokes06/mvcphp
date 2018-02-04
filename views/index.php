<div class="container">
    <div class="row">
        <div class="col-sm-10 col-sm-offset-1">
            <h1 class="text-center">Liste des produits</h1>
            <div class="row">
                <div style="margin: 20px 0;" class="col-sm-3">
                            <button type="button" class="btn btn-info" id="btn-filtres" data-toggle="collapse"
                                    data-target="#filtres">Afficher les filtres
                            </button>
                </div>
                <div class="col-sm-9">
                    <ul class="pagination">
                        <?php $i = 1; while($i <= $pageMax): ?>
                        <li class="<?= $page==$i ? 'active' : null?>">
                            <a href="/product?page=<?=$i?><?=$sort? "&sort=".$sort : null?><?=$nom?"&nom=".$nom : null?><?=$type?"&type=".$type:null?>"><?= $i?></a></li>
                        <?php ++$i; endwhile; ?>
                    </ul>
                </div>
            </div>

            <div class="row">
                <div id="filtres" class="col-sm-6 collapse">
                    <div class="col-md-12">
                        <form class=action="/product" method="get">
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
                            <div class="input-group">
                                <input name="nom" value="<?= $nom ?? '' ?>" type="text" class="form-control"
                                       placeholder="Produit commençant par...">
                                <div class="input-group-btn">
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
                            <div class="col-sm-4">
                                Nom
                            </div>
                            <div class="col-sm-4">
                                <a data-toggle="tooltip" title="trier par nom croissant" href="/product?sort=nom<?=$nom?"&nom=".$nom : null?><?=$type?"&type=".$type:null?>">
                                    <img
                                            class="img-responsive"
                                            src="/img/fleche_up.png"
                                            alt="+">
                                </a>
                            </div>
                            <div class="col-sm-4">
                                <a data-toggle="tooltip" title="trier par nom décroissant"
                                   href="/product?sort=nom,desc<?=$nom?"&nom=".$nom : null?><?=$type?"&type=".$type:null?>"><img
                                            class="img-responsive" src="/img/fleche_down.jpg"
                                            alt="-"></a>
                            </div>
                        </div>
                    </td>
                    <td class="col-sm-2">
                        <div class="row">
                            <div class="col-sm-4">
                                Prix
                            </div>
                            <div class="col-sm-4">
                                <a data-toggle="tooltip" title="trier par prix croissant" href="/product?sort=prix<?=$nom?"&nom=".$nom : null?><?=$type?"&type=".$type:null?>">
                                    <img
                                            class="img-responsive"
                                            src="/img/fleche_up.png"
                                            alt="+">
                                </a>
                            </div>
                            <div class="col-sm-4">
                                <a data-toggle="tooltip" title="trier par prix décroissant"
                                   href="/product?sort=prix,desc<?=$nom?"&nom=".$nom : null?><?=$type?"&type=".$type:null?>"><img
                                            class="img-responsive" src="/img/fleche_down.jpg"
                                            alt="-"></a>
                            </div>
                        </div>
                    </td>
                    <td class="col-sm-2">
                        <div class="row">
                            <div class="col-sm-4">
                                Type
                            </div>
                            <div class="col-sm-4">
                                <a data-toggle="tooltip" title="trier type nom croissant" href="/product?sort=idtype<?=$nom?"&nom=".$nom : null?><?=$type?"&type=".$type:null?>">
                                    <img
                                            class="img-responsive"
                                            src="/img/fleche_up.png"
                                            alt="+">
                                </a>
                            </div>
                            <div class="col-sm-4">
                                <a data-toggle="tooltip" title="trier par type décroissant"
                                   href="/product?sort=idtype,desc<?=$nom?"&nom=".$nom : null?><?=$type?"&type=".$type:null?>"><img
                                            class="img-responsive" src="/img/fleche_down.jpg"
                                            alt="-"></a>
                            </div>
                        </div>
                    </td>
                    <td class="col-sm-2">
                        <div class="row">
                            <div class="col-sm-4">
                                Saison
                            </div>
                            <div class="col-sm-4">
                                <a data-toggle="tooltip" title="trier par saison croissante" href="/?sort=mois<?=$nom?"&nom=".$nom : null?><?=$type?"&type=".$type:null?>">
                                    <img
                                            class="img-responsive"
                                            src="/img/fleche_up.png"
                                            alt="+">
                                </a>
                            </div>
                            <div class="col-sm-4">
                                <a data-toggle="tooltip" title="trier par saison décroissante"
                                   href="/?sort=mois,desc<?=$nom?"&nom=".$nom : null?><?=$type?"&type=".$type:null?>"><img
                                            class="img-responsive" src="/img/fleche_down.jpg"
                                            alt="-"></a>
                            </div>
                        </div>
                    </td>
                    <td class="col-sm-2">
                        <div class="row">
                            <div class="col-sm-4">
                                Stock
                            </div>
                            <div class="col-sm-4">
                                <a data-toggle="tooltip" title="trier par stock croissant" href="/?sort=stock<?=$nom?"&nom=".$nom : null?><?=$type?"&type=".$type:null?>">
                                    <img
                                            class="img-responsive"
                                            src="/img/fleche_up.png"
                                            alt="+">
                                </a>
                            </div>
                            <div class="col-sm-4">
                                <a data-toggle="tooltip" title="trier par stock décroissant"
                                   href="/?sort=stock,desc<?=$nom?"&nom=".$nom : null?><?=$type?"&type=".$type:null?>"><img
                                            class="img-responsive" src="/img/fleche_down.jpg"
                                            alt="-"></a>
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
                            <ul class="btn-action">
                                <li><a href="/product/look?id=<?= $produit->getId() ?>">Voir</a></li>
                                <?php if ($user->isAdmin()) : ?>
                                    <li><a href="/product/update?id=<?= $produit->getId() ?>">Modifier</a></li>
                                    <li><a onclick="return confirm('supprimer ce produit ?');"
                                           href="/product/delete?id=<?= $produit->getId() ?>">Supprimer</a></li>
                                <?php endif; ?>
                            </ul>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>