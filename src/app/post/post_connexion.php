<?php

session_start();
require_once '../classe/Database.php';
require_once '../helper/session_helper.php';
require_once '../repository/manager/UserManager.php' ;

if (isset($_GET['action']))
{
    switch (strip_tags($_GET['action']))
    {
        case "login":
            if (isset($_POST['pseudo']) AND isset($_POST['email']))
            {
                
            }
            break;
        case "logout":
            session_end();
            header('Location: http://' . $_SERVER["SERVER_NAME"] . '/' . strip_tags($_GET['uri']));
            exit();
            break;
    }
} else
{
    header('Location: http://' . $_SERVER["SERVER_NAME"] . strip_tags($_GET['uri']));
    exit();
}
