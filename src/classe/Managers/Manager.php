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

require_once '../Database.php';

abstract class Manager
{
    protected $pdo ;
    
    public function __construct()
    {
        $this->pdo = Database::getInstance()->getPDO() ;
    }

    public function findAll() ;
    
    public function findById(int $id) ;
    
    public function findByCriteria(string $criteria) ;

    public function update(Article $a) ;
        
    public function delete(int $id) ;
}
