<?php include "header.php"; ?>

<div>
    <form action="../src/PDF.php" target="_blank" method="post" accept-charset="UTF-8">
        <input list="reportList">
        <select id="reportLis" name="reportType">
            <option value="llibre">Per llibre</option>
            <option value="usuari">Per usuari</option>
            <option value="periode">Per periode</option>
        </select>
        <button type="submit" style="width: auto">Mostrar informe</button>
    </form>
</div>

<?php include "footer.php"; ?>