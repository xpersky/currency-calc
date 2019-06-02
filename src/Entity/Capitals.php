<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CapitalsRepository")
 */
class Capitals // połączenie z tabelą capitals w bazie danych
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $CapitalWithCurrency;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCapitalWithCurrency(): ?string
    {
        return $this->CapitalWithCurrency;
    }

    public function setCapitalWithCurrency(string $CapitalWithCurrency): self
    {
        $this->CapitalWithCurrency = $CapitalWithCurrency;

        return $this;
    }
}
