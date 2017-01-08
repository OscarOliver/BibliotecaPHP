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

if ($_POST['idCataleg'] == '') header('Location: ../mostrarCataleg.php');

$id = $_POST['idCataleg'];
$idLlibre = Cataleg::getLlibre($id);

$idLlibre = $idLlibre['idLlibre'];
$usuaris = Usuari::getUsuaris();
$invalidUsers = Prestecs::getUsuarisLimit();


/*Llistat de usuaris*/
echo "<form action='prestarLlibre.php' method='post'>
<input type='hidden' name='idCataleg' value='" .$id."'>
<input type='number' name='dies' min='1' max = '60'>

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

    /*recuperem la data de devolució*/

    $dataDev = $_POST['dies'];
    $dataDev = date('Y-m-d H:i:s', strtotime('+'.$dataDev.' day'));
    /*Realitzem el prestec*/
    echo Prestecs::prestar($usuari,$id,$dataDev);
    header('Location: ../mostrarCataleg.php');
}