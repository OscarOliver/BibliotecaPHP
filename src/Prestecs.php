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
    function get(){
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

    function retornar($idCataleg){
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
}