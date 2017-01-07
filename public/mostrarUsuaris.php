<?php include "header.php"; ?>

    <div class="usuarisBody">
    <?php
    require_once ("../src/DBConnection.php");
    $link = DBConnection::getConnection();

    // Comprovar la connexió, si no pot connectar-se donara error
    if ($link === false) die("Die");

    $sql = "SELECT * FROM usuari";

    $results = mysqli_query($link, $sql);

    echo "<table>";
    echo "<thead><tr>";
    echo    "<th>Id</th>";
    echo    "<th>DNI</th>";
    echo    "<th>Nom</th>";
    echo    "<th>Cognoms</th>";
    echo    "<th>Data naixement</th>";
    echo    "<th>Email</th>";
    echo    "<th>Telefon</th>";
    echo    "<th>Direcció</th>";
    echo    "<th>Població</th>";
    echo    "<th>Provincia</th>";
    echo    "<th>Nacionalitat</th>";
    echo "</tr></thead>";
    echo "<tbody>";
    while ($row = $results->fetch_array()) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['dni'] . "</td>";
        echo "<td>" . $row['nom'] . "</td>";
        echo "<td>" . $row['cognom'] . "</td>";
        echo "<td>" . $row['dataNaixement'] . "</td>";
        echo "<td>" . $row['email'] . "</td>";
        echo "<td>" . $row['telefon'] . "</td>";
        echo "<td>" . $row['direccio'] . "</td>";
        echo "<td>" . $row['poblacio'] . "</td>";
        echo "<td>" . $row['provincia'] . "</td>";
        echo "<td>" . $row['nacionalitat'] . "</td>";
        echo "<td>";
            echo "<form method='POST' target='_self' >";
                echo "<input type='hidden' name='id' value='$row[id]'>";
                echo "<button type='submit' value='Editar'>Editar</button>";
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
        <button type='submit' value='Afegir' style="width:auto;">Afegir usuari</button>
    </form>



<?php include "modals/usuariModal2.php"; ?>

<?php
$id = $_POST['id'];
if ($id != null)
    echo "<script>document.getElementById('newUserModal').style.display='block'</script>";
?>

<?php include "footer.php"; ?>