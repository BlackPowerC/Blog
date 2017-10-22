<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Form
 *
 * @author jordy
 */
class Form
{
    private $data ;
    private $surround ;
    private $keys ;
    private $i ;
    private $l ;
    
    public function __construct($data = array())
    {
        $this->data = $data ;
        $this->surround = 'p' ;
        $this->keys = array_keys($data) ;
        $this->i = 0 ;
        $this->l = count($data) ;
    }
    
    private function surround($html)
    {
        echo "<div class=\"form-group\">{$html}</div" ;
    }
    
    public function input(array $param = ["type"=>"text", "placeholder"=>"", "required"=>"", "hidden"=>""], string $css)
    {
        $css = strtolower($css) ;
        $html = "" ;
        if($this->i < $this->l)
        {
            $html .= '<label for="'.$this->keys[$this->i].'"></label>' ;
            $html .='<input class="'.$css.'" type="'.$param["type"].'" name="'.$this->keys[$this->i].'" value="'.$this->data[$this->keys[$this->i]].'" placeholder="'.$param['placeholder'].'" />';
            $this->i++ ;
            $this->surround($html) ;
        }
    }
}
