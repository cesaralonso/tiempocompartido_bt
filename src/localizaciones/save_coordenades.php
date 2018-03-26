<html>
<head>
<?php
include("../conexion.php");
$query = mysql_query("select * from jquery_locations where idUser=1");
$count = mysql_num_rows($query);
if ($count==0)
{
mysql_query("INSERT INTO jquery_locations(`name`,`latitude`,`longitude`) VALUES ('$_POST[name]','$_POST[lat]','$_POST[lng]')");
 
}
else {
mysql_query("UPDATE jquery_locations SET name='$_POST[name]',latitude='$_POST[lat]',longitude='$_POST[lng]' WHERE idUser=1");
 }
?>
</head>
<body>

<script language='javascript'>

window.location.href='index.php';
</script>
</body>
</html>

