<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author jordy
 */

require_once '../core/Autoloader.php';
Autoloader::getInstance()->load_entity('entity') ;
Autoloader::getInstance()->load_class('database') ;

abstract class Manager
{
    /**
     * Instance de la classe PDO pour manipuler la BD.
     * @var PDO 
     */
    protected $pdo ;
    protected function __construct()
    {
        $this->pdo = Database::getInstance()->getPDO();
    }
    
    public abstract function insert(Entity $a) ;
    
    public abstract function findAll() ;
    
    public abstract function findById(int $id) ;
    
    public abstract function findByCriteria(string $criteria) ;
    public abstract function update(Entity $a) ;
        
    public abstract function delete(int $id) ;
}
