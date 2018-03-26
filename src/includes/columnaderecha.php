 <?php
 
///////////////////////////////// PROMOCIONES




function publicidad_derecha(){

	
global $label;
global $publicidad;

    
     if(count($publicidad['index_der'])>=1){
  ?>
<div class="ui-widget-header ui-corner-top" style="padding:1px 0 1px 4px;">
  <label for="patrocinadores"><? echo $label[$_SESSION['idioma']]['patrocinadores'] ?></label>
</div>
<div id="publicidad" class="ui-widget-content ui-corner-bottom" style="height:auto; margin-bottom:15px; padding:3px 0 3px 0;" align="center">
  <? foreach($publicidad['index_der'] as $valor => $item){ ?>
  <div id="index_der" style="margin-bottom:4px"><a href="<? if($publicidad['index_der'][$valor]['link']!=""){ echo $publicidad['index_der'][$valor]['link']; } else { echo HOST."publicidad/".enlace($publicidad['index_der'][$valor]['titulo'])."/".$publicidad['index_der'][$valor]['id']."/"; } ?>" target="<? echo $publicidad['index_der'][$valor]['target'] ?>" title="<? echo ucwords($publicidad['index_der'][$valor]['titulo']."
	  ".$publicidad['index_der'][$valor]['descripcion']."
	   ".$publicidad['index_der'][$valor]['argumento']) ?>">
       <img src="<?=HOST?>galeria/publicidad/<? echo $publicidad['index_der'][$valor]['tamano']."/",$publicidad['index_der'][$valor]['imagen'] ?>" width="<? echo $publicidad['index_der'][$valor]['tamano'] ?>" height="<? echo $publicidad['index_der'][$valor]['alto'] ?>" alt="<? echo $publicidad['index_der'][$valor]['argumento'] ?>"  border="0" class="img-fluid"/>
       </a></div>
  <? } ?>
</div>
<? }

}



///////////////////////////////// PUBLICIDAD



