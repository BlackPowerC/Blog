<?php

require_once 'Entity.php';

class Comment extends Entity
{
    private $id_user;
    private $id_article ;
    private $date;
    private $text;

    public function __construct()
    {
    }

    function getId_article()
    {
        return $this->id_article;
    }

    function setId_article($id_article)
    {
        $this->id_article = $id_article;
        return $this;
    }

    public function getId_user()
    {
        return $this->id_user;
    }

    public function setId_user($id_user)
    {
        $this->id_user = $id_user;
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
