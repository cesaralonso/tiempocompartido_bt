<?php

//////////////////////////////////////// HEADER NUEVO

function enlace2($var){
    return $res= htmlspecialchars(substr(str_replace("/","",str_replace(" ","-",ucwords(strtolower($var)))),0,50)); 
}

function main_header(){

    global $publicidad;
    global $label;
    global $meta;
	
 ?>

<div class="bg-light p-3">
    <div class="row">
        <div class="col-md-4">
            <a href="<?=HOST?>" title="<? echo $meta['description'] ?>">
                <img class="img-fluid" src="<?=HOST?>/images/tiempo-compartido-logo.gif" border="0" alt="Tiempos Compartidos en Renta, Tiempos Compartidos en Venta y Tiempos Compartidos en Intercambio" />
            </a>
        </div>
        <div class="col-md-6">
            <div id="carouselExampleControls" class="carousel slide hidden-md-down" data-ride="carousel">
                <div class="carousel-inner">
                    <?php 
                    if(count($publicidad['cabezera'])>=1){
                        foreach($publicidad['cabezera'] as $valor => $item){
                        ?>

                    <div class="carousel-item <?php if($valor == 0) echo 'active'; ?>">
                        <a href="<?php if($publicidad['cabezera'][$valor]['link']!=""){ echo $publicidad['cabezera'][$valor]['link']; } else { echo "<?=HOST?>publicidad/".enlace2($publicidad['cabezera'][$valor]['titulo'])."/".$publicidad['cabezera'][$valor]['id']."/"; } ?>" 
                            target="<?php echo $publicidad['cabezera'][$valor]['target'] ?>" 
                            title="<?php echo ucwords($publicidad['cabezera'][$valor]['titulo']."".$publicidad['cabezera'][$valor]['descripcion']."".$publicidad['cabezera'][$valor]['argumento']) ?>">
                            <img class="d-block w-100" src="<?=HOST?>/galeria/publicidad/<?php echo $publicidad['cabezera'][$valor]['tamano']."/",$publicidad['cabezera'][$valor]['imagen'] ?>" width="480" height="60" alt="<?php echo $publicidad['cabezera'][$valor]['argumento'] ?>"  border="0"/>
                        </a>
                    </div>

                    <?php
                        } 
                    } else { 
                    ?>
                    <div class="carousel-item active">
                        <div style="width:468px; height:60px; background-color:#FFCC55; vertical-align:middle" align="center">Banner Publicitario Default</div>
                    </div>
                    <?php } ?>  
                </div>
                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
        <div class="col-md-2 text-right">
            <?php if($_SESSION["idioma"]=="ingles"){ ?>
                <button id="esp" type="button" class="btn btn-primary">
                espa&ntilde;ol
                </button>
            <?php } ?>
            <?php if($_SESSION["idioma"]=="espanol"){ ?>
                <button id="eng" type="button" class="btn btn-primary">
                english
                </button>
            <?php } ?>
        </div>
    </div>
</div>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
        <li class="active"><a class="nav-link" href="<?=HOST?>publicar/" title="<?=$label[$_SESSION['idioma']]['publicar membresia']?>"><span class="fa fa-star"></span> <?=$label[$_SESSION['idioma']]['publicar membresia']?></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?=HOST?>listadosgenerales/Listados+De+Rentas+Vacacionales+En+Todo+El+Mundo.php" title="<?=$label[$_SESSION['idioma']]['listas de suscripcion']?>"><span class="fa fa-list"></span> <?=$label[$_SESSION['idioma']]['listas de suscripcion']?></a>
        </li>  
        <li class="nav-item">
            <a class="nav-link" href="<?=HOST?>renta/" title="<?=$label[$_SESSION['idioma']]['renta']?>"><span class="fa fa-star"></span> <?=ucwords($label[$_SESSION['idioma']]['renta'])?></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?=HOST?>venta/" title="<?=$label[$_SESSION['idioma']]['venta']?>"><span class="fa fa-star"></span> <?=ucwords($label[$_SESSION['idioma']]['venta'])?></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?=HOST?>intercambio/" title="<?=$label[$_SESSION['idioma']]['intercambio']?>"><span class="fa fa-star"></span> <?=ucwords($label[$_SESSION['idioma']]['intercambio'])?></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?=HOST?>clubes/" title="por Clubes"><span class="fa fa-home"></span> Clubes</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?=HOST?>ciudades/" title="por Destinos Turisticos"><span class="fa fa-home"></span> Destinos Turisticos</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?=HOST?>paises/" title="por Paises"><span class="fa fa-home"></span> Paises</a>
        </li>
    </ul>
  </div>
</nav>


<div class="bg-light p-4">
    <div style=" float:right; padding-right:10px; width:auto; font-size:10px;"> <? echo $label[$_SESSION['idioma']]['bienvenido'] ?>
        <? if (isset($_SESSION['k_username']) and !isset($_GET['logout'])){ echo "<strong>".$_SESSION['k_username']."</strong>";
        } else { echo $label[$_SESSION['idioma']]['invitado']; }	?>
        <? if (!isset($_SESSION["k_id"]) or isset($_GET['logout']) and $_GET['logout']=="ok"){ ?>

        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#loginModal">
        <? echo $label[$_SESSION['idioma']]['entrar'] ?>
        </button>

        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#signupModal">
        <? echo $label[$_SESSION['idioma']]['inscribete'] ?>
        </button>

        <? } else { ?>


        <div class="dropdown" style="float:right">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Menú usuario
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item capitalize" href="<?=HOST?>publicar/index.php"> <span class="fa fa-star"></span> <? echo $label[$_SESSION['idioma']]['publicar membresia'] ?></a>
                <a class="dropdown-item capitalize" href="<?=HOST?>admin/index.php"> <span class="fa fa-pencil"></span> <? echo $label[$_SESSION['idioma']]['mis membresias'] ?></a>
                <a class="dropdown-item capitalize" href="<?=HOST?>mis-mensajes/"> <span class="fa fa-envelope"></span> <? echo $label[$_SESSION['idioma']]['Mi Bandeja'] ?></a>
                <a class="dropdown-item capitalize" href="<?=HOST?>admin/mis-datos/index.php"> <span class="fa fa-user"></span> <? echo $label[$_SESSION['idioma']]['mis datos'] ?></a>
            </div>
        </div>

        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#logoutModal">
        <? echo $label[$_SESSION['idioma']]['salir'] ?>
        </button>

        <? } ?>
    </div>
    <div style="clear:both"></div>

</div>


<!-- Modal Acceso -->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="loginModalLabel">Accesa</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <div id="login" title="<? echo $label[$_SESSION['idioma']]['Accesar a mi cuenta'] ?>">
            <h2 id="validateTips"> <? echo $label[$_SESSION['idioma']]['Si no te has inscrito entra'] ?>
                <button class="ui-button-small ui-state-default ui-corner-all" id="registrate_login"><? echo $label[$_SESSION['idioma']]['aqui'] ?> </button>
            </h2>
            <form id="formulario">
                <fieldset>
                <label for="name"><? echo $label[$_SESSION['idioma']]['Seudonimo'] ?></label>
                <input type="text" name="name" id="name" class="form-control" />
                <br>
                <label for="password"><? echo $label[$_SESSION['idioma']]['Clave'] ?></label>
                <input type="password" name="password" id="password" value="" class="form-control" />
                <br>
                </fieldset>
                <div id="resultados"></div>
            </form>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary">Aceptar</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal Registro -->
<div class="modal fade" id="signupModal" tabindex="-1" role="dialog" aria-labelledby="signupModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="signupModalLabel">Regístrate</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <div id="registrar" title="<? echo $label[$_SESSION['idioma']]['No estas registrado aun?'] ?>">
            <p id="validateTips_reg">* <? echo $label[$_SESSION['idioma']]['Ingresa tus datos en todos los espacios para crear tu nueva cuenta.'] ?></p>
            <h2><? echo $label[$_SESSION['idioma']]['Si ya te inscribiste anteriormente entra'] ?>
                <button class="ui-button-small ui-state-default ui-corner-all" id="logeate_registro"><? echo $label[$_SESSION['idioma']]['aqui'] ?></button>
            </h2>
            <form id="formulario">
                <fieldset>
                <label for="name"><? echo $label[$_SESSION['idioma']]['Seudonimo'] ?></label>
                <input type="text" name="name_reg" id="name_reg" class="form-control" />
                <br>
                <label for="email"><? echo $label[$_SESSION['idioma']]['Email'] ?></label>
                <input type="text" name="email_reg" id="email_reg" value="" class="form-control" />
                <br>
                <label for="re-email"><? echo $label[$_SESSION['idioma']]['Repetir Email'] ?></label>
                <input type="text" name="re-email" id="re-email" value="" class="form-control" />
                <br>
                <label for="password"><? echo $label[$_SESSION['idioma']]['Clave'] ?></label>
                <input type="password" name="password_reg" id="password_reg" value="" class="form-control" />
                <br>
                <label for="password"><? echo $label[$_SESSION['idioma']]['Repetir Clave'] ?></label>
                <input type="password" name="re_password" id="re_password" value="" class="form-control" />
                <br>
                <table>
                    <tr>
                    <td><input type="checkbox" name="condiciones" id="condiciones" /></td>
                    <td><? echo $label[$_SESSION['idioma']]['Acepto las condiciones de uso de este servicio'] ?> / <a href="<?=HOST?>seccion/condicionesdeuso.php?seccion=condiciones de uso" title="condiciones de uso de tiempocompartido.com"><? echo $label[$_SESSION['idioma']]['condiciones de uso'] ?></a> *
                        <label style="float:right; width:auto"></label></td>
                    </tr>
                    <tr>
                    <td><input type="checkbox" name="newsletter" id="newsletter" /></td>
                    <td><? echo $label[$_SESSION['idioma']]['Acepto recibir el newsletter de Tiempocompartido.com'] ?></td>
                    </tr>
                </table>
                </fieldset>
                <div id="resultados"></div>
            </form>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary">Aceptar</button>
      </div>
    </div>
  </div>
</div>




<!-- Modal Recordar -->
<div class="modal fade" id="recordarModal" tabindex="-1" role="dialog" aria-labelledby="recordarModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="recordarModalLabel">Accesa</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <div id="recordar" title="<? echo $label[$_SESSION['idioma']]['Recordar clave'] ?>">
            <form id="formulario">
                <fieldset>
                <label for="email_rec">eMail</label>
                <input type="text" name="email_rec" id="email_rec" value="" class="form-control" />
                <br>
                </fieldset>
                <div id="resultados"></div>
            </form>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary">Aceptar</button>
      </div>
    </div>
  </div>
</div>

<?	
}





