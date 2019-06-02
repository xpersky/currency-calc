<?php

namespace App\Entity;

class CalcRespond // przechowuje wiadomości do wyrenderowania
{
    protected $api;     // odpowiedź api
    protected $sc1;     // odpowiedzi skryptu
    protected $sc2;
    protected $sc3;

    public function __construct() 
    { 
        $this->api = "";
        $this->sc1 = "";
        $this->sc2 = "";
        $this->sc3 = "";
    }
    public function setAPI($api)
    {
        $this->api = $api;
    }
    public function getAPI()
    {
        return $this->api;
    }
    public function setSC1($sc1)
    {
        $this->sc1 = $sc1;
    }
    public function getSC1()
    {
        return $this->sc1;
    }
    public function setSC2($sc2)
    {
        $this->sc2 = $sc2;
    }
    public function getSC2()
    {
        return $this->sc2;
    }
    public function setSC3($sc3)
    {
        $this->sc3 = $sc3;
    }
    public function getSC3()
    {
        return $this->sc3;
    }
    public function issetSC23()
    {
        if(!empty($this->sc2) && !empty($this->sc3)) return true;
        else return false;
    }
}