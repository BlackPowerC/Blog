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

    private $method;
    private $action;
    /*     * ************ */
    private $data;
    private $surround;
    private $keys;
    private $i;
    private $l;

    public function __construct($data = array(), string $method = "POST", string $action = "")
    {
        $this->data = $data;
        $this->surround = 'div';
        $this->keys = array_keys($data);
        /*         * ********************************* */
        $this->i = 0;
        $this->l = count($data);
        /*         * ********************************* */
        $this->method = $method;
        $this->action = $action;
    }

    private function surround($html)
    {
        echo "<{$this->surround} class=\"form-group\">{$html}</{$this->surround}>";
    }

    public function input()
    {
        
    }

    public function submit()
    {
        
    }

    public function createView()
    {
        
    }

    function getMethod()
    {
        return $this->method;
    }

    function getAction()
    {
        return $this->action;
    }

    function setMethod($method)
    {
        $this->method = $method;
    }

    function setAction($action)
    {
        $this->action = $action;
    }

}
