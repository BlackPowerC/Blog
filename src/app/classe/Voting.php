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
Autoloader::getInstance()->load_class("database") ;

class Voting
{
    private static $p_singleton;

    protected function __construct()
    {

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
        $tmp = VoteManager::getInstance()->get($v) ;
        if(is_null($tmp))
        {
            return NULL ;
        }
        return $tmp;
    }

    public function vote(Vote $v)
    {
        /* L'utilisateur n'a pas encore voté */
        if(is_null($this->verifyVote($v)))
        {
            VoteManager::getInstance()->insert($v) ;
        }
        /* L'utilisateur à déja voté */
        else
        {
            $ps = Database::getInstance()->prepare("DELETE FROM Vote WHERE id_article=:id AND id_user=:id_user") ;
            $ps->execute(["id"=>$v->getId(), "id_user"=>$v->getId_user()]) ;
            $ps->closeCursor() ;
        }
    }
    
    public static function getVoteResults(int $id_article): array
    {
        $vote_array = VoteManager::getInstance()->findById($id_article) ;
        $vote_result = [
            "count"=>["like"=>0, "dislike"=>0],
            "percent"=>["like"=>0, "dislike"=>0]
        ];
        $total = 0 ;
        if(count($vote_array) == 0)
        {
            return $vote_result;
        }
        foreach ($vote_array as $value)
        {
            if($value["type"] === 1)
            {
                $vote_result["count"]["like"]++ ;
            }
            else
            {
                $vote_result["count"]["dislike"]++ ;
            }
            $total++ ;
        }
        $vote_result["percent"]["like"] = ($total > 0)? 100*ceil($vote_result["count"]["like"]/$total):0 ;
        $vote_result["percent"]["dislike"] = ($total > 0)? 100*ceil($vote_result["count"]["dislike"]/$total):0 ;
        return $vote_result;
    }
}
