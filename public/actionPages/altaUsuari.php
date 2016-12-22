<?php
/**
 * Created by PhpStorm.
 * User: alumne
 * Date: 13/12/16
 * Time: 16:48
 */
require_once("../../src/Usuari.php");
$usuari = new Usuari($_POST['nom'], $_POST['cognoms'], $_POST['dni'], $_POST['direccio'], $_POST['poblacio'],
                     $_POST['provincia'], $_POST['pais'], $_POST['email'], $_POST['telefon'], $_POST['dataNaixement']);

echo "<script>console.log('Object usuari created. Attempting to save to DB...')</script>";
$usuari->guardar();
header('Location: ../mostrarUsuaris.php');