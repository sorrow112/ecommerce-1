<?php


namespace App;


class Paymentlocal
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $nom;

    /**
     * @var string
     */
    private $prenom;

    /**
     * @var integer
     */
    private $numeroDeCarte;

    /**
     * @var string
     */
    private $CW;

    /**
     * @var string
     */
    private $MMYY;

    /**
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     */
    public function setNumeroDeCarte($numeroDeCarte): void
    {
        $this->numeroDeCarte = $numeroDeCarte;
    }

    public function getNumeroDeCarte()
    {
        return $this->numeroDeCarte;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom): void
    {
        $this->nom = $nom;
    }

    /**
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @param mixed $nom
     */
    public function setPrenom($prenom): void
    {
        $this->prenom = $prenom;
    }

    /**
     * @return string
     */
    public function getCW()
    {
        return $this->CW;
    }

    /**
     * @param mixed $nom
     */
    public function setCW($CW): void
    {
        $this->CW = $CW;
    }

    /**
     * @return string
     */
    public function getMMYY()
    {
        return $this->MMYY;
    }

    /**
     * @param mixed $nom
     */
    public function setMMYY($MMYY): void
    {
        $this->MMYY = $MMYY;
    }
}