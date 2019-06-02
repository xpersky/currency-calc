<?php

namespace App\Entity;

class ScriptPY
{
    protected $python;
    protected $prPath;      // ścieżka do folderu projektu
    protected $currFrom;    // waluta wejściowa
    protected $currTo;      // waluta wyjściowa
    protected $apiResult;   // mnożnik waluty wyliczony na podstawie odpowiedzi api
    protected $result;      // rezultat - oszacowany miesiąc w którym najlepiej byłoby wymienić walutę
    const SCRIPT_PATH = "scriptsPY\scripts\predict.py";             // aby można było wykonać skrypt 
    const DATA_PATH = "scriptsPY\input\avg_exchange_rates.csv";   // trzeba podać pełną ścieżkę
    const PARAMS = "6 1";   // konfiguracja arimy - to optymalna konfiguracja, wartości maksymalne to (10 2)
    const MONTHS = array(  "stycznia","lutego","marca","kwietnia",
                            "maja","czerwca","lipca","sierpnia","wrzesnia",
                            "października","listopada","grudnia");

    public function __construct($python,$from,$to,$result)
    {   
        $this->python = $python;
        $this->apiResult = $result;
        $this->currFrom = $from;
        $this->currTo = $to;
        $this->prPath = str_replace(basename(__DIR__),"",dirname(__FILE__));
    }

    public function execute()
    {
        $path = $this->python." ".$this->prPath.self::SCRIPT_PATH." ";
        $pathCD = " ".$this->prPath.self::DATA_PATH." ".self::PARAMS;
        // Odbiera oszacowane wartości dla waluty wejściowej

        $command = escapeshellcmd($path.$this->currFrom.$pathCD);
        $output1 = shell_exec($command." 2>&1"); 

        // Odbiera oszacowane wartości dla waluty wyjściowej

        $command = escapeshellcmd($path.$this->currTo.$pathCD);
        $output2 = shell_exec($command." 2>&1");

        unset($command);
        unset($path);
        unset($pathCD);
        // Odpowiedź skryptu wygląda nastepująco Miesiąc:Wartość;Miesiąc:Wartość... dlatego należy ją podzielić

        $out1result = explode(";",$output1);

        unset($output1);

        $out1values = array();

        foreach($out1result as $key)
        {
            $arr = array();
            $str = explode(":",$key);
            if(strlen($str[0]) > 8) $in1 = substr($str[0],0,8);
            else $in1 = $str[0];
            if(strlen($str[1]) > 8) $in2 = substr($str[1],0,8);
            else $in2 = $str[1];
            array_push($arr,$in1);
            array_push($arr,$in2);
            array_push($out1values,$arr);
        }
        
        unset($out1result);

        $out2result = explode(";",$output2);

        unset($output2);

        $out2values = array();
        foreach($out2result as $key)
        {
            $arr = array();
            $str = explode(":",$key);
            if(strlen($str[0]) > 8) $in1 = substr($str[0],0,8);
            else $in1 = $str[0];
            if(strlen($str[1]) > 8) $in2 = substr($str[1],0,8);
            else $in2 = $str[1];
            array_push($arr,$in1);
            array_push($arr,$in2);
            array_push($out2values,$arr);
        }

        unset($out2result);

        // Po podzieleniu odpowiedzi, należy wyliczyć mnożniki, i posortować je od największego

        $ratios = array();

        for( $x=0; $x < sizeof($out2values) ; $x++)
        {
            $topush = array();
            $ratio = bcdiv($out2values[$x][1],$out1values[$x][1],6);      
            $month = (int)$out2values[$x][0];
            array_push($topush,$ratio);
            array_push($topush,$month);
            array_push($ratios,$topush);
        }

        unset($out1values);
        unset($out2values);

        rsort($ratios);

        // po czym podzielić je sezonami

        $summer = array();
        $winter = array();

        for( $x=0; $x < sizeof($ratios) ; $x++)
        {
            if($ratios[$x][1] >= 3 && $ratios[$x][1] <= 8)
            {
                array_push($summer,$ratios[$x]);
            }
            else
            {
                array_push($winter,$ratios[$x]);
            }
        }

        unset($ratios);

        $result = array();

        // na każdy sezon należy wybrać 1 najwyższy mnożnik

        array_push($result,$summer[0]);
        array_push($result,$winter[0]);

        $this->result = $result;
    }

    public function getResult()
    {
        return $this->result;
    }

    public function getResponse1() // pierwsza część odpowiedzi skryptu
    {
        $text = "Nasze narzędzia statystyczne mówią, że najlepiej wymienić ";
        return $text.$this->currFrom." na ".$this->currTo." :";
    }
    public function getResponse2() // druga częśc odpowiedzi skryptu ( na sezon letni = wiosna - lato)
    {
        $this_month = date('n');
        if ($this_month >= 3 && $this_month <= 8)
        {
            if($this->apiResult < $this->result[0][0])
            {
                $respond = "Na sezon letni w okolicach ".self::MONTHS[$this->result[0][1]-1].".";
            }
            else $respond = "Na sezon letni w okolicach tego miesiąca.";
        }
        else $respond = "Na sezon letni w okolicach ".self::MONTHS[$this->result[0][1]-1].".";
        return $respond;
    }
    public function getResponse3() // trzecia część odpowiedzi skryptu ( na sezon zimowy = jesień - zima)
    {
        $this_month = date('n');
        if ($this_month >= 9 || $this_month <= 2)
        {
            if($this->apiResult < $this->result[1][0])
            {
                $respond = "Na sezon zimowy w okolicach ".self::MONTHS[$this->result[1][1]-1].".";
            }
            else $respond = "Na sezon zimowy w okolicach tego miesiąca.";
        }
        else $respond = "Na sezon zimowy w okolicach ".self::MONTHS[$this->result[1][1]-1].".";
        return $respond;
    }
}