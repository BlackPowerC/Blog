<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once 'config.php';
/**
 * Autoloader pour charger automatiquement des classes ou des fichiers.
 *
 * @author jordy
 */
class Autoloader
{
    /**
     * Tableau devant contenir les noms des helpers sans l'extension.
     * @var array 
     */
    private $helper = [] ;
    /**
     * Tableau devant contenir les noms des classes sans l'extension.
     * @var array 
     */
    private $classe = [] ;
    /**
     * Tableau devant contenir les noms des entités sans l'extension.
     * @var array 
     */
    private $entity = [] ;
    /**
     * Tableau devant contenir les noms des manager sans l'extension.
     * @var array 
     */
    private $manager = [] ;
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
        foreach ($this->helper as $hlp) {
            if(file_exists(HELPER.$hlp.'php')) {
                require_once HELPER.$hlp.'php';
            }
        }
        
        foreach($this->entity as $hlp) {
            if(file_exists(ENTITY.ucfirst($hlp).'php')) {
                require_once ENTITY.ucfirst($hlp).'php';
            }
        }
        
        foreach ($this->classe as $hlp) {
            if(file_exists(CLASSE.ucfirst($hlp).'php')) {
                require_once CLASSE.ucfirst($hlp).'php';
            }
        }
        
        foreach($this->manager as $hlp) {
            if(file_exists(MANAGER.ucfirst($hlp).'php')) {
                require_once MANAGER.ucfirst($hlp).'php';
            }
        }
        $this->register();
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

    public function load_helper(string $class)
    {
        if(file_exists(HELPER.$class.'.php')) {
            require_once HELPER.$class.'.php';
        }   
    }
    
    public function load_class(string $class)
    {
        if(file_exists(CLASSE.ucfirst($class).'.php')) {
            require_once CLASSE.ucfirst($class).'.php';
        } 
    }
    
    public function load_entity(string $class)
    {
        if(file_exists(ENTITY.ucfirst($class).'.php')) {
            require_once ENTITY.ucfirst($class).'.php';
        }
    }
    
    public function load_manager(string $class)
    {
        if(file_exists(MANAGER.ucfirst($class).'.php')) {
            require_once MANAGER.ucfirst($class).'.php';
        }
    }
    
    private function register()
    {
        spl_autoload_register([__CLASS__, "load_helper"]) ;
        spl_autoload_register([__CLASS__, "load_class"]) ;
        spl_autoload_register([__CLASS__, "load_entity"]) ;
        spl_autoload_register([__CLASS__, "load_manager"]) ;
    }
}