function promociones(){
	
	
		
global $label;

	
		
$qr1 = mysql_query("SELECT * FROM promociones WHERE (lenguaje='".$_SESSION['idioma']."' OR lenguaje='') AND status='publicado' ORDER BY orden DESC");
		
$c=0;
while($rw1 = mysql_fetch_array($qr1)){
$promocion['columna_der'][$c]['id'] = $rw1['id'];
$promocion['columna_der'][$c]['fecha'] = $rw1['fecha'];
$promocion['columna_der'][$c]['imagen'] = $rw1['imagen'];
$promocion['columna_der'][$c]['tamano'] = $rw1['tamano'];
$promocion['columna_der'][$c]['espanol_titulo'] = $rw1['titulo'];
$promocion['columna_der'][$c]['ingles_titulo'] = $rw1['ingles_titulo'];
$promocion['columna_der'][$c]['alto'] = $rw1['alto'];
$promocion['columna_der'][$c]['link'] = $rw1['link'];
$promocion['columna_der'][$c]['ruta'] = $rw1['ruta'];
$promocion['columna_der'][$c]['espanol_argumento'] = $rw1['argumento'];
$promocion['columna_der'][$c]['ingles_argumento'] = $rw1['ingles_argumento'];
$promocion['columna_der'][$c]['target'] = $rw1['target'];

$c++;
}




	?>
<div class="ui-widget-header ui-corner-top" style="padding:1px 0 1px 4px;">
  <label for="promociones"><? echo $label[$_SESSION['idioma']]['promociones'] ?></label>
</div>
<div id="promociones" class="ui-widget-content ui-corner-bottom" style="min-height:230px; margin-bottom:15px; ">
  <div style="height:auto;z-index:0" align="center" id="s5"  class="pics ui-widget ui-state-default">
    <? if(count($promocion['columna_der'])>=1){
    foreach($promocion['columna_der'] as $valor => $item){
    ?>
    <div style="margin-bottom:0px; height:140px;"> <span style="margin-bottom:0px;"> <a href="<?=HOST?>seccion/promociones.php?idPromo=<? echo $promocion['columna_der'][$valor]['id']; ?>" target="<? echo $promocion['columna_der'][$valor]['target'] ?>" title="<? echo $promocion['columna_der'][$valor]['argumento'] ?>">
    <img src="<?=HOST?>galeria/promociones/<? echo $promocion['columna_der'][$valor]['tamano']."/",$promocion['columna_der'][$valor]['imagen'] ?>" width="<? echo $promocion['columna_der'][$valor]['tamano'] ?>" height="140" alt="<? echo $promocion['columna_der'][$valor]['argumento'] ?>" border="0" name="<? echo $promocion['columna_der'][$valor]['titulo'] ?>" class="img-fluid"/>
    </a> </span>
      <div style="margin-top:0px; padding:4px">
        <h2 style="margin-bottom:0px; font-size:15px; position:relative;"><a href="h<?=HOST?>seccion/promociones.php?idPromo=<? echo $promocion['columna_der'][$valor]['id']; ?>" target="<? echo $promocion['columna_der'][$valor]['target'] ?>" title="<? echo $promocion['columna_der'][$valor]['argumento'] ?>" style="text-decoration:none"><? echo $promocion['columna_der'][$valor][$_SESSION['idioma'].'_titulo'] ?></a></h2>
        <div style="background-color:#FFFFFF; padding:1px 2px 0 2px;">
          <h1 style="font-size:11px; position:relative;"><a href="<?=HOST?>seccion/promociones.php?idPromo=<? echo $promocion['columna_der'][$valor]['id']; ?>" target="<? echo $promocion['columna_der'][$valor]['target'] ?>" title="<? echo $promocion['columna_der'][$valor]['argumento'] ?>" style="text-decoration:none"><? echo $promocion['columna_der'][$valor][$_SESSION['idioma'].'_argumento'] ?></a></h1>
        </div>
      </div>
    </div>
    <? }
    }
    ?>
  </div>
</div>
<?
	}





	
	//////////////////////////////////////////  BOLSA DE TRABAJO
	

	
	function bolsa_de_trabajo(){ 
	
	
	global $label;
	
   ?>
<div class="ui-widget-header ui-corner-top" style="padding:1px 0 1px 4px;">
  <div style="float:left"> <? echo $label[$_SESSION['idioma']]['bolsa de trabajo'] ?> </div>
  <div style="float:right"><a type="application/rss+xml" href="<?=HOST?>rss/bolsadetrabajotiemposcompartidos.php" title="Suscribete a esta lista RSS"><img src="<?=HOST?>images/rss2.gif" border="0" alt="Suscribete a esta lista RSS" /></a></div>
  <div style="clear:both"></div>
</div>
<div style=" clear:both; min-height:15px; width:auto; padding:3px; margin:0px; margin-bottom:25px; overflow:hidden"  class="ui-widget-content ui-corner-bottom">
  <div style="padding:20px 2px 3px 3px; margin-bottom:25px;">
    <? $query1 = mysql_query("SELECT * FROM bolsa WHERE status='publicado' and destacar='destacado'");
	
while($r1=mysql_fetch_array($query1)){

?>
    <div style="width:98%; margin-bottom:5px; clear:both; padding-top:5px; padding-left:3px;" class="ui-widget-content ui-state-active">
      <div>
        <div>
          <div>
            <div style="text-transform:lowercase; text-transform:capitalize; font-size:13px"><strong><a href="<?=HOST?>seccion/bolsadetrabajo.php?seccion=Bolsa%20de%20Trabajo&idBol=<? echo $r1['idBol'] ?>" style="color:#003366; text-decoration:none"> <? echo htmlspecialchars($r1['categoria']); ?></a></strong></div>
          </div>
          <div align="left" style="font-weight:600"> <a href="<?=HOST?>seccion/bolsadetrabajo.php?seccion=Bolsa%20de%20Trabajo&idBol=<? echo $r1['idBol'] ?>" style="text-decoration:none"><? echo htmlspecialchars($r1['descripcion']); ?></a> </div>
          <div style="font-size:10px; clear:both; text-transform:capitalize" align="left"><? echo $label[$_SESSION['idioma']]['solicita'] ?>: <b><? echo htmlspecialchars($r1['empresa']); ?></b></div>
          <div style="font-size:9px; clear:both; text-transform:capitalizeh" align="right"><? echo $label[$_SESSION['idioma']]['ubicacion'] ?>: <b><? echo htmlspecialchars($r1['lugar']); ?></b></div>
        </div>
        <div style="clear:both">
          <div style="float:left"> </div>
        </div>
      </div>
      <div style="clear:both; margin-top:8px"></div>
    </div>
    <? }
?>
  </div>
  <div style="padding:1px; width:85%; float:left" align="right"><a href="<?=HOST?>seccion/bolsadetrabajo.php?seccion=Bolsa%20de%20Trabajo" title="<? echo $label[$_SESSION['idioma']]['bolsa de trabajo'] ?>"><? echo $label[$_SESSION['idioma']]['ver lista completa'] ?></a></div>
</div>
<? }







	//////////////////////////////////////////  MEMBRESIAS MAS VISITADAS
	
	
	function membresias_mas_visitadas(){ 
	
	global $label;
	
	?>

<div class="card bg-light mb-3" style="">
    <div class="card-header"> 
        <div style="float:left">
            <label for="lo mas visitado"><? echo $label[$_SESSION['idioma']]['lo mas visitado'] ?></label>
        </div>
        <div style="float:right"><a type="application/rss+xml" href="<?=HOST?>rss/suscripcion-tiempos-compartidos-mas-visitados.php" title="Suscribete a esta lista RSS"><img src="<?=HOST?>images/rss2.gif" border="0" alt="Suscribete a esta lista RSS" /></a></div>
        <div style="clear:both"></div>
    </div>
    <div class="card-body">

        <? $query1 = mysql_query("SELECT * FROM membresias, visitas WHERE membresias.idMem = visitas.idMem AND status='publicado' ORDER BY visitas.cont DESC LIMIT 0,5");
        
        while(@$r1=mysql_fetch_array($query1)){
            if($r1['idMem']!=$_GET['id']){
        ?>

        <div class="card" style="">
            <div class="card-body">
                <div class="row">
                    <div class="col-4">
                    <? 
                    $query_f1=mysql_query("SELECT nombre, comentario FROM files WHERE idMem = '$r1[idMem]' LIMIT 0,1");
                    $foto1 = mysql_num_rows($query_f1);
                    if($foto1>=1){
                        while($ff=mysql_fetch_array($query_f1)){
                    ?>
                        <a href="<?=enlace_cont($r1['pais'],$r1['ciudad'],$r1['club'],$r1['idMem'])?>" title="<? echo $r1['info_adicional'] ?>"> 
                            <img src="<?=HOST?>admin/gallery/60/<? echo $ff[0]; ?>"  alt="<? echo $ff[0]  ?>" width="60" border="0"/>
                        </a>
                    <? 
                        }
                    } 
                    ?>
                    </div>
                    <div class="col-8">
                        <h4 class="card-title" style="text-transform:lowercase; text-transform:capitalize; font-size:11px">
                            <a href="<?=enlace_cont($r1['pais'],$r1['ciudad'],$r1['club'],$r1['idMem'])?>" style="color:#003366; text-decoration:none"> <? echo ucwords(strtolower($r1['club'])); ?></a>
                        </h4>
                        <p class="card-text" style="font-size:9px" align="right">
                            <a href="<?=enlace_cont($r1['pais'],$r1['ciudad'],$r1['club'],$r1['idMem'])?>" style="color:#333; text-decoration:none;" ><b><? echo ucwords($r1['pais']) ?> > <? echo ucwords(strtolower($r1['ciudad'])); ?></b></a>
                        </p>
                        <div>
                            <a href="<?=enlace_cont($r1['pais'],$r1['ciudad'],$r1['club'],$r1['idMem'])?>"  style="color:#d50; text-decoration:none;" > 
                                <strong>
                                    <span style="font-size:9px">

                                        <? if($r1['venta']=="1"){ ?>
                                            <div style="float:left; padding-right:7px; margin-right:7px;">
                                            <div style="margin-right:0px; padding:0px; font-size:11px;"><? echo $label[$_SESSION['idioma']]['venta'] ?> $ <? echo number_format($r1['precio_venta']); ?> <span style="font-size:9px">
                                                <? if($r1['moneda_venta']=="Dolares" or $r1['moneda_venta']=="Dolares US")echo $label[$_SESSION['idioma']]['Dolares'];
                                            if($r1['moneda_venta']=="Pesos Mexicanos")echo $label[$_SESSION['idioma']]['Pesos Mexicanos']; 			
                                            if($r1['moneda_venta']=="Euros")echo $label[$_SESSION['idioma']]['Euros']; 
                                            if($r1['moneda_venta']=="Puntos")echo $label[$_SESSION['idioma']]['Puntos']; 
                                            ?>
                                                </span></div>
                                            </div>
                                        <? } ?>
                                        <? if($r1['renta']=="1"){ ?>
                                            <div style="float:left; padding-right:7px; margin-right:7px;">
                                            <div style="margin-right:0px; padding:0px; font-size:11px"><? echo $label[$_SESSION['idioma']]['renta'] ?> $<? echo number_format($r1['precio_renta']); ?> <span style="font-size:9px">
                                                <? if($r1['moneda_renta']=="Dolares")echo $label[$_SESSION['idioma']]['Dolares'];
                                            if($r1['moneda_renta']=="Pesos Mexicanos")echo $label[$_SESSION['idioma']]['Pesos Mexicanos']; 			
                                            if($r1['moneda_renta']=="Euros")echo $label[$_SESSION['idioma']]['Euros']; 
                                            if($r1['moneda_renta']=="Puntos")echo $label[$_SESSION['idioma']]['Puntos']; 
                                            ?>
                                                </span></div>
                                            </div>
                                        <? } ?>
                                        <? if($r1['intercambio']=="1"){ ?>
                                            <div style="float:left; padding-right:7px; margin-right:7px;">
                                            <div style="margin-right:0px; padding:0px; font-size:11px; float:left;"><? echo $label[$_SESSION['idioma']]['intercambio'] ?>: </div>
                                            <div style="color:333; float:left;"><? echo $r1['destino_inter']; ?></div>
                                            <div style="clear:both"></div>
                                            </div>
                                            <div style="clear:both"></div>
                                        <? } ?>

                                    </span>
                                </strong>
                            </a>
                        </div>
                    </div>
                    <div class="col-12">
                        <div style="float:right; color:#333333; font-size:10px"><? echo $label[$_SESSION['idioma']]['dorms'] ?>: <strong><? echo $r1['dormitorios']; ?></strong> | <? echo $label[$_SESSION['idioma']]['cap'] ?>: <strong><? echo $r1['cap_max']; ?></strong></div>
                    </div>
                </div>
            </div>
        </div>
        <? } 
        } ?>

        <div class="row">
            <div style="padding:1px; width:85%; float:left" align="right">
                <a href="<?=HOST?>seccion/tiempos-compartidos-mas-visitados.php?seccion=tiempos-compartidos-mas-visitados" title="listado de tiempos compartidos mas visitados"> <? echo $label[$_SESSION['idioma']]['ver lista completa'] ?></a>
            </div>
        </div>
    </div>
</div>

<? }




