<?php

session_start();
require '../classe/Database.php';

if (isset($_SESSION["token"]))
{
    if (isset($_POST['operation']))
    {
        switch ($_POST['operation'])
        {
            case 'insert':
                if (isset($_POST["comment"]) AND isset($_POST["id_article"]))
                {
                    if (strcmp($_POST["comment"], "") != 0)
                    {
                        $comment = strip_tags($_POST["comment"]);
                        $id_article = strip_tags($_POST["id_article"]);
                        $id_user = strip_tags($_SESSION["id"]);

                        $sql = "INSERT INTO comment values (NULL, :id_user, :id_article, :date, :comment)";
                        $requete = Database::getInstance()->prepare($sql);
                        $requete->execute(array("id_article" => $id_article, "id_user" => $id_user, "date" => date("d-m-y"), "comment" => $comment));
                    }
                }
                break;
            case 'delete':
                $id_comment = strip_tags($_POST['id_comment']);
                $sql = "DELETE FROM comment WHERE id = ?";
                $requete = Database::getInstance()->prepare($sql);
                $requete->execute(array($id_comment));
                $requete->closeCursor();
                break;
            case 'modify':
                if (isset($_POST["comment"]) AND isset($_POST["id_article"]))
                {
                    if (strcmp($_POST["comment"], "") != 0)
                    {
                        $id_comment = strip_tags($_POST['id_comment']);
                        $text_comment = strip_tags($_POST['comment']);
                        $sql = "UPDATE comment SET text = :text_comment, date = :date_comment WHERE id = :id_comment";
                        $requete = Database::getInstance()->prepare($sql);
                        $requete->execute(array("text_comment" => $text_comment, "date_comment" => 'modifié le ' . date("d-m-y"), "id_comment" => $id_comment));
                    }
                }
                break;
        }
    }
}
header('Location: http://' . $_SERVER['SERVER_NAME'] . strip_tags($_POST["uri"]));
exit();
