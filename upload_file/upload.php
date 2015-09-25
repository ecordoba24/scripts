<?php
require "datos_conexion.php";

mysql_connect($db['default']['hostname'] , $db['default']['username'] , $db['default']['password'] );
mysql_select_db ($db['default']['database'] );

$Data =addslashes(file_get_contents($_FILES['archivo']['tmp_name']));

$sql = "INSERT INTO docs VALUES(NULL, '{$_FILES['archivo']['name']}', '{$Data}' )";
$current_id = mysql_query($sql) or die("<b>Error:</b> Problem on File Insert<br/>" . mysql_error());

header("location: index.php?mensaje=Archivo Subido");