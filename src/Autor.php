<?php

/**
 * Created by PhpStorm.
 * User: alumne
 * Date: 13/12/16
 * Time: 17:30
 */
class Autor
{
    private $nom;
    private $cognom;
    private $email;
    private $telefon;
    private $pais;

    function __construct($nom, $cognom, $email, $telefon, $pais)
    {
        $this->nom = $nom;
        $this->cognom = $cognom;
        $this->pais = $pais;
        $this->email = $email;
        $this->telefon = $telefon;
    }
}