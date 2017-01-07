<div id="newAutorModal" class="modal">

    <form class="modal-content animate" action="actionPages/altaAutor.php" method="post" accept-charset="UTF-8">
        <div class="imgcontainer">
            <span onclick="document.getElementById('newAutorModal').style.display='none'" class="close" title="Close Modal">&times;</span>
            <img src="img/add-author.png" alt="Avatar" class="avatar">
        </div>

        <div class="container">
            <?php
            $id = $_POST['id'];
            echo "<input type='hidden' name='id' value='$id'>";
            if ($id == -1) {
                echo "
                    <input type='text' name='nom' placeholder='Nom *' required>
                    <br>
                    <input type='text' name='cognoms' placeholder='Cognoms *' required>
                    <br>
                    <input type='email' name='email' placeholder='Email'>
                    <br>
                    <input type='text' name='telefon' placeholder='Telefon'>
                    <br>
                    <input list='paisos' name='pais' placeholder='Pais'>
                    <datalist id='paisos'>
                        <option value='Espanya'>
                        <option value='França'>
                        <option value='Portugal'>
                        <option value='Andorra'>
                        <option value='Italia'>
                        <option value='Alemania'>
                        <option value='Regne Unit'>
                        <option value='Estats Units America'>
                        <option value='Canada'>
                        <option value='China'>
                        <option value='Japo'>
                    </datalist>
        
                    <button type='submit'>Afegir</button>";
            }
            else {
                require_once ("../src/DBConnection.php");
                $link = DBConnection::getConnection();

                // Comprovar la connexió, si no pot connectar-se donara error
                if ($link === false) die("Die");

                $sql = "SELECT * FROM autor WHERE id = ".$id;

                $results = mysqli_query($link, $sql);
                $row = $results->fetch_array();

                echo "
                    <input type='text' name='nom' placeholder='Nom *' value='$row[nom]' required>
                    <br>
                    <input type='text' name='cognoms' placeholder='Cognoms *' value='$row[cognom]' required>
                    <br>
                    <input type='email' name='email' placeholder='Email' value='$row[email]'>
                    <br>
                    <input type='text' name='telefon' placeholder='Telefon' value='$row[telefon]'>
                    <br>
                    <input list='paisos' name='pais' placeholder='Pais' value='$row[nacionalitat]'>
                    <datalist id='paisos'>
                        <option value='Espanya'>
                        <option value='França'>
                        <option value='Portugal'>
                        <option value='Andorra'>
                        <option value='Italia'>
                        <option value='Alemania'>
                        <option value='Regne Unit'>
                        <option value='Estats Units America'>
                        <option value='Canada'>
                        <option value='China'>
                        <option value='Japo'>
                    </datalist>
        
                    <button type='submit'>Guardar canvis</button>";

                $link->close();
            }
            ?>

        </div>

        <div class="container" style="background-color:#f1f1f1">
            <button type="button" onclick="document.getElementById('newAutorModal').style.display='none'" class="cancelbtn">Cancel</button>
        </div>
    </form>
</div>

<script>
    // Get the modal
    var modal = document.getElementById('newAutorModal');

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>