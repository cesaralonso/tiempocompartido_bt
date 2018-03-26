<?php

    if ($_SESSION['idioma']=="ingles") { 
        $query=mysql_query("SELECT description_ing, keywords_ing, title_ing FROM metatags");
    } else { 
        $query=mysql_query("SELECT description, keywords, title FROM metatags"); 
    }


    while($row=mysql_fetch_array($query)){
        $meta['description']=$row[0];
        $meta['keywords']=$row[1];
        $meta['title']=$row[2];
    }