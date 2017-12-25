<?php
session_start();

if (isset($_POST['passe']) AND isset($_POST['pseudo']) AND isset($_POST['sexe']))
{
    require_once '../classe/User.php';

    

    /* Redirection vers la page de connexion */
    header("Location: ../frontend/connexion.php") ;
    exit() ;
}
else
{
    header("Location: ../frontend/inscription.php");
    exit() ;
}
