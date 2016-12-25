<?php include "header.php"; ?>

<div style="padding: 0 20%">
    <form action="../src/PDF.php" target="_blank" method="post" accept-charset="UTF-8">

        <select name="reportType" onclick="displayDateRangeForReport(this.selectedIndex)">
            <option value="llibre" >Per llibre</option>
            <option value="usuari" >Per usuari</option>
            <option value="periode">Per periode</option>
        </select>

        <div id="dateRangePeriodReport">
            Des de:
            <input type="date" name="dateSince">
            Fins:
            <input type="date" name="dateTo">
        </div>

        <button type="submit" style="width: auto">Generar informe</button>
    </form>
</div>

<?php include "footer.php"; ?>