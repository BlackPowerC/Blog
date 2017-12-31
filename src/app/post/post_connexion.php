<?php

session_start();
require_once '../core/Autoloader.php';
Autoloader::getInstance()->load_manager('userManager') ;
Autoloader::getInstance()->load_helper('session_helper') ;

if (isset($_GET['action']))
{
    switch (strip_tags($_GET['action']))
    {
        case "login":
            if (isset($_POST['pseudo']) AND isset($_POST['email']))
            {
                $user = new User();
                $user->setEmail(strip_tags($_POST['email']));
                $user->setPseudo(strip_tags($_POST['pseudo']));
//                if(preg_match("[A-Za-z0-9]{6, 20}", $_POST['pseudo']) ===1
//                        && preg_match("^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9]+\.[a-zA-Z0-9-.]+$", $_POST['email'])===1)
//                {
                    $result = UserManager::getInstance()->get($user) ;
                    if(is_null($result))
                    {
                        /* redirection vers la page d'inscription */
                        header('Location: inscription?msg=bad_action');
                        exit();
                    }
                    /* L'utilisateur existe, on lui crée une session */
                    set_session_data([
                        "id"=>$result->getId(),
                        "email"=>$user->getEmail(),
                        "pseudo"=>$user->getPseudo()
                            ]);
                    $_SESSION["time"]=time();
//                }
            }
            break;
        case "logout":
            unset_session_data();
            session_end();
            break;
        case "update":
            if (isset($_POST['pseudo']) AND isset($_POST['email']))
            {
                $user = new User();
                $user->setEmail(strip_tags($_POST['email']))->setId($_SESSION["id"]);
                $user->setPseudo(strip_tags($_POST['pseudo']));
                UserManager::getInstance()->update($user) ;
                set_session_data([
                        "id"=>$_SESSION["id"],
                        "email"=>$user->getEmail(),
                        "pseudo"=>$user->getPseudo()
                            ]);
            }
            break;
    }
}
header('Location: http://' . $_SERVER["SERVER_NAME"] . '/' . strip_tags($_GET['uri']));
exit();
