<?php

namespace App\Controller;

use App\Form\CurrCalcType;
use App\Entity\CalcData;
use App\Entity\CurrApi;
use App\Entity\FormRespond;
use App\Entity\ScriptPY;
use App\Entity\CalcRespond;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class CurrencyCalcController extends AbstractController
{
    /**
     * @Route("/currency/calc", name="currency_calc")
     */
    public function calc(Request $request)
    {
        bcscale(6);     // ustawienie parametru scale dla BC MATH
        $form = $this->createForm(CurrCalcType::class);
        $form->handleRequest($request);     
        $response = new CalcRespond();       // przechowuje gotowe dane które zostaną wyrenderowane
        if($form->isSubmitted() && $form->isValid())
        {
            $data = $form->getData();   
            $formResp = new FormRespond($data->getCapitol(),"PLN",$data->getCurrency(),$data->getKwota());  // przechowuje odpowiedź formularza
            $myAPI = new CurrApi('<--YOUR---API---KEY-->');                                                 // klasa do pracy z api
            $myAPI->convert($formResp->getValue(),$formResp->getCurrencyFrom(),$formResp->getCurrencyTo()); // przelicza kwotę na walutę wyjściową
            $formResp->setResult($myAPI->getResult());                                                      // zapisuje wynik działania api
            $response->setAPI($formResp->getResponse());                                                    // zapisuje gotową wiadomość dla użytkownika
            if($data->getRunScript() && $formResp->currencyIsValid()){                  // skrypt zadziała jeśli wybrana waluta jest wspierana
                $script = new ScriptPY("python36","PLN",$data->getCurrency(),$myAPI->getRatio());  // klasa do pracy z pythonowym skryptem
                $script->execute();                                                     // wykonuje skrypt
                $response->setSC2($script->getResponse2());                             // zapisujemy wiadomośi dla użytkownika
                $response->setSC3($script->getResponse3());                             // odpowiedź skryptu podzieliłem na sezony letni i zimowy
                if($response->issetSC23())
                {
                    $response->setSC1($script->getResponse1());
                }
            }
            else if($data->getRunScript())  // jeżeli waluta nie jest wspierana przesyła wiadomość alternatywną                                 
            {
                $response->setSC1("System predykcji wspiera waluty:");
                $response->setSC2("EUR, CZK, DKK, NOK, RUB, CHF, SEK, HUF, GBP, PLN");
            }
        }

        return $this->render('currency_calc/calc.html.twig', [
            'calc_form' => $form->createView(),
            'apiRespond' => $response->getAPI(),
            'scRespond1' => $response->getSC1(),
            'scRespond2' => $response->getSC2(),
            'scRespond3' => $response->getSC3()
        ]);
     
    }
}
