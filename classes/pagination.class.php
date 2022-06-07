<?php

class Pagination
{
    public $nbpages;
    public $nblignespages;
    public $nbrecords;
    public $page;
    public $firstline;
    public $lastline;


    /**
     * Constructeur
     * @param int $page
     */
    public function __construct(int $page)
    {
        $this->page = $page;
    }


    /**
     * Retourne le numéro de la page actuelle
     * @return int
     */
    public function getPage() : int 
    {
        return $this->page;
    }
    

    /**
     * Retourne le nombre total de pages 
     * @return int
     */
    public function getNbPages() : int
    {
        return $this->nbpages;
    }


    /**
     * Retourne le nombre total de lignes
     * @return int
     */
    public function getRecords() : int
    {
        return $this->nbrecords;
    }


    /**
     * Retourne le nombre de lignes par page
     * @param int $nblignespages
     * 
     * @return int
     */
    public function getNbLignesPages(int $nblignespages) : int
    {
        return $this->nblignespages;
    }


    /**
     * Initialise le nombre total de lignes
     * @param int $nbrecords
     * 
     * @return [type]
     */
    public function setRecords(int $nbrecords)
    {
        $this->nbrecords = $nbrecords;
    }


    /**
     * Initialise le nombre de lignes par page
     * @param int $nblignespages
     * 
     * @return [type]
     */
    public function setNbLignesPages(int $nblignespages)
    {
        $this->nblignespages = $nblignespages;
    }


    /**
     * Initialise le nombre de pages
     * en fonction du nombre d'enregistrement
     * et du nombre de lignes par page
     * @param int $nblignespages
     * @param int $nbrecords
     * 
     * @return [type]
     */
    public function setNbPages(int $nblignespages, int $nbrecords)
    {
        $this->nbpages = ceil($nbrecords / $nblignespages);
    }


    /**
     * Retourne la page suivante
     * @return Pagination
     */
    public function nextPage() : Pagination
    {
        $page = $this->page + 1;

        $nbpages = $this->nbpages;

        if ($page > $nbpages) {
            $page = $nbpages;
        }

        $next_page = new Pagination($page);
        
        return $next_page;    
    }


    /**
     * Retourne la page précédente
     * @return Pagination
     */
    public function previousPage() : Pagination
    {
        $page = $this->page - 1;

        if ($page < 1) {
            $page = 1;
        }

        $next_page = new Pagination($page);
        
        return $next_page; 
    }


    /**
     * Retourne la premiere ligne d'une page
     * @return int
     */
    public function firstLine() : int
    {
        $firstLine = ($this->page - 1) * $this->nblignespages;
        
        return $firstLine;
    }


    /**
     * Retourne la dernière ligne d'une page
     * @return int
     */
    public function lastLine() : int
    {
        $lastLine = ($this->page * $this->nblignespages) - 1;

        if ($lastLine >= $this->nbrecords) {
            $lastLine = $lastLine - ($lastLine - $this->nbrecords) - 1;
        }

        return $lastLine;
    }
}