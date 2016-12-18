<?php
/**
 * Created by PhpStorm.
 * User: Aaron
 * Date: 18/12/2016
 * Time: 0:25
 */

require_once "../src/Prestecs.php";

$prestecs = new Prestecs();
$prestecs->retornar($_POST['idCataleg']);