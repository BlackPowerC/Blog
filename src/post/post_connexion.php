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
                $i = 0;
                $pseudo = strip_tags($_POST['pseudo']);
                $passe = strip_tags($_POST['passe']);
                $requete = Database::getInstance()->prepare("SELECT * FROM user WHERE pseudo = :user_pseudo AND passe = :user_passe");
                $requete->execute(array("user_passe" => $passe, "user_pseudo" => $pseudo));
                $reponse = $requete->fetch(PDO::FETCH_ASSOC);
                $requete->closeCursor();
                foreach ($reponse as $value)
                {
                    $i++;
                    if ($i)
                    {
                        break;
                    }
                }
                if ($i == 0)
                {
                    /* La base de données de contient aucune données correspondante */
                    /* Redirection vers une page d'inscription */
                    //	echo "pas de bol<br/>" ;
                    header("Location: ../frontend/inscription.php?msg=bad_action");
                    exit();
                } else if ($i == 1)
                {
                    $_SESSION['passe'] = $passe;
                    $_SESSION['pseudo'] = $pseudo;
                    $_SESSION['id'] = (integer) $reponse['id'];
                    $_SESSION['pays'] = $reponse['pays'];
                    $_SESSION['age'] = (integer) $reponse['age'];
                    $_SESSION['sexe'] = $reponse['sexe'];
                    $_SESSION['id_type'] = (integer) $reponse['id_type'];
                    $_SESSION['token'] = sha1($passe . $pseudo);
                    $_SESSION['time'] = time() ;
                    if (isset($_POST['remind']))
                    {
                        $_SESSION['persist'] = ( (isset($_POST['remind']) AND strcmp($_POST['remind'], 'on') == 0 ) ) ? true : false;
                    }
                    header('Location: http://' . $_SERVER["SERVER_NAME"] . strip_tags($_GET['uri']));
                    exit();
                }
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
