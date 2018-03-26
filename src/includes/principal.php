<?php


/////////////////////////////////////  PRINCIPAL


function principal(){
	
	
global $label;

// BÚSQUEDA
if($_GET['item']){

    /*echo"<pre>";
    print_r($_GET);
    echo"</pre>";*/

    $exp_url=explode("/",$_SERVER['REQUEST_URI']);
    $nivel=array();
    foreach ($exp_url as $valor => $item){ 
        $nivel[$valor]=ucwords(str_replace("-"," ",$item));  
    }


    echo"<div class='ui-widget-header ui-corner-top' style='height:auto; padding:20px 0 3px 10px;'>";
    echo"<p style='color:#ffe; font-weight:normal;'><i>".$nivel[1]." > ".$nivel[2]."</i></p><br><h1 style='font-weight:bold; color:#fff'>".ucwords(str_replace(",",", ",$nivel[3]))."</h1><br>";
    echo"</div>";
    echo"<div class='ui-widget-content ui-corner-bottom' style='height:auto; margin-bottom:15px; padding:30px 0 3px 10px;'>";

    $pais_nombre=ucwords(str_replace("-"," ",$_GET['opcion']));

    $item = strrchr ($_GET['item'],"-");

    if(substr($item,-7)=="listado"){
        $d="x";
        $c="x";
        $precio="x";
        $m="x";
        $fecha1="x";
        $fecha2="x";

        
    } else {
        
        $d=substr($item,1,1);
        $c=substr($item,2,1);
        $m=substr($item,3,1);
        switch($m){
            case "p":
                $m="Pesos Mexicanos";
            break;
            case "d":
                $m="Dolares";
            break;
            case "e":
                $m="Euros";
            break;	
            default:
                $m="x";
            break;	
        }
        
        $pre=substr($item,4,1);
        $k=substr($item,5,1);
        if($k=="k") {$k=1000; } else if($k=="c") { $k=100; } else if($k=="D") { $k=10000;} else if($k=="C") { $k=100000;} else if($k=="M") { $k=1000000;} else { $k=0; }
        
        $precio=$pre*$k;
        ($precio==0)?$precio="x":$precio=$precio;
        
        $fecha=substr($item,6);
        
        
        if($fecha!="x"){

            $fecha=base_convert($fecha,36,10); 
                
            $año1=substr($fecha,0,4);
            $mes1=substr($fecha,6,2);
            $dia1=substr($fecha,4,2);
            $año2=substr($fecha,8,4);
            $mes2=substr($fecha,14,2);
            $dia2=substr($fecha,12,2);
            $fecha1=$año1."-".$mes1."-".$dia1;
            $fecha2=$año2."-".$mes2."-".$dia2;
            
            
            switch($mes1){
                case "01":
                $temporada="enero";
                break;
                case "02":
                $temporada="febrero";
                break;
                case "03":
                $temporada="marzo";
                break;
                case "04":
                $temporada="abril";
                break;
                case "05":
                $temporada="mayo";
                break;
                case "06":
                $temporada="junio";
                break;
                case "07":
                $temporada="julio";
                break;
                case "08":
                $temporada="agosto";
                break;
                case "09":
                $temporada="septiembre";
                break;

                case "10":
                $temporada="octubre";
                break;
                case "11":
                $temporada="noviembre";
                break;
                case "12":
                $temporada="diciembre";
                break;
                default: $temporada="cualquier temporada";
                break;
            }

        } else {
            $fecha1="x";
            $fecha2="x";
            $temporada="cualquier temporada";
        }
        
    }

        
    /*    BUSQUEDA  */

    $sql = "";

    if($_GET['club']!="hoteles y clubes" AND $_GET['club']!="Name of the Club") $sql .= " AND club LIKE '%".$_GET['club']."%'";
    if($_GET['categoria']=="renta" OR $_GET['categoria']=="venta" OR $_GET['categoria']=="intercambio") $sql .= " AND ".$_GET['categoria']." = '1'";
    /* if($_GET['tipo_unidad']!="no_importa") $sql .= " AND tipo_unidad='".$_GET['tipo_unidad']."'"; */
    if($c!="x") $sql .= " AND cap_privacidad<='".$c."' AND cap_max>='".$c."'";
    if($d!="x") $sql .= " AND dormitorios='".$d."'";
    if($_GET['pais_nombre']!="todo el mundo"){
        if($_GET['pais_nombre']=="españa"){
            $_GET['pais_nombre']="espa&ntilde;a";
        } 
        $sql .= " AND pais='".$_GET['pais_nombre']."'"; 
    }
    if($fecha1!="x"){ ($_GET['categoria']=="renta")?$sql .= " AND entrada_renta<='".$fecha1."' AND salida_renta>='".$fecha2."'": $sql .= ""; }
    if($precio!="x"){ ($_GET['categoria']!="renta-venta-intercambio" && $_GET['categoria']!="intercambio")?$sql .= " AND precio_".$_GET['categoria']."<='".$precio."'": $sql .= ""; }
    if($m!="x"){ ($_GET['categoria']!="renta-venta-intercambio" && $_GET['categoria']!="intercambio")?$sql .= " AND moneda_".$_GET['categoria']."='".$m."'": $sql .= ""; }
    if($_GET['estados']!=0 AND $_GET['estados']!="") $sql .= " AND num_estado='".$_GET['estados']."'"; 
    if($_GET['ciudad']!="cualquier destino" AND $_GET['ciudad']!="" AND $_GET['ciudad']!="City") $sql .= " AND ciudad LIKE '%".$_GET['ciudad']."%'";


    $_SESSION['sql_']=$sql;

    $hoy=date("Y-m-d");	

    //Sentencia sql (sin limit) 
    $_pagi_sql2 = "SELECT *
                    FROM membresias as m  RIGHT JOIN destacados as d ON d.idMem=m.idMem
                    WHERE status='publicado' ".$sql."
                    AND d.fecha_inicio <= '".$hoy."'
                    AND  d.fecha_fin >= '".$hoy."'   
                    ORDER BY d.fecha_fin DESC"; 

    $_pagi_sql = "SELECT *
                    FROM membresias
                    WHERE status='publicado' ".$sql." 
                    ORDER BY fecha DESC"; 

    /*   FIN BUSQUEDA  */
                                      
                              
    //cantidad de resultados por página (opcional, por defecto 20) 
    $_pagi_cuantos = 10; 


    include("paginator.inc.php"); 

    $count = mysql_num_rows($_pagi_result);


    if($_pagi_totalReg==0){

        if(isset($_GET['club'])){ echo"<h3 class='ui-state-error' style='padding:15px; margin-bottom:55px'><span style='float:left' class='ui-icon ui-icon-info'></span>".$label[$_SESSION['idioma']]['No se encontraron resultados']."</h3>"; }

        destacados();

        renta_venta_intercambio();

    } else {

        // TEXTOS PARA SEO
        echo"<div class='ui-widget-content ui-corner-all' style='height:auto; margin-bottom:15px; padding:30px 0 3px 10px; font-size:8px;'>";
        echo "<p>Vacaciones en ".$ciudad_." ".$inmueble_." ".$club_." ".ucwords($temporada)." Listado</p>";
        echo"<p>Rentas Vacacionales En ".$club_." - Intercambios Vacacionales en ".$club_." - Reventa de Multipropiedad en ".$club_."</p>";
        echo"<p>Villas Vacacionales En ".$pais_nombre." | Hoteles Vacacionales En ".$pais_nombre." | Apartamentos Vacacionales En ".$pais_nombre." | Compra Venta Multipropiedad ".$pais_nombre."</p>";
        echo"</div>";
        echo "<br><p class='ui-widget ui-state-highlight' style='padding:20px'>".$label[$_SESSION['idioma']]['Total de registros encontrados'].": <b>".$_pagi_desde." - ".$_pagi_hasta." / ".$_pagi_totalReg."</b></p><br>";
        
        //Leemos y escribimos los registros de la página actual 

        $sq=mysql_query($_pagi_sql2);

        while($r2 = mysql_fetch_array($sq)){ 
            @$ids[]=$r2['idMem'];

        ?>

        <div style="width:98%; margin-bottom:10px; clear:both; padding-top:5px; padding-left:3px" class="<?=($r2['destacar']=="destacado")?"ui-widget-content ui-state-active":"ui-widget-content ui-state-default"?>" >
        <div style="float:left; width:14%">
            <? $query_f1=mysql_query("SELECT nombre, comentario FROM files WHERE idMem = ".$r2['idMem']." LIMIT 0,1");
                $foto1 = mysql_fetch_row($query_f1);
                if($foto1){
            ?>
            <ul id="thumbs">
            <li> <a href="<?=enlace_cont($r2['pais'],$r2['ciudad'],$r2['club'],$r2['idMem'])?>"> <img src="<?=HOST?>admin/gallery/82/<? echo $foto1[0]; ?>"  alt="<? echo $r2['info_adicional'] ?>" width="82" class="ui-widget-content ui-corner-all" /> </a> </li>
            </ul>
            <? } else { ?>
            <ul id="thumbs_60">
            <li> <a href="<?=enlace_cont($r2['pais'],$r2['ciudad'],$r2['club'],$r2['idMem'])?>"> <img src="<?=HOST?>images/sin_foto_c.jpg"  alt="<? echo $r2['info_adicional'] ?>" width="60" class="ui-widget-content ui-corner-all"/> </a> </li>
            </ul>
            <? } ?>
        </div>
        <div id="principal_right">
            <div>
            <div style="float:left">
                <div style="text-transform:capitalize; font-size:12px"><strong><? echo $r2['club']; ?></strong></div>
            </div>
            <div style="float:right; text-decoration:underline" align="right"><? echo $r2['pais']; ?> > <b><? echo $r2['ciudad']; ?></b></div>
            </div>
            <div style="clear:both; font-size:11px; color:#333"><b style="font-weight:normal">
            <? switch($_SESSION['idioma']){
                        case "ingles":
                        if($r2['info_adicional_ingles']!="")
                        echo substr(stripslashes($r2['info_adicional_ingles']),0,100)."..."; 
                        else
                        echo substr(stripslashes($r2['info_adicional']),0,100)."..."; 
                        break;
                        case "espanol":
                        if($r2['info_adicional']!="")
                        echo substr(stripslashes($r2['info_adicional']),0,100)."..."; 
                        else
                        echo substr(stripslashes($r2['info_adicional_ingles']),0,100)."..."; 
                        break;
                        }
                        ?>
            </b></div>
            <div style="clear:both; font-size:10px; color:#003366">
            <? $caracteristica = explode("|",$r2['caracteristicas']);
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
            </div>
            <div style="clear:both">
            <div style="float:left">
                <div align="center">
                <ul style="list-style:none; list-style-type:none; padding:2px; margin:0px; text-align:right">
                    <? if($r2['venta']=="1"){ ?>
                    <li style="float:left; padding-right:7px; margin-right:7px; border-right:1px solid #ccd">
                    <li style="float:left; margin-right:3px; padding:1px" class="ui-state-focus ui-corner-all"><? echo $label[$_SESSION['idioma']]['venta']; ?> $<? echo number_format($r2['precio_venta']); ?> <span style="font-size:9px">
                    <? if($r2['moneda_venta']=="Dolares")echo $label[$_SESSION['idioma']]['Dolares'];
                    if($r2['moneda_venta']=="Pesos Mexicanos")echo $label[$_SESSION['idioma']]['Pesos Mexicanos']; 			
                    if($r2['moneda_venta']=="Euros")echo $label[$_SESSION['idioma']]['Euros']; 
                    if($r2['moneda_venta']=="Puntos")echo $label[$_SESSION['idioma']]['Puntos']; 
                    ?>
                    </span></li>
                    </li>
                    <? } ?>
                    <? if($r2['renta']=="1"){ ?>
                    <li style="float:left; padding-right:7px; margin-right:7px; border-right:1px solid #ccd">
                    <li style="float:left; margin-right:3px; padding:1px" class="ui-state-focus ui-corner-all"><? echo $label[$_SESSION['idioma']]['renta']; ?> $<? echo number_format($r2['precio_renta']); ?> <span style="font-size:9px">
                    <? if($r2['moneda_renta']=="Dolares")echo $label[$_SESSION['idioma']]['Dolares'];
                    if($r2['moneda_renta']=="Pesos Mexicanos")echo $label[$_SESSION['idioma']]['Pesos Mexicanos']; 			
                    if($r2['moneda_renta']=="Euros")echo $label[$_SESSION['idioma']]['Euros']; 
                    if($r2['moneda_renta']=="Puntos")echo $label[$_SESSION['idioma']]['Puntos']; 
                    ?>
                    </span></li>
                    </li>
                    <? } ?>
                    <? if($r2['intercambio']=="1"){ ?>
                    <li style="float:left; padding-right:7px; margin-right:7px; border-right:1px solid #ccd">
                    <li style="float:left; margin-right:3px; padding:1px" class="ui-state-focus ui-corner-all"><? echo $label[$_SESSION['idioma']]['intercambio']; ?>: <strong style="color:333"><? echo $r2['destino_inter']; ?></strong></li>
                    </li>
                    <li style="clear:both"></li>
                    <? } ?>
                </ul>
                </div>
            </div>
            <div style="float:right; color:#333333"><? echo $label[$_SESSION['idioma']]['dorms'] ?>: <strong><? echo $r2['dormitorios']; ?></strong> | <? echo $label[$_SESSION['idioma']]['cap'] ?>: <strong><? echo $r2['cap_max']; ?></strong></div>
            </div>
        </div>
        <div style="clear:both; margin-top:8px"></div>
        </div>
    <? 
    } 

    while($r1 = mysql_fetch_array($_pagi_result)){ 
        
    if (is_array($ids)) {
        foreach(@$ids as $valor => $item){
            if($r1['idMem'] == $item[$valor]){
                 $no_mostrar = 1; 
            }
        }
    }
    if($no_mostrar!=1){
    ?>
    <div style="width:98%; margin-bottom:10px; clear:both; padding-top:5px; padding-left:3px" class="<?=($r1['destacar']=="destacado")?"ui-widget-content ui-state-active":"ui-widget-content ui-state-default"?>">
    <div style="float:left; width:14%">
        <? $query_f1=mysql_query("SELECT nombre, comentario FROM files WHERE idMem = ".$r1['idMem']." LIMIT 0,1");
            $foto1 = mysql_fetch_row($query_f1);
            if($foto1){
        ?>
        <ul id="thumbs">
        <li> <a href="<?=enlace_cont($r1['pais'],$r1['ciudad'],$r1['club'],$r1['idMem'])?>"> <img src="<?=HOST?>admin/gallery/82/<? echo $foto1[0]; ?>"  alt="<? echo $r1['info_adicional'] ?>" width="82" class="ui-widget-content ui-corner-all" /> </a> </li>
        </ul>
        <? } else { ?>
        <ul id="thumbs_60">
        <li> <a href="<?=enlace_cont($r1['pais'],$r1['ciudad'],$r1['club'],$r1['idMem'])?>"> <img src="<?=HOST?>images/sin_foto_c.jpg"  alt="<? echo $r1['info_adicional'] ?>" width="60" class="ui-widget-content ui-corner-all"/> </a> </li>
        </ul>
        <? } ?>
    </div>
    <div id="principal_right">
        <div>
        <div style="float:left">
            <div style="text-transform:capitalize; font-size:12px"><strong><? echo $r1['club']; ?></strong></div>
        </div>
        <div style="float:right; text-decoration:underline" align="right"><? echo $r1['pais']; ?> > <b><? echo $r1['ciudad']; ?></b></div>
        </div>
        <div style="clear:both; font-size:11px; color:#333"><b style="font-weight:normal">
        <? switch($_SESSION['idioma']){
                    case "ingles":
                    if($r1['info_adicional_ingles']!="")
                    echo substr(stripslashes($r1['info_adicional_ingles']),0,100)."..."; 
                    else
                    echo substr(stripslashes($r1['info_adicional']),0,100)."..."; 
                    break;
                    case "espanol":
                    if($r1['info_adicional']!="")
                    echo substr(stripslashes($r1['info_adicional']),0,100)."..."; 
                    else
                    echo substr(stripslashes($r1['info_adicional_ingles']),0,100)."..."; 
                    break;
                    }
                    ?>
        </b></div>
        <div style="clear:both; font-size:10px; color:#003366">
        <? $caracteristica = explode("|",$r1['caracteristicas']);
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
        </div>
        <div style="clear:both">
        <div style="float:left">
            <div align="center">
            <ul style="list-style:none; list-style-type:none; padding:2px; margin:0px; text-align:right">
                <? if($r1['venta']=="1"){ ?>
                <li style="float:left; padding-right:7px; margin-right:7px; border-right:1px solid #ccd">
                <li style="float:left; margin-right:3px; padding:1px" class="ui-state-focus ui-corner-all"><? echo $label[$_SESSION['idioma']]['venta']; ?> $<? echo number_format($r1['precio_venta']); ?> <span style="font-size:9px">
                <? if($r1['moneda_venta']=="Dolares")echo $label[$_SESSION['idioma']]['Dolares'];
                if($r1['moneda_venta']=="Pesos Mexicanos")echo $label[$_SESSION['idioma']]['Pesos Mexicanos']; 			
                if($r1['moneda_venta']=="Euros")echo $label[$_SESSION['idioma']]['Euros']; 
                if($r1['moneda_venta']=="Puntos")echo $label[$_SESSION['idioma']]['Puntos']; 
                ?>
                </span></li>
                </li>
                <? } ?>
                <? if($r1['renta']=="1"){ ?>
                <li style="float:left; padding-right:7px; margin-right:7px; border-right:1px solid #ccd">
                <li style="float:left; margin-right:3px; padding:1px" class="ui-state-focus ui-corner-all"><? echo $label[$_SESSION['idioma']]['renta']; ?> $<? echo number_format($r1['precio_renta']); ?> <span style="font-size:9px">
                <? if($r1['moneda_renta']=="Dolares")echo $label[$_SESSION['idioma']]['Dolares'];
                if($r1['moneda_renta']=="Pesos Mexicanos")echo $label[$_SESSION['idioma']]['Pesos Mexicanos']; 			
                if($r1['moneda_renta']=="Euros")echo $label[$_SESSION['idioma']]['Euros']; 
                if($r1['moneda_renta']=="Puntos")echo $label[$_SESSION['idioma']]['Puntos']; 
                ?>
                </span></li>
                </li>
                <? } ?>
                <? if($r1['intercambio']=="1"){ ?>
                <li style="float:left; padding-right:7px; margin-right:7px; border-right:1px solid #ccd">
                <li style="float:left; margin-right:3px; padding:1px" class="ui-state-focus ui-corner-all"><? echo $label[$_SESSION['idioma']]['intercambio']; ?>: <strong style="color:333"><? echo $r1['destino_inter']; ?></strong></li>
                </li>
                <li style="clear:both"></li>
                <? } ?>
            </ul>
            </div>
        </div>
        <div style="float:right; color:#333333"><? echo $label[$_SESSION['idioma']]['dorms'] ?>: <strong><? echo $r1['dormitorios']; ?></strong> | <? echo $label[$_SESSION['idioma']]['cap'] ?>: <strong><? echo $r1['cap_max']; ?></strong></div>
        </div>
    </div>
    <div style="clear:both; margin-top:8px"></div>
    </div>
    <? 
        }
    }

    //Incluimos la barra de navegación 
    echo"<p style='margin-bottom:55px; margin-top:35px'>".$_pagi_navegacion."</p>"; 
    }

    echo"</div>";

} else {

    destacados();
    renta_venta_intercambio();
        
}
?>
<div style="clear:both; height:0px"></div>
<?
	
}
	
	



