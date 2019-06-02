<?php

namespace App\DataFixtures;

use App\Entity\Capitals;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)    // wypełnia bazę danych danymi o stolicach i walutach tam używanych
    {
        $currencies =   "Wiedeń, EUR;Bruksela, EUR;Praga, CZK;Kopenhaga, DKK;".
                        "Helsinki, EUR;Paryż, EUR;Ateny, EUR;Madryt, EUR;Amsterdam, EUR;".
                        "Dublin, EUR;Luksemburg, EUR;Ryga, EUR;Vallletta, EUR;Monako, EUR;".
                        "Berlin, EUR;Oslo, NOK;Lizbona, EUR;Moskwa, RUB;San Marino, EUR;".
                        "Bratysława, EUR;Lublana, EUR;Berno, CHF;Sztokholm, SEK;Watykan, EUR;".
                        "Budapeszt, HUF;Londyn, GBP;Rzym, EUR;Tirana, ALL;Sarajewo, BAM;".
                        "Sofia, BGN;Wilno, LTL;Skopje, MKD;Kijów, UAH;Kiszyniów, MDL;".
                        "Bukareszt, RON;Belgrad, RSD;Kair, EGP;Rejkiawik, ISK";

        $arr = explode(";",$currencies);

        foreach($arr as $value)
        {
            $capital = new Capitals();
            $capital->setCapitalWithCurrency($value);
            $manager->persist($capital);
        }
        $manager->flush();
    }
}
