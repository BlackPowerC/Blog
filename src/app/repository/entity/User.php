<?php

require_once 'Entity.php';

class User extends Entity
{
    private $pseudo ;
    private $email ;

    public function __construct()
    {
    }

    public function getPseudo()
    {
        return $this->pseudo;
    }

    public function setPseudo($pseudo)
    {
        $this->pseudo = $pseudo;
        return $this;
    }
    
    public function getEmail()
    {
        return $this->pays;
    }

    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }
}
