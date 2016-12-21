<?php include "header.php"; ?>

<div class="catalegBody">

<?php
require_once "../src/Cataleg.php";
require_once "../src/Prestecs.php";
require_once "../src/Llibre.php";

/*Taula prestats*/
echo "<table id='infoPrestats'>";
echo "<tr><th>Llibre</th><th>Usuari</th><th>DNI</th><th>Num. Cataleg</th><th>Data de lloguer</th></tr>";
$resTaula = Prestecs::resumPrestecs();
while ($row = $resTaula->fetch_array()){
    echo "<tr><td>".$row['titol']."</td><td>".$row['nom']."</td><td>".$row['dni']."</td><td>".$row['idCataleg']."</td><td>".$row['dataPrestec']."</td></tr>";
}
echo "</table>";
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

echo "<div class = 'formularis'>";
/*Llista de llibres per Prestar*/

echo "<form action='prestarLlibre.php' method='post' autocomplete='off'>";
echo "<label>Llibres disponibles</label>";
echo "<br />";
echo "<input list='disponibles' name='idCataleg' placeholder='Escriu el id del cataleg' onchange='descripcio(this.value)'>";
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
echo "<input list='retornar' name='idCataleg' placeholder='Escriu el id del cataleg' onchange='descripcio(this.value)'>";
echo "<datalist id='retornar'>";
for ($x = 0; $x < count($arrTornar); $x++){
    echo '<option value="'.$arrTornar[$x].'">';
}
echo "</datalist>";
echo "</input>";
echo "<input type='submit' value='Tornar'>";
echo "</form>";
?>
</div>
<!--/*Descripció llibres Prestec*/-->
<div class="desc">
    <p><b>Informació dels llibres</b></p>
    <h4>Titol del llibre: <span style="color: red; font-weight: bold" id="titolLlibre"></span> </h4>

</div>

