<?php

require_once 'Database.php';

/**
 * @class Pagination
 * @brief Classe permettant de faire de la pagination sur les pages HTML
 * 
 * @attribute nItem: Le nombre total de d'article
 * @attribute nPage: Le nombre de page obtenu en faisant nItem/perPage
 * @attribute perPage: Le nombre d'article par page 
 *
 */

class Pagination
{
    private $nItem;
    private $nPage;
    private $perPage;
    private $contentArray;
    private $currentPage ;
    
    /**
     * Initialiser la pagination avec un nombre total de page et un nombre d'article
     * @param string $countRequest
     * Requête SQL pour compter le nombre de ligne d'une colonne d'une table
     */
    public function initPager(string $countRequest)
    {
        /* 'select COUNT(' . $column . ') AS nItem FROM ' . $table.' '.$where */
        $requete = Database::getInstance()->getInstance()->getPDO()->query($countRequest);
        $reponse = $requete->fetchAll(PDO::FETCH_NUM);
        $this->nItem = (integer) $reponse[0];
        var_dump($this->nItem) ;
        $this->nPage = (integer) ceil($this->nItem / $this->perPage);
        $requete->closeCursor() ;
    }
    
    /* Getters and Setter */
    // nItem
    /**
     * Renvoie le nombre total d'articles
     * @return int
     */
    public function getNItem(): int
    {
        return $this->nItem;
    }
    public function setNItem(int $i)
    {
        $this->nItem = $i ;
        return $this;
    }
    
    // nPage
    /**
     * Renvoie le nombre total de pages
     * @return int
     */
    public function getNPage(): int
    {
        return $this->nPage ;
    }
    public function setNPage(int $i)
    {
        $this->nPage = $i ;
        return $this ;
    }
    
    // perPage
    /**
     * Renvoie le nombre d'article par pages
     * @return int
     */
    public function getPerPage(): int
    {
        return $this->perPage ;
    }
    public function setPerPage(int $i)
    {
        $this->perPage = $i ;
        return $this ;
    }


    /**
     * Initialiser le contenu de pagination
     * 
     * @param int $currentPage le numero de la page courante
     * @param string $selectQuery Requête SQL de type Select pour récupérer un certain nombre d'article
     * @return array tableau contenant les articles ou null
     */
    public function initContent($currentPage, $selectQuery): array
    {
        $this->currentPage = $currentPage ;
        if ($currentPage >= 1 AND $currentPage <= $this->nPage)
        {
            $requete = Database::getInstance()->getInstance()->getPDO()->query($selectQuery . ' LIMIT ' . ($currentPage - 1) * $this->perPage . ', ' . $this->perPage);
            $this->contentArray = $requete->fetchAll(PDO::FETCH_ASSOC);
            $requete->closeCursor();
            return $this->contentArray;
        }
        return array();
    }
    
    /**
     * Ecrit du code HTML pour afficher la pagination sous forme de lien numeroté
     * @param string $uri l'URL de la page courante
     */
    public function getPagination(string $uri)
    {
        echo '<ul class="pagination">';
        for ($i = 1; $i <= $this->nPage; $i++)
        {
            if($i == $this->currentPage)
            {
                echo '<li><a>' . $i . '</a></li>';
            }
            else
            {
                echo '<li><a href="' . $uri  . $i . '">' . $i . '</a></li>';
            }
        }
        echo '</ul>';
    }
    
    /**
     * Constructeur de la classe
     * @param int $perPage Le nombre d'article par page
     */
    public function __construct(int $perPage)
    {
        $this->perPage = $perPage;
    }
    
    
}
