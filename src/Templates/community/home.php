<?php $this->layout('layout', ['title' => 'MealOclock - Home']) ?>
<main>

<div id="miniatures" class="container-fluid bg-3 text-center">

    <h1 class="col-md-12">Nos Communautés</h1><br>

        <?php foreach ($communities as $community): ?>
        <div id="commu" class="row">
            <div class="col-md-4"><a href="<?php echo $router->generate('community', array('id' => $community['id'])) ?>">

                <h2><?php echo $community['community_name'] ?></h2>
                <p><?php echo $community['short_desc'] ?></p>

                <div class="container-fluid-pic">
                <img id="pic_commu" src="<?php echo $ASSET_PATH . '/img/' . $community['picture'] ?>"
                    class="img-responsive margin" alt="<?php echo $community['picture'] ?>">
                </div>
            </div></a>
        <?php endforeach; ?>
      </div>
</div>
</main>
