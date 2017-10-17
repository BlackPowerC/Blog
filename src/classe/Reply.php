<?php

require_once 'Entity.php';

class Reply extends Entity
{
    private $id_user;
    private $id_comment ;
    private $date;
    private $text;

    public function __construct(array $_array)
    {
        foreach ($_array as $key => $value)
        {
            $this->$key = $value ;
        }
    }

    public function toHTML()
    {
        // le nom de l'auteur dans un span
        // le texte dans un div
        // le date dans unuser span
        $HTMLView = array(
            'date' => '<span class="date_comment"><i class="fa fa-calendar"></i> ' . $this->date_comment . '</span>',
            'text' => '<div class="text_comment">' . $this->text_comment . '</div>'
                );
        return $HTMLView;
    }

    function getId_comment()
    {
        return $this->id_comment;
    }

    function setId_comment($id_comment)
    {
        $this->id_comment = $id_comment;
    }

    public function getId_user()
    {
        return $this->id_user;
    }

    public function setId_user($id_user)
    {
        $this->id_user = $id_user;
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
    }
}
