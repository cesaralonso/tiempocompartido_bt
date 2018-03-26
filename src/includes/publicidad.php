<?php

///////////////////////////////// PROMOCIONES

function publicidad(){

    $qr1 = mysql_query("SELECT * FROM publicidad WHERE posicion = 'cabezera' AND (lenguaje='".$_SESSION['idioma']."' OR lenguaje='') AND status='publicado' ORDER BY orden DESC");


    $c=0;
    while($rw1 = mysql_fetch_array($qr1)){
        $publicidad['cabezera'][$c]['id'] = $rw1['id'];

        $publicidad['cabezera'][$c]['titulo'] = $rw1['titulo'];
        $publicidad['cabezera'][$c]['titulo_ing'] = $rw1['titulo_ing'];

        if($_SESSION['idioma']=="ingles") $titulo = $rw1['titulo_ing']; else $titulo = $rw1['titulo'];
        $publicidad['cabezera'][$c]['titulo'] = $titulo;

        $publicidad['cabezera'][$c]['descripcion'] = $rw1['descripcion'];
        $publicidad['cabezera'][$c]['descripcion_ing'] = $rw1['descripcion_ing'];

        if($_SESSION['idioma']=="ingles") $descripcion = $rw1['descripcion_ing']; else $descripcion = $rw1['descripcion'];
        $publicidad['cabezera'][$c]['descripcion'] = $descripcion;

        $publicidad['cabezera'][$c]['fecha'] = $rw1['fecha'];
        $publicidad['cabezera'][$c]['imagen'] = $rw1['imagen'];
        $publicidad['cabezera'][$c]['tamano'] = $rw1['tamano'];
        $publicidad['cabezera'][$c]['alto'] = $rw1['alto'];
        $publicidad['cabezera'][$c]['link'] = $rw1['link'];
        $publicidad['cabezera'][$c]['ruta'] = $rw1['ruta'];
        if($_SESSION['idioma']=="ingles") $argumento = $rw1['argumento_ing']; else $argumento = $rw1['argumento'];
        $publicidad['cabezera'][$c]['argumento'] = $argumento;
        $publicidad['cabezera'][$c]['posicion'] = $rw1['posicion'];
        $publicidad['cabezera'][$c]['target'] = $rw1['target'];

        $c++;
    }


    $qr2 = mysql_query("SELECT * FROM publicidad WHERE posicion = 'index_der' AND (lenguaje='$_SESSION[idioma]' OR lenguaje='') AND status='publicado' ORDER BY orden DESC");
            


    $c=0;
    while($rw2 = mysql_fetch_array($qr2)){
        $publicidad['index_der'][$c]['id'] = $rw2['id'];

        $publicidad['index_der'][$c]['titulo'] = $rw2['titulo'];
        $publicidad['index_der'][$c]['titulo_ing'] = $rw2['titulo_ing'];

        if($_SESSION['idioma']=="ingles") $titulo = $rw2['titulo_ing']; else $titulo = $rw2['titulo'];
        $publicidad['index_der'][$c]['titulo'] = $titulo;

        $publicidad['index_der'][$c]['descripcion'] = $rw2['descripcion'];
        $publicidad['index_der'][$c]['descripcion_ing'] = $rw2['descripcion_ing'];

        if($_SESSION['idioma']=="ingles") $descripcion = $rw2['descripcion_ing']; else $descripcion = $rw2['descripcion'];
        $publicidad['index_der'][$c]['descripcion'] = $descripcion;

        $publicidad['index_der'][$c]['fecha'] = $rw2['fecha'];
        $publicidad['index_der'][$c]['imagen'] = $rw2['imagen'];
        $publicidad['index_der'][$c]['tamano'] = $rw2['tamano'];
        $publicidad['index_der'][$c]['alto'] = $rw2['alto'];
        $publicidad['index_der'][$c]['link'] = $rw2['link'];
        $publicidad['index_der'][$c]['ruta'] = $rw2['ruta'];
        if($_SESSION['idioma']=="ingles") $argumento = $rw2['argumento_ing']; else $argumento = $rw2['argumento'];
        $publicidad['index_der'][$c]['argumento'] = $argumento;
        $publicidad['index_der'][$c]['posicion'] = $rw2['posicion'];
        $publicidad['index_der'][$c]['target'] = $rw2['target'];

        $c++;
    }

    return $publicidad;

}

$publicidad = publicidad();

