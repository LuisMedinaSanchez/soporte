<?php
/**
 * @author evilnapsis
 * */
define("ROOT", dirname(__FILE__)); //Se define la ruta de los archivos

$debug = false;
if ($debug) {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}

include "core/autoload.php"; //se incluyen todos los archivos para navegar en el sistema

ob_start();
session_start();
Core::$root = "";

// si quieres que se muestre las consultas SQL debes decomentar la siguiente linea
//Core::$debug_sql = true;

$lb = new Lb();
$lb->start();

?>