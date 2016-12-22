<?php
/**
 * Created by PhpStorm.
 * User: Aaron
 * Date: 18/12/2016
 * Time: 1:05
 */

require_once "../../src/Usuari.php";
require_once "../../src/Cataleg.php";
require_once "../../src/Prestecs.php";

$id = $_POST['idCataleg'];
$idLlibre = Cataleg::getLlibre($id);

$idLlibre = $idLlibre['idLlibre'];
$usuaris = Usuari::getUsuaris();
$invalidUsers = Prestecs::getUsuarisLimit();

/*Llistat de usuaris*/
echo "<form action='prestarLlibre.php' method='post'>
<input type='hidden' name='idCataleg' value='" .$id."'>
<input list='usuaris' name='usuari'>
<datalist id='usuaris'>";
while ($row = $usuaris ->fetch_array()){
    if (array_search($row['id'],$invalidUsers) === false){
        echo "<option value='".$row['nom']." ".$row['cognom']."  (".$row['id'].")"."'>";
    }
}
echo "</datalist>
</input>
<input type='submit' value='Seleccionar'>
</form>";

if(sizeof($_POST) > 1){
    /*Seleccionem el id de usuari a partir del nom*/
    $usuari = filter_var($_POST['usuari'], FILTER_SANITIZE_NUMBER_INT);

    /*Realitzem el prestec*/
    Prestecs::prestar($usuari,$id);
    header('Location: ../mostrarCataleg.php');
}