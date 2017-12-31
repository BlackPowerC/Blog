<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserManager
 *
 * @author jordy
 */
require_once ROOT.'core/Autoloader.php';
Autoloader::getInstance()->load_manager('manager') ;
Autoloader::getInstance()->load_entity('user') ;

class UserManager extends Manager
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
            self::$p_singleton = new UserManager();
        }
        return self::$p_singleton;
    }

    public function insert(Entity $a)
    {
        if(!($a instanceof User))
        {
            return;
        }
        $ps=$this->pdo->prepare("INSERT INTO User VALUES (NULL, :pseudo, :email)") ;
        $ps->execute([
            "pseudo"=>$a->getPseudo(),
            "email"=>$a->getEmail()
            ]);
        $ps->closeCursor() ;
    }

    public function get(User $u)
    {
        $ps = $this->pdo->prepare("SELECT id FROM User WHERE pseudo=? AND email=?");
        $ps->execute([$u->getPseudo(), $u->getEmail()]);
        $result = $ps->fetch(PDO::FETCH_ASSOC) ;
        $ps->closeCursor() ;
        if($result === FALSE)
        {
            return NULL ;
        }
        $u->setId($result["id"]) ;
        return $u ;
    }

    public function findAll()
    {
        
    }

    public function findById(int $id)
    {
        
    }

    public function findByCriteria(string $criteria)
    {
        
    }

    public function update(Entity $a)
    {
        if(!($a instanceof User))
        {
            return;
        }
        $ps=$this->pdo->prepare("UPDATE User SET pseudo=:pseudo, email=:email WHERE id=:id") ;
        $ps->execute([
            "pseudo"=>$a->getPseudo(),
            "email"=>$a->getEmail(),
            "id"=>$_SESSION["id"]
            ]);
        $ps->closeCursor() ;
    }

    public function delete(int $id)
    {
        $ps = $this->pdo->prepare("DELETE FROM User WHERE id=:id") ;
        $ps->execute(["id"=>$id]);
        $ps->closeCursor() ;
    }
}
