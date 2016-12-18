<?php
require_once "../src/Cataleg.php";
require_once "../src/Prestecs.php";

$results = Cataleg::get();
$resultsPrestecs = Prestecs::getRetornar();
$arrTornar = array();
$arrPrestar = array();

while ($rowPrestecs = $resultsPrestecs->fetch_array()){
    array_push($arrTornar,$rowPrestecs['idCataleg']);
}

while ($row = $results->fetch_array()){
    array_push($arrPrestar,$row['id']);
}

/*Llista de llibres per Prestar*/

echo "<form action='prestarLlibre.php' method='post' autocomplete='off'>";
echo "<label>Llibres disponibles</label>";
echo "<br />";
echo "<input list='disponibles' name='idCataleg' placeholder='Escriu el id del cataleg'>";
echo "<datalist id='disponibles'>";
for ($x = 0; $x < count($arrPrestar); $x++){
    if(array_search($arrPrestar[$x],$arrTornar) === false){
        echo '<option value="'.$arrPrestar[$x].'">';
    }
}
echo "</datalist>";
echo "</input>";
echo "<input type='submit' value='Prestar'>";
echo "</form>";

/*Llista de llibres per retornar*/

echo "<form action='retornarLlibre.php' method='post' autocomplete='off'>";
echo "<label>Llibres a retornar</label>";
echo "<br />";
echo "<input list='retornar' name='idCataleg' placeholder='Escriu el id del cataleg'>";
echo "<datalist id='retornar'>";
for ($x = 0; $x < count($arrTornar); $x++){
    echo '<option value="'.$arrTornar[$x].'">';
}
echo "</datalist>";
echo "</input>";
echo "<input type='submit' value='Tornar'>";
echo "</form>";