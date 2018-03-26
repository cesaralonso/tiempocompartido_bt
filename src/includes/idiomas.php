<?php


    $_SESSION['idioma'] = "espanol";

    /////////////////////// IDIOMA Y REFERENCIA

    if(isset($_GET['idioma']) and $_GET['idioma']!="") {
        
        $_SESSION['idioma']=$_GET['idioma'];

        $rr=$_SERVER["HTTP_REFERER"];

        $referen=$rr;

        if($_GET['idioma']=="ingles"){	
            $ref=mysql_query("SELECT link_ing FROM listas_especiales WHERE link_esp = '".$_SERVER['HTTP_REFERER']."'"); 
            $refer=mysql_fetch_row($ref);
            $referen=$refer[0];
            if($referen!=""){
                header( "Location:  ".$referen."" ); 
            }
        }
        
        if($_GET['idioma']=="espanol"){
            $ref=mysql_query("SELECT link_esp FROM listas_especiales WHERE link_ing = '".$_SERVER['HTTP_REFERER']."'");
            $refer=mysql_fetch_row($ref);
            $referen=$refer[0];
            if($referen!=""){
                header( "Location:  ".$referen."" ); 
            }
        }
        
        if($referen==""){
        header( "Location:  ".$rr."" ); 
        }
        
    }
