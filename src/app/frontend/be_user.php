<?php
session_start();

require_once '../core/Autoloader.php';
Autoloader::getInstance()->load_class('pages') ;
Autoloader::getInstance()->load_entity('user') ;
Autoloader::getInstance()->load_class('database') ;

class beuserController
{
    public function beuserAction()
    {
        $_sexe = ["H"=>"Homme", "F"=>"Femme"] ;
        $_type = [1=>"Utilisateur normal", 2=> "Auteur"] ;
        include_once '../views/beuserView.php' ;
    }
}

$bec = new beuserController() ;

if (!isset($_SESSION['token']))
{
    /* Redirection vers la page d'inscription */
    header("Location: inscription.php?msg=bad_action");
    exit();
}
else
{
    $bec->beuserAction() ;
}
