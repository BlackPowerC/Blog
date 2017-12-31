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
require_once '../../core/Autoloader.php';
Autoloader::getInstance()->load_entity('entity') ;
Autoloader::getInstance()->load_entity('vote') ;
Autoloader::getInstance()->load_classe('database') ;

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
        
    }

    public function findAll()
    {
        
    }

    public function findByCriteria(string $criteria)
    {
        
    }

    public function findById(int $id)
    {
        
    }

    public function insert(Entity $a)
    {
        
    }

    public function update(Entity $a)
    {
        
    }

}
