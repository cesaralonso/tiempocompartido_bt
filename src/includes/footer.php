 <?php
 
///////////////////////////////////////////////// FOOTER


function footer(){
	
		
global $label;
?>

<div class="row">

  <? $ms=mysql_query("select cat_esp, cat_ing, idCat, descripcion, desc_ing, link, link_ing from categorias order by orden");
    while($r=mysql_fetch_array($ms)){
    $cat_esp[]=$r[0];
    $cat_ing[]=$r[1];
    $cat_id[]=$r[2];
    $cat_desc[]=$r[3];
    $cat_desc_ing[]=$r[4];
    $cat_link[]=$r[5];
    $cat_link_ing[]=$r[6];
    }

    if($_SESSION['idioma']=="ingles"){
    $cat = $cat_ing; 
    $desc = $cat_desc_ing;
    $link = $cat_link_ing;

    $cat2 = $cat_ing; 
    $desc2 = $cat_desc_ing;
    $link2 = $cat_link_ing;

    } else {
    $cat = $cat_esp;
    $desc = $cat_desc;
    $link = $cat_link;

    $cat2 = $cat_esp;
    $desc2 = $cat_desc;
    $link2 = $cat_link;
    }

    foreach($cat as $valor => $item){
    ?>

    <div class="col-md-3">

        <label style="text-transform:capitalize" title="<? echo $desc[$valor] ?>"><a href="<? echo "<?=HOST?>".$link2[$valor] ?>"><? echo $item ?></a>:</label>

        <? 
        if($_SESSION['idioma']=="ingles"){
        $query=mysql_query("SELECT seccion_ingles, link_ing, descripcion_ingles, id FROM secciones WHERE estado='activado' AND categoria='".$cat_id[$valor]."' ORDER BY posicion");
        } else {
        $query=mysql_query("SELECT seccion, link, descripcion, id FROM secciones WHERE estado='activado' AND categoria='".$cat_id[$valor]."' ORDER BY posicion");
        }

        while($rw = mysql_fetch_array($query)){
        $seccion = $rw[0];
        $link = $rw[1];
        $texto = $rw[2];
        $idSec=$rw[3];
        ?>
            <ul>
                <li style="text-transform:capitalize"><a title="<?=$texto?>" href="<?=HOST.$link?>" class="top_parent"><?=$seccion?></a>
                <? if($_SESSION['idioma']=="espanol"){
        @$query2 = mysql_query("SELECT subseccion,link FROM subsecciones WHERE seccion='".$idSec."'");
        } else {
        @$query2 = mysql_query("SELECT subseccion_ingles,link_ing FROM subsecciones WHERE seccion='".$idSec."'");
        }
        if($query2){
        ?>
                <ul>
                    <? while(@$rx = mysql_fetch_array($query2)){
        $subseccion = $rx[0];
        $link = $rx[1];
        ?>
                    <li class="top_parent"> <a href="<?=HOST.$link; ?>" class="<?=$class?>"> <?=$subseccion?></a>
                    <? @$query3 = mysql_query("SELECT * FROM subsubsecciones WHERE subseccion='".$subseccion."'");
        if($query3){
        ?>
                    <ul>
                        <? while(@$rxx = mysql_fetch_array($query3)){
        $subsubseccion = $rxx['subsubseccion'];	
        $subsubseccion_ingles = $rxx['subsubseccion_ingles'];	
            
        $link = $rxx['link'];	
        $link2 = $rxx['link_ing'];																	
        ?>
                        <li class="subsubmenu"> <a href="<?=HOST?><?=$link?>"><?=$subsubseccion?></a> </li>
                        <? } 
        ?>
                    </ul>
                    <? } //subsecciones?>
                    </li>
                    <? }
        ?>
                </ul>
                <? } //subsecciones?>
                </li>
            </ul>
            <? } ?>
    </div>
  <? } ?>
</div>


<div style="padding:10px; height:auto; width:auto;" class="ui-widget">
  <div style="clear:both; margin-top:25px; margin-bottom:25px; vertical-align:bottom" align="center">
    <label><? echo $label[$_SESSION['idioma']]['tiempocompartido.com - Todos los derechos reservados'] ?></label>
    <p align='center'><? //echo $label[$_SESSION['idioma']]['resolucion'] ?></p>
  </div>
  <div style="clear:both"></div>
  <h1 style='text-indent:-9999px;'>Sistema desarrollado por Cesar Alonso Magaña Gavilanes - contacto webmaster: cesar_alonso_m_g@hotmail.com</h1>
</div>
<? 

echo"<span style='visibility:hidden'>Sistema desarrollado por Cesar Alonso Magaña Gavilanes - contacto webmaster: cesar_alonso_m_g@hotmail.com</span>";


}
    
    
    