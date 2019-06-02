<?php

namespace App\Entity;

class FormRespond // klasa generująca odpowiedź na wpisane przez użytkownika dane
{
    protected $capitol;         // stolica
    protected $currencyFrom;    // waluta wejściowa
    protected $currencyTo;      // waluta wyjściowa
    protected $value;           // kwota
    protected $result;          // wynik działania api

    public function __construct($capitol,$currencyFrom,$currencyTo,$value)
    {
        $this->capitol = $capitol;
        $this->currencyFrom = $currencyFrom;
        $this->currencyTo = $currencyTo;
        $this->value = $value;
    }
    public function setResult($result)
    {
        $this->result = $result;
    }
    public function getCurrencyFrom()
    {
        return $this->currencyFrom;
    }
    public function getCurrencyTo()
    {
        return $this->currencyTo;
    }
    public function getValue()
    {
        return $this->value;
    }
    public function getResponse() // jeśli wszystkie pola klasy są wypełnione wygeneruj wiadomość dla użytkownika
    {
        $con1 = !empty($this->capitol) && !empty($this->currencyFrom);
        $con2 = !empty($this->currencyTo) && !empty($this->value) && !empty($this->result);
        if( $con1 && $con2 )
        {
            return  $this->capitol." : dysponując ".$this->value." "
                    .$this->currencyFrom." będziesz posiadać "
                    .round($this->result,2)." ".$this->currencyTo.".";
        }
        else return "";
    }
    public function currencyIsValid()   // sprawdza czy waluta wyjściowa jest wspierana
    {
        $valid = array("EUR", "CZK", "DKK", "NOK", "RUB", "CHF", "SEK", "HUF", "GBP", "PLN");
        return in_array($this->currencyTo,$valid);
    }
}