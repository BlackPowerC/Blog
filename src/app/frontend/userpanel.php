<?php
session_start();

require_once '../core/Autoloader.php';
Autoloader::getInstance()->load_class('pages') ;
Autoloader::getInstance()->load_entity('user') ;
Autoloader::getInstance()->load_class('database') ;
Autoloader::getInstance()->load_helper('form_helper') ;

class beuserController
{
    public function beuserAction()
    {
        include_once '../views/userpanel.inc.php' ;
    }
}

if (isset($_SESSION["id"]) && isset($_SESSION["email"]) && isset($_SESSION["pseudo"]))
{  
    $bec = new beuserController() ;
    $bec->beuserAction() ;
}
else
{
    /* Redirection vers la page d'inscription */
    header("Location: inscription.php?msg=bad_action");
    exit();
}
