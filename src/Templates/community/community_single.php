<?php $this->layout('layout', ['title' => 'MealOclock - Détail d\'une communauté']) ?>

<main>
    <div id="page_communaute">
        <div id="titre" class="animated zoomIn">
            <h2>Bienvenue sur la communauté : <?php echo $community['community_name'] ?></h2>
        </div>

        <div id="presentation">
            <div id="presentation_left">
                <img src="<?php echo $ASSET_PATH . 'img/' . $community['picture'] ?>" class="img-responsive" alt="<?php echo $community['picture']?>">
                <p><?php echo $community['long_desc'] ?></p>
            </div>

            <div id="presentation_center">
                <div id="lastblogmsg" class="bounceInDown">
                    <hr>
                    <h2>Les derniers posts</h2>
                    <hr>
                </div>
                <div id="events_list" class="bounceInUp">
                    <hr>
                    <h2>Les prochains évènements</h2>
                    <hr>
                </div>
            </div>

            <div id="presentation_right">
                <div id="members_list" class="bounceInRight">
                    <hr>
                    <h2>Les membres <?php echo $community['community_name'] ?></h2>
                    <hr>
                    <?php if($user): ?>
                    <div class="panel panel-default">
                        <!-- Default panel contents -->
                        <div class="panel-heading">Liste des membres</div>
                        <!-- Table -->
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Prénom</th>
                                    <th>Nom</th>
                                    <th>Email</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($communityMembers as $communityMember): ?>
                                    <tr>
                                        <td><?php echo isset($communityMember['first_name']) ? $communityMember['first_name'] : '' ?></td>
                                        <td><?php echo isset($communityMember['last_name']) ? $communityMember['last_name'] : '' ?></td>
                                        <td><?php echo isset($communityMember['email']) ? $communityMember['email'] : '' ?></td>
                                        <td>
                                            <a href="<?php echo $router->generate('member_single', array('id' => $communityMember['id'])) ?>">
                                                <i class="fa fa-search" aria-hidden="true"></i>
                                                Voir détails
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <?php else: ?>
                        <p>Pour voir la liste de membres de cette communauté ou bien la rejoindre, inscrivez-vous ou connectez vous !</p>
                        <a href="<?php echo $router->generate('login') ?>">
                            <button class="btn btn-info" type="button" name="button">GO!</button>
                        </a>
                    <?php endif; ?>
                </div>
            </div>

        </div>
    </div>
<?php if($user): ?>
    <?php if(isset($joined) && $joined === true): ?>
        <form class="" action="" method="post">
            <input type="hidden" name="community_id" value="<?php echo $community['id'] ?>">
            <input type="hidden" name="user_id" value="<?php echo $user['id'] ?>">
            <button type="submit" name="delete">Quitter cette communauté</button>
        </form>
    <?php elseif(isset($joined) && $joined === false): ?>
        <form class="" action="" method="post">
            <input type="hidden" name="community_id" value="<?php echo $community['id'] ?>">
            <input type="hidden" name="user_id" value="<?php echo $user['id'] ?>">
            <button type="submit" name="insert">Rejoindre cette communauté</button>
        </form>
    <?php endif; ?>
<?php endif; ?>
</main>
