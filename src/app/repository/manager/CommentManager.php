<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CommentManager
 *
 * @author jordy
 */
require_once ROOT.'core/Autoloader.php';
Autoloader::getInstance()->load_entity('comment') ;
Autoloader::getInstance()->load_class('database') ;
Autoloader::getInstance()->load_manager('manager') ;

class CommentManager extends Manager
{
    private static $p_singleton ;

    protected function __construct()
    {
        parent::__construct() ;
    }

    public static function getInstance()
    {
        if(is_null(self::$p_singleton))
        {
           self::$p_singleton = new CommentManager() ;
        }
        return self::$p_singleton ;
    }
    
    public function insert(Entity $a)
    {
        if(!($a instanceof Comment))
        {
            return;
        }
        $sql = "INSERT INTO Comment VALUES (NULL, :id_user, :id_article, :date, :text)" ;
        $ps = $this->pdo->prepare($sql) ;
        return $ps->execute(
                array(
                    "id_user"=>$a->getId_user(),
                    "id_article"=>$a->getId_article(),
                    "date"=>date("dd-mm-yyyy"),
                    "text"=>$a->getDate()
                )) ;
    }
    
    public function findAll()
    {
        $sql = "SELECT c.id, c.id_article, c.id_user, c.date, c.text,
                    u.pseudo, 
                    FROM Comment c RIGHT JOIN User u ON u.id = c.id_user";
        // La variable à renvoyer c'est un tableau de Comment
        $comment_array = array() ;
        $query = $this->pdo->query($sql) ;
        // result est un tableau contenant des tableaux
        $results = $query->fetchAll(PDO::FETCH_ASSOC) ;
        $comment = new Comment() ;
        $user = new User() ;
        
        foreach ($results as $value)
        {
            $comment->setId($value['id']) ;
            $comment->setDate($value['date']) ;
            $comment->setId_article($value['id_article']) ;
            $comment->setText($value['text']) ;
            $user->setPseudo($value['pseudo']) ;
            $comment->setId_user($user) ;
            array_push($comment_array, $comment) ;
        }
        $query->closeCursor() ;
        return $comment_array;
    }
    
    public function findById(int $id)
    {
        $sql = "SELECT c.id, c.id_article, c.id_user, c.date, c.text, u.pseudo, 
                    FROM Comment c RIGHT JOIN User u ON u.id = c.id_user 
                    WHERE c.id_carticle = :id_article";
        // La variable à renvoyer c'est un tableau de Comment
        $comment_array = array() ;
        $ps = $this->pdo->prepare($sql) ;
        $ps->execute(array("id_article"=>$id)) ;
        // result est un tableau contenant des tableaux
        $results = $ps->fetchAll(PDO::FETCH_ASSOC) ;
        $comment = new Comment() ;
        $user = new User() ;
        
        foreach ($results as $value)
        {
            $comment->setId($value['id']) ;
            $comment->setDate($value['date']) ;
            $comment->setId_article($value['id_article']) ;
            $comment->setText($value['text']) ;
            $user->setPseudo($value['pseudo']) ;
            $comment->setId_user($user) ;
            array_push($comment_array, $comment) ;
        }
        $ps->closeCursor() ;
        return $comment_array;
    }
    
    public function findByCriteria(string $criteria)
    {
        return array() ;
    }

    public function update(Entity $a)
    {
        if(!($a instanceof Comment))
        {
            return;
        }
        $sql = "UPDATE Comment set text=:text WHERE id = :id" ;
        $ps = $this->pdo->prepare($sql) ;
        return $ps->execute(array("id"=>$a->getId(), "text"=>$a->getText())) ;
    }
        
    public function delete(int $id)
    {
        $sql = "DELETE FROM Comment WHERE id=:id" ;
        $ps = $this->pdo->prepare($sql) ;
        return $ps->execute(array("id"=>$id)) ;
    }
}
