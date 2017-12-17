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
        $sql_query = "SELECT a.id, a.id_user, a.date, a.text, u.pseudo 
                        FROM article a
                        LEFT JOIN user u on a.id_user = u.id  " ;
        $select = Database::getInstance()->getPDO()->executeQuery($sql_query) ;
        $array = $select->fetchAll(PDO::FETCH_ASSOC) ;
        $articles = array() ;
        foreach ($array as $value)
        {
            $a = new Article();
            array_push($articles, $a
                    ->setDate($value['date'])->setId($value['id'])
                    ->setText($value['text'])->setTitre($value['titre'])
                    ->setUser($value['id_user'])) ;
        }
        return $articles ;
    }
    
    public function findById(int $id)
    {
        $sql_query = "SELECT a.id, a.id_user, a.date, a.text, u.pseudo 
                        FROM article a
                        LEFT JOIN user u on a.id_user = u.id  
                            WHERE a.id=:id" ;
        $ps = Database::getInstance()->prepare($sql_query) ;
        $ps->execute(array("id"=>$id)) ;
        $article = $ps->fetchAll(PDO::FETCH_ASSOC) ;
        $ps->closeCursor() ;
        $a = new Article();
        $a->setDate($article['date'])
                ->setId($article['id'])
                ->setText($article['text'])
                ->setTitre($article['titre'])
                ->setUser($article['id_user']);
        return $a ;
    }
    
    public function findByCriteria(string $criteria)
    {
        $sql_query = "SELECT a.id, a.id_user, a.date, a.text, u.pseudo 
                        FROM article a
                        LEFT JOIN user u on a.id_user = u.id  
                            WHERE a.text LIKE '%:criteria%' " ;
        $ps = Database::getInstance()->prepare($sql_query) ;
        $ps->execute(array("criteria"=>$criteria)) ;
        $article = $ps->fetchAll(PDO::FETCH_ASSOC) ;
        $ps->closeCursor() ;
        $a = new Article();
        $a->setDate($article['date'])
                ->setId($article['id'])
                ->setText($article['text'])
                ->setTitre($article['titre'])
                ->setUser($article['id_user']);
        return $a ;
    }

    public function update(Article $a)
    {
        $sql_query = "UPDATE article set titre=:titre, text=:text, date=:date WHERE id=:id" ;
        $ps = Database::getInstance()->prepare($sql_query) ;
        $ps->execute(array("titre"=>$a->getTitre(),
            "text"=>$a->getText(),
            "date"=>$a->getDate(),
            "id"=>$a->getId())) ;
        $ps->closeCursor() ;
    }
        
    public function delete(int $id)
    {
        $sql_query = "DELETE FROM article WHERE id=:id" ;
        $ps = Database::getInstance()->prepare($sql_query) ;
        $ps->execute(array("id"=>$id)) ;
        $ps->closeCursor() ;
    }
}