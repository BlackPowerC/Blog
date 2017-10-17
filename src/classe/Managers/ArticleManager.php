<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ArticleManager
 *
 * @author jordy
 * @field array $articles un tableau d'objet de la classe Article
 * @brief La classe ArticleManager sert à la gestion (Ajout, modification, suppression et select) d'entités Articles
 *          Cette classe est la voie royale pour manipuler les entités Articles
 */
require_once '../Article.php' ;
require_once '../Database.php' ;
require_once '../Manager.php' ;

class ArticleManager extends Manager
{
    private static $p_singleton;

    private function __construct()
    {
        parent::__construct();
    }

    public function select(string $select_query, array $param)
    {
        $select_match = substr($select_query, 0, 6);
        if (strcasecmp($select_match, "select") != 0)
        {
            return null;
        }
        $prepared_statement = $this->pdo->pepare($select_query);
        $prepared_statement->execute($param);
        $response = $prepared_statement->fetchAll();
        $prepared_statement->closeCursor();
        return $response;
    }

    public static function getInstance()
    {
        if (self::$p_singleton == null)
        {
            self::$p_singleton = new ArticleManager;
        }
        return self::$p_singleton;
    }

    public function insert(Article $article)
    {
        $sql_query = "INSERT INTO article VALUES(NULL, :titre, :date, :text)";
        $prepare_statement = $this->pdo->prepare($sql_query);
        $prepare_statement->execute(
                array("titre" => $article->getTitre_article(),
                    "date" => $article->getDate_article(),
                    "text" => $article->getText_article())
        );
        $prepare_statement->closeCursor();
    }

    public function update(Article $article)
    {
        $sql_query = "UPDATE article SET date_article=:date titre_article=:titre, text_article=:text WHERE id=:id";
        $prepare_statement = $this->pdo->prepare($sql_query);
        $prepare_statement->execute(
                array("titre" => $article->getTitre_article(),
                    "id" => $article->getId(),
                    "text" => $article->getText_article(),
                    "date" => 'Modifié le ' . $article->getDate_article(),)
        );
        $prepare_statement->closeCursor();
    }

    public function delete(Article $article)
    {
        $sql_query = "DELETE FROM article WHERE id=:id";
        $prepare_statement = $this->pdo->prepare($sql_query);
        $prepare_statement->execute(array("id" => $article->getId()));
        $prepare_statement->closeCursor();
    }
}
