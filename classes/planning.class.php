<?php

class Month 
{
    public $days    = ['Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam', 'Dim'];
    private $months = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];
    public $month;
    public $year; 


    /**
     * Constructeur
     * 
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
     * 
     * @param int
     * @return string
     */
    public function toString() : string
    {
        $month_alpha = $this->months[$this->month - 1]." ".$this->year;
        
        return $month_alpha;
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

        $Mondayeaster = date('Y-m-d', strtotime($easter . "+2days")); //1
        $ascencion = date('Y-m-d', strtotime($easter . "+39days")); //39
        $pentecote = date('Y-m-d', strtotime($easter . "+50days")); //50
    
        $tabJourFerie = ["$year-01-01", $Mondayeaster, "$year-05-01", "$year-05-08", $ascencion, $pentecote, "$year-07-14", "$year-08-15", "$year-11-01", "$year-11-11", "$year-12-25"];

        if (in_array($date, $tabJourFerie)) {
            $ferie = true;
        }

        return $ferie;
    }


    /**
     * Renvoie un booleen si la date en paramètre
     * est un jour de week end
     * 
     * @param string $date
     * 
     * @return bool
     */
    public function weekEnd(string $date) : bool
    {
        $we = false;

        $jour = date('l', strtotime($date));

        if (($jour == "Saturday") || ($jour == "Sunday")) {
            $we = true;
        }

        return $we;
    }

    /**
     * Retourne le motif d'absence
     * si la date en paramètre 
     * correspond à un jour d'absence du salarié
     * 
     * @param string $date
     * @param mixed $conges
     * 
     * @return string
     */
    public function conges(string $date, array $conges) : string
    {
        $enconges = "";

        foreach($conges as $conge) {
            for($j = 0; $j <= count($conge['periode']); $j++) {

                if(isset($conge['periode'][$j])) {
                    if($conge['periode'][$j] == $date) {
                        $enconges = ucfirst(substr($conge['motif'],0,1));
                    }
                }
            }
        }
        return $enconges;
    }


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
     * Retourne le mois suivant
     * 
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
     * 
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