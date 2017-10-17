<?php

session_start();

//require_once '../classe/Managers/ArticleManager.php';
require_once '../classe/Article.php';
require_once '../classe/Database.php';

if (isset($_SESSION['token']) AND $_SESSION['id_type'] == 2)
{
    if (isset($_POST['operation']))
    {
        /* PDO OBJCET */
        $pdo = Database::getInstance()->getPDO();
        
        switch (strip_tags($_POST['operation']))
        {
            case 'modify':
                $id = trim($_POST['id']);
                $text = htmlentities($_POST['text']);
                $tags = explode(strtolower(strip_tags($_POST['tags'])), ",");
                $titre = strip_tags($_POST['titre']);
                /* Update des tags */
                $insert_tags = $pdo->prepare("INSERT INTO tag values (:id_article, :tags)");
                foreach ($tags as $value)
                {
                    $insert_tags->bindParam(':tags', $value, PDO::PARAM_STR) ;
                    $insert_tags->bindParam(':id_article', $value, PDO::PARAM_INT) ;
                    $insert_tags->execute() ;
                }
                $insert_tags->closeCursor() ;
                /* Update opération */
                $insert = $pdo->prepare("UPDATE article SET titre=:titre, text =:text WHERE id=:id");
                $insert->execute(array("titre" => $titre, "id" => $id, "text" => $text, "tags" => $tags));
                break;
            case 'insert':
                $text = htmlentities($_POST['text']);
                $tags = strtolower(strip_tags($_POST['tags']));
                $titre = strip_tags($_POST['titre']);
                $insert = $pdo->prepare("INSERT INTO article VALUES (NULL, :id_user, :titre, :date, :tags, :text)");
                $insert->execute(array('id_user' => $_SESSION['id'], "titre" => $titre, "date" => date("d F Y"), "text" => $text, "tags" => $tags));
                break;
            case 'delete' :
                $id = trim($_POST['id']);
                $delete = $pdo->prepare("DELETE FROM article WHERE id = :id");
                $delete->execute(array("id" => $id));
                $delete->closeCursor();
        }
        header("Location: ../backend/backend.php?link=rediger&msg=0");
        exit();
    }
    header("Location: ../backend/backend.php?link=rediger?msg=1");
    exit();
} else
{
    header("Location: ../frontend/connexion.php");
    exit();
}
