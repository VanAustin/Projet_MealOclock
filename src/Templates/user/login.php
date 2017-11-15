<?php $this->layout('layout', ['title' => 'MealOclock - Login']) ?>

<main id="login" class="container-fluid">
    <form class="col-md-12" action="" method="POST">
    <h2>Connexion</h2><br>

        <?php if(isset($message) && $message != "") : ?>
            <p class="bg-info"><?= $message ?></p>
    	<?php endif; ?>

        <div class="row">
    	            <div class="col-md-12 form-group ">
                            <label class="control-label" for="email">Email</label>
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
        <div class="row">
		          <div class="col-md-12 form-group">
                    <label class="control-label" for="password"> Mot de passe </label>
                    <input
    				            type="password"
    				            class="form-control"
    				            id="password"
    				            name="password"
    				            value=""
    				            placeholder ="password"
                    />
                    <p class="resignup" >Pas encore inscrit? N'hésitez-pas <a href="<?= $router->generate('signup') ?>"> créer un compte </a></p>
		          </div>
        </div>
        <div class="row">
            <div class="col-md-6 orm-group">
                <button  class="pull-left connect " type="submit" name="login">Connexion</button>
            </div>
            <div class="col-md-6">
                <button class="pull-right" type="text" name="button"><a href="<?php echo $router->generate('lostpassword') ?>">Problème de connexion</a></button>
            </div>
        </div>
	</form>
</main>
