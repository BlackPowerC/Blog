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
Autoloader::getInstance()->load_entity("entity") ;

class Tag extends Entity
{
    protected $tag  ;
    
    public function __construct()
    {
    }
    
    function getId_article()
    {
        return $this->id;
    }

    function getTag()
    {
        return $this->tag;
    }

    function setId_article($id_article)
    {
        $this->id = $id_article;
        return $this;
    }

    function setTag($tag)
    {
        $this->tag = $tag;
        return $this;
    }
}
