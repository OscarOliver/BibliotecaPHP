<?php
require_once "../src/Cataleg.php";
require_once "../src/Prestecs.php";

$cataleg = new Cataleg();
$prestecs = new Prestecs();

$results = $cataleg ->get();
$resultsPrestecs = $prestecs ->get();


/*Llista de llibres per Prestar*/

echo "<form action='prestarLlibre.php' method='post' autocomplete='off'>";
echo "<label>Llibres disponibles</label>";
echo "<br />";
echo "<input list='disponibles' name='idCataleg' placeholder='Escriu el id del cataleg'>";
echo "<datalist id='disponibles'>";
while ($row = $results->fetch_array()){
$idCataleg = $row['id'];
$disponible = true;
    while ($rowPrestecs = $resultsPrestecs->fetch_array()){
        if($rowPrestecs['idCataleg'] == $idCataleg && $rowPrestecs['dataDevolucio'] == null) $disponible = false;
    }

    if($disponible)echo '<option value="'.$row[id].'">';
}
echo "</datalist>";
echo "</input>";
echo "<input type='submit'>";
echo "</form>";

/*Llista de llibres per retornar*/

echo "<form action='retornarLlibre.php' method='post' autocomplete='off'>";
echo "<label>Llibres a retornar</label>";
echo "<br />";
echo "<input list='retornar' name='idCataleg' placeholder='Escriu el id del cataleg'>";
echo "<datalist id='retornar'>";
while ($rowPrestecs = $resultsPrestecs->fetch_array()){
    $idCataleg = $rowPrestecs['idCataleg'];
    $valid = false;
    if($rowPrestecs['dataDevolucio'] == null)$valid = true;
    if ($valid) echo "<option value = '.$rowPrestecs[idCataleg].'>";
}
echo "</datalist>";
echo "</input>";
echo "<input type='submit'>";
echo "</form>";