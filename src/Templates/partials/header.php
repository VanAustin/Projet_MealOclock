<div class="container-header">
    <div id="top" class="row">
        <div class="col-lg-12">
            <div class="row">
                <div  class="col-lg-1 nav1"><span class="glyphicon glyphicon-menu-hamburger"></span></div>
                <div class="col-lg-2 nav1" >
                    <input type="search" class="input-sm form-control" placeholder="Recherche">
                </div>
                <div  class="col-lg-7 nav1"><span><a href="<?php echo $router->generate('home') ?>">
                  <img id="logo" src="<?php echo $ASSET_PATH . 'img/telechargement.svg' ?>" alt=""></a>
                  <?php echo $user ? ' - Bienvenue, ' . $user['first_name'] : '' ?></span></div>
                <?php if($user) : ?>
                    <div  class="col-lg-1 nav1"><span class="glyphicon glyphicon-volume-down"></span> <a href="<?= $router->generate('logout') ?>"> Déconnexion</div>
                    <div  class="col-lg-1 nav1"><span class="glyphicon glyphicon-edit"></span> <a href="<?= $router->generate('myaccount') ?>"> Mon Compte</div>
                <?php else: ?>
                    <div  class="col-lg-1 nav1"><span class="glyphicon glyphicon-volume-down"></span> <a href="<?= $router->generate('login') ?>"> Connexion</div>
                    <div  class="col-lg-1 nav1"><span class="glyphicon glyphicon-edit"></span> <a href="<?= $router->generate('signup') ?>"> Inscription</div>
                <?php endif; ?>
          </div>
    </div>
</div>
<div class="container-header">
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div   class="col-lg-2 nav2"><a href="<?php echo $router->generate('home') ?>">Communautés</div>
                <div  class="col-lg-2 nav2" ><a href="#">Blog</a></div>
                <div   class="col-lg-2 nav2"><a href="#">Evènements</a></div>
                <div   class="col-lg-2 nav2"><a href="<?php echo $router->generate('members') ?>">Membres</a></div>
                <div   class="col-lg-1 nav2"><a href="#">Forum</a></div>
                <div   class="col-lg-1 nav2"><a href="<?php echo $router->generate('atable') ?>"> A Table</a></div>
                <div   class="col-lg-1 nav2"><a href="#"> <i class="fa fa-twitter-square fa-2x" aria-hidden="true"> </i></a></div>
                <div   class="col-lg-1 nav2"><a href="#"><i class="fa fa-facebook-square fa-2x" aria-hidden="true"></i> </a></div>
          </div>
    </div>
</div>
<?php if($user): ?>
    <div class="container-header">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-2 nav2"><a href="<?php echo $router->generate('myaccount') ?>">Mon Compte</a></div>
                    <?php if(intval($user['group_id']) === 3): ?>
                        <div class="col-lg-2 nav2"><a href="<?php echo $router->generate('admin') ?>">Admin</a></div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
