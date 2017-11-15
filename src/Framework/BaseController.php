<?php

namespace Community\Framework;

use League\Plates\Engine;
use Community\Model\UserModel;

class BaseController
{
    protected $router;
    protected $config;
    protected $templates;

    public function __construct($router, $config)
    {
        $this->router = $router;
        $this->config = $config;

        Database::setConfig($config);

        session_start();
        $userModel = new UserModel();
        $this->user = $userModel->getUser();

        // initialisez le moteur de templates ici
        $this->templates = new Engine('src/Templates');

        // mettre des variables à disposition des templates:
        $this->templates->addData([
            'router' => $router,
            'ASSET_PATH' => $config['BASE_PATH'].'/assets/',
            'user' => $this->user
        ]);

    }
}



 ?>