///////////////////////////////////////////////////////////////////


function destacados(){
	

	
global $label;


$hoy = date("Y-m-d");
$query1 = mysql_query("SELECT *
					FROM destacados AS d
					INNER JOIN membresias AS m ON m.idMem = d.idMem
					WHERE d.fecha_inicio <= '".$hoy."'
					AND  d.fecha_fin >= '".$hoy."'
					AND m.status='publicado'
					ORDER BY d.fecha_fin DESC");

$query2=mysql_query("SELECT * FROM membresias WHERE status='publicado' AND destacar='destacado' ORDER BY idMem DESC");

?>
<div class="row">
  <div class="col-md-8 col-sm-12">
    <div style="padding:2px; width:100%; margin-bottom:0px;" class="ui-widget-header ui-corner-top">
      <div  style="padding:1px 0 1px 4px; font-size:15px; width:60%;"> <? echo $label[$_SESSION['idioma']]['publicaciones destacadas'] ?> </div>
      <div>
        <div style="padding:1px; width:82%; float:left" align="right"> <a href="<?=HOST?>seccion/tiempos-compartidos-destacados.php?seccion=tiempos-compartidos-destacados" title="<? echo $label[$_SESSION['idioma']]['publicaciones destacadas'] ?>"> <? echo $label[$_SESSION['idioma']]['ver lista completa'] ?> </a> </div>
        <div style="padding:1px; width:13%; float:right;" align="right"><a type="application/rss+xml" href="<?=HOST?>rss/suscripcion-tiempos-compartidos-destacados.php"><img src="<?=HOST?>images/rss2.gif" alt="<? echo $label[$_SESSION['idioma']]['publicaciones destacadas'] ?>" border="0"/></a></div>
      </div>
      <div style="clear:both" ></div>
    </div>
    <div class="ui-widget-content ui-corner-bottom" style="padding:4px 2px 3px 3px; margin-bottom:25px; width:100%">
      <?
    $cont1=mysql_num_rows($query1); 
    $cont2=mysql_num_rows($query2);

    if($cont2>=1 or $cont1>=1){
        
    while($r1=mysql_fetch_array($query1)){ ?>

        <div class="row">
            <div class="col-md-5">
                <? $query_f1=mysql_query("SELECT nombre, comentario FROM files WHERE idMem = ".$r1['idMem']." LIMIT 0,1");
                $foto1 = mysql_num_rows($query_f1);
                if($foto1>=1){
                ?>
                <div style="height:auto;" align="center" class="ui-widget ui-state-default pics">
                    <? while($ff=mysql_fetch_array($query_f1)){
                ?>
                    <div> 
                        <a href="<?=enlace_cont($r1['pais'],$r1['ciudad'],$r1['club'],$r1['idMem'])?>" title="<? echo $r1['info_adicional'] ?>"> 
                            <img src="<?=HOST?>admin/gallery/thumbs/<? echo $ff[0]; ?>"  alt="<? echo $ff[0]  ?>" class="img-fluid" class="ui-widget-content ui-corner-all" border="0"/> 
                        </a> 
                    </div>
                    <? } ?>
                </div>
                <? } else { ?>
                <ul id="thumbs_60">
                    <li> <a href="<?=enlace_cont($r1['pais'],$r1['ciudad'],$r1['club'],$r1['idMem'])?>"> 
                        <img src="<?=HOST?>images/sin_foto_c.jpg"  alt="<? echo substr($r1['info_adicional'],0,200)."... Ler Mas" ?>" width="60" class="ui-widget-content ui-corner-all" border="0"/> </a> </li>
                </ul>
                <? } ?>
            </div>
            <div class="col-md-7">

                <div>
                    <div style="float:left">
                    <div style="text-transform:lowercase; text-transform:capitalize; font-size:12px">
                        <h2><a href="<?=enlace_cont($r1['pais'],$r1['ciudad'],$r1['club'],$r1['idMem'])?>"><? echo $r1['club']; ?></a></h2>
                    </div>
                    </div>
                    <div style="float:right; text-decoration:underline" align="right"><a href="<?=enlace_cont($r1['pais'],$r1['ciudad'],$r1['club'],$r1['idMem'])?>"><? echo $r1['pais']; ?> > <b><? echo $r1['ciudad']; ?></b></a></div>
                </div>
                <div style="clear:both; font-size:11px; color:#333">
                    <p style="font-weight:normal">
                    <? switch($_SESSION['idioma']){
                        case "ingles":
                        if($r1['info_adicional_ingles']!="")
                        echo substr(stripslashes($r1['info_adicional_ingles']),0,200)."... More"; 
                        else
                        echo substr(stripslashes($r1['info_adicional']),0,200)."... Mas Info"; 
                        break;
                        case "espanol":
                        if($r1['info_adicional']!="")
                        echo substr(stripslashes($r1['info_adicional']),0,200)."... Mas Info"; 
                        else
                        echo substr(stripslashes($r1['info_adicional_ingles']),0,200)."... More"; 
                        break;
                        }
                        ?>
                    </p>
                </div>
                <div style="clear:both; font-size:10px; color:#003366"> </div>
                <div style="clear:both">
                    <div style="float:left">
                    <div align="center"> <a href="<?=enlace_cont($r1['pais'],$r1['ciudad'],$r1['club'],$r1['idMem'])?>">
                        <ul style="list-style:none; list-style-type:none; padding:2px; margin:0px; text-align:right">
                        <? if($r1['venta']=="1"){ ?>
                        <li style="float:left; padding-right:7px; margin-right:7px; border-right:1px solid #ccd">
                        <li style="float:left; margin-right:3px; padding:1px" class="ui-state-focus ui-corner-all"><? echo $label[$_SESSION['idioma']]['venta']; ?> $<? echo number_format($r1['precio_venta']); ?> <span style="font-size:9px">
                            <? if($r1['moneda_venta']=="Dolares" or $r1['moneda_venta']=="Dolares US")echo $label[$_SESSION['idioma']]['Dolares'];
                    if($r1['moneda_venta']=="Pesos Mexicanos")echo $label[$_SESSION['idioma']]['Pesos Mexicanos']; 			
                    if($r1['moneda_venta']=="Euros")echo $label[$_SESSION['idioma']]['Euros']; 
                    if($r1['moneda_venta']=="Puntos")echo $label[$_SESSION['idioma']]['Puntos']; 
                    ?>
                            </span></li>
                        </li>
                        <? } ?>
                        <? if($r1['renta']=="1"){ ?>
                        <li style="float:left; padding-right:7px; margin-right:7px; border-right:1px solid #ccd">
                        <li style="float:left; margin-right:3px; padding:1px" class="ui-state-focus ui-corner-all"><? echo $label[$_SESSION['idioma']]['renta']; ?> $<? echo number_format($r1['precio_renta']); ?> <span style="font-size:9px">
                            <? if($r1['moneda_renta']=="Dolares")echo $label[$_SESSION['idioma']]['Dolares'];
                    if($r1['moneda_renta']=="Pesos Mexicanos")echo $label[$_SESSION['idioma']]['Pesos Mexicanos']; 			
                    if($r1['moneda_renta']=="Euros")echo $label[$_SESSION['idioma']]['Euros']; 
                    if($r1['moneda_renta']=="Puntos")echo $label[$_SESSION['idioma']]['Puntos']; 
                    ?>
                            </span></li>
                        </li>
                        <? } ?>
                        <? if($r1['intercambio']=="1"){ ?>
                        <li style="float:left; padding-right:7px; margin-right:7px; border-right:1px solid #ccd">
                        <li style="float:left; margin-right:3px; padding:1px" class="ui-state-focus ui-corner-all"><? echo $label[$_SESSION['idioma']]['intercambio']; ?>: <strong style="color:333"><? echo $r1['destino_inter']; ?></strong></li>
                        </li>
                        <li style="clear:both"></li>
                        <? } ?>
                        </ul>
                        </a> </div>
                    </div>
                    <div style="float:right; color:#333333; font-size:10px"><? echo $label[$_SESSION['idioma']]['dorms'] ?>: <strong><? echo $r1['dormitorios']; ?></strong> | <? echo $label[$_SESSION['idioma']]['cap'] ?>: <strong><? echo $r1['cap_max']; ?></strong></div>
                </div>

            </div>
        </div>



      <? 
      }
      

      # CONSULTA 2  DESTACADAS POR ADMINISTRADOR


      while($r1=mysql_fetch_array($query2)){ ?>

        <div class="row">
            <div class="col-md-5">
                <? $query_f1=mysql_query("SELECT nombre, comentario FROM files WHERE idMem = ".$r1['idMem']." LIMIT 0,1");
                $foto1 = mysql_num_rows($query_f1);
                if($foto1>=1){
                ?>
                <div style="height:auto;" align="center" class="ui-widget ui-state-default pics">
                    <? while($ff=mysql_fetch_array($query_f1)){
                ?>
                    <div> 
                        <a href="<?=enlace_cont($r1['pais'],$r1['ciudad'],$r1['club'],$r1['idMem'])?>" title="<? echo $r1['info_adicional'] ?>"> 
                            <img src="<?=HOST?>admin/gallery/thumbs/<? echo $ff[0]; ?>"  alt="<? echo $ff[0]  ?>" class="img-fluid" class="ui-widget-content ui-corner-all" border="0"/> 
                        </a> 
                    </div>
                    <? } ?>
                </div>
                <? } else { ?>
                <ul id="thumbs_60">
                    <li> <a href="<?=enlace_cont($r1['pais'],$r1['ciudad'],$r1['club'],$r1['idMem'])?>"> 
                        <img src="<?=HOST?>images/sin_foto_c.jpg"  alt="<? echo substr($r1['info_adicional'],0,200)."... Ler Mas" ?>" width="60" class="ui-widget-content ui-corner-all" border="0"/> </a> </li>
                </ul>
                <? } ?>
            </div>
            <div class="col-md-7">

                <div>
                    <div style="float:left">
                    <div style="text-transform:lowercase; text-transform:capitalize; font-size:12px">
                        <h2><a href="<?=enlace_cont($r1['pais'],$r1['ciudad'],$r1['club'],$r1['idMem'])?>"><? echo $r1['club']; ?></a></h2>
                    </div>
                    </div>
                    <div style="float:right; text-decoration:underline" align="right"><a href="<?=enlace_cont($r1['pais'],$r1['ciudad'],$r1['club'],$r1['idMem'])?>"><? echo $r1['pais']; ?> > <b><? echo $r1['ciudad']; ?></b></a></div>
                </div>
                <div style="clear:both; font-size:11px; color:#333">
                    <p style="font-weight:normal">
                    <? switch($_SESSION['idioma']){
                        case "ingles":
                        if($r1['info_adicional_ingles']!="")
                        echo substr(stripslashes($r1['info_adicional_ingles']),0,200)."... More"; 
                        else
                        echo substr(stripslashes($r1['info_adicional']),0,200)."... Mas Info"; 
                        break;
                        case "espanol":
                        if($r1['info_adicional']!="")
                        echo substr(stripslashes($r1['info_adicional']),0,200)."... Mas Info"; 
                        else
                        echo substr(stripslashes($r1['info_adicional_ingles']),0,200)."... More"; 
                        break;
                        }
                        ?>
                    </p>
                </div>
                <div style="clear:both; font-size:10px; color:#003366"> </div>
                <div style="clear:both">
                    <div style="float:left">
                    <div align="center"> <a href="<?=enlace_cont($r1['pais'],$r1['ciudad'],$r1['club'],$r1['idMem'])?>">
                        <ul style="list-style:none; list-style-type:none; padding:2px; margin:0px; text-align:right">
                        <? if($r1['venta']=="1"){ ?>
                        <li style="float:left; padding-right:7px; margin-right:7px; border-right:1px solid #ccd">
                        <li style="float:left; margin-right:3px; padding:1px" class="ui-state-focus ui-corner-all"><? echo $label[$_SESSION['idioma']]['venta']; ?> $<? echo number_format($r1['precio_venta']); ?> <span style="font-size:9px">
                            <? if($r1['moneda_venta']=="Dolares" or $r1['moneda_venta']=="Dolares US")echo $label[$_SESSION['idioma']]['Dolares'];
                    if($r1['moneda_venta']=="Pesos Mexicanos")echo $label[$_SESSION['idioma']]['Pesos Mexicanos']; 			
                    if($r1['moneda_venta']=="Euros")echo $label[$_SESSION['idioma']]['Euros']; 
                    if($r1['moneda_venta']=="Puntos")echo $label[$_SESSION['idioma']]['Puntos']; 
                    ?>
                            </span></li>
                        </li>
                        <? } ?>
                        <? if($r1['renta']=="1"){ ?>
                        <li style="float:left; padding-right:7px; margin-right:7px; border-right:1px solid #ccd">
                        <li style="float:left; margin-right:3px; padding:1px" class="ui-state-focus ui-corner-all"><? echo $label[$_SESSION['idioma']]['renta']; ?> $<? echo number_format($r1['precio_renta']); ?> <span style="font-size:9px">
                            <? if($r1['moneda_renta']=="Dolares")echo $label[$_SESSION['idioma']]['Dolares'];
                    if($r1['moneda_renta']=="Pesos Mexicanos")echo $label[$_SESSION['idioma']]['Pesos Mexicanos']; 			
                    if($r1['moneda_renta']=="Euros")echo $label[$_SESSION['idioma']]['Euros']; 
                    if($r1['moneda_renta']=="Puntos")echo $label[$_SESSION['idioma']]['Puntos']; 
                    ?>
                            </span></li>
                        </li>
                        <? } ?>
                        <? if($r1['intercambio']=="1"){ ?>
                        <li style="float:left; padding-right:7px; margin-right:7px; border-right:1px solid #ccd">
                        <li style="float:left; margin-right:3px; padding:1px" class="ui-state-focus ui-corner-all"><? echo $label[$_SESSION['idioma']]['intercambio']; ?>: <strong style="color:333"><? echo $r1['destino_inter']; ?></strong></li>
                        </li>
                        <li style="clear:both"></li>
                        <? } ?>
                        </ul>
                        </a> </div>
                    </div>
                    <div style="float:right; color:#333333; font-size:10px"><? echo $label[$_SESSION['idioma']]['dorms'] ?>: <strong><? echo $r1['dormitorios']; ?></strong> | <? echo $label[$_SESSION['idioma']]['cap'] ?>: <strong><? echo $r1['cap_max']; ?></strong></div>
                </div>

            </div>
        </div>
      <? 
      }
    } 
    ?>
    </div>
  </div>
  <div class="col-md-4 col-sm-12">
    <div style="padding:2px; width:100%; margin-bottom:0px;" class="ui-widget-header ui-corner-top">
        <div  style="padding:1px 0 1px 4px; font-size:15px; width:99%;  "> <? echo htmlspecialchars($label[$_SESSION['idioma']]['Informacion sobre Tiempo Compartido']) ?> </div>
        <div style="width:98%" align="left"> <? echo stripslashes($label[$_SESSION['idioma']]['Novedades Portada']) ?> </div>
        <div style="clear:both; margin-top:8px"></div>
    </div>
  </div>
  <div style="clear:both"></div>
</div>
<?
}




///////////////////////////////////////////PORTADA 2




function renta_venta_intercambio(){
	
global $label;

?>
<div class="row">
  <div class="col-md-6 col-sm-12">
    <div class="card bg-light mb-3" style="">
        <div class="card-header"> 
            <label for="recientes en venta"><? echo ucwords($label[$_SESSION['idioma']]['recientes en venta']) ?></label>
            <div style="padding:1px; width:85%; float:left" align="right">
                <label for="ver lista completa"><a href="<?=HOST?>listadosgenerales/suscripcion-tiempos-compartidos-en-venta.php" title="<? echo ucwords($label[$_SESSION['idioma']]['recientes en venta']) ?>"><? echo $label[$_SESSION['idioma']]['ver lista completa'] ?> </a></label>
            </div>
            <div style="padding:1px; width:13%; float:right" align="right"><a type="application/rss+xml" href="<?=HOST?>rss/suscripcion-tiempos-compartidos-en-venta.php"><img src="<?=HOST?>images/rss2.gif" alt="<? echo ucwords($label[$_SESSION['idioma']]['recientes en venta']) ?>" border="0"/></a></div>
            <div style="clear:both"></div>
        </div>
        <div class="card-body">

        <? $query1=mysql_query("SELECT * FROM membresias WHERE status='publicado' AND venta='1' ORDER BY idMem DESC LIMIT 0,5");

            while($r1=mysql_fetch_array($query1)){ ?>

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
                                <img src="<?=HOST?>admin/gallery/thumbs/<? echo $ff[0]; ?>"  alt="<? echo $ff[0]  ?>" class="img-fluid" border="0"/>
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
                                    <strong>$ <? echo number_format($r1['precio_venta']); ?> 
                                        <span style="font-size:9px">
                                            <? 
                                            if($r1['moneda_venta']=="Dolares" or $r1['moneda_venta']=="Dolares US") echo $label[$_SESSION['idioma']]['Dolares'];
                                            if($r1['moneda_venta']=="Pesos Mexicanos") echo $label[$_SESSION['idioma']]['Pesos Mexicanos']; 			
                                            if($r1['moneda_venta']=="Euros") echo $label[$_SESSION['idioma']]['Euros']; 
                                            if($r1['moneda_venta']=="Puntos") echo $label[$_SESSION['idioma']]['Puntos']; 
                                            ?>
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
        <? } ?>
        </div>
    </div>
  </div>
  <div class="col-md-6 col-sm-12">
    <div class="card bg-light mb-3" style="">
        <div class="card-header"> 
            <label for="recientes en renta"><? echo ucwords($label[$_SESSION['idioma']]['recientes en renta']) ?></label>
        
            <div style="padding:1px; width:85%; float:left" align="right">
                <label for="ver lista completa"><a href="<?=HOST?>listadosgenerales/suscripcion-tiempos-compartidos-en-renta.php" title="<? echo ucwords($label[$_SESSION['idioma']]['recientes en renta']) ?>"><? echo $label[$_SESSION['idioma']]['ver lista completa'] ?> </a></label>
            </div>
            <div style="padding:1px; width:13%; float:right" align="right"><a type="application/rss+xml" href="<?=HOST?>rss/suscripcion-tiempos-compartidos-en-renta.php"><img src="<?=HOST?>images/rss2.gif" alt="<? echo ucwords($label[$_SESSION['idioma']]['recientes en renta']) ?>" border="0"/></a></div>
            <div style="clear:both"></div>
        </div>
        <div class="card-body">

        <? $query1=mysql_query("SELECT * FROM membresias WHERE status='publicado' AND renta='1' ORDER BY idMem DESC LIMIT 0,5");

            while($r1=mysql_fetch_array($query1)){ ?>

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
                                <img src="<?=HOST?>admin/gallery/thumbs/<? echo $ff[0]; ?>" alt="<? echo $ff[0]  ?>" class="img-fluid" border="0"/>
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
                                    <strong>$ <? echo number_format($r1['precio_renta']); ?> 
                                        <span style="font-size:9px">
                                            <? 
                                            if($r1['moneda_renta']=="Dolares" or $r1['moneda_renta']=="Dolares US") echo $label[$_SESSION['idioma']]['Dolares'];
                                            if($r1['moneda_renta']=="Pesos Mexicanos") echo $label[$_SESSION['idioma']]['Pesos Mexicanos']; 			
                                            if($r1['moneda_renta']=="Euros") echo $label[$_SESSION['idioma']]['Euros']; 
                                            if($r1['moneda_renta']=="Puntos") echo $label[$_SESSION['idioma']]['Puntos']; 
                                            ?>
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
        <? } ?>
        </div>
    </div>
  </div> 
</div>
<?	
}

