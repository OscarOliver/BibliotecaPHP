<?php

/**
 * Created by PhpStorm.
 * User: alumne
 * Date: 13/12/16
 * Time: 15:53
 */

require_once ("DBConnection.php");

class Usuari
{
    private $nom;
    private $cognom;
    private $dni;
    private $direccio;
    private $poblacio;
    private $provincia;
    private $nacionalitat;
    private $email;
    private $telefon;
    private $dataNaixement;

    function __construct($nom, $cognom, $dni, $direccio, $poblacio, $provincia, $nacionalitat,
                         $email, $telefon, $dataNaixement)
    {
        $this->nom = $nom;
        $this->cognom = $cognom;
        $this->dni = $dni;
        $this->direccio = $direccio;
        $this->poblacio = $poblacio;
        $this->provincia = $provincia;
        $this->nacionalitat = $nacionalitat;
        $this->email = $email;
        $this->telefon = $telefon;
        $this->dataNaixement = $dataNaixement;
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

        $sql = "INSERT INTO usuari VALUES (NULL, '" .
                $this->nom . "', '" . $this->cognom . "', '" . $this->dni . "', '" .
                $this->dataNaixement . "', '" . $this->telefon . "', '" . $this->email . "', '" .
                $this->direccio . "', '" . $this->poblacio . "', '" . $this->nacionalitat . "', '" . $this->provincia . "')";


        if (mysqli_query($link, $sql)) {
            $msg = "New record created successfully";
        }
        else {
            $msg = "Error: " . $sql . "\n" . mysqli_error($link);
        }
        echo "<script>console.log( '" . $msg . "' );</script>";

        $link->close();
    }

    /********************************
     * Getters & Setters
     ********************************/

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
    public function getDni()
    {
        return $this->dni;
    }

    /**
     * @param mixed $dni
     */
    public function setDni($dni)
    {
        $this->dni = $dni;
    }

    /**
     * @return mixed
     */
    public function getDireccio()
    {
        return $this->direccio;
    }

    /**
     * @param mixed $direccio
     */
    public function setDireccio($direccio)
    {
        $this->direccio = $direccio;
    }

    /**
     * @return mixed
     */
    public function getPoblacio()
    {
        return $this->poblacio;
    }

    /**
     * @param mixed $poblacio
     */
    public function setPoblacio($poblacio)
    {
        $this->poblacio = $poblacio;
    }

    /**
     * @return mixed
     */
    public function getProvincia()
    {
        return $this->provincia;
    }

    /**
     * @param mixed $provincia
     */
    public function setProvincia($provincia)
    {
        $this->provincia = $provincia;
    }

    /**
     * @return mixed
     */
    public function getNacionalitat()
    {
        return $this->pais;
    }

    /**
     * @param mixed $nacionalitat
     */
    public function setNacionalitat($pais)
    {
        $this->pais = $pais;
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
    public function getDataNaixement()
    {
        return $this->dataNaixement;
    }

    /**
     * @param mixed $dataNaixement
     */
    public function setDataNaixement($dataNaixement)
    {
        $this->dataNaixement = $dataNaixement;
    }
}
?>