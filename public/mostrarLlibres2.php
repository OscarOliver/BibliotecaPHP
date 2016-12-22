<?php include "header.php"; ?>

    <div class="llibreBody">
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
            echo "<td>" . $row['isbn'] . "</td>";
            echo "<td>" . $row['editorial'] . "</td>";
            echo "<td>" . $row['numEdicio'] . "</td>";
            echo "<td>" . $row['anyEdicio'] . "</td>";
            echo "<td>" . $row['llocPublicacio'] . "</td>";
            echo "<td>" . $row['quantitat'] . "</td>";
            echo "</tr>";
        }
        echo "</tbody></table>";

        $link->close();
        ?>
    </div>

    <button onclick="document.getElementById('newLlibreModal').style.display='block'" style="width:auto;">Afegir llibre</button>

    <?php include "modals/llibreModal.html"; ?>

<?php include "footer.php"; ?>