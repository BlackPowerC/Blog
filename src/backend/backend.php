<?php

session_start();

require_once '../classe/Article.php';
require_once '../classe/Database.php';

class backendController
{

    public function __construct()
    {
        
    }

    public function statsAction()
    {
        include_once '../../views/backend_statsView.php';
    }

    public function redigerAction()
    {
        $sql_query = "SELECT a.id, a.date, a.titre, a.text, a.id_user
                        FROM article a 
                        LEFT JOIN user u ON u.id = a.id_user
                        WHERE u.id=:id_user" ;
        
        $requete = Database::getInstance()->prepare($sql_query);
        $requete->execute(array("id_user"=>$_SESSION['id'])) ;
        $articles = $requete->fetchAll(PDO::FETCH_ASSOC);
        include_once '../views/backend/backend_redigerView.php';
    }

}

$bc = new backendController();
if (isset($_SESSION['id_type']) AND $_SESSION['id_type'] == 2)
{
    if (isset($_GET['link']))
    {
        $link = strip_tags($_GET['link']);
        switch ($link)
        {
            case 'stats';
                break;

            case 'site':
                header("Location: ../frontend/index.php");
                exit() ;
                break;

            case 'rediger':
                $bc->redigerAction();
                break;

            case 'logout':
                unset($_SESSION["token"]);
                unset($_SESSION["login"]);
                unset($_SESSION["passwd"]);
                header("Location: ../frontend/index.php");
                exit() ;
                break;
        }
    }
} else
{
    header("location: index.php");
    exit() ;
}
