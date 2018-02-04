<div class="container">
    <div id="look-product"  class="row">
        <div class="col-sm-7">
            <!-- Left-aligned media object -->
            <div class="media vendeur">
                <div class="media-left">
                    <img src="/img/img_avatar1.png" class="media-object" style="width:60px">
                </div>
                <div class="media-body">
                    <h4 class="media-heading">Vendeur</h4>
                    <p>le <?= $produit->getNom() ?>
                        est un <?= $produit->getType()->getNom() ?>.</p>
                </div>
            </div>
            <hr>

            <!-- Right-aligned media object -->
            <div class="media acheteur">
                <div class="media-body">
                    <h4 class="media-heading">Vous</h4>
                    <p> A quel mois devons nous planter ce produit ?
                    </p>
                </div>
                <div class="media-right">
                    <img src="/img/img_avatar1.png" class="media-object" style="width:60px">
                </div>
            </div>
            <hr>
            <!-- Left-aligned media object -->
            <div class="media vendeur">
                <div class="media-left">
                    <img src="/img/img_avatar1.png" class="media-object" style="width:60px">
                </div>
                <div class="media-body">
                    <h4 class="media-heading">Vendeur</h4>
                    <p> Ce produit se plante en <?= $produit->getSaison()?> et plus précisément en <?= $produit->getMois() ?><br>
                        Nous en avons <?= $produit->getStock() ?> à vendre !
                    </p>
                </div>
            </div>

            <hr>
            <!-- Right-aligned media object -->
            <div class="media acheteur">
                <div class="media-body">
                    <h4 class="media-heading">Vous</h4>
                    <p> A quel prix ?
                    </p>
                </div>
                <div class="media-right">
                    <img src="/img/img_avatar1.png" class="media-object" style="width:60px">
                </div>
            </div>
            <hr>
            <!-- Left-aligned media object -->
            <div class="media vendeur">
                <div class="media-left">
                    <img src="/img/img_avatar1.png" class="media-object" style="width:60px">
                </div>
                <div class="media-body">
                    <h4 class="media-heading">Vendeur</h4>
                    <p>  <?= $produit->getPrix() . " €/" . $produit->getNom() ?>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-sm-5">
            <img src="<?= $produit->getPath() ?>" class="img-thumbnail" alt="image du produit indisponible">
        </div>
    </div>
</div>

