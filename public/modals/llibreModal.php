<div id="newLlibreModal" class="modal">

    <form class="modal-content animate" action="actionPages/altaLlibre.php" method="post" accept-charset="UTF-8">
        <div class="imgcontainer">
            <span onclick="document.getElementById('newLlibreModal').style.display='none'" class="close" title="Close Modal">&times;</span>
            <img src="img/add-book.png" alt="Avatar" class="avatar">
        </div>

        <div class="container">
            <?php
            require_once "../src/Llibre.php";
            require_once "../src/Autor.php";
            $res = Llibre::resumLlibre();
            $autorRes = Autor::get();

            $id = $_POST['id'];
            echo "<input type='hidden' name='id' value='$id'>";
            if ($id == -1) {    // Nou llibre
                echo "<select name='idAutor' title='autors' required>";
                while ($row = $autorRes->fetch_array()) {
                    echo "<option value='" . $row['id'] . "'>" . $row['nom'] . " " . $row['cognom'] . "</option>";
                };
                echo "</select>";
                echo "
                    <br>
                    <input type='text' name='titol' placeholder='Titol *' required>
                    <br>
                    <input type='text' name='genere' placeholder='Genere *' required>
                    <br>
                    <input type='number' min='1' name='quantitat' placeholder='Quantitat *' required>
                    <br>
                    <input type='text' name='isbn' placeholder='ISBN *' required>
                    <br>
                    <input type='text' name='editorial' placeholder='Editorial'>
                    <br>
                    <input type='number' min='1' name='numEdicio' placeholder='Num. Edicio'>
                    <br>
                    <input type='number' min='1' name='anyEdicio' placeholder='Any edicio'>
                    <br>
                    <input type='text' name='llocPublicacio' placeholder='Lloc publicacio'>
                    <br>
                    <button type='submit'>Afegir</button>";
            }
            else {
                require_once ("../src/DBConnection.php");
                $link = DBConnection::getConnection();

                // Comprovar la connexió, si no pot connectar-se donara error
                if ($link === false) die("Die");

                $sql = "SELECT * FROM llibre WHERE id = ".$id;

                $results = mysqli_query($link, $sql);
                $row = $results->fetch_array();

                echo "<select name='idAutor' title='autors' required>";
                while ($rowAutor = $autorRes->fetch_array()) {
                    echo "<option value='" . $row['id'] . "' ";
                    if ($row['idAutor'] == $rowAutor['id']) echo "selected";
                    echo ">" . $rowAutor['nom'] . " " . $rowAutor['cognom'] . "</option>";
                };
                echo "</select>";
                echo "
                    <br>
                    <input type='text' name='titol' placeholder='Titol * ' value='$row[titol]' required>
                    <br>
                    <input type='text' name='genere' placeholder='Genere * ' value='$row[genere]' required>
                    <br>
                    <input type='number' min='1' name='quantitat' placeholder='Quantitat * ' value='$row[quantitat]' required>
                    <br>
                    <input type='text' name='isbn' placeholder='ISBN * ' value='$row[ISBN]' required>
                    <br>
                    <input type='text' name='editorial' placeholder='Editorial' value='$row[editorial]'>
                    <br>
                    <input type='number' min='1' name='numEdicio' placeholder='Num. Edicio' value='$row[numEdicio]'>
                    <br>
                    <input type='number' min='1' name='anyEdicio' placeholder='Any edicio' value='$row[anyEdicio]'>
                    <br>
                    <input type='text' name='llocPublicacio' placeholder='Lloc publicacio' value='$row[llocPublicacio]'>
                    <br>
                    <button type='submit'>Guardar canvis</button>";
                $link->close();
            }

            ?>
        </div>

        <div class="container" style="background-color:#f1f1f1">
            <button type="button" onclick="document.getElementById('newLlibreModal').style.display='none'" class="cancelbtn">Cancel</button>
        </div>
    </form>
</div>

<script>
    // Get the modal
    var modal = document.getElementById('newLlibreModal');

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>