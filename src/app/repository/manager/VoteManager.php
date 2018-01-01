<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Classe gérant la table Vote dans la base de données.
 *
 * @author jordy
 */
//require_once '../../core/Autoloader.php';
Autoloader::getInstance()->load_manager('manager') ;
Autoloader::getInstance()->load_entity('entity') ;
Autoloader::getInstance()->load_entity('vote') ;

class VoteManager extends Manager
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
            self::$p_singleton = new VoteManager();
        }
        return self::$p_singleton;
    }
    public function delete(int $id)
    {
        $ps=$this->pdo->prepare("DELETE FROM Vote WHERE id_article=:id") ;
        $ps->execute(["id"=>$id]) ;
    }

    public function findAll()
    {
        
    }

    public function findByCriteria(string $criteria)
    {
        
    }

    public function findById(int $id)
    {
        $ps = $this->pdo->prepare("SELECT type FROM Vote WHERE id_article=:id");
        $ps->execute(["id"=>$id]) ;
        $results = $ps->fetchAll(PDO::FETCH_ASSOC) ;
        $vote_array = [] ;
        if($results === FALSE)
        {
            return $vote_array ;
        }
        $vote = new Vote() ;
        foreach ($results as $value)
        {
            $vote->setType((int)$value["type"]) ;
            array_push($vote_array, $vote) ;
        }
        return $results;
    }

    public function insert(Entity $a)
    {
        if(!($a instanceof Vote))
        {
            return FALSE ;
        }
        $ps = $this->pdo->prepare("INSERT INTO Vote VALUES (:id, :id_user, :vote)") ;
        $ps->execute(["id"=>$a->getId(), "id_user"=>$a->getId_user(), "vote"=>$a->getType()]) ;
        return $ps->closeCursor() ;
    }

    public function update(Entity $a)
    {
        if(!($a instanceof Vote))
        {
            return FALSE ;
        }
        $ps = $this->pdo->prepare("UPDATE Vote SET type=:vote WHERE id_article=:id AND id_user=:id_user") ;
        $ps->execute(["id"=>$a->getId(), "id_user"=>$a->getId_user(), "vote"=>$a->getType()]) ;
        return $ps->closeCursor() ;
    }
    
    public function get(Entity $a)
    {
        if(!($a instanceof Vote))
        {
            return FALSE ;
        }
        $ps = $this->pdo->prepare("SELECT type FROM Vote WHERE id_article=:id AND id_user=:id_user") ;
        $ps->execute(["id"=>$a->getId(), "id_user"=>$a->getId_user()]) ;
        $result = $ps->fetch();
        if($result === FALSE)
        {
            return NULL ;
        }
        $ps->closeCursor() ;
        return $a ;
    }
}
