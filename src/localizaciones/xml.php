<?php

include("../conexion.php");
 
$dom = new DomDocument('1.0','UTF-8');
$element = $dom->createElement('markers');
$dom->appendChild($element);
 
$sql = mysql_query("SELECT * FROM jquery_locations ORDER BY idMap DESC LIMIT 0,10 ");
 
while($row = mysql_fetch_assoc($sql)) {
  $marker = $dom->createElement('marker');
  $element->appendChild($marker);
  $marker->setAttribute('lat',$row["latitude"]);
  $marker->setAttribute('lng',$row["longitude"]);
  $marker->setAttribute('name',utf8_encode($row["name"]));
  $marker->setAttribute('created',utf8_encode($row["created"]));
}
 
echo $dom->saveXML();


?>