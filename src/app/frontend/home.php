<?php

session_start();

require_once '../core/Autoloader.php';
Autoloader::getInstance()->load_class('database') ;
Autoloader::getInstance()->load_class('pagination') ;
Autoloader::getInstance()->load_class('pages') ;
Autoloader::getInstance()->load_entity('article') ;

class indexController
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

    public function searchAction(int $pageNum, string $keyword)
    {
        $pages = new Pagination(5);
        $pages->initPager("SELECT COUNT(Article.id) as nItem 
                                    FROM Article 
                                    WHERE Article.titre LIKE '%{$keyword}%' OR Article.text LIKE '%{$keyword}%'") ;
        $sqlStatement = "SELECT a.id, a.titre, a.date, a.text, COUNT(c.id_article) AS nbre_comment
                            FROM Article a 
                            LEFT JOIN Comment c ON a.id = c.id_article 
                            WHERE a.titre LIKE '%{$keyword}%' OR a.text LIKE '%{$keyword}%' 
                            GROUP by a.id" ;
        $data = $pages->initContent($pageNum, $sqlStatement);
        include_once '../views/home.inc.php';
    }

    public function indexAction(int $page, string $tag)
    {
        $pages = new Pagination(5) ;
        /* Récupération des articles */
        $sqlStatement = "";

        if($tag == "")
        {
            $pages->initPager("SELECT COUNT(Article.id) as n FROM Article") ;
            $sqlStatement = "SELECT a.id, a.titre, a.date, a.text, COUNT(c.id_article) AS nbre_comment
                                FROM Article a
                                    LEFT JOIN Comment c ON a.id = c.id_article
                                    GROUP by a.id";
        }
        else
        {
            $pages->initPager("SELECT COUNT(*) as n FROM Tag t WHERE t.tag LIKE '%{$tag}%'") ;
            $sqlStatement = "SELECT a.id, a.titre, a.date, a.text, COUNT(c.id_article) AS nbre_comment
                                FROM Article a
                                LEFT JOIN Comment c ON a.id = c.id_article
                                RIGHT JOIN Tag t ON a.id = t.id_article
                                WHERE t.tag LIKE '%{$tag}%'
                                GROUP by a.id";
        }
        $data = $pages->initContent($page, $sqlStatement);
        include_once '../views/home.inc.php';
    }

}

$ic = new indexController();
if (isset($_GET['keyword']))
{
    $keyword = strip_tags($_GET['keyword']);
    $ic->searchAction((isset($_GET['page']) ? (int) strip_tags($_GET['page']) : 1), $keyword);
}
else
{
    $ic->indexAction((isset($_GET['page']) ? (int) strip_tags($_GET['page']) : 1), (isset($_GET['tag']) ? (string) strip_tags($_GET['tag']) : ""));
}