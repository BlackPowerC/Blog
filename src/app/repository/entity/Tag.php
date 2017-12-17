<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Tag
 *
 * @author jordy
 */
class Tag
{
    protected $id_article ;
    protected $tag  ;
    
    public function __construct()
    {
    }
    
    function getId_article()
    {
        return $this->id_article;
    }

    function getTag()
    {
        return $this->tag;
    }

    function setId_article($id_article)
    {
        $this->id_article = $id_article;
    }

    function setTag($tag)
    {
        $this->tag = $tag;
        return $this;
    }
}
