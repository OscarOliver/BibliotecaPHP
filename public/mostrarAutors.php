<?php include "header.php"; ?>

<div class="autorBody">
    <?php

    require_once ("../src/DBConnection.php");
    $link = DBConnection::getConnection();

    // Comprovar la connexió, si no pot connectar-se donara error
    if ($link === false) {
        die("ERROR: No s'ha pogut connectar. " . mysqli_connect_error());
    }
    else {
        echo "<script>console.log( 'Connected successfully.' );</script>";
    }

    $sql = "SELECT * FROM autor";

    $results = mysqli_query($link, $sql);

    echo "<table>";
    echo "<thead><tr>";
    echo    "<th>Id</th>";
    echo    "<th>Nom</th>";
    echo    "<th>Cognoms</th>";
    echo    "<th>Telefon</th>";
    echo    "<th>Email</th>";
    echo    "<th>Pais</th>";
    echo "</tr></thead>";
    echo "<tbody>";
    while ($row = $results->fetch_array()) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['nom'] . "</td>";
        echo "<td>" . $row['cognom'] . "</td>";
        echo "<td>" . $row['telefon'] . "</td>";
        echo "<td>" . $row['email'] . "</td>";
        echo "<td>" . $row['nacionalitat'] . "</td>";
        echo "<td>";
            echo "<form method='POST' target='_self' >";
                echo "<input type='hidden' name='id' value='$row[id]'>";
                echo "<button class='editButton' type='submit' value='Editar'>Editar</button>";
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
        <button type='submit' value='Afegir' style="width:auto;">Afegir autor</button>
    </form>

<?php include "footer.php"; ?>

<?php include "modals/autorModal.php"; ?>

<?php
$id = $_POST['id'];
if ($id != null)
    echo "<script>document.getElementById('newAutorModal').style.display='block'</script>";
?>