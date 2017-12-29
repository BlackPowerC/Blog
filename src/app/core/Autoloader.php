<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'config.php';
/**
 * Autoloader pour charger automatiquement des classes ou des fichiers.
 *
 * @author jordy
 */
class Autoloader
{
    /**
     * Variable static pour implémenter le pattern Singleton.
     * @var Autoloader 
     */
    private static $p_singleton ;
    /**
     * Construteur de la classe.
     * Elle autoload les fichiers dont les noms sont dans les tableaux de config.php.
     */
    private function __construct()
    {
        foreach ($helper as $hlp) {
            if(file_exists(HELPER.$hlp.'php')) {
                require_once HELPER.$hlp.'php';
            }
        }
        
        foreach($entity as $hlp) {
            if(file_exists(ENTITY.ucfirst($hlp).'php')) {
                require_once ENTITY.ucfirst($hlp).'php';
            }
        }
        
        foreach ($class as $hlp) {
            if(file_exists(CLASSE.ucfirst($hlp).'php')) {
                require_once CLASSE.ucfirst($hlp).'php';
            }
        }
        
        foreach($manager as $hlp) {
            if(file_exists(MANAGER.ucfirst($hlp).'php')) {
                require_once MANAGER.ucfirst($hlp).'php';
            }
        }
    }
    
    /**
     * Permet d'accéder à l'unique instance de la classe.
     * @return \Autoloader Renvoie l'unique instance de la classe.
     */
    public static function getInstance(): Autoloader
    {
        if(is_null(self::$p_singleton))
        {
            self::$p_singleton = new Autoloader();
        }
        return self::$p_singleton;
    }

    public static function load_helper(string $class)
    {
        if(file_exists(HELPER.$class.'php')) {
            require_once HELPER.$class.'php';
        }   
    }
    
    public static function load_class(string $class)
    {
        if(file_exists(CLASSE.ucfirst($class).'php')) {
            require_once CLASSE.ucfirst($class).'php';
        } 
    }
    
    public static function load_entity(string $class)
    {
        if(file_exists(ENTITY.ucfirst($class).'php')) {
            require_once ENTITY.ucfirst($class).'php';
        }
    }
    
    public static function load_manager(string $class)
    {
        if(file_exists(MANAGER.ucfirst($class).'php')) {
            require_once MANAGER.ucfirst($class).'php';
        }
    }
    
    public static function register()
    {
        spl_autoload(["__CLASS__", "load_helper"]) ;
        spl_autoload(["__CLASS__", "load_class"]) ;
        spl_autoload(["__CLASS__", "load_entity"]) ;
        spl_autoload(["__CLASS__", "load_manager"]) ;
    }
}
