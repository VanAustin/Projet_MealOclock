<?php $this->layout('layout', ['title' => 'MealOclock - Lost Password']) ?>

<main id="login" class="container">
    <h2>Mot de passe perdu ?</h2><br>

    <form class="form-horizontal col-sm-8 col-sm-offset-2"action="" method="POST">

      <?php if(isset($message) && $message != "") : ?>
            <p class="bg-info"><?= $message ?></p>
    	<?php endif; ?>

      <div class="">
        <p>Entrez votre email de connexion afin que nous vous donnions la possibilité de renouveler votre mot de passe :)</p>
      </div>
    	<div class="form-group">
            <label class="col-lg-3 control-label" for="email">Email</label>
        	<div class="col-sm-7">

                <input
    				type="text"
    				class="form-control"
    				id="email"
    				name="email"
    				value="<?= isset($data['email']) ? $data['email'] : '' ?>"
    				placeholder="email"
                />
            </div>
      </div>

        <div class="form-group">
            <div class="col-sm-offset-8 col-sm-7">
                <button  class="btn btn-default" type="submit" name="login">Envoyer l'email</button>
            </div>
        </div>
	</form>
</main>
