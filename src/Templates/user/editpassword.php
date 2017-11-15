<?php $this->layout('layout', ['title' => 'MealOclock - Lost Password']) ?>

<main id="login" class="container">
    <h2>Renouveler votre mot de passe</h2><br>

    <form class="form-horizontal col-sm-8 col-sm-offset-2"action="" method="POST">

        <!-- si erreur, afficher le message -->
        <?php if (!empty($errors)): ?>
            <!-- et afficher les erreurs -->
            <?php foreach ($errors as $error): ?>
                <p class="text-danger"><?= $error ?></p>
            <?php endforeach; ?>
        <?php endif; ?>

    	<div class="form-group">
            <label class="col-lg-3 control-label" for="password">Nouveau mot de passe</label>
        	<div class="col-sm-7">
                <input
    				type="password"
    				class="form-control"
    				id="password"
    				name="password"
    				value=""
    				placeholder="nouveau mot de passe"
                />
            </div>
      </div>

    	<div class="form-group">
            <label class="col-lg-3 control-label" for="confirm_password">Confirmer mot de passe</label>
        	<div class="col-sm-7">
                <input
    				type="password"
    				class="form-control"
    				id="confirm_password"
    				name="confirm_password"
    				value=""
    				placeholder="confirmer mot de passe"
                />
            </div>
      </div>

        <div class="form-group">
            <div class="col-sm-offset-8 col-sm-7">
                <button  class="btn btn-default" type="submit" name="login">Renouveler le mot de passe</button>
            </div>
        </div>
	</form>
</main>
