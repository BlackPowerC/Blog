<?php

require_once 'Entity.php';

class User
{
    private $id_type ;
    private $pseudo;
    private $passe;
    private $age;
    private $sexe;
    private $pays;

    public function __construct()
    {
    }

    public function getId_type()
    {
        return $this->id_type;
    }

    public function setId_type($id_type)
    {
        $this->id_type = $id_type;
    }

    public function getPseudo()
    {
        return $this->pseudo;
    }

    public function setPseudo($pseudo)
    {
        $this->pseudo = $pseudo;
    }

    public function getPasse()
    {
        return $this->passe;
    }

    public function setPasse($passe)
    {
        $this->passe = $passe;
    }

    public function getAge()
    {
        return $this->age;
    }

    public function setAge($age)
    {
        $this->age = $age;
    }

    public function getSexe()
    {
        return $this->sexe;
    }

    public function setSexe($sexe)
    {
        $this->sexe = $sexe;
    }

    public function getPays()
    {
        return $this->pays;
    }

    public function setPays($pays)
    {
        $this->pays = $pays;
    }
}
