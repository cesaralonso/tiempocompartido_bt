<?php

function limpiar_enlace($var){
    return $res=ucwords(strtolower(str_replace("-"," ",$var))); 
}
	
function enlace($var){
    return $res= htmlspecialchars(substr(str_replace("/","",str_replace(" ","-",ucwords(strtolower($var)))),0,50)); 
}

function enlace_cont($pais,$ciudad,$club,$id){
    return $res= HOST."catalogo/".enlace($pais)."/".enlace($ciudad)."/".enlace($club)."/".$id."/".enlace(SECCION)."-en-".enlace($ciudad)."-".enlace($club);
}
