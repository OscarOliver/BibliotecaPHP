<?php
require_once "../src/Cataleg.php";

$cataleg = new Cataleg();

$results = $cataleg ->get();

echo "<table>";
echo "<thead>";
echo "<tr><th colspan='4'>Cataleg de llibres</th></tr>";
echo "<tr><th>Cataleg ID</th><th>Llibre ID</th><th>Prestar</th><th>Tornar</th></tr>";
echo "</thead>";
echo "<tbody>";

//Loop per al contingut

while ($row = $results->fetch_array()){
    echo "<tr>";
    echo "<td>". $row['id'] ."</td>";
    echo "<td>". $row['idLlibre'] ."</td>";
    echo "<td> funcioPerPrestar </td>";
    echo "<td> funcioPerTornar </td>";
}

echo "</tbody></table>";