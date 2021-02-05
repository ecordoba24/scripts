<?php

if($_SERVER["SERVER_NAME"] == "localhost"){
    $show = true;
}else{
    $show = false;
}
ini_set('display_errors', $show);
error_reporting(E_ALL & ~E_NOTICE  & ~E_STRICT & ~E_DEPRECATED );

if($_SERVER["SERVER_NAME"] == "localhost"){
    echo "<script>console.log('Nombre de base de datos: {$nombre_db}');</script>";
}