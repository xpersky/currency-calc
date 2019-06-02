<?php

namespace App\Entity;

class CurrApi // klasa do pracy z api
{
    private $key;       // klucz do api
    protected $ratio;   // proporcje kursu walut
    protected $result;  // wynik wyjściowy, przeliczona na wybraną walutę kwota

    public function __construct($key)
    {
        $this->key = $key;
    }

    public function convert($value,$from,$to) // wykonaj konwersję
    { 
        // z dokumentacj :
        $endpoint = 'live';
        $access_key = $this->key;
     
        $conversion = $from.','.$to;
     
        // initialize CURL:
        $ch = curl_init('http://apilayer.net/api/'.$endpoint.'?access_key='.$access_key.'&currencies='.$conversion.'');   
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
     
        // get the (still encoded) JSON data:
        $json = curl_exec($ch);
        curl_close($ch);
     
        // Decode JSON response:
        $conversionResult = json_decode($json, true);
     
        // access the conversion result
        $info = $conversionResult['quotes'];
     
        $labelfrom = "USD".$from;
        $labelto = "USD".$to;
     
        $valuefrom = $info[$labelfrom];
        $valueto = $info[$labelto];

        $ratio = bcdiv($valueto,$valuefrom); 

        $this->ratio = $ratio;

        $result = bcmul($ratio,$value);

        $this->result = $result;
    }
    public function getRatio()
    {
        return $this->ratio;
    }
    public function getResult()
    {
        return $this->result;
    }
}