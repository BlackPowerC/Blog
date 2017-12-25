<?php

session_start();

require_once '../repository/manager/ArticleManager.php';
require_once '../repository/entity/Article.php';
require_once '../classe/Database.php';

if (isset($_SESSION['token']) AND $_SESSION['id_type'] == 2)
{
    if (isset($_POST['operation']))
    {
        switch (strip_tags($_POST['operation']))
        {
            case 'modify':
                /* Les données de l'article */
                $id = (int) strip_tags($_POST['id']);
                $text = htmlentities($_POST['text']);
                $titre = strip_tags($_POST['titre']);
                $tags = explode(",", strip_tags($_POST['tags']));
                /* Modification de l'article */
                $update_article = Database::getInstance()->prepare("UPDATE article set text=:text, titre=:titre WHERE id=:id_article");
                $update_article->bindValue(":text", $text, PDO::PARAM_STR);
                $update_article->bindValue(":id_article", $id, PDO::PARAM_INT);
                $update_article->bindValue(":titre", $titre, PDO::PARAM_STR);
                $update_article->execute();
                $update_article->closeCursor();
                /* Modification des tags */
                $delete_tags = Database::getInstance()->prepare("DELETE FROM tag WHERE id_article=:id_article");
                $delete_tags->bindValue(":id_article", $id, PDO::PARAM_INT);
                $delete_tags->execute();
                $delete_tags->closeCursor();
                $insert_tags = Database::getInstance()->prepare("INSERT INTO tag VALUES (:id_article, :tag)");
                $insert_tags->bindValue(":id_article", $id, PDO::PARAM_INT);
                foreach ($tags as $tag)
                {
                    $insert_tags->bindValue(":tag", trim($tag), PDO::PARAM_STR);
                    $insert_tags->execute();
                }
                $insert_tags->closeCursor();
                break;
            case 'insert':
                /* Les données de l'article */
                $id = (int) strip_tags($_POST['id']);
                $text = htmlentities($_POST['text']);
                $titre = strip_tags($_POST['titre']);
                $date = date("d F Y");
                /* Les tags */
                $tags = explode(",", strip_tags(trim($_POST['tags'])));
                /*Insertion de l'article */
                $article = new Article() ;
                $article->setId($id+1)
                        ->setDate(date("d-m-y"))
                        ->setText($text)
                        ->setTitre($titre)
                        ->setUser($id) ;
                ArticleManager::getInstance()->insert($article) ;
                /* Insertion des tags */
                $tag = new Tag() ;
                $tag->setId_article($id+1) ;
                foreach ($tags as $tag)
                {
                    $tag->setTag(trim($tag)) ;
                    TagManager::getInstance()->insert($tag) ;
                }
                break;
            case 'delete' :
                $id = trim($_POST['id']);
                ArticleManager::getInstance()->delete($id) ;
        }
        header("Location: ../backend/backend.php?link=rediger&msg=0");
        exit();
    }
    header("Location: ../backend/backend.php?link=rediger?msg=1");
    exit();
}
else
{
    header("Location: ../frontend/connexion.php");
    exit();
}