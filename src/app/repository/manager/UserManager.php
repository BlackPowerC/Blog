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
require_once 'Manager.php';
require_once '../entity/User.php';

class UserManager extends Manager
{

    private static $p_singleton;

    private function __construct()
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

    public function insert(User $a)
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

    public function update(User $a)
    {
        
    }

    public function delete(int $id)
    {
        
    }
}
