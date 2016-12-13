<?php

/**
 * Created by PhpStorm.
 * User: alumne
 * Date: 13/12/16
 * Time: 16:30
 */
class DBConnection
{
    static function getConnection()
    {
        /*Connexió a la bd, per ordre van, IP del servidor, nom usuari, contrasenya i la base a la que treballa */
        $link = mysqli_connect("hl344.dinaserver.com", "alumne", "alumne", "m7biblioteca");

        return $link;
    }
}