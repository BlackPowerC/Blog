<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ArticleManager
 *
 * @author jordy
 * @field array $articles un tableau d'objet de la classe Article
 * @brief La classe ArticleManager sert à la gestion (Ajout, modification, suppression et select) d'entités Articles
 *          Cette classe est la voie royale pour manipuler les entités Articles
 */
require_once '../Article.php' ;
require_once '../Database.php' ;
require_once '../Manager.php' ;

class ArticleManager extends Manager
{
    private static $p_singleton ;

    private function __construct()
    {
    }

    public static function getInstance()
    {
        if(is_null(self::$p_singleton))
        {
           self::$p_singleton = new ArticleManager() ;
        }
        return self::$p_singleton ;
    }

    public function insert(Article $a)
    {
        $sql_query = "INSERT INTO ARTICLE VALUES (NULL, :id_user, :titre, :date, :text)" ;
        $ps = Database::getInstance()->prepare($sql_query) ;
        $ps->execute(array(
            "id_user"=>$a->getUser()->getId(),
            "titre"=>$a->getTitre(),
            "date"=>$a->getDate(),
            "text"=>$a->getText()
                )) ;
        $ps->closeCursor() ;
    }
    
    public function findAll()
    {
        $sql_query = "" ;
    }
    
    public function findById(int $id)
    {
        $sql_query = "" ;
    }
    
    public function findByCriteria(string $criteria)
    {
        $sql_query = "" ;
    }

    public function update(Article $a)
    {
        $sql_query = "" ;
    }
        
    public function delete(int $id)
    {
        $sql_query = "" ;
    }
}