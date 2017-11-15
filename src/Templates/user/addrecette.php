<?php $this->layout('layout', ['title' => 'Ajouter une recette']) ?>

<main id="addrecette" class="container-fluid">
	   <form id="" class="col-md-10" action="" method="POST">
            <h2>Ajouter une recette</h2>

            <!-- si erreur, afficher le message -->
			<?php if (!empty($errors)): ?>
				<!-- et afficher les erreurs -->
				<?php foreach ($errors as $error): ?>
					<p class="text-danger"><?= $error ?></p>
				<?php endforeach; ?>
			<?php endif; ?>

        <div class="row">
          <div class="col-md-12">
              <div class="">
                  <img src="<?php echo $user['picture'] ?>" class="avatar img-circle" alt="Photo de la recette">
                  <h6>Télécharger une image de la recette..</h6>
                  <input type="file" class="form-control">
              </div>
          </div>
        </div>
        <div id="recettepower" class="row">
    		<div class="col-md-12 form-group">
    			<label class="control-label" for="email">Détail de la recette</label>
    			<input
		            type="textarea"
		            id="detail_recette"
		            class="form-control"
		            name="detail_recette"
		            value=""
		            placeholder="Veuillez renseigner la marche à suivre pour réaliser la recette"
				/>
    		</div>
            <div class="col-md-12 form-group">
    			<label class="control-label" for="lastName">Ingrédients</label>
    			<input
                    type="textarea"
                    id="ingredients"
                    class="form-control"
                    name="ingrédients"
                    value="<?php echo isset($userdata['lastName']) ? $userdata['lastName'] : '' ?>"
                    placeholder="Veuillez renseigner les ingrédients nécesaires"
				/>
    		</div>
        </div>
        <div class="row">
            <div class="col-md-5 pull-left">
                <button type="submit" name="addrecette">Poster la recette</button>
            </div>
        </div>
        </div>
    </form>
</main>
