<?php
/**
 * Created by PhpStorm.
 * User: Aaron
 * Date: 18/12/2016
 * Time: 11:23
 */

require_once "DBConnection.php";

class Llibre
{
    private $id;
    private $idAutor;
    private $numEdicio;
    private $quantitat;
    private $llocPublicacio;
    private $anyEdicio;
    private $editorial;
    private $isbn;
    private $titol;
    private $genere;

    /**
     * Llibre constructor.
     * @param $id
     * @param $idAutor
     * @param $numEdicio
     * @param $quantitat
     * @param $llocPublicacio
     * @param $anyEdicio
     * @param $editorial
     * @param $isbn
     * @param $titol
     * @param $genere
     */
    public function __construct($id, $idAutor, $numEdicio, $quantitat, $llocPublicacio, $anyEdicio, $editorial, $isbn, $titol, $genere)
    {
        $this->id = $id;
        $this->idAutor = $idAutor;
        $this->numEdicio = $numEdicio;
        $this->quantitat = $quantitat;
        $this->llocPublicacio = $llocPublicacio;
        $this->anyEdicio = $anyEdicio;
        $this->editorial = $editorial;
        $this->isbn = $isbn;
        $this->titol = $titol;
        $this->genere = $genere;
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
     * @return Llibre
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getIdAutor()
    {
        return $this->idAutor;
    }

    /**
     * @param mixed $idAutor
     * @return Llibre
     */
    public function setIdAutor($idAutor)
    {
        $this->idAutor = $idAutor;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNumEdicio()
    {
        return $this->numEdicio;
    }

    /**
     * @param mixed $numEdicio
     * @return Llibre
     */
    public function setNumEdicio($numEdicio)
    {
        $this->numEdicio = $numEdicio;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getQuantitat()
    {
        return $this->quantitat;
    }

    /**
     * @param mixed $quantitat
     * @return Llibre
     */
    public function setQuantitat($quantitat)
    {
        $this->quantitat = $quantitat;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLlocPublicacio()
    {
        return $this->llocPublicacio;
    }

    /**
     * @param mixed $llocPublicacio
     * @return Llibre
     */
    public function setLlocPublicacio($llocPublicacio)
    {
        $this->llocPublicacio = $llocPublicacio;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAnyEdicio()
    {
        return $this->anyEdicio;
    }

    /**
     * @param mixed $anyEdicio
     * @return Llibre
     */
    public function setAnyEdicio($anyEdicio)
    {
        $this->anyEdicio = $anyEdicio;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEditorial()
    {
        return $this->editorial;
    }

    /**
     * @param mixed $editorial
     * @return Llibre
     */
    public function setEditorial($editorial)
    {
        $this->editorial = $editorial;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getIsbn()
    {
        return $this->isbn;
    }

    /**
     * @param mixed $isbn
     * @return Llibre
     */
    public function setIsbn($isbn)
    {
        $this->isbn = $isbn;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTitol()
    {
        return $this->titol;
    }

    /**
     * @param mixed $titol
     * @return Llibre
     */
    public function setTitol($titol)
    {
        $this->titol = $titol;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getGenere()
    {
        return $this->genere;
    }

    /**
     * @param mixed $genere
     * @return Llibre
     */
    public function setGenere($genere)
    {
        $this->genere = $genere;
        return $this;
    }

    static function get($id){
        $link = DBConnection::getConnection();
        $sql = "select * from llibre WHERE id = ".$id."";
        $res = mysqli_query($link,$sql);
        return $res;
    }
}