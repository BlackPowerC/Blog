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
 * Vote permet de faire des votes positifs ou négatifs et d'avoir les résultats de vote pour un article
 * @field $id_user Identifiant du votant
 * @field $id_article Identifiant de l'article à voter
 * @field $type_vote Le type de vote (like ou dislike)
 */
require_once 'Entity.php';

class Vote extends Entity
{
    private $id_user;
    private $type_vote;
    
    public function __construct() {}

    public function setId_user(int $another)
    {
        $this->id_user = $another;
        return $this;
    }

    public function getId_user()
    {
        return $this->id_user;
    }
    
    public function getType()
    {
        return $this->type_vote;
    }

    public function setType(int $type)
    {
        $this->type_vote= $type;
        return $this;
    }
}
