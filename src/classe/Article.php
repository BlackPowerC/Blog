<?php

require_once 'Entity.php';
require_once 'Tag.php';

class Article extends Entity
{
    private $id_user ;
    private $titre;
    private $date;
    private $text;

    public function __construct(array $_array)
    {
        foreach ($_array as $key => $value)
        {
            $this->$key = $value;
        }
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId_user()
    {
        return $this->id_user;
    }

    public function setId_user($id_user)
    {
        $this->id_user = $id_user;
    }

    public function getTitre()
    {
        return $this->titre;
    }

    public function setTitre($titre)
    {
        $this->titre = $titre;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function setDate($date)
    {
        $this->date = $date;
    }

    public function getText()
    {
        return $this->text;
    }

    public function setText($text)
    {
        $this->text = $text;
    }
    
    public function toHTML()
    {
        $HTMLView = array(
            "titre" => '<h2 class="title_article">' . $this->titre . '</h2>',
            "date" => '<span class="date_article"><i class="fa fa-calendar"></i> ' . $this->date . '</span><br>',
            "text" => $this->text
        );
        return $HTMLView;
    }

}
