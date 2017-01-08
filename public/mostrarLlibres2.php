<?php include "header.php"; ?>

<div class="llibreBody">
<?php
require_once ("../src/DBConnection.php");
$link = DBConnection::getConnection();

// Comprovar la connexió, si no pot connectar-se donara error
if ($link === false) die("Die");

$sql = "SELECT * FROM llibre";

$results = mysqli_query($link, $sql);

echo "<table>";
echo "<thead><tr>";
echo    "<th>ID</th>";
echo    "<th>Titol</th>";
echo    "<th>Autor</th>";
echo    "<th>Genere</th>";
echo    "<th>ISBN</th>";
echo    "<th>Editorial</th>";
echo    "<th>Num. edició</th>";
echo    "<th>Any edició</th>";
echo    "<th>Lloc publicació</th>";
echo    "<th>Quantitat</th>";
echo "</tr></thead>";
echo "<tbody>";
while ($row = $results->fetch_array()) {
    echo "<tr>";
    echo "<td>" . $row['id'] . "</td>";
    echo "<td>" . $row['titol'] . "</td>";
    $sqlAutor = "SELECT nom, cognom FROM autor WHERE id =".$row['idAutor'];
    $autorResult = mysqli_query($link, $sqlAutor);
    $autor = $autorResult->fetch_array();
    $autor = $autor['nom']." ".$autor['cognom'];
    echo "<td>" . $autor . "</td>";
    echo "<td>" . $row['genere'] . "</td>";
    echo "<td>" . $row['ISBN'] . "</td>";
    echo "<td>" . $row['editorial'] . "</td>";
    echo "<td>" . $row['numEdicio'] . "</td>";
    echo "<td>" . $row['anyEdicio'] . "</td>";
    echo "<td>" . $row['llocPublicacio'] . "</td>";
    echo "<td>" . $row['quantitat'] . "</td>";
    echo "<td>";
        echo "<form method='POST' target='_self' >";
            echo "<input type='hidden' name='id' value='$row[id]'>";
            echo "<button class='editButton' ype='submit' value='Editar'>Editar</button>";
        echo "</form>";
    echo "</td>";
    echo "</tr>";
}
echo "</tbody></table>";

$link->close();
?>
</div>

<form method="POST" target="_self">
    <input type='hidden' name='id' value='-1'>
    <button type='submit' value='Afegir' style="width:auto;">Afegir llibre</button>
</form>

<?php include "footer.php"; ?>

<?php include "modals/llibreModal.php"; ?>

<?php
$id = $_POST['id'];
if ($id != null)
    echo "<script>document.getElementById('newLlibreModal').style.display='block'</script>";
?>

