<?php include "header.php"; ?>

<div id="reportType">
    <form name="informe" action="../src/PDF.php" target="_blank">
        <select>
            <option>Per llibre</option>
            <option>Per usuari</option>
            <option>Per periode</option>
        </select>
        <button type="submit">Mostrar informe</button>
    </form>
</div>

<?php include "footer.php"; ?>