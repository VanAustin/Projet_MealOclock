<?php $this->layout('layout', ['title' => 'MealOclock - Admin']) ?>

<main id="login" class="container">
    <div class="panel panel-default">
        <!-- Default panel contents -->
        <div class="panel-heading">Users admin dashboard</div>
        <!-- Table -->
        <table class="table">
            <thead>
                <tr>
                    <th>Prénom</th>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Profil</th>
                    <th>Statut</th>
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
                        <td>
                            <form class="" action="" method="post">
                                <input type="hidden" name="user_id" value="<?php echo $member['id'] ?>">
                                <select class="" name="group_id">
                                    <?php foreach ($groups as $group): ?>
                                        <option
                                            value="<?php echo $group['id'] ?>"
                                            <?php echo $member['group_id'] === $group['id'] ? 'selected' : '' ?>
                                        /><?php echo $group['group_name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <button type="submit" name="change_user_status">OK</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div  class="col-lg-3 "><button class=""><a href="<?= $router->generate('addrecette') ?>"> Ajouter une recette </button></div>
</main>
