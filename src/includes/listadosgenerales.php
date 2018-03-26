 <?php
 
///////////////////////////////// LISTADOS GENERALES





function listadosgenerales($listado){

	
    global $label;


    if ($listado === 'Listados De Rentas Vacacionales En Todo El Mundo.php') {

 ?>



    <style type="text/css">
    #listas_abajo  {
    text-transform:capitalize;
    font-size:smaller;
    background-color:#eef
    }

    </style>

    <h4 style="text-transform:capitalize" title="<?php echo $desc[$valor] ?>"><?php echo ucwords($label[$_SESSION['idioma']]['Listados Principales']) ?>: </h4>		
    <div style="width:95%; padding:10px; height:auto; overflow:auto;" align="left">	

    <div>


    <ul id="listas_abajo" class="ui-widget ui-corner-all">
    <?php 

    $consulta=mysql_query("SELECT titulo_esp,titulo_ing,link_esp,link_ing,pagina_esp,pagina_ing,desc_esp,desc_ing FROM listas_especiales WHERE listado='listadosprincipales' ORDER BY orden");
    while($ww=mysql_fetch_array($consulta)){

    $titulo_esp = $ww[0]; 
    $link_esp = $ww[2]; 
    $pagina_esp = $ww[4]; 
    $desc_esp = $ww[6]; 

    $titulo_ing =$ww[1]; 
    $link_ing = $ww[3]; 
    $pagina_ing = $ww[5]; 
    $desc_ing = $ww[7]; 
    ?>

    <?php if($_SESSION['idioma']=="espanol"){?>
    <li><a href="<?php echo $link_esp ?>" title="<?php echo $desc_esp ?>"><?php echo $titulo_esp ?></a></li>
    <?php } else {  ?>
    <li style="padding-left:10px;"><a href="<?php echo $link_ing ?>" title="<?php echo $desc_ing ?>" style="text-decoration:none; color:#666666"><?php echo $titulo_ing ?></a></li>
    <?php
    }
    }
    ?>
    </ul>
    </div>
    </div>



    <h4 style="text-transform:capitalize" title="<?php echo $desc[$valor] ?>"><?php echo ucwords($label[$_SESSION['idioma']]['Listados por Clubes']) ?>: </h4>
    <div style="width:95%; padding:10px; height:auto; overflow:auto;" align="left">	

    <div>


    <ul id="listas_abajo" class="ui-widget ui-corner-all">
    <?php 


    $consulta=mysql_query("SELECT
    *
    FROM (
    (select titulo_esp,titulo_ing,link_esp,link_ing,pagina_esp,pagina_ing,desc_esp,desc_ing FROM listas_especiales WHERE listado='clubes')
    ) as tabla
    ORDER BY tabla.titulo_esp ASC");


    while($ww=mysql_fetch_array($consulta)){

    $titulo_esp = $ww[0]; 
    $link_esp = $ww[2]; 
    $pagina_esp = $ww[4]; 
    $desc_esp = $ww[6]; 

    $titulo_ing =$ww[1]; 
    $link_ing = $ww[3]; 
    $pagina_ing = $ww[5]; 
    $desc_ing = $ww[7]; 
    ?>

    <?php if($_SESSION['idioma']=="espanol"){?>
    <li><a href="<?php echo $link_esp ?>" title="<?php echo $desc_esp ?>"><?php echo $titulo_esp ?></a></li>
    <?php } else {  ?>
    <li style="padding-left:10px;"><a href="<?php echo $link_ing ?>" title="<?php echo $desc_ing ?>" style="text-decoration:none; color:#666666"><?php echo $titulo_ing ?></a></li>
    <?php
    }
    }
    ?>
    </ul>
    </div>
    </div>



    <h4 style="text-transform:capitalize" title="<?php echo $desc[$valor] ?>"><?php echo ucwords($label[$_SESSION['idioma']]['Listados por Paises']) ?>: </h4>
    <div style="width:auto; padding:10px;; height:auto; overflow:auto;" align="left">	

    <div>


    <ul id="listas_abajo" class="ui-widget ui-corner-all">
    <?php 



    $consulta=mysql_query("SELECT
    *
    FROM (
    (select titulo_esp,titulo_ing,link_esp,link_ing,pagina_esp,pagina_ing,desc_esp,desc_ing FROM listas_especiales WHERE listado='paises')
    ) as tabla
    ORDER BY tabla.titulo_esp ASC");
    while($ww=mysql_fetch_array($consulta)){

    $titulo_esp = $ww[0]; 
    $link_esp = $ww[2]; 
    $pagina_esp = $ww[4]; 
    $desc_esp = $ww[6]; 

    $titulo_ing =$ww[1]; 
    $link_ing = $ww[3]; 
    $pagina_ing = $ww[5]; 
    $desc_ing = $ww[7]; 
    ?>


    <?php if($_SESSION['idioma']=="espanol"){?>
    <li><a href="<?php echo $link_esp ?>" title="<?php echo $desc_esp ?>"><?php echo $titulo_esp ?></a></li>
    <?php } else {  ?>
    <li style="padding-left:10px;"><a href="<?php echo $link_ing ?>" title="<?php echo $desc_ing ?>" style="text-decoration:none; color:#666666"><?php echo $titulo_ing ?></a></li>
    <?php
    }
    }
    ?>
    </ul>
    </div>
    </div>



    <h4 style="text-transform:capitalize" title="<?php echo $desc[$valor] ?>"><?php echo ucwords($label[$_SESSION['idioma']]['Listados por Ciudades']) ?>: </h4>
    <div style="width:auto; padding:10px;; height:auto; overflow:auto;" align="left">
    
    <div>
        <ul id="listas_abajo" class="ui-widget ui-corner-all">
        <?php 



    $consulta=mysql_query("SELECT
    *
    FROM (
    (select titulo_esp,titulo_ing,link_esp,link_ing,pagina_esp,pagina_ing,desc_esp,desc_ing FROM listas_especiales WHERE listado='ciudades')
    ) as tabla
    ORDER BY tabla.titulo_esp ASC");
    while($ww=mysql_fetch_array($consulta)){

    $titulo_esp = $ww[0]; 
    $link_esp = $ww[2]; 
    $pagina_esp = $ww[4]; 
    $desc_esp = $ww[6]; 

    $titulo_ing =$ww[1]; 
    $link_ing = $ww[3]; 
    $pagina_ing = $ww[5]; 
    $desc_ing = $ww[7]; 
    ?>
        <?php if($_SESSION['idioma']=="espanol"){?>
        <li><a href="<?php echo $link_esp ?>" title="<?php echo $desc_esp ?>"><?php echo $titulo_esp ?></a></li>
        <?php } else {  ?>
        <li style="padding-left:10px;"><a href="<?php echo $link_ing ?>" title="<?php echo $desc_ing ?>" style="text-decoration:none; color:#666666"><?php echo $titulo_ing ?></a></li>
        <?php
        } 
    }
    ?>
        </ul>
    </div>
    </div>



    <h4 style="text-transform:capitalize" title="<?php echo $desc[$valor] ?>"><?php echo ucwords($label[$_SESSION['idioma']]['Listados por Unidades']) ?>: </h4>
    <div style="width:95%; padding:10px; height:auto; margin-bottom:25px" align="left">	

    <div>

    <?php echo ucwords($label[$_SESSION['idioma']]['en renta']) ?>
    <ul id="listas_abajo" style="height:auto; overflow:auto;" class="ui-widget ui-corner-all">
    <?php 



    $consultass=mysql_query("SELECT
    *
    FROM (
    (select titulo_esp,titulo_ing,link_esp,link_ing,pagina_esp,pagina_ing,desc_esp,desc_ing FROM listas_especiales WHERE listado='unidad_enrenta')
    ) as tabla
    ORDER BY tabla.titulo_esp ASC");
    while($ww=mysql_fetch_array($consultass)){

    $titulo_esp = $ww[0]; 
    $link_esp = $ww[2]; 
    $pagina_esp = $ww[4]; 
    $desc_esp = $ww[6]; 

    $titulo_ing =$ww[1]; 
    $link_ing = $ww[3]; 
    $pagina_ing = $ww[5]; 
    $desc_ing = $ww[7]; 
    ?>

    <?php if($_SESSION['idioma']=="espanol"){?>
    <li><a href="<?php echo $link_esp ?>" title="<?php echo $desc_esp ?>"><?php echo $titulo_esp ?></a></li>
    <?php } else {  ?>
    <li style="padding-left:10px;"><a href="<?php echo $link_ing ?>" title="<?php echo $desc_ing ?>" style="text-decoration:none; color:#666666"><?php echo $titulo_ing ?></a></li>
    <?php
    }
    }
    ?>
    </ul>



    <?php echo ucwords($label[$_SESSION['idioma']]['en venta']) ?>
    <ul id="listas_abajo" style="height:auto; overflow:auto;" class="ui-widget ui-corner-all">
    <?php 



    $consultass=mysql_query("SELECT
    *
    FROM (
    (select titulo_esp,titulo_ing,link_esp,link_ing,pagina_esp,pagina_ing,desc_esp,desc_ing FROM listas_especiales WHERE listado='unidad_enventa')
    ) as tabla
    ORDER BY tabla.titulo_esp ASC");
    while($ww=mysql_fetch_array($consultass)){

    $titulo_esp = $ww[0]; 
    $link_esp = $ww[2]; 
    $pagina_esp = $ww[4]; 
    $desc_esp = $ww[6]; 

    $titulo_ing =$ww[1]; 
    $link_ing = $ww[3]; 
    $pagina_ing = $ww[5]; 
    $desc_ing = $ww[7]; 
    ?>
    <?php if($_SESSION['idioma']=="espanol"){?>
    <li><a href="<?php echo $link_esp ?>" title="<?php echo $desc_esp ?>"><?php echo $titulo_esp ?></a></li>
    <?php } else {  ?>
    <li style="padding-left:10px;"><a href="<?php echo $link_ing ?>" title="<?php echo $desc_ing ?>" style="text-decoration:none; color:#666666"><?php echo $titulo_ing ?></a></li>
    <?php
    }
    }
    ?>
    </ul>

    <?php echo ucwords($label[$_SESSION['idioma']]['en intercambio']) ?>
    <ul id="listas_abajo" style="height:auto; overflow:auto;" class="ui-widget ui-corner-all">
    <?php 


    $consultass=mysql_query("SELECT
    *
    FROM (
    (select titulo_esp,titulo_ing,link_esp,link_ing,pagina_esp,pagina_ing,desc_esp,desc_ing FROM listas_especiales WHERE listado='unidad_enintercambio')
    ) as tabla
    ORDER BY tabla.titulo_esp ASC");
    while($ww=mysql_fetch_array($consultass)){

    $titulo_esp = $ww[0]; 
    $link_esp = $ww[2]; 
    $pagina_esp = $ww[4]; 
    $desc_esp = $ww[6]; 

    $titulo_ing =$ww[1]; 
    $link_ing = $ww[3]; 
    $pagina_ing = $ww[5]; 
    $desc_ing = $ww[7]; 
    ?>

    <?php if($_SESSION['idioma']=="espanol"){?>
    <li><a href="<?php echo $link_esp ?>" title="<?php echo $desc_esp ?>"><?php echo $titulo_esp ?></a></li>
    <?php } else {  ?>
    <li style="padding-left:10px;"><a href="<?php echo $link_ing ?>" title="<?php echo $desc_ing ?>" style="text-decoration:none; color:#666666"><?php echo $titulo_ing ?></a></li>
    <?php
    }
    }
    ?>
    </ul>


    </div>
    </div>



    <div style="clear:both; height:30px;"></div>


 <?php
 




    } else {

        /// Listados generales
?>

    <div class="ui-widget-header ui-corner-top" style="padding:5px 0 4px 7px; text-transform:capitalize"><? echo stripslashes($title) ?></div>
    <div id="contenido_" class="ui-widget-content ui-corner-bottom" style="height:auto; margin-bottom:15px; padding:10px; padding-top:20px; width:auto;">	
    <p><? echo stripslashes($description) ?></p>


    <div style="padding:2px 25px 2px 0; font-size:large; width:auto;" align="right"><a type="application/rss+xml" href="<?=$urlfeed?>" target="_blank" title="<?=stripslashes($r[0]) ?>">Suscribete a esta lista-> <img src="<?=HOST?>images/rss2.gif" border="0" alt="Suscribete a esta lista RSS" /></a></div>

        <div id="title_item">
            <strong><? echo $feed->get_title(); ?></strong><br />
            <em><? echo $feed->get_description(); ?></em>
        </div>
        <div id="content_item">
            <? foreach ($feed->get_items() as $item) { ?>
            <div id="item_item">
                <a href="<? echo $item->get_link(); ?>" class="tit"><? echo $item->get_title(); ?></a><br>
                <em>Fecha: <? echo $item->get_date(); ?></em><br />
                <? echo $item->get_content(); ?>
            </div>
            <? } ?>
        </div>



 <?php


        
    }
    
}


