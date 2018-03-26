<?php


/////////////////////////////////////  PRINCIPAL


function contenido() {
	
	
global $label;

?>


<?php
// VISITA CONTADOR
$qr=mysql_query("SELECT cont FROM visitas WHERE idMem = '".$_GET['id']."'");
@$x=mysql_fetch_row($qr);
$cont = $x[0];
if($cont>=1){
    $cont++;
    mysql_query("UPDATE visitas SET  idMem='".$_GET['id']."', idUser='".$_SESSION['k_id']."', cont='$cont' WHERE idMem ='".$_GET['id']."'");
} else {
    $cont=1;
    mysql_query("INSERT INTO visitas(`idMem`,`idUser`,`cont`) VALUES ('".$_GET['id']."','".$_SESSION['k_id']."','$cont') ");
}

// SELECCIONA MEMBRESÍA
$query = "SELECT * FROM membresias WHERE status='publicado' AND idMem='".$_GET['id']."' ORDER BY fecha DESC";
$mysql_query = mysql_query($query);
$mysql_num_rows = mysql_num_rows($mysql_query);


// SI NO HAY RESULTADOS
if($mysql_num_rows==0 or !isset($_GET['id'])){
    
    echo "<div class='ui-state-highlight' style='padding:15px; margin-bottom:20px'>".$label[$_SESSION['idioma']]['Esta memebresia ya no se encuentra en nuestra base de datos']."</div>";
    principal();

} else {

    if ($row = mysql_fetch_array($mysql_query)) { 

    $_SESSION["pais_rel"]=$row['pais'];
    $_SESSION["ciudad_rel"]=$row['ciudad'];
    $_SESSION["renta_rel"]=$row['renta'];
    $_SESSION["venta_rel"]=$row['venta'];
    $_SESSION["inter_rel"]=$row['intercambio'];
    ?>

    <div class="row">
        <div class="col-md-6 col-sm-12">
            <h3>
                <?php echo htmlspecialchars(utf8_decode($label[$_SESSION['idioma']]['club'])) ?>: <?php echo  ucwords(stripslashes(strtolower($row['club']))) ?>
            </h3>
        </div>
        <div class="col-md-6 col-sm-12 text-right">
            <?php echo $label[$_SESSION['idioma']]['publicado'] ?>: <b><?php echo $row['fecha']; ?></b> 
            <? if($row['fecha_actualizacion']!="0000-00-00 00:00:00"){ ?><br />
            <?php 
                if(@$label[$_SESSION['idioma']]['actualizado'] != "") { 
                    echo $label[$_SESSION['idioma']]['actualizado']; 
                } else {
                    echo "Actualizado"; 
                } ?>: 
                <b><?php echo $row['fecha_actualizacion']; ?></b>
            <? } ?>
        </div>
    </div>

    <?php
    if($row['venta']==1){
        $cat1 = $label[$_SESSION['idioma']]['en venta']; 
    } else {
        $cat1 = "";
    } 
    if($row['renta']==1){
        $cat2 = $label[$_SESSION['idioma']]['en renta']; 
    } else {
        $cat2 = "";
    } 
    if($row['intercambio']==1){
        $cat3 = $label[$_SESSION['idioma']]['en intercambio']; 
    } else {
        $cat3 = "";
    } 
    ?>

    <div class="row">
        <div class="col-md-6 col-sm-12">
            <?php if($row['tipo_unidad']=="Cabana")  echo ucwords(utf8_encode(utf8_encode($label[$_SESSION['idioma']]['cabana'])));  else  echo str_replace("&iuml;&iquest;&frac12;","ñ",ucwords($row['tipo_unidad'])); ?>
            <?php echo $cat1; ?> <?php echo $cat2; ?> <?php echo $cat3; ?>
        </div>
        <div class="col-md-6 col-sm-12 text-right">
            <?php echo stripslashes($row['pais']); echo " - ".$row['estado'];?> - <strong><?php echo ucwords(stripslashes($row['ciudad'])); ?></strong>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 col-sm-12">
            <h3 class="capitalize">
                <label for="descripcion"><?php echo htmlspecialchars($label[$_SESSION['idioma']]['Imagenes']) ?></label>
            </h3>
            <?php $queryx=mysql_query("SELECT nombre, comentario FROM files WHERE idMem = '$row[idMem]'"); ?>
            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <?php 
                    
                    if(mysql_num_rows($queryx) > 1){
                        $valor = 0;
                        while($rwx=mysql_fetch_array($queryx)){ ?>

                    <div class="carousel-item <?php if($valor == 0) echo 'active'; ?>">
                        <a href="<?=HOST?>catalogo_imgs/<?php echo $rwx[0]; ?>" title="<?php echo $rwx[1];?>" rel="prettyPhoto[x]" >
                            <img src="<?=HOST?>admin/gallery/thumbs/<?php echo $rwx[0]; ?>" 
                                width="200" 
                                height="150" 
                                alt="<?php echo strtolower($rwx[1]." - ".$row['club']." - ".$row['ciudad'])  ?>" 
                                title="<?php echo ucwords($rwx[1]." - ".$row['club']." - ".$row['ciudad']." - ".$row['tipo_unidad'])  ?>"
                                class="img-fluid"/>
                       </a>
                    </div>

                    <?php
                        $valor ++;
                        } 
                    } else { 
                        
                        if(mysql_num_rows($queryx)==1){
                    ?>

                    <div class="carousel-item active'">
                        <a href="<?=HOST?>catalogo_imgs/<?php echo $rwx[0]; ?>" title="<?php echo $rwx[1];?>" rel="prettyPhoto[x]" ><img src="<?=HOST?>admin/gallery/thumbs/<?php echo $rwx[0]; ?>"  width="200" border="0"/></a>
                    </div>
                    <?php } else {  ?>  

                    <div class="carousel-item active'">
                        NO HAY FOTO
                    </div>

                    <?php } ?>
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
            <div class="text-center">
              <?php echo $label[$_SESSION['idioma']]['click en la imagen para agrandar'] ?>
            </div>
        </div>
        <div class="col-md-6 col-sm-12">
            <h3 class="capitalize">
                <label for="descripcion"><?php echo ucwords(htmlentities(utf8_decode($label[$_SESSION['idioma']]['descripcion']))) ?></label>
            </h3>
            <div>
                <?php switch($_SESSION['idioma']){
                case "ingles":
                    if($row['info_adicional_ingles']!="")
                        echo stripslashes($row['info_adicional_ingles']); 
                    else
                        echo stripslashes($row['info_adicional']);
                break;
                case "espanol":
                    if($row['info_adicional']!="")
                        echo stripslashes($row['info_adicional']);
                    else
                        echo stripslashes($row['info_adicional_ingles']);
                break;
                }
                ?>      
                </div>
                <div id="redes">                                      
                <table>
                    <tr>
                        <td>
                            <div class="fb-like" href="<?=HOST2?><?=$_SERVER['REQUEST_URI']?>" data-send="true" data-layout="button_count" data-width="150" data-show-faces="false"></div>
                        </td>
                        <td width="150"></td>
                        <td align="right">
                            <g:plusone size="medium"></g:plusone>
                        </td>
                    </tr>
                </table>                        
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-6 col-sm-12">
            <h3 class="capitalize">
                <label for="detalles"><?php echo htmlspecialchars($label[$_SESSION['idioma']]['detalles']) ?></label>
            </h3>
                <table class="table table-bordered" border="0" cellpadding="5">
            <tr>
                <td><b><?php echo $label[$_SESSION['idioma']]['dormitorios/ambientes'] ?>:</b></td><td><?php echo $row['dormitorios']; ?></td>
            </tr>
            <tr>
                <td><b><?php echo $label[$_SESSION['idioma']]['tipo de cocina'] ?>:</b></td><td>
                <?php
                switch($row['tipo_cocina']){
                case "No disponible":
                    echo $label[$_SESSION['idioma']]['no disponible'];
                break;
                case "Mini cocineta":
                    echo $label[$_SESSION['idioma']]['mini cocineta'];
                break;
                case "Cocineta":
                    echo $label[$_SESSION['idioma']]['cocineta'];
                break;
                case "Cocina completa":
                    echo $label[$_SESSION['idioma']]['cocina completa'];
                break;
                case "varias":
                    echo $label[$_SESSION['idioma']]['varias'];
                break;
                }
                ?>
                
                </td>
            </tr>
            <tr>
                <td><b><?php echo $label[$_SESSION['idioma']]['cuenta con sala'] ?>:</b></td><td>
                <?php
                switch($row['sala']){
                case "No":
                    echo $label[$_SESSION['idioma']]['no'];
                break;
                case "Si":
                    echo $label[$_SESSION['idioma']]['si'];
                break;
                }
                ?>
                
                </td>
            </tr>
            <tr>
                <td><b><?php echo $label[$_SESSION['idioma']]['maximo de personas'] ?>:</b></td><td><?php echo $row['cap_max']; ?></td>
            </tr>
            <tr>
                <td><b><?php echo $label[$_SESSION['idioma']]['capacidad con privacidad'] ?>:</b></td><td><?php echo $row['cap_privacidad']; ?></td>
            </tr>
            <tr>
                <td><b><?php echo $label[$_SESSION['idioma']]['banos'] ?>:</b></td><td><?php echo $row['banos']; ?></td>
            </tr>
            
            
            <?php if(($row['venta']==1 OR $row['intercambio']==1) AND $row['renta']==1) { ?>
            
            <tr>
                <td><b><?php echo $label[$_SESSION['idioma']]['tipo de semana'] ?>:</b></td><td><?php echo $row['tipo_semana']; ?></td>
            </tr>
            <?php
                switch($row['tipo_semana']){
                case "Flotante":
                ?>
            <tr>
                <td><b><?php echo $label[$_SESSION['idioma']]['flotante'] ?>:</b></td><td><?php echo $row['flotante_datos']; ?></td>
            </tr>			  
                <?php
                break; 
                
                case "Fija":
                ?>
            <tr>
                <td><b><?php echo $label[$_SESSION['idioma']]['numero de semana'] ?>:</b></td><td><?php echo $row['fija_datos']; ?></td>
            </tr>			  
                <?php
                break; 
                
                case "Noches":
                ?>
            <tr>
                <td><b><?php echo $label[$_SESSION['idioma']]['numero de noches'] ?>:</b></td><td><?php echo $row['noches_datos']; ?></td>
            </tr>			  
                <?php
                break; 
                
                case "Puntos":
                ?>
            <tr>
                <td><b><?php echo $label[$_SESSION['idioma']]['cantidad de puntos'] ?>:</b></td><td><?php echo $row['puntos_datos']; ?></td>
            </tr>			  
                <?php
                break; 
                
                }
            ?>
            
            <?php } ?>
            <?php if($row['lock_off']!="No se" && $row['lock_off']!="No" ){ ?>
            <tr>
                <td><b><?php echo $label[$_SESSION['idioma']]['lock off'] ?>:</b></td><td>
                <?php
                    echo $label[$_SESSION['idioma']]['si'];
                ?>
                </td>
            </tr>
            <?php } ?> 
            <?php if($row['renta']==1){ ?>
            <?php if($row['entrada_renta']!="0000-00-00"){ ?>
            <tr>
                <td><b><?php echo $label[$_SESSION['idioma']]['Fecha de Entrada'] ?>:</b></td><td><?php echo $row['entrada_renta']; ?></td>
            </tr>
            <?php } ?>
            <?php if($row['salida_renta']!="0000-00-00"){ ?>
            <tr>
                <td><b><?php echo $label[$_SESSION['idioma']]['Fecha de Salida'] ?>:</b></td><td><?php echo $row['salida_renta']; ?></td>
            </tr>  
            <?php } ?>           
            <?php } ?>
            
                <?php if($row['renta']!=1){ ?>
            
            <tr>
                <td><b><?php echo $label[$_SESSION['idioma']]['con derecho a reservar'] ?>:</b></td><td><?php echo utf8_encode($row['res_num_sem']); ?> - 
                <?php
                switch($row['res_freq_sem']){
                case "cada ano":
                    echo $label[$_SESSION['idioma']]['cada ano'];
                break;
                case "cada anos nones":
                    echo $label[$_SESSION['idioma']]['cada anos nones'];
                break;
                case "cada anos pares":
                    echo $label[$_SESSION['idioma']]['cada anos pares'];
                break;
                case "cada tres anos":
                    echo $label[$_SESSION['idioma']]['cada tres anos'];
                break;
                case "varias":
                    echo $label[$_SESSION['idioma']]['varias'];
                break;
                }
                ?>
                </td>
            </tr>
            
            <?php } ?>
            <?php if($row['url']!="http://"){ ?>
            <tr>
                <td><b><?php echo utf8_encode($label[$_SESSION['idioma']]['url del club']) ?>:</b></td><td><a href="<?php echo $row['url']; ?>" target="_blank"><?php echo utf8_encode($label[$_SESSION['idioma']]['click aqui']) ?></a></td>
            </tr>
            <?php } ?>
                <?php if($row['renta']!=1){ ?>
            <tr>
                <td><b><?php echo $label[$_SESSION['idioma']]['afiliaciones del club'] ?>:</b></td><td><?php echo htmlspecialchars(str_replace("_"," ",str_replace("|"," ",$row['afiliado']))); ?></td>
            </tr>
            <?php } ?>
            
            <tr>
                <td valign="top"><b><?php echo utf8_encode($label[$_SESSION['idioma']]['caracteristicas']) ?>:</b></td><td valign="top">
                
            <?php $caracteristica = explode("|",$row['caracteristicas']);
            foreach($caracteristica as $value => $item){
            
                if($item=="_"){} else {
                    switch($item){
                        case "montana":
                            echo $label[$_SESSION['idioma']]['Montana - Campismo']." - ";
                        break;
                        case "ciudad_":
                            echo $label[$_SESSION['idioma']]['Ciudad']." - ";
                        break;
                        case "parque":
                            echo $label[$_SESSION['idioma']]['Parque Tematico']." - ";
                        break;
                        case "golf":
                            echo $label[$_SESSION['idioma']]['Golf']." - ";
                        break;
                        case "ski":
                            echo $label[$_SESSION['idioma']]['Ski en Nieve']." - ";
                        break;
                        case "pesca":
                            echo $label[$_SESSION['idioma']]['Pesca Deportiva']." - ";
                        break;
                        case "buceo":
                            echo $label[$_SESSION['idioma']]['Buceo - Snorquel']." - ";
                        break;
                        case "gym_spa":
                            echo $label[$_SESSION['idioma']]['Gimnasio - Spa']." - ";
                        break;
                        case "equitacion":
                            echo $label[$_SESSION['idioma']]['Equitacion']." - ";
                        break;
                        case "casino":
                            echo $label[$_SESSION['idioma']]['Casinos']." - ";
                        break;
                        case "raquet":
                            echo $label[$_SESSION['idioma']]['Raquet - Padel']." - ";
                        break;
                        case "tenis":
                            echo $label[$_SESSION['idioma']]['Canchas de Tennis']." - ";
                        break;
                        case "piscina":
                            echo $label[$_SESSION['idioma']]['Piscina']." - ";
                        break;
                        case "piscina_ninos":
                            echo $label[$_SESSION['idioma']]['Piscina infantil - Chapoteadero']." - ";
                        break;
                        case "guarderia":
                            echo $label[$_SESSION['idioma']]['Guarderia Infantil']." - ";
                        break;
                        case "juegos":
                            echo $label[$_SESSION['idioma']]['Juegos infantiles']." - ";
                        break;
                        case "familiar":
                            echo $label[$_SESSION['idioma']]['Ambiente Familiar']." - ";
                        break;
                        case "adultos":
                            echo $label[$_SESSION['idioma']]['Solo Para Adultos']." - ";
                        break;
                        case "jacuzzi":
                            echo $label[$_SESSION['idioma']]['Jacuzzi o Hidromasaje']." - ";
                        break;
                        case "lavanderia":
                            echo $label[$_SESSION['idioma']]['Lavanderia']." - ";
                        break;
                        case "wifi":
                            echo $label[$_SESSION['idioma']]['Wifi']." - ";
                        break;
                        case "todo_incluido":
                            echo $label[$_SESSION['idioma']]['Todo Incluido']." - ";
                        break;
                        case "minusvalidos":
                            echo $label[$_SESSION['idioma']]['Instalaciones Para Minusvalidos']." - ";
                        break;
                        case "mascotas":
                            echo $label[$_SESSION['idioma']]['Aceptan Mascotas']." - ";
                        break;
                        case "playa":
                        echo $label[$_SESSION['idioma']]['Playa - Deportes Acuaticos']." - ";
                        break;
                    
                    }
                
                }
                
            }
			 ?>
             </td>
           </tr>
         </table>

        </div>
        <div class="col-md-6 col-sm-12">
            <h3 class="capitalize">
                <?php echo htmlspecialchars($label[$_SESSION['idioma']]['precios']) ?>
            </h3>
            <table class="table" border="0" align="right">
                <?php if($row['renta']==1) { ?>
                <tr>
                    <td><div style='float:left; margin-right:3px; padding:2px;' class='capitalize'><?php echo $label[$_SESSION['idioma']]['en renta'] ?>: $ <?php echo number_format($row['precio_renta']); ?> <span style="font-size:x-small">
                    <?php 
                    if($row['moneda_renta']=="Dolares") echo $label[$_SESSION['idioma']]['Dolares'];
                    if($row['moneda_renta']=="Pesos Mexicanos") echo $label[$_SESSION['idioma']]['Pesos Mexicanos']; 			
                    if($row['moneda_renta']=="Euros") echo $label[$_SESSION['idioma']]['Euros']; 
                    if($row['moneda_renta']=="Puntos") echo $label[$_SESSION['idioma']]['Puntos']; 
                    ?>
                    </span></div>
                
                    <?php if($row['precio_neg_renta']=="si"){?>
                    <span style='float:left; margin-right:3px; padding:2px;' class='lead'>
                    <?php echo $label[$_SESSION['idioma']]['Negociable'];?>
                    </span>
                    <?php } ?>
                    </td>
                </tr>
                <?php } ?>
                <tr>
                <td></td>
                </tr>
                <?php if($row['venta']==1) { ?>
                <tr>
                    <td><div style='float:left; margin-right:3px; padding:2px;' class='capitalize'><?php echo $label[$_SESSION['idioma']]['en venta'] ?>: $ <?php echo number_format($row['precio_venta']); ?> 
                    <span style="font-size:x-small">
                    <?php 
                    if($row['moneda_venta']=="Dolares" or $row['moneda_venta']=="Dolares US") echo $label[$_SESSION['idioma']]['Dolares'];
                    if($row['moneda_venta']=="Pesos Mexicanos") echo $label[$_SESSION['idioma']]['Pesos Mexicanos']; 			
                    if($row['moneda_venta']=="Euros") echo $label[$_SESSION['idioma']]['Euros']; 
                    if($row['moneda_venta']=="Puntos") echo $label[$_SESSION['idioma']]['Puntos']; 
                    ?>
                    </span></div>
                    <?php if($row['precio_neg_venta']=="si"){?>
                    <span style='float:left; margin-right:3px; padding:2px;' class='lead'>
                        <?php echo $label[$_SESSION['idioma']]['Negociable'];?>
                    </span>
                    <?php } ?>          
                    </td>
                </tr>
                <?php } ?>
                <?php if($row['intercambio']==1) { ?>
                <tr>
                    <td><div style='float:left; margin-right:3px; padding:2px;' class='capitalize'><?php echo $label[$_SESSION['idioma']]['se intercambia por'] ?>: <?php echo htmlspecialchars($row['destino_inter']); ?></div></td>
                </tr>
                <tr>
                    <td><b><?php echo htmlspecialchars($label[$_SESSION['idioma']]['cap max para intercambio']) ?>:</b> <?php echo $row['capacidad_inter']; ?> <?php echo $label[$_SESSION['idioma']]['personas'] ?></td>
                </tr>
                <?php } ?>
            
            </table>

            <?php

            # MAPA

            $sqlq = mysql_query("SELECT idMem, latitude, longitude FROM jquery_locations WHERE idMem = '".$_GET['id']."' ");
            $rows = mysql_num_rows($sqlq);
            $ubicacion = mysql_fetch_array($sqlq);
            if($rows>=1) { ?> 
            <div style="width:auto; padding:3px 0 2px 5px; width:auto" class="ui-widget-header ui-corner-top"><?php echo utf8_encode($label[$_SESSION['idioma']]['ubicacion']) ?></div>
            <div class="ui-widget-content ui-corner-bottom" style="width:auto">
            <div id="map" style="width:auto; height:240px;" class="ui-widget-content ui-corner-bottom"></div> 
            </div>

            <script>
                function initMap() {
                    var membresia = [];
                    membresia[0] = [];
                    membresia[0]["ubicacion"] = [];
                    membresia[0]["ubicacion"]["descripcion"] = 'Tiempo compartido en: <?php echo $row['club']; ?>';
                    membresia[0]["ubicacion"]["lat"] = '<?php echo $ubicacion['latitude']; ?>';
                    membresia[0]["ubicacion"]["lng"] = '<?php echo $ubicacion['longitude']; ?>';

                    setLocationsOnMap(membresia);
                }

                function setLocationsOnMap(membresias) {
                    var locations=[];

                    for(var x = 0; x < membresias.length; x ++) {
                        if( membresias[x].ubicacion != null && membresias[x].ubicacion != undefined)
                            locations.push([
                                membresias[x].ubicacion.descripcion,
                                membresias[x].ubicacion.lat,
                                membresias[x].ubicacion.lng,
                            ]);
                    }

                    var map = new google.maps.Map(document.getElementById('map'), {
                        zoom: 2,
                        center: {lat: <?php echo $ubicacion['latitude']; ?>, lng: <?php echo $ubicacion['longitude']; ?>},        
                        mapTypeId: google.maps.MapTypeId.ROADMAP
                    });

                    var infowindow = new google.maps.InfoWindow();
                    var marker, i;

                    for(i =0; i < locations.length; i++) {
                        marker = new google.maps.Marker({
                            position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                            map: map
                        });

                        google.maps.event.addListener(marker, 'click', (function(marker, i) {
                            return function() {
                            infowindow.setContent(locations[i][0]);
                            infowindow.open(map, marker);
                            }
                        })(marker, i));
                    }
                    console.log(locations);
                }
            </script>

            <?php 
            } 
            ?>

        </div>
    </div>

    <div class="row">
        <div class="col-md-6 col-sm-12">
        </div>
        <div class="col-md-6 col-sm-12">
            <h3 class="capitalize">
                <?php echo $label[$_SESSION['idioma']]['datos de contacto'] ?>
            </h3>
            <?php 
            if(isset($_SESSION['k_id'])){ 
                $wq=mysql_query("SELECT * FROM web_users WHERE id='".$row['idUser']."'"); 
                $rw_=mysql_fetch_array($wq);
            ?>
            <table class="table">
                <tr>
                    <td width="53%"><div><span class="ui-icon ui-icon-person" style="float:left;"></span><?php echo htmlspecialchars($label[$_SESSION['idioma']]['user']) ?>:</div></td>
                    <td width="47%"><strong><?php echo $rw_['user']; ?></strong></td>
                </tr>
                <?php if ($rw_['pais']==""){ } else { ?>
                <tr>
                    <td width="53%"><div><span class="ui-icon ui-icon-pin-s" style="float:left;"></span><?php echo utf8_encode($label[$_SESSION['idioma']]['pais']) ?>:</div></td>
                    <td width="47%"><strong><?php echo htmlspecialchars($rw_['pais']); ?></strong></td>
                </tr>
                <?php } ?> 
                <?php if (!isset($row['telefono'])){ } else { ?>
                <tr>
                    <td width="53%"><div><span class="ui-icon ui-icon-note" style="float:left;"></span><?php echo $label[$_SESSION['idioma']]['fono'] ?>:</div></td>
                    <td width="47%"><strong><?php echo $row['telefono']; ?></strong></td>
                </tr>
                <?php } ?>
                <?php if (!isset($row['lenguajes'])){ } else { ?>
                <tr>
                    <td width="53%"><div><span class="ui-icon ui-icon-note" style="float:left;"></span><?php echo $label[$_SESSION['idioma']]['lenguajes'] ?>:</div></td>
                    <td width="47%"><strong><?php echo htmlspecialchars($row['lenguajes']); ?></strong></td>
                </tr>
                <?php } ?>
                <tr>
                    <td width="53%"><div><span class="ui-icon ui-icon-mail-closed" style="float:left;"></span><?php echo htmlspecialchars($label[$_SESSION['idioma']]['contactar']) ?>:</div></td>
                    <td width="47%"><button id="enviar_email" class="btn btn-primary" data-toggle="modal" data-target="#contactarModal"><?php echo htmlspecialchars($label[$_SESSION['idioma']]['enviar email']) ?></button></td>
                </tr>
            </table>

            <!-- Modal Contacto -->
            <div class="modal fade" id="contactarModal" tabindex="-1" role="dialog" aria-labelledby="contactarModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <form id="form-contactar" action="<?=HOST?>contacto-email.php">     
                        <div class="modal-header">
                            <h5 class="modal-title" id="contactarModalLabel">Contacto</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <h2>
                                Contacta al propietario
                            </h2>
                            <fieldset>
                                <input type="hidden" id="idmem" name="idmem" value="<?php echo $_SESSION['k_id']; ?>">
                                <label for="titulo">Nombre</label>
                                <br>
                                <input type="text" name="titulo" id="titulo" class="form-control" />
                                <br>
                                <label for="cuerpo">Comentarios</label>
                                <br>
                                <textarea name="cuerpo" id="cuerpo" value="" class="textarea form-control" /></textarea>
                            </fieldset>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button class="btn btn-primary pull-right" type="submit">Enviar</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>

            <?php } else { ?>
            <br /><div style="width:auto"><span class="fa fa-info"></span><a href="http://www.tiempocompartido.com/publicar/index.php" style="text-decoration:none"><?php echo stripslashes($label[$_SESSION['idioma']]['para mostrar datos inicia sesion']) ?></a></div>
            <?php } ?>

        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <h3 class="capitalize">
                <?php echo $label[$_SESSION['idioma']]['comentarios'] ?>
            </h3>
            <table cellpadding="2" class="table">

            <?php		
            $q=mysql_query("SELECT web_users.user, preguntas.pregunta, preguntas.fecha, preguntas.idPreg FROM preguntas INNER JOIN web_users ON web_users.id = preguntas.idUser WHERE preguntas.idMem = '".$_GET['id']."' ORDER BY preguntas.idPreg ASC");
            
            while(@$r=mysql_fetch_array($q)){
            ?>          
                <tr>
                    <td width="120"><strong><?php echo $r[0] ?></strong><br /><span style="font-size:9px;"><?php echo $r[2] ?></span></td>
                    <td><?php echo $r[1] ?></td>
                </tr>
                <?php 
                $qre=mysql_query("SELECT * FROM respuestas WHERE idPreg = '$r[3]' ORDER BY fecha ASC");
                $count=mysql_num_rows($qre);
                
                if($count>=1){
                while($rp=mysql_fetch_array($qre)){
                ?>
                
                <tr>
                    <td colspan="2" width="100%"></td>
                </tr>
                <tr class="ui-state-default">
                    <td style="width:16%;"><b><?php echo $label[$_SESSION['idioma']]['respuesta'] ?></b>
                        <br />
                        <span style="font-size:9px;"><?php echo $rp['fecha'] ?></span>
                    </td>
                    <td  style="width:80%;">
                        <?php echo $rp['respuesta'] ?>
                    </td>
                </tr>
                
                <?php
                    }
                }
            }
            ?>
        </table>   
        
        <? 
        $idMem=$_GET['id'];
        
        $qqq=mysql_query("SELECT idUser FROM membresias WHERE idMem = '$idMem'");
        $rrr=mysql_fetch_row($qqq);
        $idUser=$rrr[0];
        if($_SESSION['k_id']==$idUser){
            
            echo "<p>".$label[$_SESSION['idioma']]['Para contestar tus comentarios accesa a Mis Membresias en el Menu de Usuario']."</p>";
            
            } else { ?>
        <div style="margin-top:8px" align="center">    
                <form>
                    <textarea class="form-control textarea" rows="3" id="comentarios_" name="comentarios_" ></textarea>
                </form>
        </div> 
        <div align="right">
                <button id="agregar_comentarios" class="btn btn-default" style="margin-top:15px; padding:5px;"/><?php echo $label[$_SESSION['idioma']]['agregar comentarios'] ?></button>
        </div>
        <? } ?>

        </div>
    </div>

 <?php
        } 
    }
}

?>
