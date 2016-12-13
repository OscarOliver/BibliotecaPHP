<?php
/**
 * Created by PhpStorm.
 * User: alumne
 * Date: 13/12/16
 * Time: 16:48
 */
require_once ("../src/Usuari.php");
$usuari = new Usuari($_POST['nom'], $_POST['cognoms'], $_POST['dni'], $_POST['direccio'], $_POST['poblacio'],
                     $_POST['provincia'], $_POST['pais'], $_POST['email'], $_POST['telefon'], "1992-03-02");

//$usuari = new Usuari("Oscar", "Oliver Obiol", "47822130R", "C/ Estel, 28", "Amposta", "Tarragona", "Catalunya",
//                     "oscaroliver@iesmontsia.org", "664369592", "1992-03-02");

$usuari->guardar();