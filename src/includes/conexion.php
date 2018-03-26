<?php

    if($_SERVER["REMOTE_ADDR"] == "127.0.0.1" or $_SERVER["REMOTE_ADDR"] == "localhost" OR $_SERVER["REMOTE_ADDR"] == "::1"){
        mysql_connect('localhost','root','') or die(mysql_error()); 
        mysql_select_db('tiempocompartido') or die(mysql_error());
    } else {
        mysql_connect('localhost','wwwtiemp_root','15%Pk,vX3]H[') or die(mysql_error()); 
        mysql_select_db('wwwtiemp_tiempocompartido') or die(mysql_error());
    }
