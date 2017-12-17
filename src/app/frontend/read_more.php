<?php

session_start();

require_once '../classe/MediaSharing.php';
require_once '../classe/Database.php';
require_once '../classe/Article.php';
require_once '../classe/Comment.php';
require_once '../classe/Pages.php';
require_once '../classe/Tag.php';
require_once '../classe/Vote.php';

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
        
        $requete = Database::getInstance()->prepare("SELECT * FROM article WHERE id = :id_article");
        $requete->execute(array('id_article' => $id_article));
        $article = $requete->fetch();
        $requete->closeCursor();
        
        /* Les commentaires de l'article */
        $sqlCmtQuery = Database::getInstance()->prepare(
                "SELECT c.id, c.id_article, c.id_user, c.date, c.text, u.pseudo
                 FROM comment c
                 LEFT JOIN user u ON c.id_user = u.id
                 WHERE c.id_article = :id");
        $sqlCmtQuery->execute(array('id' => $id_article));
        $comments = $sqlCmtQuery->fetchAll(PDO::FETCH_ASSOC);
        $sqlCmtQuery->closeCursor();
        
        /* Récupération des tags */
        $sql_tags = "SELECT t.id_article, t.tag
                        FROM tag t 
                        LEFT JOIN article a 
                        ON t.id_article = a.id
                        WHERE t.id_article= :id_article" ;
        $request_tags = Database::getInstance()->prepare($sql_tags);
        $request_tags->execute(array('id_article' => $id_article)) ;
        $response_tags = $request_tags->fetchAll(PDO::FETCH_ASSOC) ;
        $request_tags->closeCursor() ;
        
        /* L'article en question */
        $t_article = new Article($article);
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
