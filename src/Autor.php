<?php

/**
 * Created by PhpStorm.
 * User: alumne
 * Date: 13/12/16
 * Time: 17:30
 */
require_once ("DBConnection.php");

class Autor
{
    private $id;
    private $nom;
    private $cognom;
    private $email;
    private $telefon;
    private $nacionalitat;

    function __construct($id, $nom, $cognom, $telefon, $email, $nacionalitat)
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->cognom = $cognom;
        $this->telefon = $telefon;
        $this->email = $email;
        $this->nacionalitat = $nacionalitat;
    }

    public function guardar()
    {
        /* Connexió a la bd */
        $link = DBConnection::getConnection();

        // Comprovar la connexió, si no pot connectar-se donara error
        if ($link === false) {
            die("ERROR: No s'ha pogut connectar. " . mysqli_connect_error());
        }
        else {
            echo "<script>console.log( 'Connected successfully.' );</script>";
        }

        if ($this->id == -1) {
            $sql = "INSERT INTO autor VALUES (NULL, '" .
                $this->nom . "', '" . $this->cognom . "', '" .
                $this->telefon . "', '" . $this->email . "', '" .
                $this->nacionalitat . "')";
        }
        else {
            $sql = "UPDATE autor
                SET nom = '$this->nom', cognom = '$this->cognom', telefon = '$this->telefon', email = '$this->email',
                nacionalitat = '$this->nacionalitat'
                WHERE id = $this->id";
        }

        if (mysqli_query($link, $sql)) {
            $msg = "Query executed successfully";
        }
        else {
            $msg = "Error: " . $sql . "\n" . mysqli_error($link);
        }
        echo "<script>console.log( '" . $msg . "' );</script>";

        $link->close();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return mixed
     */
    public function getCognom()
    {
        return $this->cognom;
    }

    /**
     * @param mixed $cognom
     */
    public function setCognom($cognom)
    {
        $this->cognom = $cognom;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getTelefon()
    {
        return $this->telefon;
    }

    /**
     * @param mixed $telefon
     */
    public function setTelefon($telefon)
    {
        $this->telefon = $telefon;
    }

    /**
     * @return mixed
     */
    public function getPais()
    {
        return $this->pais;
    }

    /**
     * @param mixed $pais
     */
    public function setPais($pais)
    {
        $this->pais = $pais;
    }

    static function get(){
        $link = DBConnection::getConnection();

        if ($link === false) {
            die("ERROR: No s'ha pogut connectar. " . mysqli_connect_error());
        }
        else {
            echo "<script>console.log( 'Connected successfully.' );</script>";
        }

        $sql = "select * from autor";
        if ($res = mysqli_query($link, $sql)) {
            $msg = "New record created successfully";
        }
        else {
            $msg = "Error: " . $sql . "\n" . mysqli_error($link);
        }
        echo "<script>console.log( '" . $msg . "' );</script>";
        return $res;
    }
}