/////////////////////// PAGINAS AMIGAS


function paginas_amigas(){
	
global $label;


$qx=mysql_query("SELECT * FROM enlaces WHERE status='publicado' and (lenguaje='$_SESSION[idioma]' or lenguaje='') ORDER BY destacar,orden DESC");
	$x=mysql_num_rows($qx);
	if($x>=1){
	?>
<div class="ui-widget-header ui-corner-top" style="padding:1px 0 1px 4px;">
  <label for="paginas amigas"><? echo $label[$_SESSION['idioma']]['paginas amigas'] ?></label>
</div>
<div id="enlaces" class="ui-widget-content ui-corner-bottom" style="height:auto; margin-bottom:15px; padding:3px; " align="left">
  <table>
    <? while($rx=mysql_fetch_array($qx)){
	 if($_SESSION['idioma']=="ingles"){ $desc=$rx['descripcion_ing']; } else { $desc=$rx['descripcion']; }
    ?>
    <tr <? if($rx['destacar']=="destacado"){ ?>bgcolor="#FFFFCC"<? } ?>>
      <td class="ui-widget ui-state-active" style="padding:1px; font-size:14px"><a href="<? echo $rx['enlace'] ?>" title="<? echo $desc ?>" target="_blank" style="text-decoration:none">
        <? if($rx['imagen']!=""){ ?>
        <img src="<?php echo HOST; ?>galeria/logos/48/<? echo $rx['imagen'] ?>" border="0" width="48" alt="<? echo $rx['nombre'] ?>" />
        <? } ?>
        </a></td>
      <td><a href="<? echo $rx['enlace'] ?>" title="<? echo $desc ?>" target="_blank" style="text-decoration:none"><? echo $rx['nombre'] ?></a></td>
    </tr>
    <? } ?>
  </table>
</div>
<? } 
 }
 

  
  /////////////////////// OTRAS SECCIONES


