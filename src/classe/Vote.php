<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Vote
 *
 * @author jordy
 */
require_once 'Database.php';

class Vote
{

    private $id_user;
    private $id_article;
    private $type_vote;

    public function __construct(array $params)
    {
        foreach ($params as $key => $value)
        {
            $this->$key = $value;
        }
    }

    public function setId_user(int $another)
    {
        $this->id_user = $another;
        return $this;
    }

    public function getId_article()
    {
        return $this->id_article;
    }

    public function getId_user()
    {
        return $this->id_user;
    }

    private function verifyVote()
    {
        /* Vérification du vote */
        $action = Database::getInstance()->getPDO()->prepare("SELECT type FROM vote_article WHERE id_user=:id_user AND id_article=:id_article");
        $action->bindValue(":id_user", $this->id_user, PDO::PARAM_INT);
        $action->bindValue(":id_article", $this->id_article, PDO::PARAM_INT);
        $action->execute();
        $result = $action->fetch(PDO::FETCH_NUM);
        $action->closeCursor();
        return $result;
    }

    public function vote()
    {
        /* L'utilisateur n'a pas encore vté */
        if (count($this->verifyVote()) == 0 || !$this->verifyVote())
        {
            $insert = Database::getInstance()->getPDO()->prepare("INSERT INTO vote_article VALUES(:id_user, :id_article, :vote)");
            $insert->bindValue(":id_user", $this->id_user, PDO::PARAM_INT);
            $insert->bindValue(":id_article", $this->id_article, PDO::PARAM_INT);
            $insert->bindValue(":vote", $this->type_vote, PDO::PARAM_BOOL);
            $insert->execute();
            $insert->closeCursor();
        }
        /* l'utlisisateur à déja voter */
        else
        {
            /* Même type de vote */
            if ($this->type_vote == $this->verifyVote()[0])
            {
                $delete = Database::getInstance()->getPDO()->prepare("DELETE FROM vote_article WHERE id_user=:id_user AND id_article=:id_article");
                $delete->bindValue(":id_user", $this->id_user, PDO::PARAM_INT);
                $delete->bindValue(":id_article", $this->id_article, PDO::PARAM_INT);
                $delete->execute();
                $delete->closeCursor();
            }
            /* Sinon une mise à jour */
            else
            {
                $this->type_vote = !$this->type_vote;
                $update = Database::getInstance()->getPDO()->prepare("UPDATE vote_article SET type=:type WHERE id_user=:id_user AND id_article=:id_article");
                $update->bindValue(":id_user", $this->id_user, PDO::PARAM_INT);
                $update->bindValue(":id_article", $this->id_article, PDO::PARAM_INT);
                $update->bindValue(":type", $this->type_vote, PDO::PARAM_BOOL);
                $update->execute();
                $update->closeCursor();
            }
        }
    }

}
