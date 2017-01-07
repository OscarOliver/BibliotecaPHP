<?php include "header.php"; ?>

<div id="content">
    <form action="prestecs.php" method="post" accept-charset="UTF-8" style="width: 200px">

        <select name="filtrePrestec" onclick="displayUserSelection(this.selectedIndex)">
            <option id="prestecsActius" value="prestecsActius" >Prestecs actius</option>
            <option id="prestecsUsuari" value="prestecsUsuari" >Prestecs per usuari</option>
            <option id="historialPrestecs" value="historialPrestecs">Historial de prestecs</option>
        </select>

        <div id="seleccionarUsuari">
            <input list="usuaris" name="usuari" placeholder="Usuari">
            <datalist id="usuaris">
                <?php
                require_once ("../src/DBConnection.php");
                $link = DBConnection::getConnection();
                // Comprovar la connexió, si no pot connectar-se donara error
                if ($link === false) die("Die");

                $sql = "SELECT id, LPAD(id,5,'0') 'idUsuari', nom, cognom FROM usuari";

                $results = mysqli_query($link, $sql);

                while ($row = $results->fetch_array()) {
                    echo "<option value='".$row['id']."' ";
                    echo "label='".$row['nom']." ".$row['cognom']." - ".$row['idUsuari'];
                    echo "'>";
                }
                ?>
            </datalist>
        </div>

        <button type="submit" style="width: auto">Mostrar</button>
    </form>

    <table>
        <thead>
        <tr>
            <th style="width: 3px; background-color: transparent"></th>
            <th>Data prestec</th>
            <th>Data devolucio</th>
            <th>Id cataleg</th>
            <th>Llibre</th>
            <th>Usuari</th>
            <thstyle="background-color: transparent"></th>
        </tr>
        </thead>
        <tbody>
        <?php
        require_once ("../src/DBConnection.php");
        $link = DBConnection::getConnection();
        if ($link === false) die("Die");
        $sql = "SELECT prestecs.id 'id', now() 'now', dataPrestec, dataMaxDevolucio, dataDevolucio, idCataleg, llibre.titol, usuari.nom, usuari.cognom
                FROM prestecs, usuari, cataleg, llibre
                WHERE prestecs.idUsuari = usuari.id AND prestecs.idCataleg = cataleg.id AND cataleg.idLlibre = llibre.id
                ORDER BY dataPrestec DESC";
        $results = mysqli_query($link, $sql);
        while ($row = $results->fetch_array()) {
            echo "<tr onclick=\"window.document.location='prestecs.php?id=".$row['id']."'\" style='cursor: pointer';>";
            if ($row['dataDevolucio'] == null && $row['dataMaxDevolucio'] < $row['now'])
                echo "<td style='background-color: red'></td>";
            elseif ($row['dataDevolucio'] == null)
                echo "<td style='background-color: orange'></td>";
            else
                echo "<td style='background-color: green'></td>";
            echo "<td>".$row['dataPrestec']."</td>";
            if ($row['dataDevolucio'] == null)
                echo "<td>".$row['dataMaxDevolucio']."</td>";
            else
                echo "<td>".$row['dataDevolucio']."</td>";
            echo "<td>".$row['idCataleg']."</td>";
            echo "<td>".$row['titol']."</td>";
            echo "<td>".$row['nom']." ".$row['cognom']."</td>";
            echo "<td><a href='./prestecs.php?prestecId=".$row['id']."'>Edit</a></td>";
            echo "</tr>";
        }
        ?>
        </tbody>
    </table>

</div>

<?php include "footer.php"; ?>