function otras_secciones(){
	
global $label;

  
    $query=mysql_query("SELECT * FROM secciones WHERE estado='activado' AND categoria='derecha' ORDER BY posicion");
	$c=mysql_num_rows($query);
	if($c>=1){
	?>
<div class="ui-widget-header ui-corner-top" style="padding:1px 0 1px 4px;">
  <label for="documentos"><? echo $label[$_SESSION['idioma']]['documentos'] ?></label>
</div>
<div id="documentos" class="ui-widget-content ui-corner-bottom" style="height:auto; margin-bottom:15px; ">
  <? while($rw = mysql_fetch_array($query)){
    $seccion = $rw['seccion'];
    $link = $rw['link'];
    $texto = $rw['descripcion'];
    ?>
  <ul style="list-style:square; line-height:7px">
    <li><a title="<? echo"$texto"; ?>" href="<?=HOST?><? echo"$link"; ?>" class="top_parent"><? echo"$seccion"; ?></a>
      <ul>
        <? $query2 = mysql_query("SELECT * FROM subsecciones WHERE seccion='$seccion'");
    while($rx = mysql_fetch_array($query2)){
    $subseccion = $rx['subseccion'];
    $link = $rx['link'];
    ?>
        <li class="top_parent"> <a href="<?=HOST?><? echo"$link"; ?>" class="<? echo"$class"; ?>"> <? echo"$subseccion"; ?></a>
          <ul>
            <? $query3 = mysql_query("SELECT * FROM subsubsecciones WHERE subseccion='$subseccion'");
    while($rxx = mysql_fetch_array($query3)){
    $subsubseccion = $rxx['subsubseccion'];		
    $link = $rxx['link'];																	
    ?>
            <li class="subsubmenu"> <a href="<?=HOST?><? echo"$link"; ?>"><? echo"$subsubseccion"; ?></a> </li>
            <? } 
    ?>
          </ul>
        </li>
        <? }
    ?>
      </ul>
    </li>
  </ul>
  <? }
    ?>
</div>
<? }
  
		  
}
 
 



 
 
 //////////////////////////  MEMBRESIAS RELACIONADAS
 
 
 function membresias_relacionadas(){
	 
	 global $label;
	 ?>

<div class="card bg-light mb-3" style="">
    <div class="card-header"> 
        <label for="membresias relacionada"><? echo ucwords($label[$_SESSION['idioma']]['membresias relacionadas']) ?></label>
    </div>
    <div class="card-body">

        <? $query1=mysql_query("SELECT * FROM membresias WHERE ciudad = '".str_replace('-', ' ', $_GET['it_cd'])."' AND  pais = '".str_replace('-', ' ', $_GET['it_pais'])."' AND status='publicado' ORDER BY fecha DESC LIMIT 0,5");
        while($r1=mysql_fetch_array($query1)){
            if($r1['idMem']!=$_GET['id']){
        ?>

        <div class="card" style="">
            <div class="card-body">
                <div class="row">
                    <div class="col-4">
                    <? 
                    $query_f1=mysql_query("SELECT nombre, comentario FROM files WHERE idMem = '$r1[idMem]' LIMIT 0,1");
                    $foto1 = mysql_num_rows($query_f1);
                    if($foto1>=1){
                        while($ff=mysql_fetch_array($query_f1)){
                    ?>
                        <a href="<?=enlace_cont($r1['pais'],$r1['ciudad'],$r1['club'],$r1['idMem'])?>" title="<? echo $r1['info_adicional'] ?>"> 
                            <img src="<?=HOST?>admin/gallery/60/<? echo $ff[0]; ?>"  alt="<? echo $ff[0]  ?>"  class="img-fluid" border="0"/>
                        </a>
                    <? 
                        }
                    } 
                    ?>
                    </div>
                    <div class="col-8">
                        <h4 class="card-title" style="text-transform:lowercase; text-transform:capitalize; font-size:11px">
                            <a href="<?=enlace_cont($r1['pais'],$r1['ciudad'],$r1['club'],$r1['idMem'])?>" style="color:#003366; text-decoration:none"> <? echo ucwords(strtolower($r1['club'])); ?></a>
                        </h4>
                        <p class="card-text" style="font-size:9px" align="right">
                            <a href="<?=enlace_cont($r1['pais'],$r1['ciudad'],$r1['club'],$r1['idMem'])?>" style="color:#333; text-decoration:none;" ><b><? echo ucwords($r1['pais']) ?> > <? echo ucwords(strtolower($r1['ciudad'])); ?></b></a>
                        </p>
                        <div>
                            <a href="<?=enlace_cont($r1['pais'],$r1['ciudad'],$r1['club'],$r1['idMem'])?>"  style="color:#d50; text-decoration:none;" > 
                                <strong>
                                    <span style="font-size:9px">

                                        <? if($r1['venta']=="1"){ ?>
                                            <div style="float:left; padding-right:7px; margin-right:7px;">
                                            <div style="margin-right:0px; padding:0px; font-size:11px;"><? echo $label[$_SESSION['idioma']]['venta'] ?> $ <? echo number_format($r1['precio_venta']); ?> <span style="font-size:9px">
                                                <? if($r1['moneda_venta']=="Dolares" or $r1['moneda_venta']=="Dolares US")echo $label[$_SESSION['idioma']]['Dolares'];
                                            if($r1['moneda_venta']=="Pesos Mexicanos")echo $label[$_SESSION['idioma']]['Pesos Mexicanos']; 			
                                            if($r1['moneda_venta']=="Euros")echo $label[$_SESSION['idioma']]['Euros']; 
                                            if($r1['moneda_venta']=="Puntos")echo $label[$_SESSION['idioma']]['Puntos']; 
                                            ?>
                                                </span></div>
                                            </div>
                                        <? } ?>
                                        <? if($r1['renta']=="1"){ ?>
                                            <div style="float:left; padding-right:7px; margin-right:7px;">
                                            <div style="margin-right:0px; padding:0px; font-size:11px"><? echo $label[$_SESSION['idioma']]['renta'] ?> $<? echo number_format($r1['precio_renta']); ?> <span style="font-size:9px">
                                                <? if($r1['moneda_renta']=="Dolares")echo $label[$_SESSION['idioma']]['Dolares'];
                                            if($r1['moneda_renta']=="Pesos Mexicanos")echo $label[$_SESSION['idioma']]['Pesos Mexicanos']; 			
                                            if($r1['moneda_renta']=="Euros")echo $label[$_SESSION['idioma']]['Euros']; 
                                            if($r1['moneda_renta']=="Puntos")echo $label[$_SESSION['idioma']]['Puntos']; 
                                            ?>
                                                </span></div>
                                            </div>
                                        <? } ?>
                                        <? if($r1['intercambio']=="1"){ ?>
                                            <div style="float:left; padding-right:7px; margin-right:7px;">
                                            <div style="margin-right:0px; padding:0px; font-size:11px; float:left;"><? echo $label[$_SESSION['idioma']]['intercambio'] ?>: </div>
                                            <div style="color:333; float:left;"><? echo $r1['destino_inter']; ?></div>
                                            <div style="clear:both"></div>
                                            </div>
                                            <div style="clear:both"></div>
                                        <? } ?>

                                    </span>
                                </strong>
                            </a>
                        </div>
                    </div>
                    <div class="col-12">
                        <div style="float:right; color:#333333; font-size:10px"><? echo $label[$_SESSION['idioma']]['dorms'] ?>: <strong><? echo $r1['dormitorios']; ?></strong> | <? echo $label[$_SESSION['idioma']]['cap'] ?>: <strong><? echo $r1['cap_max']; ?></strong></div>
                    </div>  
                </div>
            </div>
        </div>
    <? } 
    } ?>
    </div>
</div>

<?
 }
 
 