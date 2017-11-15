<?php
namespace Community\Controller;

use Community\Framework\BaseController;
use Community\Model\UserModel;
use Community\Model\CommunityModel;
use Community\Model\UserCommunityModel;
use Community\Model\GroupModel;

class UserController extends BaseController
{
    /**
     * Signup
     */
    public function signup()
    {
        if(empty($_POST))
        {
            echo $this->templates->render('user/signup', [
                'errors' => []
            ]);
            exit();
        }

        // clean data
        $post = array_map(function($item) {
            return strip_tags($item);
        }, $_POST);

        // Vérifier que les données saisies sont correctes
        $userModel = new UserModel();
        $errors = $userModel->validData($post);

        // vérifier la correspondance entre password et confirm-password
        if($post['password'] !== $post['confirmPassword'])
            $errors['confirmPassword'] = 'Les mots de passe ne correspondent pas.';

        // si correctes
        if(empty($errors))
        {
            // enregistrer !! avec le mot de passe crypté/hashé
            $res = $userModel->register($post);

            if(!$res)
            {
                $errors[] = "Erreur lors de l'insertion.";
            }
            else
            {
                header('Location: ' . $this->router->generate('login'));
            }
        }

        // si données incorrectes === si tableau errors PAS vide
        if(!empty($errors))
        {
            // message à l'utilisateur
            // on réaffiche les données déjà saisies dans le formulaire
            echo $this->templates->render('user/signup', [
                'errors' => $errors,
                'userdata' => $post
            ]);
        }
   }

    /**
    * Login
    */
    public function login()
    {
        // si le form n'a pas été soumis on l'affiche
        if(empty($_POST))
        {
            echo $this->templates->render('user/login');
            exit();
        }

        // clean les data
        $post = array_map(function($item) {
            return strip_tags($item);
        }, $_POST);

        // 2.on tente d'authentifier l'utilisateur avec son email & mdp
        $userModel = new UserModel();
        // si ses données sont correctes
        if($userModel->auth($post['email'], $post['password']))
        {
            // il est authentifié, on le redirige vers la page compte client
            header('Location: ' . $this->router->generate('home'));
        }
        else
        {
            // sinon on affiche le form avec les erreurs
            echo $this->templates->render('user/login', [
                'message' => 'L\'authentification a échoué.',
                'datalogin' => $post
            ]);
        }
    }

    public function logout()
    {
        $userModel = new UserModel();
        $userModel->logout();
        header('Location: ' . $this->router->generate('home'));
    }

    public function lostpassword()
    {
        if(empty($_POST))
        {
            echo $this->templates->render('user/lostpassword');
            exit;
        }

        // clean les data
        $post = array_map(function($item) {
            return strip_tags($item);
        }, $_POST);

        // on check si l'email donné par le user est bien db
        $userModel = new UserModel();
        $user = $userModel->findByEmail($post['email']);

        if($user)
        {
            // si on a un user, on génére un token
            $token = bin2hex(random_bytes(16));
            // puis on l'inscrit (le token) en db pour ce user
            $userModel->insertTokenToUser($user['id'], $token);
            // on envoie un email au user avec le lien de renouvellement
            $subject = "Rénitialisation de votre mot de passe";
            $email = 'Cher utilisateur,<br><br>
                     Merci de suivre le lien ci-dessous pour réinitialiser votre mot de passe :<br>
                     <a href="localhost' . $this->config['BASE_PATH'] . '/editpassword?id=' . $user['id'] . '&token=' . $token . '">Réinitialiser mon mot de passe</a>';
            $headers = "Content-type: text/html; charset=UTF-8";
            mail($user['email'], $subject, $email, $headers);

            echo $this->templates->render('user/lostpassword', [
                'message' => 'Demande prise en compte ! Veuillez regarder vos emails à \'' . $post['email'] . '\'.',
            ]);
        }
        else
        {
            echo $this->templates->render('user/lostpassword', [
                'message' => 'Nous n\'avons pas trouvé l\'utilisateur \'' . $post['email'] . '\' corresondant chez nous :/',
                'data' => $post
            ]);
        }
    }

