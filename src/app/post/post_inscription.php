<?php
session_start();

if (isset($_POST['email']) AND isset($_POST['pseudo']))
{
    require_once '../core/Autoloader.php';
    Autoloader::getInstance()->load_entity('user') ;
    Autoloader::getInstance()->load_manager('userManager') ;
    Autoloader::getInstance()->load_class('database') ;
    
    $user = new User();
    $user->setEmail(strip_tags($_POST['email']));
    $user->setPseudo(strip_tags($_POST['pseudo']));
//    if(preg_match("[A-Za-z0-9]{6, 20}$", $_POST['pseudo']===1) 
//            && preg_match("^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9]+\.[a-zA-Z0-9-.]+$", $_POST['email'])===1)
//    {
        $result = UserManager::getInstance()->get($user) ;
        /* Utilisateur non inscrit */
        if(is_null($result))
        {
            UserManager::getInstance()->insert($user);
            /* Allez vers la page de connexion */
            header("Location: ../frontend/connexion.php?msg=good_action") ;
            exit() ;
//        }
    }
    /* Utilisateur inscrit */
    header("Location: ../frontend/connexion.php?msg=bad_action") ;
    exit() ;
}
else
{
    header("Location: ../frontend/inscription.php");
    exit() ;
}
