<?php

session_start();

require_once '../classe/MediaSharing.php';
require_once '../classe/Database.php';
require_once '../repository/entity/Article.php';
require_once '../repository/entity/Comment.php';
require_once '../classe/Pages.php';
require_once '../repository/entity/Tag.php';
require_once '../classe/Vote.php';

require_once '../repository/manager/ArticleManager.php';

class readmoreController
{
    public function __construct()
    {
        if (isset($_SESSION['token']) AND isset($_SESSION['persist']))
        {
            if ($_SESSION['persist'])
            {
                setcookie("pseudo", $_SESSION['pseudo'], 3600 * 24, null, null, true, false);
                setcookie("passe", $_SESSION['passe'], 3600 * 24, null, null, true, false);
                setcookie("id", $_SESSION['id'], 3600 * 24, null, null, true, false);
                setcookie("id_type", $_SESSION['id_type'], 3600 * 24, null, null, true, false);
                setcookie("pays", $_SESSION['pays'], 3600 * 24, null, null, true, false);
                setcookie("age", $_SESSION['age'], 3600 * 24, null, null, true, false);
                setcookie("sexe", $_SESSION['sexe'], 3600 * 24, null, null, true, false);
                setcookie("time", $_SESSION['time'], 3600 * 24, null, null, true, false);
            }
        }
    }

    public function readmoreIndex()
    {
        $id_article = strip_tags($_GET['id_article']);
        /* L'article */
        $article = ArticleManager::getInstance()->findByid($id_article) ;
        
        /* Les commentaires de l'article */
        $comments = CommentManager::getInstance()->findByid($id_article) ;
        
        /* Récupération des tags */
        $tags = TagManager::getInstance()->findByid($id_article) ;
        
        /* L'article en question */
        $HTMLView = $t_article->toHTML();
        
        /* Les résultats du vote */
        $vote_results = Vote::getVoteResults($id_article);
        include_once '../views/readmoreView.php';
    }

}

$rdc = new readmoreController();
if (isset($_GET['id_article']))
{
    $rdc->readmoreIndex();
} else
{
    header('Location: http://localhost/~jordy/Blog/frontend/index.php');
}
