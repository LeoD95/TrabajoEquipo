<?php

$bd_host = "localhost";
$bd_usuario = "root";
$bd_password = "1234";
$bd_base = "bsistema_farmacia";
//$bd_base = "utltic2019";
//$bd_base = "utltic2019";

$conexion = mysql_connect($bd_host,$bd_usuario,$bd_password) ;
mysql_select_db($bd_base,$conexion)or die (mysql_error());
?>