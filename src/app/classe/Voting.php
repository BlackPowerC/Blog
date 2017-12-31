<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Le role de cette classe est permettre l'action d'effectuer un Vote.
 *
 * @author jordy
 */

require_once '../core/Autoloader.php';
Autoloader::getInstance()->load_manager("voteManager") ;
Autoloader::getInstance()->load_entity("vote") ;

class Voting
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
            self::$p_singleton = new Voting();
        }
        return self::$p_singleton;
    }
    
    private function verifyVote(Vote $v)
    {
        
    }

    public function vote(Vote $v)
    {
        
    }
    
    public static function getVoteResults(int $id_article): array
    {
        
    }
}
