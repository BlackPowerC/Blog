<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Vote
 *
 * @author jordy
 */
class Vote
{
    private $id_user ;
    private $id_article ;
    private $type_vote ;
    
    public function __construct(array $params)
    {
        foreach($params as $key)
        {
            $this->$key = $params[$key] ;
        }
    }
    
    public function setId_user(int $another)
    {
        $this->id_user = $another ;
        return $this;
    }
    
    public function getId_article()
    {
        return $this->id_article;
    }
    
    public function getId_user()
    {
        return $this->id_user;
    }
}
