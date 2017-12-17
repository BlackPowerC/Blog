<?php

require_once 'Entity.php';
require_once 'Tag.php';
require_once 'Comment.php';

class Article extends Entity
{
    private $user;
    private $titre;
    private $date;
    private $text;

    public function __construct()
    {}

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function setUser($id_user)
    {
        $this->user = $id_user;
        return $this;
    }

    public function getTitre()
    {
        return $this->titre;
    }

    public function setTitre($titre)
    {
        $this->titre = $titre;
        return $this;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function setDate($date)
    {
        $this->date = $date;
        return $this;
    }

    public function getText()
    {
        return $this->text;
    }

    public function setText($text)
    {
        $this->text = $text;
        return $this;
    }
}
