<?php
/**
 * Created by PhpStorm.
 * User: alumne
 * Date: 22/12/16
 * Time: 18:25
 */
require_once("../../src/Llibre.php");
$llibre = new Llibre($_POST['id'], $_POST['idAutor'], $_POST['numEdicio'], $_POST['quantitat'], $_POST['llocPublicacio'],
    $_POST['anyEdicio'], $_POST['editorial'], $_POST['isbn'], $_POST['titol'], $_POST['genere']);

echo "<script>console.log('Object Llibre created. Attempting to save to DB...')</script>";
$llibre->guardar();
header('Location: ../mostrarLlibres2.php');