<?php

include("../conexion.php");
 

 
$sql = mysql_query("SELECT * FROM jquery_locations");
 
 $locacion = array();
while($row = mysql_fetch_array($sql)) {

	$locacion[] = $row;
	}

require_once('JSON.php'); // http://pear.php.net/pepr/pepr-proposal-show.php?id=198
$json = new Services_JSON();
echo $json->encode($locacion);
	


?>