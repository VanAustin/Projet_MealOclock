<?php $this->layout('layout', ['title' => 'MealOclock - Members']) ?>

<main id="login" class="container">
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
                <?php foreach ($members as $member): ?>
                    <tr>
                        <td><?php echo isset($member['first_name']) ? $member['first_name'] : '' ?></td>
                        <td><?php echo isset($member['last_name']) ? $member['last_name'] : '' ?></td>
                        <td><?php echo isset($member['email']) ? $member['email'] : '' ?></td>
                        <td>
                            <a href="<?php echo $router->generate('member_single', array('id' => $member['id'])) ?>">
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
</main>
