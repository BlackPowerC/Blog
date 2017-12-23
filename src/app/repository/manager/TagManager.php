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

    private function __construct()
    {
        
    }

    public static function getInstance()
    {
        if (is_null(self::$p_singleton))
        {
            self::$p_singleton = new ArticleManager();
        }
        return self::$p_singleton;
    }

    public function insert(Tag $a)
    {
        
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

    public function update(Tag $a)
    {
        
    }

    public function delete(int $id)
    {
        
    }
}
