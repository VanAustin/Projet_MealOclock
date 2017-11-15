<?php $this->layout('layout', ['title' => 'MealOclock - Mon Profil']) ?>

<div class="container">
    <div  id="account"  class="row">
        <h1>Mon Profil</h1>
        <hr>

        <!-- Colonne de gauche-->
        <div class="col-md-3">
            <div class="text-center">
                <img src="<?php echo $user['picture'] ?>" class="avatar img-circle" alt="avatar">
                <h6>Télécharger une photo...</h6>
                <input type="file" class="form-control">
            </div>
        </div>

        <!-- Colonne de droite -->
        <div class="col-md-9 personal-info">
            <form class="form-horizontal" action="" method="POST">
                <!-- si erreur, afficher le message -->
    			<?php if (!empty($errors)): ?>
    				<!-- et afficher les erreurs -->
    				<?php foreach ($errors as $error): ?>
    					<p class="text-danger"><?= $error ?></p>
    				<?php endforeach; ?>
    			<?php endif; ?>
                <div class="form-group">
                    <label class="col-lg-3 control-label">Prénom: </label>
                    <div class="col-lg-8">
                        <input placeholder="prénom" name="first_name" class="form-control" type="text" value="<?php echo isset($user['first_name']) ? $user['first_name'] : 'prénom' ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label">Nom: </label>
                    <div class="col-lg-8">
                        <input placeholder="nom" name="last_name" class="form-control" type="text" value="<?php echo isset($user['last_name']) ? $user['last_name'] : 'nom' ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label">Adresse: </label>
                    <div class="col-lg-8">
                        <input placeholder="adresse" name="address" class="form-control" type="text" value="<?php echo isset($user['address']) ? $user['address'] : 'adresse' ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label">Ville: </label>
                    <div class="col-lg-8">
                        <input placeholder="ville" name="city" class="form-control" type="text" value="<?php echo isset($user['city']) ? $user['city'] : 'ville' ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label">Email:</label>
                    <div class="col-lg-8">
                        <input placeholder="email" name="email" class="form-control" type="text" value="<?php echo isset($user['email']) ? $user['email'] : 'email' ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label">Hangouts:</label>
                    <div class="col-lg-8">
                        <input placeholder="hangouts" name="hangouts" class="form-control" type="text" value="<?php echo isset($user['hangouts']) ? $user['hangouts'] : 'hangouts' ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label">Skype:</label>
                    <div class="col-lg-8">
                        <input placeholder="skype" name="skype" class="form-control" type="text" value="<?php echo isset($user['skype']) ? $user['skype'] : 'skype' ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label">Bio:</label>
                    <div class="col-lg-8">
                        <textarea placeholder="bio" rows="8" class="form-control" name="bio" value="bio"><?php echo isset($user['bio']) ? $user['bio'] : '' ?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Password:</label>
                    <div class="col-md-8">
                        <input placeholder="nouveau mot de passe" name="password" class="form-control" type="password">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Confirm password:</label>
                    <div class="col-md-8">
                        <input placeholder="confirmation du nouveau mot de passe" name="confirmPassword" class="form-control" type="password">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label">Notifications: </label>
                    <div class="col-lg-8">
                        <input
                            class="form-control"
                            id="wants_notif"
                            type="checkbox"
                            name="wants_notif"
                            value="1"
                            <?php echo intval($user['wants_notif']) === 1 ? 'checked' : '' ?>
                        />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label">Statut: </label>
                    <div class="col-lg-8">
                        <p class="form-control"><?php echo $group['group_name'] ?></p>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label">Communauté(s): </label>
                    <div class="col-lg-8">
                        <?php foreach ($communities as $community): ?>
                            <label for="<?php echo $community['community_name'] ?>"><?php echo $community['community_name'] ?>
                                <input
                                    class="form-control"
                                    id="<?php echo $community['community_name'] ?>"
                                    type="checkbox"
                                    name="communities[]"
                                    value="<?php echo $community['id'] ?>"
                                    <?php if(isset($userCommunities)){
                                        foreach ($userCommunities as $userCommunity) {
                                            echo $userCommunity['community_id'] === $community['id'] ? 'checked' : '';
                                        }
                                    } ?>
                                />
                            </label>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label"></label>
                    <div class="col-md-8">
                        <input type="submit" name="profil-submit" class="btn btn-primary" value="Mettre à jour mon profil">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<hr>
