
<div class="container">
    <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
           <?php if(isset($produit)) : ?>
               <h1 class="text-center">Modifier un produit</h1>
            <?php else : ?>
            <h1 class="text-center">Ajouter un produit</h1>
            <?php endif; ?>
            <form id="form" enctype="multipart/form-data" action="/product/submit" method="post" class="form-horizontal">
                <input type="hidden" name="id" value="<?= isset($produit)? $produit->getId() : null?>">
                <div class="form-group">
                    <label class="control-label col-sm-3" for="nom">Nom du produit:</label>
                    <div class="col-sm-9">
                        <input required value="<?= isset($produit) ? $produit->getNom() : null?>"  type="text" name="nom" class="form-control" id="nom" >
                    </div>
                    <div class="form-error col-sm-offset-3"><?= $errors['nom'] ?? null?></div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-3" for="prix">Prix du produit:</label>
                    <div class="col-sm-9">
                        <input type="number" value="<?= isset($produit) ? $produit->getPrix() :null?>" step="0.01" min="0" name="prix" class="form-control" id="prix" >
                    </div>
                    <div class="form-error col-sm-offset-3"><?= $errors['prix'] ?? null?></div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-3" for="stock">Stock:</label>
                    <div class="col-sm-9">
                        <input type="number" min="0" value="<?= isset($produit) ? $produit->getStock() :null?>" name="stock" class="form-control" id="stock" >
                    </div>
                    <div class="form-error col-sm-offset-3"><?= $errors['stock'] ?? null?></div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-3" for="mois">Mois:</label>
                    <div class="col-sm-9">
                        <select name="mois">
                            <option value="0">Selectionnez le mois</option>
                            <?php for($i=0; $i<count($mois); ++$i): ?>
                                <option value="<?=$i+1?>"><?=$mois[$i]?></option>
                            <?php endfor; ?>
                        </select>
                    </div>
                    <div class="form-error col-sm-offset-3"><?= $errors['mois'] ?? null?></div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-3" for="type">Type de produit:</label>
                    <div class="col-sm-9">
                        <select name="type" class="form-control">
                            <option value="0">Selectionnez un type</option>
                            <?php foreach ($types as $type) : ?>
                                <option <?= (isset($produit) && $produit->getType()->getId()==$type->getId()) ? 'selected' :null ?> value="<?= $type->getId()?>"><?= $type->getNom()?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-error col-sm-offset-3 "><?= $errors['type']?? null?></div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-3" for="image">Image:</label>
                    <div class="col-sm-5">
                        <input type="file"  name="image" id="image"/>
                            <button style="margin-top: 1em" class="btn btn-primary" type="submit">Valider</button>
                    </div>
                    <div class="col-sm-4">
                        <?php if(isset($produit)): ?>
                        <img src="<?= $produit->getPath() ?>" class="img-responsive" alt="image non disponible">
                        <?php endif; ?>
                    </div>
                    <div class="form-error col-sm-offset-3"><?= $errors['image'] ?? null?></div>
                </div>

            </form>
        </div>
    </div>
</div>
<!--<div id="result"></div>
<script>
    $("#form").on('submit', function(e){
        e.preventDefault();
    $.post("/create.php",{
        nom:$('#form input[name="nom"]').val(),
        stock:$('#form input[name="stock"]').val(),
        id:$('#form input[name="id"]').val(),
        type:$('#form input[name="type"]').val(),
        prix:$('#form input[name="prix"]').val(),
        mois:$('#form input[name="mois"]').val()
    },
        function(data){
        $("#result").html(data);
    });
    });
</script>-->