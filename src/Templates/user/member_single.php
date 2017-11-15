<?php $this->layout('layout', ['title' => 'MealOclock - Member details']) ?>

<main>
  <div class="container">
	   <div class="row">
        <div class="col-md-10 ">
            <div class="panel panel-default">
               <div id="membre" class="panel-heading">  <h4 >Profil Membre</h4></div>
               <div class="panel-body">
                   <div class="box box-info">
                       <div class="box-body">
                           <div class="col-sm-14">
                               <div  align="center"> <img alt="User Pic" src="<?php echo isset($member['picture']) ? $member['picture'] : ''  ?>" id="profile-image1" class="img-circle img-re">
                                   <br>
<!-- /input-group -->

                                <div class="col-sm-8 col-lg-12">
                                    <h4 ><?php echo isset($member['first_name']) ? $member['first_name'] : '' ?> <?php echo isset($member['last_name']) ? $member['last_name'] : '' ?></h4>
                                </div>
                                <div class="cat">
                                    <h5>Communautés :</h5>
                                    <span>-</span>
                                    <?php foreach ($userCommunities as $userCommunity): ?>
                                        <span><?php echo $userCommunity['community_name'] ?> -</span>
                                    <?php endforeach; ?>
                                </div>

                                <div class="col-sm-12 col-xs-6 tital subtitle " >Bio :</div><br><div class="col-sm-7"></div>
                                    <div class="clearfix"></div>

                                <div class="col-sm-12 bio"><p><?php echo isset($member['bio']) ? $member['bio'] : '' ?></p></div>
                                    <div class="clearfix"></div>

                                <div class="col-sm-12 col-xs-6 tital subtitle  " >Adresse :</div><div class="col-sm-7"></div>
                                    <div class="clearfix"></div>

                                <div class="col-sm-12"><p><?php echo isset($member['city']) ? $member['city'] : '' ?></p></div>
                                    <div class="clearfix"></div>


                                <div class="col-sm-12 col-xs-6 tital subtitle  " >Social</div><div class="col-sm-7"></div>
                                    <div class="clearfix"></div>

                                <div class="col-sm-4" >
                                    <a href="<?php echo isset($member['hangouts']) ? $member['hangouts'] : '' ?>" >
                                    <img id="hang" src="../assets/img/noun_61578.svg" alt=""></a></div>


                                <div class="col-sm-4 icons" ><a href="mailto:<?php echo isset($member['skype']) ? $member['skype'] : '' ?>">
                                    <i class="fa fa-skype fa-3x" aria-hidden="true"></i></a></div>

                                <div class="col-sm-4 icons" ><a href="<?php echo isset($member['email']) ? $member['email'] : '' ?>">
                                    <i class="fa fa-envelope-o fa-3x" aria-hidden="true"></i></a></div>
                                    <div class="clearfix"></div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
</main>
