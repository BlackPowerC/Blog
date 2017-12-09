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
 * Vote permet de faire des votes positifs ou négatifs et d'avoir les résultats de vote pour un article
 * @field $id_user Identifiant du votant
 * @field $id_article Identifiant de l'article à voter
 * @field $type_vote Le type de vote (like ou dislike)
 */
require_once 'Database.php';

class Vote
{

    private $id_user;
    private $id_article;
    private $type_vote;
    
    /**
     * 
     * @param array $params constructeur de la classe avec $params contenant des clés qui sont les champs de la classe
     */
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
    
    /**
     * Permet de récupérer pour un article les résultats des votes
     * @param int $id_article Identifiant de l'article dont on veut connaitre les résultats des votes
     * @return array Un tableau à deux clés
     * <p>
     *  clé count, qui est le tableaa contenant le nombre de type de vote
     *  <ol>
     *      <li>like: le nombre de vote positif</li>
     *      <li>dislike: le nombre de vote négatif</li>
     *  </ol>
     *  clé percent, qui est le tableau contenant les pourcentage de type de vote
     *  <ol>
     *      <li>likePercent: pourcentage de vote positif</li>
     *      <li>dislikePercent: pourcentage de vote négatif</li>
     *  </ol>
     * </p>
     */
    public static function getVoteResults(int $id_article): array
    {
        $pdo = Database::getInstance()->getPDO() ;
        $select = $pdo->prepare("SELECT type FROM vote_article WHERE id_article=?") ;
        $select->execute([$id_article]);
        $results = $select->fetchAll(PDO::FETCH_NUM) ;
        $select->closeCursor();
        $votes = array("percent"=>array("likePercent"=>0, "dislikePercent"=>0), "count"=>array("like"=>0, "dislike"=>0)) ;
        if(!$results)
        {
            return $votes ;
        }
        foreach ($results as $value)
        {
            if($value)
            {
                $votes["count"]["like"]++;
            }
            else
            {
                $votes["count"]["dislike"]++;
            }
        }
        return array("percent"=>array("likePercent"=>100*ceil($votes["count"]["like"]/($votes["count"]["like"]+$votes["count"]["dislike"])), 
                                      "dislikePercent"=>100*ceil($votes["count"]["dislike"]/($votes["count"]["like"]+$votes["count"]["dislike"]))), 
                     "count"=>array("like"=>$votes["count"]['like'], 
                                    "dislike"=>$votes["count"]["dislike"]));
    }
}
