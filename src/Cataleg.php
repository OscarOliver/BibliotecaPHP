<?php
/**
 * Created by PhpStorm.
 * User: Aaron
 * Date: 17/12/2016
 * Time: 23:09
 */
require_once ("DBConnection.php");

class Cataleg
{
    function get(){
        $link = DBConnection::getConnection();

        if ($link === false) {
            die("ERROR: No s'ha pogut connectar. " . mysqli_connect_error());
        }
        else {
            echo "<script>console.log( 'Connected successfully.' );</script>";
        }

        $sql = "select * from cataleg";
        $res = mysqli_query($link,$sql);
        $link -> close();
        return $res;
    }
}