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
                $id = (int) strip_tags($_POST['id']);
                $text = htmlentities($_POST['text']);
                $titre = strip_tags($_POST['titre']);
                $tags = explode(",", strip_tags($_POST['tags']));
                /* Modification de l'article */
                $update_article = $pdo->prepare("UPDATE article set text=:text, titre=:titre WHERE id=:id_article");
                $update_article->bindValue(":text", $text, PDO::PARAM_STR);
                $update_article->bindValue(":id_article", $id, PDO::PARAM_INT);
                $update_article->bindValue(":titre", $titre, PDO::PARAM_STR);
                $update_article->execute();
                $update_article->closeCursor();
                /* Modification des tags */
                $delete_tags = $pdo->prepare("DELETE FROM tag WHERE id_article=:id_article");
                $delete_tags->bindValue(":id_article", $id, PDO::PARAM_INT);
                $delete_tags->execute();
                $delete_tags->closeCursor();
                $insert_tags = $pdo->prepare("INSERT INTO tag VALUES (:id_article, :tag)");
                $insert_tags->bindValue(":id_article", $id, PDO::PARAM_INT);
                foreach ($tags as $tag)
                {
                    $insert_tags->bindValue(":tag", trim($tag), PDO::PARAM_STR);
                    $insert_tags->execute();
                }
                $insert_tags->closeCursor();
                break;
            case 'insert':
                /* Insertion de l'article */
                $id = (int) strip_tags($_POST['id']);
                $text = htmlentities($_POST['text']);
                $titre = strip_tags($_POST['titre']);
                $date = date("d F Y");
                $tags = explode(",", strip_tags(trim($_POST['tags'])));
                $insert_article = $pdo->prepare("INSERT INTO article VALUES (:id, :id_user, :titre, :date, :text)");
                $insert_article->bindValue(":id", $id + 1, PDO::PARAM_INT);
                $insert_article->bindValue(":id_user", (int) $_SESSION['id'], PDO::PARAM_INT);
                $insert_article->bindValue(":titre", $titre, PDO::PARAM_STR);
                $insert_article->bindValue(":date", $date, PDO::PARAM_STR);
                $insert_article->bindValue(":text", $text, PDO::PARAM_STR);
                $insert_article->execute();
                $insert_article->closeCursor();
                /* Insertion des tags */
                $insert_tags = $pdo->prepare("INSERT INTO tag VALUES (:id_article, :tag)");
                $insert_tags->bindValue(":id_article", $id, PDO::PARAM_INT);
                foreach ($tags as $tag)
                {
                    $insert_tags->bindValue(":tag", trim($tag), PDO::PARAM_STR);
                    $insert_tags->execute() ;
                }
                var_dump($_POST);
                var_dump($insert_article);
                $insert_tags->closeCursor();
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
