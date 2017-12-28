<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function form($action="", $method=""):string
{
    return '<form method="'.$method.'" action="'.$action.'"/>' ;
}

function form_input(array $params = []): string
{
    if(count($params) == 0)
    {
        return '<input type="text" name="text"/>';
    }
    $form = '<input ';
    foreach ($params as $key => $value)
    {
        $form.$key.'="'.$value.'" ' ;
    }
    $form.'/>' ;
    return $form;
}

function form_label(string $name, string $for=""): string
{
    return '<label for="'.$for.'">'.$name.'</label>';
}