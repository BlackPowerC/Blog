<?php

class Database
{
    private $pdo;
    private $host;
    private $user;
    private $sgbd;
    private $passwd;
    private $database;
    private static $p_singleton;

    private function __construct($user = "jordy", $passwd = "jordy", $database = "Blog", $host = "localhost", $sgbd = "mysql")
    {
        $dsn = $sgbd . ':host=' . $host . ';dbname=' . $database;
        try
        {
            $this->pdo = new PDO($dsn, $user, $passwd);
        } catch (Exception $e)
        {
            die('Erreur lors de la connexion à la base de données' . $e->getMessage());
        }
    }

    public function updateQuery($preparedQuery, $array)
    {
        $requete = $this->pdo->prepare($preparedQuery);
        $requete->execute($array);
        $requete->closeCursor();
    }

    public function selectQuery($preparedStatement, $array)
    {
        
    }

    public function getPDO()
    {
        return $this->pdo;
    }

    public static function getInstance($user = "jordy", $passwd = "jordy", $database = "Blog", $host = "localhost", $sgbd = "mysql")
    {
        if (is_null(self::$p_singleton))
        {
            self::$p_singleton = new Database();
        }
        return self::$p_singleton;
    }
    
    public function prepare(string $sqlstatement)
    {
        return $this->pdo->prepare($sqlstatement) ;
    }
    
}
