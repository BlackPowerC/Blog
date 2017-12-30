<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Classe gérant les Tag dans la base de données
 *
 * @author jordy
 */
require_once 'Manager.php';
require_once '../entity/Tag.php';

class TagManager extends Manager
{
    private static $p_singleton;

    protected function __construct()
    {
        parent::__construct() ;
    }

    public static function getInstance()
    {
        if (is_null(self::$p_singleton))
        {
            self::$p_singleton = new ArticleManager();
        }
        return self::$p_singleton;
    }

    public function insert(Entity $a)
    {
        if(!($a instanceof Tag))
        {
            return;
        }
        $sql = "INSERT INTO Tag VALUES (:id_article, :tag)" ;
        $ps = Database::getInstance()->prepare($sql) ;
        return $ps->execute([
            "id_article"=>$a->getId_article(),
            "tag"=> strtolower($a->getTag())
            ]) ;
    }

    public function findAll(): array
    {
        $sql = "SELECT * FROM Tag" ;
        $ps = $this->pdo->query($sql) ;
        $tag_array = array() ;
        $results = $ps->fetchAll(PDO::FETCH_ASSOC) ;
        if($results === FALSE)
        {
            return [];
        }
        $tag = new Tag() ;
        foreach ($results as $value)
        {
            $tag->setId_article($value["id_article"]) ;
            $tag->setTag($value["tag"]) ;
            array_push($tag_array, $tag) ;
        }
        return $tag_array;
    }

    public function findById(int $id): Tag
    {
        $sql = "SELECT * FROM Tag WHERE id_article=:id" ;
        $ps = Database::getInstance()->prepare($sql) ;
        $ps->execute(["id"=>$id]);
        $result = $ps->fetchAll(PDO::FETCH_ASSOC) ;
        if($result === FALSE)
        {
            return NULL;
        }
        $tag = new Tag() ;
        $tag->setId_article($result["id_article"]) ;
        $tag->setTag($result["tag"]) ;
        
        return $tag;
    }

    public function findByCriteria(string $criteria)
    {
        $sql = "SELECT * FROM Tag WHERE tag=:criteria" ;
        $ps = Database::getInstance()->prepare($sql) ;
        $ps->execute(["criteria"=>$criteria]);
        $tag_array = array() ;
        $results = $ps->fetchAll(PDO::FETCH_ASSOC) ;
        if($results=== FALSE)
        {
            return [];
        }
        $tag = new Tag() ;
        foreach ($results as $value)
        {
            $tag->setId_article($value["id_article"]) ;
            $tag->setTag($value["tag"]) ;
            array_push($tag_array, $tag) ;
        }
        return $tag_array;
    }

    public function update(Entity $a)
    {
        if(!($a instanceof Tag))
        {
            return;
        }
        $sql = "UPDATE Tag set tag=:tag WHERE id_article=:id_article" ;
        $ps = Database::getInstance()->prepare($sql) ;
        return $ps->execute([
            "id_article"=>$a->getId_article(),
            "tag"=>$a->getTag()
        ]);
    }

    public function delete(int $id)
    {
        $sql = "DELETE FROM Tag WHERE id=:id" ;
        $ps = Database::getInstance()->prepare($sql) ;
        return $ps->execute(array("id"=>$id)) ;
    }
}
