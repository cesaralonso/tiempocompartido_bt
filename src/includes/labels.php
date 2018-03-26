<?php

    function label(){
        $query = mysql_query("SELECT * FROM idiomas ORDER BY clave");
        while(@$row = mysql_fetch_array($query)){
            $label['espanol'][$row['clave']]=$row['espanol'];
        }

        $query = mysql_query("SELECT * FROM idiomas ORDER BY clave");
        while(@$row = mysql_fetch_array($query)){
            $label['ingles'][$row['clave']]=$row['ingles'];
        }
        return $label;
    }

    $label = label();
