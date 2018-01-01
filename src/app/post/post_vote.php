<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

session_start();

require_once '../core/Autoloader.php';;
Autoloader::getInstance()->load_entity('vote') ;
Autoloader::getInstance()->load_class('voting') ;

if (isset($_SESSION["id"]))
{
    if (isset($_POST["vote"]) AND isset($_POST["id_article"]))
    {
        $vote = (int) strip_tags($_POST["vote"]);
        $id_article = (int) strip_tags($_POST["id_article"]);
        $this_vote = new Vote() ;
        $this_vote->setId($id_article)->setType($vote)->setId_user($_SESSION["id"]) ;
        Voting::getInstance()->vote($this_vote) ;
    }
}
/* redirection en envoyant un message d'erreur */
header('Location: http://' . $_SERVER["SERVER_NAME"] . strip_tags($_GET['uri']));
exit();
