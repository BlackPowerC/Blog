<?php
session_start();

require_once '../classe/Pages.php';
require_once '../classe/User.php';
require_once '../classe/Database.php';

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
