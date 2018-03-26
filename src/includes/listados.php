 <?php
 
///////////////////////////////// LISTADOS 


if(isset($_GET['listado']) && isset($_GET['para']) && $_GET['para'] !== null) {


    $host = HOST;
    require("lector-feeds-rss/simplepie.inc");

    //$basename = basename($_SERVER['PHP_SELF']);


    if ($_GET['para']) { 
        
        $para=$_GET['para']; 
        $urlfeed = $host."rss/".$para."/";
        $title="Tiempos Compartidos en ".ucwords($para)." en Cualquier Punto Turistico";

    } else { $para=""; }

    if ($_GET['ciudad']) { 
        $ciudad=$_GET['ciudad'];
        $ciudad_mas=str_replace(' ','+',$_GET['ciudad']); 
        $urlfeed = $host."rss/".$para."/".$ciudad_mas."/";
        $title="Tiempos Compartidos en ".ucwords($para)." en ".ucwords($ciudad);

    } else { $ciudad="Cualquier Punto Turistico"; }

    if ($_GET['tipo']) { 
        $tipo=$_GET['tipo'];
        $tipo_mas=str_replace(' ','+',$_GET['tipo']); 
        $urlfeed = $host."rss/".$para."/".$ciudad_mas."/".$tipo_mas."/";
        $title=ucwords($tipo)." en ".ucwords($para)." en ".ucwords($ciudad);
    
    } else { $tipo="Tiempos Compartidos"; }

    if ($_GET['basename']) { 
        $basename=str_replace(' ','+',$_GET['basename']); 
        $urlfeed = $host."rss/".$para."/".$ciudad_mas."/".$tipo_mas."/".$basename;
        $title= ucwords(str_replace(".php","",str_replace("+"," ",$basename)));
    
    } else {$basename="";}


    if ($_POST["urlfeed"] != "") {
        $urlfeed = $_POST["urlfeed"];
    }

    $feed = new SimplePie();
    $feed->set_feed_url($urlfeed);
    $feed->set_cache_location("cache");
    $feed->init();
    $feed->handle_content_type();


    if($_SESSION['idioma']=="espanol"){
        $description = "Rentas Vacacionales En ".$ciudad." ".$tipo." - Intercambios Vacacionales en ".$ciudad." ".$tipo." - Reventa de Multipropiedad en ".$ciudad." ".$tipo ;
    } else {
        $description = "Timeshare in ".$ciudad." Timeshare Rent Sell and Exchange";    
    }  

}






function filtros() {
    ?>
    <div class="filtro">

    <h3>FILTRAR POR</h3>
    <ul>
    <?
    $tipo=array("renta","venta","intercambio");


    foreach($tipo as $item){ ?>  
    <li><a href="<?=HOST?><?=$item?>/"><?=$item?></a></li>
    <? } ?>
    </ul>


    <? if(isset($_GET['ciudad'])){ ?>

    <h3>FILTRAR POR TIPO DE UNIDAD</h3>
    <ul>
    <?

    $cons= mysql_query("SELECT tipo_unidad, tipo_unidad_ing FROM membresias WHERE ".$_GET['para']."=1 and status = 'publicado' and ciudad='".$ciudad."' GROUP BY tipo_unidad ORDER BY tipo_unidad");
    while($t=mysql_fetch_array($cons)){
    $item2 = limpiar_club($t[0]);
    $uni_ing = limpiar_club($t[1]);
        
            

    switch($item2){
        case"Hotelera":
        $unidad_tipo="Noches de Hotel";
        break;
        case"Variable":
        $unidad_tipo="Semanas Vacacionales Variables";
        break;    
        case"Seleccionar":
        $unidad_tipo="Club Vacacional";
        break; 
            case"Duplex":
        $unidad_tipo="Tiempos Compartidos Duplex";
        break; 
        case"Cabana":
        $unidad_tipo="Caba�as";
        break; 
        case"Otro":
        $unidad_tipo="Estancias Vacacionales";
        break; 

        case"Condominio":
        $unidad_tipo="Condominios";
        break;
        case"Departamento":
        $unidad_tipo="Departamentos";
        break;    
        case"Estudio":
        $unidad_tipo="Estudios";
        break; 
            case"Villa":
        $unidad_tipo="Villas";
        break; 
        case"Apart":
        $unidad_tipo="Aparts";
        break; 
        case"Suite":
        $unidad_tipo="Suites";
        break;   

        default:
        $unidad_tipo=$item2;
        break;
    }
    $unidad_tipo_mas = utf8_encode(strtolower(str_replace(" ","+",$unidad_tipo)));
    ?>  
    <li><a href="<?=HOST?><?=$_GET['para']?>/<?=str_replace(" ","+",$_GET['ciudad'])?>/<?=$unidad_tipo_mas?>/"><?=utf8_encode($unidad_tipo)?> en <?=ucwords($_GET['para'])?></a></li>
    <? } ?>
    </ul>
    <? } ?>



    <? if(@$_GET['para']!="renta-venta-intercambio"){ ?>

    <h3>FILTRAR POR CIUDAD</h3>
    <ul>
    <? $sql=mysql_query("SELECT `ciudad` FROM `membresias` WHERE status='publicado' and ".$_GET['para']."=1 GROUP BY ciudad HAVING `ciudad`!='' ORDER BY ciudad ");
            $arr_cd="";
        while($registro=mysql_fetch_array($sql))
        {
            $new=trim($registro[0]);
            if($new!="" and $new!="Array"){
            
            @$pos = stripos($new,",");
            @$pos2 = stripos($new,"-");
            @$pos3 = stripos($new,"|");
            @$pos4 = stripos($new,"/");
            if ($pos !== false) {
                @$new=explode(",",$new,1);
            }
            if ($pos2 !== false) {
                @$new=explode("-",$new,1);
            }
            if ($pos3 !== false) {
                @$new=explode("|",$new,1);
            }
            if ($pos4 !== false) {
                @$new=explode("/",$new,1);
            }
            @$arr_cd[]=substr(utf8_encode(ucwords(strtolower(trim(@$new)))),0,27);
            $arr_cd=array_unique($arr_cd);	
            
            }
        } 
        
        foreach($arr_cd as $item){ 
        
        
    $ciudad = $item;
    $ciudad = strtolower(str_replace(" ","+",$ciudad));
    if($item!=""){     
        ?>
    <li><a href="<?=HOST?><?=$_GET['para']?>/<?=$ciudad?>/"><?=$item?></a></li>
    <? } } ?>
    </ul>
    <? } ?>


    </div>

<? 
} 