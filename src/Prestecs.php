<?php
/**
 * Created by PhpStorm.
 * User: Aaron
 * Date: 17/12/2016
 * Time: 23:09
 */
require_once ("DBConnection.php");

class Prestecs
{
    static function get(){
        $link = DBConnection::getConnection();

        if ($link === false) {
            die("ERROR: No s'ha pogut connectar. " . mysqli_connect_error());
        }
        else {
            echo "<script>console.log( 'Connected successfully.' );</script>";
        }

        $sql = "select * from prestecs";
        $res = mysqli_query($link,$sql);
        $link -> close();
        return $res;
    }

    static function getRetornar(){
        $link = DBConnection::getConnection();

        if ($link === false) {
            die("ERROR: No s'ha pogut connectar. " . mysqli_connect_error());
        }
        else {
            echo "<script>console.log( 'Connected successfully.' );</script>";
        }

        $sql = "select * from prestecs where dataDevolucio IS NULL";
        $res = mysqli_query($link,$sql);
        $link -> close();
        return $res;
    }

    static function prestar($usuari,$idCataleg){
        $link = DBConnection::getConnection();

        if ($link === false) {
            die("ERROR: No s'ha pogut connectar. " . mysqli_connect_error());
        }
        else {
            echo "<script>console.log( 'Connected successfully.' );</script>";
        }
        $sql = "INSERT INTO prestecs VALUES (NULL, " .$idCataleg . ", ". $usuari .",NULL,NULL)";
        if(mysqli_query($link,$sql)) $msg = "New record created successfully";
        else $msg = "Error: " . $sql . "\n" . mysqli_error($link);
        echo "<script>console.log( '" . $msg . "' );</script>";
        $link->close();
    }

    static function retornar($idCataleg){
        $link = DBConnection::getConnection();

        if ($link === false) {
            die("ERROR: No s'ha pogut connectar. " . mysqli_connect_error());
        }
        else {
            echo "<script>console.log( 'Connected successfully.' );</script>";
        }

        $sql = "UPDATE prestecs P SET P.dataDevolucio = NOW() WHERE idCataleg = ".$idCataleg." AND dataDevolucio IS NULL";
        $res =mysqli_query($link,$sql);
        $link->close();
    }


    static function getUsuarisLimit(){
        $link = DBConnection::getConnection();

        if ($link === false) {
            die("ERROR: No s'ha pogut connectar. " . mysqli_connect_error());
        }
        else {
            echo "<script>console.log( 'Connected successfully.' );</script>";
        }

        $sql = "SELECT idUsuari FROM prestecs WHERE dataDevolucio is NULL GROUP BY idUsuari HAVING count(*) >= 3";
        $res = mysqli_query($link,$sql);
        $link -> close();
        $arrUsers = array();
        while ($row = $res ->fetch_array()){
            $id = $row[idUsuari];
            array_push($arrUsers, $id);
        }

        return $arrUsers;
    }

    static function resumPrestecs(){
        $link = DBConnection::getConnection();

        if ($link === false) {
            die("ERROR: No s'ha pogut connectar. " . mysqli_connect_error());
        }
        else {
            echo "<script>console.log( 'Connected successfully.' );</script>";
        }
        $sql = "SELECT l.titol, u.nom, u.dni, p.idCataleg,p.dataPrestec from prestecs p JOIN cataleg c on c.id = p.idCataleg JOIN usuari u ON u.id = p.idUsuari JOIN llibre l ON l.id = c.idLlibre WHERE p.dataDevolucio IS NULL";
        $res =mysqli_query($link,$sql);
        $link->close();
        return $res;
    }
}