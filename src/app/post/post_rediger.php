<?php

session_start();

require_once '../core/Autoloader.php';
Autoloader::getInstance()->load_entity('article') ;
Autoloader::getInstance()->load_entity('tag') ;
Autoloader::getInstance()->load_manager('articleManager') ;
Autoloader::getInstance()->load_manager('tagManager') ;
Autoloader::getInstance()->load_class('database') ;

if (isset($_SESSION['id']) AND $_SESSION['id'] == 1)
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
                
                $article = new Article() ;
                $article->setId($id)->setText($text)->setTitre($titre)
                        ->setDate(date("Y-m-d H:i:s")) ;
               /* Modification de l'article */
                ArticleManager::getInstance()->update($article);
                $tags = explode(",", strip_tags($_POST['tags']));
                /* Modification des tags */
                TagManager::getInstance()->delete($id) ;
                if(count($tags) > 0)
                {
                    $t = new Tag() ;
                    $t->setId_article($id+1) ;
                    foreach ($tags as $tag)
                    {
                        $t->setTag(trim($tag)) ;
                        TagManager::getInstance()->insert($t) ;
                    }
                }
                break;
            case 'insert':
                /* Les données de l'article */
                $id = (int) strip_tags($_POST['id']);
                $text = htmlentities($_POST['text']);
                $titre = strip_tags($_POST['titre']);
                /*Insertion de l'article */
                $article = new Article() ;
                $article->setId($id+1)->setDate(date("Y-m-d H:i:s"))->setText($text)
                        ->setTitre($titre)
                        ->setUser($id) ;
                ArticleManager::getInstance()->insert($article) ;
                /* Les tags */
                $tags = explode(",", strip_tags(trim($_POST['tags'])));
                /* Insertion des tags */
                if(count($tags) > 0)
                {
                    $t = new Tag() ;
                    $t->setId_article($id+1) ;
                    foreach ($tags as $tag)
                    {
                        $t->setTag(trim($tag)) ;
                        TagManager::getInstance()->insert($t) ;
                    }
                }
                break;
            case 'delete' :
                $id = trim($_POST['id']);
                TagManager::getInstance()->delete($id) ;
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