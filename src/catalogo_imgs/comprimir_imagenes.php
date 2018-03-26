<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>comprimir imagenes</title>
</head>

<body>

<?
//leer idMem's de membresias

//leer y guardar en arreglos las imagenes de cada idMem de files

// 

include("conexion.php");
$suma =0;


$sql="SELECT m.idMem, f.nombre
FROM  `files` AS f
INNER JOIN  `membresias` AS m
WHERE m.idMem = f.idMem";

$sql1=mysql_query($sql);

while($r=mysql_fetch_array($sql1)){
	
$item2=$r[1];

			
	   $original = imagecreatefromjpeg("admin/gallery/".$item2);
    
       $ancho = imagesx($original);
       $alto = imagesy($original); 
	   
	   if($ancho=="" && $alto==""){
		   $extra="ya no existe";
		   }
	   
	   
	   if($ancho>=700){
		   
		   $widthNew= 700;
		   }
	   else{
		  
  		$widthNew= $ancho; 
		   }

		
		$heightNew = $alto * $widthNew/$ancho;
	  
	  		
 $file = "admin/gallery/".$item2;
  $size = filesize($file);
  
  	echo $item2." -|- ".$widthNew."/".$ancho." -|- ".$heightNew."/".$alto." - ".$size." ====> ";
		
	$suma = $suma + $size;  	
  
	   

/*	   $xOriginal= imagecreatetruecolor($widthNew,$heightNew); 
       imagecopyresampled($xOriginal,$original,0,0,0,0,$widthNew,$heightNew,$ancho,$alto);
       imagejpeg($xOriginal,"catalogo_imgs/".$item2,60); 
	   */
	   
		 	echo " comprimida";
	unlink("admin/gallery/".$item2);
	
		echo " y eliminada ".$extra."<br>";
	
	}

	echo "<BR><BR>SUMA TOTAL = ".$suma;

?>


</body>
</html>