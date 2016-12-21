<?php include "header.php";
/*Taula llibres*/
require_once "../src/Llibre.php";
require_once "../src/Autor.php";
echo "<table id='infoLlibres' class='center'>";
    echo "<tr><th>Titol</th><th>Autor</th><th>Genere</th><th>ISBN</th><th>Editorial</th><th>Num Edicio</th><th>Lloc publicacio</th><th>Any edicio</th><th>Quantitat</th></tr>";
    $res = Llibre::resumLlibre();
    $autorRes = Autor::get();
    while ($row = $res->fetch_array()){
    echo "
    <tr>
        <td>".$row['titol']."</td>
        <td>".$row['nom']."</td>
        <td>".$row['genere']."</td>
        <td>".$row['ISBN']."</td>
        <td>".$row['editorial']."</td>
        <td>".$row['numEdicio']."</td>
        <td>".$row['llocPublicacio']."</td>
        <td>".$row['anysEdicio']."</td>
        <td>".$row['quantitat']."</td>
    </tr>";
    }
    echo "
<form action=''>
    <tr>
        <td><input type='text' name='titol' placeholder='Titol'></td>
        <td>
            <select title='Autors'>";
              while ($row = $autorRes ->fetch_array()){
                echo "<option>".$row['nom']."</option>";
              };
            echo "</select>   
        </td>
        <td><input type='text' name='genere' placeholder='Genere'></td>
        <td><input type='text' name='isbn' placeholder='ISBN'></td>
        <td><input type='text' name='editorial' placeholder='Editorial'></td>
        <td><input type='number' name='numEdicio' placeholder='Num. edició'></td>
        <td><input type='text' name='llocPublicacio' placeholder='Lloc publicació'></td>
        <td><input type='number' name='anyEdicio' placeholder='Any de edició del llibre'></td>
        <td><input type='number' name='Quantitat' placeholder='Any de publicació del llibre'></td>
    </tr>
</form>";
    echo "</table>";
 include "footer.php"; ?>
