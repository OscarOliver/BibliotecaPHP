<?php
/**
 * Created by PhpStorm.
 * User: alumne
 * Date: 22/12/16
 * Time: 18:25
 */
require_once ("../src/Llibre.php");
$llibre = new Llibre($_POST['nom'], $_POST['cognoms'], $_POST['telefon'], $_POST['email'], $_POST['pais']);

echo "<script>console.log('Object Llibre created. Attempting to save to DB...')</script>";
$llibre->guardar();
header('Location: mostrarLlibres.php');