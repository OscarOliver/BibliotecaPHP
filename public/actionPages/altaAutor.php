<?php
/**
 * Created by PhpStorm.
 * User: alumne
 * Date: 22/12/16
 * Time: 14:52
 */
require_once("../../src/Autor.php");
$autor = new Autor($_POST['nom'], $_POST['cognoms'], $_POST['telefon'], $_POST['email'], $_POST['pais']);

echo "<script>console.log('Object Autor created. Attempting to save to DB...')</script>";
$autor->guardar();
header('Location: ../mostrarAutors.php');