<?php

namespace Community;

use AltoRouter;

class FrontController
{

    public static function run()
    {

        // Charger la config :
        $config = parse_ini_file('config.conf');

        $routes = array(
          // CommunityController : routes des communautés du site
          array('GET', '/', 'CommunityController#home', 'home'),
          // route vers une communauté
          array('GET|POST', '/community/[i:id]', 'CommunityController#community', 'community'),

          //USER ROAD
          //SignUp
          array('GET|POST', '/signup', 'UserController#signup', 'signup'),
          //LogIn
          array('GET|POST', '/login', 'UserController#login', 'login'),
          //LostPassword
          array('GET|POST', '/lostpassword', 'UserController#lostpassword', 'lostpassword'),
          //EditPassword
          array('GET|POST', '/editpassword', 'UserController#editpassword', 'editpassword'),
          //LogOut
          array('GET', '/logout', 'UserController#logout', 'logout'),
          // Members
          array('GET', '/members', 'UserController#members', 'members'),
          // 1 Member
          array('GET', '/member/[i:id]', 'UserController#member', 'member_single'),
          // my account
          array('GET|POST', '/myaccount', 'UserController#myaccount', 'myaccount'),
          // admin
          array('GET|POST', '/admin', 'UserController#admin', 'admin'),
          //Add recette
          array('GET|POST', '/addrecette', 'UserController#addrecette', 'addrecette'),
          //Section A Table
          array('GET', '/atable', 'UserController#atable', 'atable'),
        );

        // créer le router
        $router = new AltoRouter();

        // configurer le routeur (base_path & mapping des routes)
        $router->setBasePath($config['BASE_PATH']);
        $router->addRoutes($routes);


        // lancer le matching du routeur
        $match = $router->match();

        // il fait le dispatch
        if( $match ) {
            // get controller & fonction name from $match['target']
            $parts = explode('#', $match['target']);

            // je récupère le nom de la classe du Controller que je veux utiliser
            $ctrlClass = 'Community\\Controller\\' . $parts[0];

            // instancier le controller souhaité
            $controller = new $ctrlClass($router, $config);

            // on récupère le nom de la méthode souhaitée
            $methodName = $parts[1];

            $controller->$methodName($match['params']);

        } else {
        	// no route was matched
        	header( $_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
        }

    }

}

 ?>
