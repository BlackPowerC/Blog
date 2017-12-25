<?php

session_start();
require_once '../classe/Database.php';

if (isset($_GET['action']))
{
    switch (strip_tags($_GET['action']))
    {
        case "login":
            if (isset($_POST['pseudo']) AND isset($_POST['passe']))
            {
                
            }
            break;
        case "logout":
            session_destroy();
            header('Location: http://' . $_SERVER["SERVER_NAME"] . '/' . strip_tags($_GET['uri']));
            exit();
            break;
    }
} else
{
    header('Location: http://' . $_SERVER["SERVER_NAME"] . strip_tags($_GET['uri']));
    exit();
}
