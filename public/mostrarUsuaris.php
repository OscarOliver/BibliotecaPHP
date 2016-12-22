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

    <div id="newUserModal" class="modal">

        <form class="modal-content animate" action="altaUsuari.php" method="post" accept-charset="UTF-8">
            <div class="imgcontainer">
                <span onclick="document.getElementById('newUserModal').style.display='none'" class="close" title="Close Modal">&times;</span>
                <img src="img/add-user.png" alt="Avatar" class="avatar">
            </div>

            <div class="container">
                <input type="text" name="nom" placeholder="Nom" required>
                <br>
                <input type="text" name="cognoms" placeholder="Cognoms" required>
                <br>
                <input type="text" name="dni" placeholder="DNI" required>
                <br>
                <input type="email" name="email" placeholder="Email">
                <br>
                <input type="text" name="telefon" placeholder="Telefon">
                <br>
                <input type="text" name="direccio" placeholder="Direcció">
                <br>
                <input type="text" name="poblacio" placeholder="Població">
                <br>
                <input type="text" name="provincia" placeholder="Provincia">
                <br>
                <input list="paisos" name="pais" placeholder="Pais">
                <datalist id="paisos">
                    <option value="Espanya">
                    <option value="França">
                    <option value="Portugal">
                    <option value="Andorra">
                    <option value="Italia">
                    <option value="Alemania">
                    <option value="Regne Unit">
                    <option value="Estats Units America">
                </datalist>
                <br>
                <input type="date" name="dataNaixement" placeholder="Data naixement">

                <button type="submit">Afegir</button>
            </div>

            <div class="container" style="background-color:#f1f1f1">
                <button type="button" onclick="document.getElementById('newUserModal').style.display='none'" class="cancelbtn">Cancel</button>
            </div>
        </form>
    </div>

    <script>
        // Get the modal
        var modal = document.getElementById('newUserModal');

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>

<?php include "footer.php"; ?>