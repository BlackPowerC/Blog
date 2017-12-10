<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ArticleManager
 *
 * @author jordy
 * @field array $articles un tableau d'objet de la classe Article
 * @brief La classe ArticleManager sert à la gestion (Ajout, modification, suppression et select) d'entités Articles
 *          Cette classe est la voie royale pour manipuler les entités Articles
 */
require_once '../Article.php' ;
require_once '../Database.php' ;
require_once '../Manager.php' ;

class ArticleManager extends Manager
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

    public function insert(Article $a)
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

    public function update(Article $a)
    {
        
    }
        
    public function delete(int $id)
    {
        
    }
}