    public function editpassword()
    {
        // on check si l'id et le token correspondent à notre user
        $userModel = new UserModel();
        $usercheck = $userModel->findByIdAndToken($_GET['id'], $_GET['token']);

        if(empty($_POST) && $usercheck)
        {
            echo $this->templates->render('user/editpassword');
            exit;
        }

        if(!empty($_POST) && $usercheck)
        {
            // clean les data
            $post = array_map(function($item) {
                return strip_tags($item);
            }, $_POST);

            // on check si le password est 'valide'
            $errors = $userModel->validPassword($post['password']);

            // on check si les password sont equivalents
            if($post['password'] !== $post['confirm_password'])
            {
                $errors['confirm_password'] = 'Les mots de passe ne correspondent pas.';
            }

            if(empty($errors))
            {
                // enregistrer !! avec le mot de passe crypté/hashé
                $res = $userModel->updatePassAndClearToken($post['password'], $_GET['id']);

                if(!$res)
                {
                    $errors[] = "Erreur lors du changement de mot de passe.";
                }
                else
                {
                    header('Location: ' . $this->router->generate('login'));
                }
            }

            // si données incorrectes === si tableau errors PAS vide
            if(!empty($errors))
            {
                // message à l'utilisateur
                // on redonne le formulaire
                echo $this->templates->render('user/editpassword', [
                    'errors' => $errors,
                ]);
            }
        }
        else
        {
            header( $_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
        }
    }

    public function members()
    {
        $userModel = new UserModel();
        $members = $userModel->findAll();
        echo $this->templates->render('user/members', [
            'members' => $members
        ]);
    }

    public function member($params)
    {
        if($this->user) {
            extract($params);
            $userModel = new UserModel();
            $member = $userModel->findById($id);
            $userCommunityModel = new UserCommunityModel();
            $userCommunities = $userCommunityModel->findUserCommunitiesDetails($id);
            echo $this->templates->render('user/member_single', [
                'member' => $member,
                'userCommunities' => $userCommunities
            ]);
        }
        else {
            header( $_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
        }
    }

    public function myaccount()
    {
        // on retrouve notre user
        $userModel = new UserModel();
        $user = $userModel->getUser();

        if(empty($_POST))
        {
            $this->loadAccount($user);
        }

        // clean les data
        $post = array_map(function($item) {
            if(gettype($item) === "array") {
                foreach ($item as $subitem) {
                    return strip_tags($subitem);
                }
            }
            else {
                return strip_tags($item);
            }
        }, $_POST);

        $data = [];
        foreach ($post as $keyPost => $datum) {
            foreach ($user as $keyUser => $value) {
                if($keyUser === $keyPost) {
                    $data[$keyPost] = $datum;
                }
            }
        }
        !isset($data['wants_notif']) ? $data['wants_notif'] = 0 : $data['wants_notif'];
        if(isset($data['password'])) {
            unset($data['password']);
        }
        if(isset($data['confirmPassword'])) {
            unset($data['confirmPassword']);
        }

        $userModel = new UserModel();
        $errors = $userModel->validUpdate($data);

        if(!empty($post['password'])) {
            // on check si le password est 'valide'
            $errors += $userModel->validPassword($post['password']);

            // on check si les password sont equivalents
            if($post['password'] !== $post['confirmPassword'])
            {
                $errors['confirm_password'] = 'Les mots de passe ne correspondent pas.';
            }

            if(!isset($errors['password']) && !isset($errors['confirm_password']))
            {
                // enregistrer !! avec le mot de passe crypté/hashé
                $res = $userModel->updatePassAndClearToken($post['password'], $user['id']);

                if(!$res)
                {
                    $errors[] = "Erreur lors du changement de mot de passe.";
                }
            }
        }


        if(empty($errors)) {
            $userModel->update($data, $user['id']);

            // RESET $user général !!! sinon on reste sur celui en session
            $updatedUser = $userModel->findById($user['id']);
            $userModel->setUser($updatedUser);

            $userCommunityModel = new UserCommunityModel();
            isset($_POST['communities']) ? $userCommunityModel->setUserCommunities($user['id'], $_POST['communities']) : $userCommunityModel->setUserCommunities($user['id']);

            header('Location: ' . $this->router->generate('myaccount'));
        }

        if(!empty($errors)) {
            $this->loadAccount($user, $errors);
        }
    }

    public function loadAccount($user, $errors = NULL)
    {
        // on retrouve les communautés du site
        $communityModel = new CommunityModel;
        $communities = $communityModel->findAll();

        // on retrouve les communautés du user
        $userCommunityModel = new UserCommunityModel();
        $userCommunities = $userCommunityModel->findUserCommunities($user['id']);

        // on retrouve les infos sur le groupe du user
        $groupModel = new GroupModel();
        $userGroup = $groupModel->findById($user['group_id']);

        echo $this->templates->render('user/myaccount', [
            'communities' => $communities,
            'userCommunities' => $userCommunities,
            'group' => $userGroup,
            'errors' => $errors
        ]);
        exit();
    }

    public function admin()
    {
        // on retrouve notre user
        $user = $this->user;

        if(empty($_POST) && intval($user['group_id']) === 3) {
            $userModel = new UserModel();
            $members = $userModel->findAll();
            $groupModel = new GroupModel();
            $groups = $groupModel->findAll();
            echo $this->templates->render('user/admin', [
                'members' => $members,
                'groups' => $groups
            ]);
        }

        if(isset($_POST['change_user_status'])) {
            $data = [];
            $data['group_id'] = $_POST['group_id'];
            $user_id = $_POST['user_id'];
            $userModel = new UserModel();
            $userModel->update($data, $user_id);
            header('Location: '. $this->router->generate('admin'));
        }

        if(intval($user['group_id']) !== 3) {
            header( $_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
        }
    }

    public function addrecette()
    {
      $user=$this->user;

      echo $this->templates->render('user/addrecette');
    }

    public function atable()
    {
      $user=$this->user;

      echo $this->templates->render('user/atable');
    }
}
