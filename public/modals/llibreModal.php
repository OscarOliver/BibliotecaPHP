<div id="newLlibreModal" class="modal">

        <form class="modal-content animate" action="altaLlibre.php" method="post" accept-charset="UTF-8">
            <div class="imgcontainer">
                <span onclick="document.getElementById('newLlibreModal').style.display='none'" class="close" title="Close Modal">&times;</span>
                <img src="img/add-book.png" alt="Avatar" class="avatar">
            </div>

            <div class="container">
                <input type="text" name="nom" placeholder="Nom" required>
                <br>
                <input type="text" name="cognoms" placeholder="Cognoms" required>
                <br>
                <input type="email" name="email" placeholder="Email">
                <br>
                <input type="text" name="telefon" placeholder="Telefon">
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