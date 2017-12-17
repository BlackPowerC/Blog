<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

session_start();

require_once '../classe/Database.php';
require_once '../classe/Vote.php';

if (isset($_SESSION["token"]))
{
    if (isset($_POST["vote"]) AND isset($_POST["id_article"]))
    {
        $vote = (int) strip_tags($_POST["vote"]);
        $id_article = (int) strip_tags($_POST["id_article"]);
        
        $this_vote = new Vote(["id_user"=>$_SESSION["id"], "id_article"=>$id_article, "type_vote"=>$vote]) ;
        $this_vote->vote() ;
        
    }
}
/* redirection en envoyant un message d'erreur */
header('Location: http://' . $_SERVER["SERVER_NAME"] . strip_tags($_GET['uri']));
exit();
