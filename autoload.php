<?php
//Clase que se encarga de cargar todas las clases de controlladores del proyecto
function controladores_autoload($clasename){
    include 'controladores/'.$clasename.'.php';
}

spl_autoload_register('controladores_autoload');