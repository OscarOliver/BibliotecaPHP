<?php include "header.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Alta usuari</title>
</head>
<body>
<form action="altaUsuari.php" method="post" accept-charset="UTF-8">
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
    <input type="text" name="direccio" placeholder="Direccio">
    <br>
    <input type="text" name="poblacio" placeholder="Poblaci">
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
        <option value="Estats Units d'America">
    </datalist>
    <br>
    <input type="date" name="dataNaixement" placeholder="Data naixement">
    <br><br>
    <input type="submit" value="Afegir">
</form>
</body>
</html>