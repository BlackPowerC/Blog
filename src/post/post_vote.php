<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

session_start();

require_once '../classe/Database.php';

if (isset($_SESSION["token"]))
{
    if (isset($_POST["vote"]) AND isset($_POST["id_article"]))
    {
        $vote = (int) strip_tags($_POST["vote"]);
        $id_article = (int) strip_tags($_POST["id_article"]);
        /* Récupération de l'object PDO */
        $pdo = Database::getInstance()->getPDO();
        /* Vérification du vote */
        $action = $pdo->prepare("SELECT type FROM vote_article WHERE id_user=:id_user AND id_article=:id_article");
        $action->bindValue(":id_user", $_SESSION["id"], PDO::PARAM_INT);
        $action->bindValue(":id_article", $id_article, PDO::PARAM_INT);
        $action->execute();
        $result = $action->fetch(PDO::FETCH_NUM);
        var_dump($result) ;
        $action->closeCursor();
        /* L'utilisateur n'a pas encore vté */
        if (count($result) == 0 || !$result)
        {
            $insert = $pdo->prepare("INSERT INTO vote_article VALUES(:id_user, :id_article, :vote)");
            $insert->bindValue(":id_user", $_SESSION["id"], PDO::PARAM_INT);
            $insert->bindValue(":id_article", $id_article, PDO::PARAM_INT);
            $insert->bindValue(":vote", $vote, PDO::PARAM_BOOL);
            $insert->execute();
            $insert->closeCursor();
        }
        /* l'utlisisateur à déja voter */ else
        {
            /* Même type de vote */
            if ($vote == $result[0])
            {
                $delete = $pdo->prepare("DELETE FROM vote_article WHERE id_user=:id_user AND id_article=:id_article");
                $delete->bindValue(":id_user", $_SESSION["id"], PDO::PARAM_INT);
                $delete->bindValue(":id_article", $id_article, PDO::PARAM_INT);
                $delete->execute();
                $delete->closeCursor();
            }
            /* Sinon une mise à jour */ else
            {
                echo 'rtt';
                $vote = !$vote;
                $update = $pdo->prepare("UPDATE vote_article SET type=:type WHERE id_user=:id_user AND id_article=:id_article");
                $update->bindValue(":id_user", $_SESSION["id"], PDO::PARAM_INT);
                $update->bindValue(":id_article", $id_article, PDO::PARAM_INT);
                $update->bindValue(":type", $vote, PDO::PARAM_BOOL);
                $update->execute();
                $update->closeCursor();
            }
        }
    }
}
/* redirection en envoyant un message d'erreur */
//header('Location: http://' . $_SERVER["SERVER_NAME"] . strip_tags($_GET['uri']));
//exit();
