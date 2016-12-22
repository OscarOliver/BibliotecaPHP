<?php include "header.php"; ?>

    <div class="usuarisBody">
    <?php
    /**
     * Created by PhpStorm.
     * User: alumne
     * Date: 14/12/16
     * Time: 20:45
     */
    require_once ("../src/DBConnection.php");
    $link = DBConnection::getConnection();

    // Comprovar la connexió, si no pot connectar-se donara error
    if ($link === false) {
        die("ERROR: No s'ha pogut connectar. " . mysqli_connect_error());
    }
    else {
        echo "<script>console.log( 'Connected successfully.' );</script>";
    }

    $sql = "SELECT * FROM usuari";

    $results = mysqli_query($link, $sql);

    echo "<table>";
    echo "<thead><tr>";
    echo    "<th>Id</th>";
    echo    "<th>Nom</th>";
    echo    "<th>Cognoms</th>";
    echo    "<th>Data naixement</th>";
    echo    "<th>Pais</th>";
    echo "</tr></thead>";
    echo "<tbody>";
    while ($row = $results->fetch_array()) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['nom'] . "</td>";
        echo "<td>" . $row['cognom'] . "</td>";
        echo "<td>" . $row['dataNaixement'] . "</td>";
        echo "<td>" . $row['nacionalitat'] . "</td>";
        echo "</tr>";
    }
    echo "</tbody></table>";

    $link->close();
    ?>
    </div>

    <button onclick="document.getElementById('newUserModal').style.display='block'" style="width:auto;">Afegir usuari</button>

<?php include "modals/usuariModal.html"; ?>

<?php include "footer.php"; ?>