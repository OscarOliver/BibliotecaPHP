<?php
/**
 * Created by PhpStorm.
 * User: Aaron
 * Date: 18/12/2016
 * Time: 18:51
 */
require_once "../src/Cataleg.php";
require_once "../src/Llibre.php";

$id = $_REQUEST["q"];
$idLlibre = Cataleg::getLlibre($id);
$row = Llibre::get($idLlibre);
$llibre = $row ->fetch_array();
echo $llibre['titol'];

//$nomLlibre = $Llibre['titol'];
//
//echo $nomLlibre;