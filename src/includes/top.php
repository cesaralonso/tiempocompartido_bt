<?php

    session_start();

    @$_GET['id'] = (isset($_GET['id'])) ? $_GET['id'] : "";
    @$_GET['idioma'] = (isset($_GET['idioma'])) ? $_GET['idioma'] : "";
    @$_GET['club'] = (isset($_GET['club'])) ? $_GET['club'] : "";
    @$_GET['categoria'] = (isset($_GET['categoria'])) ? $_GET['categoria'] : "";
    @$_GET['ciudad'] = (isset($_GET['ciudad'])) ? $_GET['ciudad'] : "";
    @$_GET['item'] = (isset($_GET['ciudad'])) ? $_GET['ciudad'] : "";
    @$ca = (isset($ca)) ? $ca : "";
    @$pais_nombre = (isset($pais_nombre)) ? $pais_nombre : "";
    @$d = (isset($d)) ? $d : "";

    $_SESSION['k_id'] = "";



    define('EMPRESA', 'Tiempo Compartido');

    define('SECCION','Tiempo-Compartido');

    define('HOST', 'http://localhost/tiempocompartidobt/src/');
    //efine('HOST', 'http://www.tiempocompartido.com/');