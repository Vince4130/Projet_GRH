<?php

class Month 
{
    public $days    = ['Lu', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam', 'Dim'];
    private $months = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];
    public $month;
    public $year; 


    /**
     * Constructeur
     * @param int $month
     * @param int $year
     */
    public function __construct(?int $month = null, ?int $year = null)
    {

        if ($month === null) {
            $month = intval(date('m'));
        }

        if ($year === null) {
            $year = intval(date('Y'));
        }
        
        if ($month < 1 OR $month > 12) {
            throw new Exception("Le mois $month n'est pas valide");
        }
        if ($year < 1970) {
            throw new Exception("L'année est inférieure à 1970");
        }
        $this->month = $month;
        $this->year  = $year;
    }


    /**
     * Retourne le mois en lettres
     * @param int
     * @return string
     */
    public function toString() : string
    {
        $month_alpha = $this->months[$this->month - 1]." ".$this->year;
        
        return $month_alpha;
    }


    /**
     * Retourne le premier jour du mois
     * @return DateTime
     */
    public function getFirstDay() : DateTime
    {
        $first_day = new DateTime("{$this->year}-{$this->month}-01");
        
        return $first_day;
    }


    /**
     * Retourne le nombre de semaines dans un mois
     * @return int
     */
    public function getWeeks() :int
    {
        $start = $this->getFirstDay();
        $end   = (clone $start)->modify('+1 month -1 day');

        $weeks = $end->format('W') - $start->format('W') + 1;
    
        //Pour traiter le mois de janvier 
        //si le 1er jour de janvier est en semaine
        if ($weeks < 0) {
            $weeks = $end->format('W');
        }
         
        return $weeks;

    }


    /**
     * Retourne un booléen si la date en paramètre
     * est un jour férié
     * 
     * @param string $date
     * 
     * @return bool
     */
    public function jourFerie(string $date) : bool 
    {
        $ferie = false;

        $year = date('Y', strtotime($date));

        $easter = date('Y-m-d', easter_date($year));

        $Mondayeaster = date('Y-m-d', strtotime($easter . "+1days")); //1
        $ascencion = date('Y-m-d', strtotime($easter . "+39days")); //39
        $pentecote = date('Y-m-d', strtotime($easter . "+50days")); //50
    
        $tabJourFerie = ["$year-01-01", $Mondayeaster, "$year-05-01", "$year-05-08", $ascencion, $pentecote, "$year-07-14", "$year-08-15", "$year-11-01", "$year-11-11", "$year-12-25"];

        if (in_array($date, $tabJourFerie)) {
            $ferie = true;
        }

        return $ferie;
    }

    public function weekEnd(string $date) : bool
    {
        $we = false;

        $jour = date('l', strtotime($date));

        if (($jour == "Saturday") || ($jour == "Sunday")) {
            $we = true;
        }

        return $we;
    }

    // public function conges(string $date) : bool
    // {
    //     $enconges = false;
    //     return $enconges;
    // }

    /**
     * Retourne le jour en français
     * 
     * @param string $day
     * 
     * @return string
     */
    public function dayFrench(int $numJour) : string
    {
        $jour = $this->days[$numJour - 1];
        
        return $jour;
    }


    /**
     * Permet de savoir si une date est dans le mois en cours
     * 
     * @param DateTime $date
     * 
     * @return bool
     */
    public function withinMonth(DateTime $date) : bool
    {   
        $inMonth = false;

        $start_month = $this->getFirstDay()->format('Y-m');
        $date  = $date->format('Y-m');

        if ($start_month === $date) {
            $inMonth = true;
        }

        return $inMonth;
    }


    /**
     * Retourne le mois suivant
     * @return Month
     */
    public function nextMonth() : Month
    {
        $month = $this->month + 1;
        $year  = $this->year;

        if ($month > 12) {
            $month = 1;
            $year  = $year + 1;
        }

        $next_month = new Month($month, $year);

        return $next_month;
    }


    /**
     * Retourne le mois précédent
     * @return Month
     */
    public function prevMonth() : Month
    {
        $month = $this->month - 1;
        $year  = $this->year;

        if ($month < 1) {
            $month = 12;
            $year  = $year - 1;
        }

        $prev_month = new Month($month, $year);

        return $prev_month;
    }
}