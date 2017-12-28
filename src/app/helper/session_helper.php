<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function session_begin(): bool
{
    return session_start();
}

function session_end(): bool
{
    return session_destroy() ;
}

function set_session_data(array $params): bool
{
    if(!isset($_SESSION))
    {
        return FALSE;
    }
    foreach ($params as $key => $value)
    {
        $_SESSION[$key]=$value;    
    }
    return TRUE;
}

function unset_session_data(array $params): nool
{
    if(!isset($_SESSION))
    {
        return FALSE;
    }
    foreach ($params as $key => $value)
    {
        if(isset($_SESSION[$key]))
        {
            unset($_SESSION[$key]) ;
        }
    }
    return TRUE;
}