<?php

session_start();
require '../classe/Database.php';
require_once '../repository/entity/Comment.php';

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
                        $cmt = new Comment() ;
                        $cm->setId_user($id_user)
                                ->setId_article($id_article)
                                ->setDate(date("d-m-y"))
                                ->setText($comment) ;
                        CommentManager::getInstance()->insert($cm) ;
                    }
                }
                break;
            case 'delete':
                $id_comment = strip_tags($_POST['id_comment']);
                CommentManager::getInstance()->delete($id_comment) ;
            case 'modify':
                if (isset($_POST["comment"]) AND isset($_POST["id_article"]))
                {
                    if (strcmp($_POST["comment"], "") != 0)
                    {
                        $id_comment = strip_tags($_POST['id_comment']);
                        $text_comment = strip_tags($_POST['comment']);
                        $cm = new Comment() ;
                        $cm->setId($id_comment)->setText($text_comment) ;
                        CommentManager::getInstance()->update($cm) ;
                    }
                }
                break;
        }
    }
}
header('Location: http://' . $_SERVER['SERVER_NAME'] . strip_tags($_POST["uri"]));
exit();
