<?php include "header.php"; ?>

<div style="padding: 0 20%">
    <form action="../src/PDF.php" target="_blank" method="post" accept-charset="UTF-8">
        <select name="reportType">
            <option value="llibre">Per llibre</option>
            <option value="usuari">Per usuari</option>
            <option value="periode">Per periode</option>
        </select>
        <button type="submit" style="width: auto">Generar informe</button>
    </form>
</div>

<?php include "footer.php"; ?>