/////////////////////////////////////////////////// MENU PRINCIPAL DINAMICO



function menu_principal(){

    global $label;

    $class="";

?>
<div id="myslidemenu" class="jqueryslidemenu" style="width:100%;">
  
      
     <ul class="" style="float: right;">
     
        <li><a href="<?=HOST?>" title="<?=$label[$_SESSION['idioma']]['inicio']?>"><span class="ui-icon ui-icon-home" style="float:left"></span><?=$label[$_SESSION['idioma']]['inicio']?></a></li>
        <li class="active"><a href="<?=HOST?>publicar/" title="<?=$label[$_SESSION['idioma']]['publicar membresia']?>"><span class="ui-icon ui-icon-star" style="float:left"></span><?=$label[$_SESSION['idioma']]['publicar membresia']?></a></li>
        <li><a href="<?=HOST?>listadosgenerales/Listados+De+Rentas+Vacacionales+En+Todo+El+Mundo.php" title="<?=$label[$_SESSION['idioma']]['listas de suscripcion']?>"><span class="ui-icon ui-icon-diag" style="float:left"></span><?=$label[$_SESSION['idioma']]['listas de suscripcion']?></a></li>
        <li><a href="<?=HOST?>seccion/bolsadetrabajo.php?seccion=bolsadetrabajo" title="<?=$label[$_SESSION['idioma']]['bolsa de trabajo']?>"><span class="ui-icon ui-icon-person" style="float:left"></span><?=$label[$_SESSION['idioma']]['bolsa de trabajo']?></a></li>    
       
        <li><a href="<?=HOST?>renta/" title="<?=$label[$_SESSION['idioma']]['renta']?>"><span class="ui-icon ui-icon-star" style="float:left"></span><?=ucwords($label[$_SESSION['idioma']]['renta'])?></a></li>
        <li><a href="<?=HOST?>venta/" title="<?=$label[$_SESSION['idioma']]['venta']?>"><span class="ui-icon ui-icon-star" style="float:left"></span><?=ucwords($label[$_SESSION['idioma']]['venta'])?></a></li>
        <li><a href="<?=HOST?>intercambio/" title="<?=$label[$_SESSION['idioma']]['intercambio']?>"><span class="ui-icon ui-icon-star" style="float:left"></span><?=ucwords($label[$_SESSION['idioma']]['intercambio'])?></a></li>
        <li><a href="<?=HOST?>clubes/" title="por Clubes"><span class="ui-icon ui-icon-home" style="float:left"></span>por Clubes</a></li>
        <li><a href="<?=HOST?>ciudades/" title="por Destinos Turisticos"><span class="ui-icon ui-icon-home" style="float:left"></span>por Destinos Turisticos</a></li>
        <li><a href="<?=HOST?>paises/" title="por Paises"><span class="ui-icon ui-icon-home" style="float:left"></span>por Paises</a></li>
      </ul> 
  
  <br style="clear: left" />    
  <? if($_SESSION['idioma']=="ingles"){
			$we=mysql_query("SELECT cat_ing, idCat, link_ing FROM categorias order by orden");
		} else {
			$we=mysql_query("SELECT cat_esp, idCat, link FROM categorias order by orden");
		}
			while($re=mysql_fetch_array($we)){
			$cat=$re[0];
			$idCat = $re[1];
			$link=$re[2];
				
		?>
  <ul style="color:#FFFFFF;">
    <li style="text-transform:capitalize"><a href="<?=HOST?><? echo"$link"; ?>" class="ui-widget ui-corner-top" ><? echo"$cat"; ?></a>
      <? $queryz = mysql_query("SELECT * FROM secciones WHERE estado='activado' AND categoria='$idCat' ORDER BY posicion");

		$zz=mysql_num_rows($queryz);
		if($zz>=1){
		
		
		 ?>
      <ul>
        <? $query2 = mysql_query("SELECT * FROM secciones WHERE estado='activado' AND categoria='$idCat' ORDER BY posicion");
		while($rx = mysql_fetch_array($query2)){
		
		if($_SESSION['idioma']=="ingles"){
		$seccion = $rx['seccion_ingles'];
		$idSec=$rx['id'];
		$link = $rx['link_ing'];
		} else {
		$seccion = $rx['seccion'];
		$idSec=$rx['id'];
		$link = $rx['link'];
		}
		?>
        <li class="submenu" style="_width:130px; _height:26px; _font-size:12px; text-transform:capitalize"><a href="<?=HOST?><?=$link?>" class="<?=$class?>"> <?=$seccion?></a>
          <ul >
            <? $query3 = mysql_query("SELECT * FROM subsecciones WHERE seccion='".$idSec."'");
		while($rxx = mysql_fetch_array($query3)){
		$subseccion = $rxx['subseccion'];		
		$link = $rxx['link'];																	
		?>
            <li class="subsubmenu"  style="_width:130px; _height:26px; _font-size:12px;"><a href="<?=HOST?><?=$link?>"><?=$subseccion?></a></li>
            <? } 
		?>
          </ul>
        </li>
        <? }
		?>
      </ul>
      <? }
		?>
    </li>
  </ul>
  <? }
		?>
  <? if(isset($_SESSION['k_id']) and !isset($_GET['logout'])){ ?>
  <ul style="_width:100%; color:#FFFFFF;">
    <li id="user_menu" style="text-transform:capitalize" class="ui-widget ui-corner-top"><a href="#" id="user_menu2">Menú usuario<? //echo htmlentities(utf8_decode($label[$_SESSION['idioma']]['Menu de usuario'])) ?></a>
      <ul>
        <li > <a href="<?=HOST?>publicar/index.php"> <span class="ui-icon ui-icon-star" style="float:left"></span><? echo $label[$_SESSION['idioma']]['publicar membresia'] ?> </a> </li>
        <li > <a href="<?=HOST?>admin/index.php"> <span class="ui-icon ui-icon-pencil" style="float:left"></span><? echo $label[$_SESSION['idioma']]['mis membresias'] ?> </a> </li>
        <li > <a href="<?=HOST?>mis-mensajes/"> <span class="ui-icon ui-icon-mail-closed" style="float:left"></span><? echo $label[$_SESSION['idioma']]['Mi Bandeja'] ?> </a> </li>
        <li > <a href="<?=HOST?>admin/mis-datos/index.php"> <span class="ui-icon ui-icon-person" style="float:left"></span><? echo $label[$_SESSION['idioma']]['mis datos'] ?> </a> </li>
      </ul>
    </li>
  </ul>
  <? } ?>  

</div>

  <br style="clear: left" />     
<?	
	
}






