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
require_once '../../classe/Database.php';
require_once 'Manager.php';
require_once '../entity/Comment.php';

class CommentManager extends Manager
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
    
    public function insert(Comment $a)
    {
        $sql = "INSERT INTO Comment VALUES (NULL, :id_user, :id_article, :date, :text)" ;
        $ps = Database::getInstance()->prepare($sql) ;
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
        $query = Database::getInstance()->query($sql) ;
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
        $ps = Database::getInstance()->prepare($sql) ;
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

    public function update(Comment $a)
    {
        $sql = "UPDATE Comment set text=:text WHERE id = :id" ;
        $ps = Database::getInstance()->prepare($sql) ;
        return $ps->execute(array("id"=>$a->getId(), "text"=>$a->getText())) ;
    }
        
    public function delete(int $id)
    {
        $sql = "DELETE FROM Comment WHERE id=:id" ;
        $ps = Database::getInstance()->prepare($sql) ;
        return $ps->execute(array("id"=>$id)) ;
    }
}
