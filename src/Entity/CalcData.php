<?php

namespace App\Entity;

use App\Entity\Capitals;

class CalcData  // klasa danych formularza
{
    private $Stolica;       // pole select 
    private $Kwota;         // pole tekstowe
    private $runscript;     // checkbox
    
    public function getStolica()
    {
        return $this->Stolica;
    }

    public function setStolica($stolica)
    {
        $this->Stolica = $stolica;
    }

    public function getKwota()  
    {
        return $this->Kwota;
    }

    public function setKwota($kwota)
    {
        $this->Kwota = $kwota;
    }
    public function getRunScript()
    {
        return $this->runscript;
    }
    public function setRunScript($runscript)
    {
        $this->runscript = $runscript;
    }
    public function getCapitol()    // Format wyjściowy z selecta to (Stolica, Waluta) , więc trzeba je podzielić
    {
        $temp = $this->Stolica->getCapitalWithCurrency();
        $fields = explode(",",$temp);
        return $fields[0];
    }
    public function getCurrency()   
    {
        $temp = $this->Stolica->getCapitalWithCurrency();
        $fields = explode(",",$temp);
        return str_replace(" ","",$fields[1]);
    }
}
