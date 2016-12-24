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
                echo "<select name='idAutor' title='autors' required>";
                while ($row = $autorRes ->fetch_array()) {
                    echo "<option value='".$row['id']."'>".$row['nom']." ".$row['cognom']."</option>";
                };
                echo "</select>";
                ?>
                <br>
                <input type="text" name="titol" placeholder="Titol*" required>
                <br>
                <input type="text" name="genere" placeholder="Genere*" required>
                <br>
                <input type="number" min="1" name="quantitat" placeholder="Quantitat*" required>
                <br>
                <input type="text" name="isbn" placeholder="ISBN*" required>
                <br>
                <input type="text" name="editorial" placeholder="Editorial">
                <br>
                <input type="number" min="1" name="numEdicio" placeholder="Num. Edicio">
                <br>
                <input type="number" min="1" name="anyEdicio" placeholder="Any edicio">
                <br>
                <input type="text" name="llocPublicacio" placeholder="Lloc publicacio">
                <br>
                <button type="submit">Afegir</button>
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