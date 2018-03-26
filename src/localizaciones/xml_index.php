<?php

include("../conexion.php");
 
require_once('JSON.php'); // http://pear.php.net/pepr/pepr-proposal-show.php?id=198
$json = new Services_JSON();
 
$sql = mysql_query("SELECT * FROM jquery_locations");
 
 $locacion = array();
while($row = mysql_fetch_array($sql)) {

	$locacion[] = $row;
	}


echo $json->encode($locacion);
	


?>