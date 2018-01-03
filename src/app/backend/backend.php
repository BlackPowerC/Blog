<?php

session_start();

require_once '../core/Autoloader.php';
Autoloader::getInstance()->load_class("database") ;
Autoloader::getInstance()->load_entity("article") ;
Autoloader::getInstance()->load_manager("articleManager") ;

//require_once '../classe/Article.php';
//require_once '../classe/Database.php';
        
class backendController
{
    public function __construct()
    {
        
    }

    public function statsAction()
    {
        include_once '../../views/backend_statsView.php';
    }

    public function redigerAction()
    {
        $articles = ArticleManager::getInstance()->findAll() ;
        include_once '../views/backend/backend_redigerView.php';
    }
}

$bc = new backendController();
if (isset($_SESSION['id']) AND $_SESSION['id'] == 1)
{
    if (isset($_GET['link']))
    {
        $link = strip_tags($_GET['link']);
        switch ($link)
        {
            case 'stats';
                break;

            case 'site':
                header("Location: ../frontend/home.php");
                exit() ;
                break;

            case 'rediger':
                $bc->redigerAction();
                break;

            case 'logout':
                header("Location: ../post/post_connexion.php?action=logout");
                exit() ;
                break;
        }
    }
} else
{
    header("location: index.php");
    exit() ;
}
