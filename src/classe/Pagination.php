<?php

require_once 'Database.php';

class Pagination
{
    private $nItem;
    private $nPage;
    private $perPage;
    private $contentArray;
    private $currentPage ;

    private function initPager(string $table, string $column, string $where="")
    {
        $requete = Database::getInstance()->getInstance()->getPDO()->query('select COUNT(' . $column . ') AS nItem FROM ' . $table.' '.$where);
        $reponse = $requete->fetch(PDO::FETCH_ASSOC);
        $this->nItem = (integer) $reponse['nItem'];
        $this->nPage = (integer) ceil($this->nItem / $this->perPage);
        $requete->closeCursor() ;
    }

    public function initContent($currentPage, $sqlStatement)
    {
        $this->currentPage = $currentPage ;
        if ($currentPage >= 1 AND $currentPage <= $this->nPage)
        {
            $requete = Database::getInstance()->getInstance()->getPDO()->query($sqlStatement . ' LIMIT ' . ($currentPage - 1) * $this->perPage . ', ' . $this->perPage);
            $this->contentArray = $requete->fetchAll(PDO::FETCH_ASSOC);
            $requete->closeCursor();
            return $this->contentArray;
        }
        return null;
    }

    public function getPagination($uri)
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

    public function __construct(int $perPage, string $table, string $column, string $where="")
    {
        $this->perPage = $perPage;
        $this->initPager($table, $column, $where);
    }
    
    public function getNItem(): int
    {
        return $this->nItem ;
    }
}
