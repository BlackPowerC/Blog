<?php

session_start();
require_once '../core/Autoloader.php';
Autoloader::getInstance()->load_entity('comment') ;
Autoloader::getInstance()->load_manager('commentManager') ;

if (isset($_SESSION["id"]) && isset($_SESSION["email"]) && isset($_SESSION["pseudo"]))
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
                        $text = strip_tags($_POST["comment"]);
                        $id_article = (int) strip_tags($_POST["id_article"]);
                        $id_user = (int) strip_tags($_SESSION["id"]);
                        $cmt = new Comment() ;
                        $cmt->setId_user($id_user)
                                ->setId_article($id_article)
                                ->setDate(date("Y-m-d H:i:s"))
                                ->setText($text) ;
                        CommentManager::getInstance()->insert($cmt) ;
                    }
                }
                break;
            case 'delete':
                if (isset($_POST["id_comment"]))
                {
                    $id_comment = strip_tags($_POST['id_comment']);
                    CommentManager::getInstance()->delete($id_comment) ;
                }
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
