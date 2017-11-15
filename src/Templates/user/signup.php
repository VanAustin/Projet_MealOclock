<?php $this->layout('layout', ['title' => 'MealOclock - Signup']) ?>

<main id="signup" class="container-fluid">
	   <form id="signup-form" class="col-md-12" action="" method="POST">
            <h2>Inscription</h2>

            <!-- si erreur, afficher le message -->
			<?php if (!empty($errors)): ?>
				<!-- et afficher les erreurs -->
				<?php foreach ($errors as $error): ?>
					<p class="text-danger"><?= $error ?></p>
				<?php endforeach; ?>
			<?php endif; ?>

    		<!-- firstname, lastname, email, password, confirmpassword -->

        <div class="row">
            <div class="col-md-6 form-group">
    			<label class="control-label" for="firstName">Prénom</label>
    			<input
                    type="text"
                    id="firstName"
                    class="form-control"
                    name="firstName"
                    value="<?php echo isset($userdata['firstName']) ? $userdata['firstName'] : '' ?>"
                    placeholder="votre prenom"
				/>
    		</div>
    		<div class="col-md-6 form-group">
    			<label class="control-label" for="email">Email</label>
    			<input
		            type="text"
		            id="email"
		            class="form-control"
		            name="email"
		            value="<?php echo isset($userdata['email']) ? $userdata['email'] : '' ?>"
		            placeholder="votre adresse mail valide"
				/>
    		</div>
        </div>
        <div class="row">
            <div class="col-md-6 form-group">
    			<label class="control-label" for="lastName">Nom</label>
    			<input
                    type="text"
                    id="lastName"
                    class="form-control"
                    name="lastName"
                    value="<?php echo isset($userdata['lastName']) ? $userdata['lastName'] : '' ?>"
                    placeholder="votre nom de famille"
				/>
    		</div>
    		<div class="col-md-6 form-group">
    			<label class="control-label" for="password">Mot de passe</label>
    			<input
		            type="password"
		            id="password"
		            class="form-control"
		            name="password"
		            value=""
		            placeholder ="8 caractères min"
				/>
    		</div>
        </div>
        <div class="row">
            <div class="col-md-6 form-group">
    			<label class="control-label" for="adresse">Adresse</label>
    			<input
                    type="text"
                    id="adresse"
                    class="form-control"
                    name="adresse"
                    value=""
                    placeholder="votre nom de famille"
				/>
    		</div>
    		<div class="col-md-6 form-group">
    			<label class="control-label" for="confirmPassword">Confirmer</label>
    			<input
		            type="password"
		            id="confirmPassword"
		            class="form-control"
		            name="confirmPassword"
		            value=""
		            placeholder ="confirmez le mot de passe"
				/>
    		</div>
        </div>
        <div class="row">
            <div class="col-md-12">
							<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d42002.02494546299!2d2.3510983!3d48.855797!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x231eb0c967e5eb10!2sPlace+de+la+Bastille!5e0!3m2!1sfr!2sfr!4v1502090855746"
							width="1270" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
            </div>
        </div>

            <p class="relogin" >Vous avez déjà un compte? <a href="<?= $router->generate('login') ?>"> Connectez-vous</a></p>

        <div class="row">
            <div class="col-md-3">
                    <button class="pull-left" type="submit" name="signup">Je m'inscris</button>
            </div>
        </div>
    	</form>
</main>
