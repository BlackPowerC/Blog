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
require_once '../Entity.php';

abstract class Manager
{
    public function insert(Entity $a) ;
    
    public function findAll() ;
    
    public function findById(int $id) ;
    
    public function findByCriteria(string $criteria) ;

    public function update(Entity $a) ;
        
    public function delete(int $id) ;
}
