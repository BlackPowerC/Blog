<?php

session_start();

function c_striptags(array $array)
{
    foreach ($array as $key => $value)
    {
        $value = strip_tags($value);
    }
}

if (isset($_POST['passe']) AND isset($_POST['pseudo']) AND isset($_POST['sexe']))
{
    require_once '../classe/User.php';
    require_once '../classe/Database.php';

    c_striptags($_POST);
    $user = new User($_POST);
    $sql_statement = "INSERT INTO user VALUES(NULL, 1, :pseudo, :passe, :age, :sexe, :pays)";
    $param = array("pseudo" => $user->getPseudo(), "passe" => $user->getPasse(), "sexe" => $user->getSexe()
        , "age" => $user->getAge(), "pays" => $user->getPays());
    $request = Database::getInstance()->getPDO()->prepare($sql_statement);
    $request->execute($param);
    $request->closeCursor();

    /* Redirection vers la page de connexion */
    header("Location: ../frontend/connexion.php") ;
    exit() ;
}
else
{
    header("Location: ../frontend/inscription.php");
    exit() ;
}
