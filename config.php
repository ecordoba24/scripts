<?php

if($_SERVER["SERVER_NAME"] == "localhost"){
    $show = true;
}else{
    $show = false;
}
ini_set('display_errors', $show);
error_reporting(E_ALL);

if($_SERVER["SERVER_NAME"] == "localhost"){
    echo "<script>console.log('Nombre de base de datos: {$nombre_db}');</script>";
}
?>

<?php
$link =  mysql_connect('ecordoba.db.11388657.hostedresource.com', 'ecordoba', 'Cor%db%2k13');
if (!$link) {
	die('No pudo conectarse: ' . mysql_error());
}

$select_db = mysql_select_db('ecordoba', $link);
if (!$select_db) {
	die ('No se puede usar compiladores : ' . mysql_error());
}

mysql_query ("SET NAMES 'utf8'");

$debug = true;
$error = false;

if(!function_exists("debug")){
	function debug($enabled=false, $query="", $code_error=false, $message_error="", $res=""){
		global $session_var;

		#debug($debug, $sql, mysql_errno(), mysql_error(), $res );

		if($enabled){
			if( $code_error ){
				echo '<br/><b><font color="red">Mysql Error: '.$code_error.':</font></b> '.$message_error.'<br/>When executing:<br/>'.$query.'<br/>';
			} else {
				echo '<br/><b><font color="green">Consulta Ok: </font></b> '.$query;
			}
			echo "<br/>";

			if($res!=""){
				$findme = "SELECT";
				$pos = strpos($query, $findme);
				if($pos === 0){
					$cant = mysql_num_rows($res);
					if($cant>0){
						echo '<b><font color="green">Cantidad de registros: </font></b> '.$cant;
					}else{
						echo '<b><font color="red">Cantidad de registros: </font></b> '.$cant;
					}
					echo "<br/>";
				}

				$findme = "UPDATE";
				$pos = strpos($query, $findme);
				if($pos === 0){
					$cant = mysql_affected_rows();
					if($cant>0){
						echo '<b><font color="green">Cantidad afectados: </font></b> '.$cant;
					}else{
						echo '<b><font color="red">Cantidad afectados: </font></b> 0';
					}
					echo "<br/>";
				}

				$findme = "INSERT";
				$pos = strpos($query, $findme);
				if($pos === 0){
					$cant = mysql_affected_rows();
					if($cant>0){
						echo '<b><font color="green">Cantidad afectados: </font></b> '.$cant;
						echo '   <b><font color="blue">Id insertado: </font></b> '.mysql_insert_id();
					}else{
						echo '<b><font color="red">Cantidad afectados: </font></b> 0';
					}
					echo "<br/>";
				}

				$findme = "DELETE";
				$pos = strpos($query, $findme);
				if($pos === 0){
					$cant = mysql_affected_rows();
					if($cant>0){
						echo '<b><font color="green">Cantidad afectados: </font></b> '.$cant;
					}else{
						echo '<b><font color="red">Cantidad afectados: </font></b> 0';
					}
					echo "<br/>";
				}
			}
		}
	}
}

if(!function_exists("escape_sql")){
	function escape_sql($string){
		return htmlentities( mysql_real_escape_string($string) );
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Traductor de español a ingles</title>

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">

	<!-- Optional theme -->
	<link rel="stylesheet" href="assets/css/bootstrap-theme.min.css">

	<!-- Latest compiled and minified JavaScript -->
	<script src="assets/js/bootstrap.min.js"></script>
	<meta name="viewport" content="width=device-width, user-scalable=no">
</head>
<body>

	<!-- Fixed navbar -->
	<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#">Traductor Español Ingles</a>
			</div>
			<div id="navbar" class="navbar-collapse collapse">
				<ul class="nav navbar-nav">
					<li class="active"><a href="#">Home</a></li>
				</ul>
			</div><!--/.nav-collapse -->
		</div>
	</nav>

	<div class="container">

		<!-- Main component for a primary marketing message or call to action -->
		<div class="jumbotron">
			<h1>Traductor Español - Ingles</h1>
			<form role="form" method="post">
				<div class="form-group">
					<label for="oracion">Oración</label>
					<input type="test" name="oracion" name class="form-control" id="oracion" placeholder="Escriba la oración a traducir aqui" value="<?=$_POST['oracion']?>">
					<br><button type="submit" class="btn btn-primary">Traducir</button>
				</div>
			</form>

			<?php

			function tipo($token){
				// global $debug;
				// $debug = true;
				$token = strtolower($token);
				$query = "SELECT * FROM diccionario WHERE token = '{$token}' collate utf8_bin LIMIT 1";
				$result = mysql_query($query);
				debug($debug, $query, mysql_errno(), mysql_error(), $result );
				$row = mysql_fetch_object($result);
				if($debug){
					print_r($row);
				}
				return $row->tipo;
			}

			function genero($token){
				// global $debug;
				// $debug = true;
				$token = strtolower($token);
				$query = "SELECT * FROM diccionario WHERE token = '{$token}'  collate utf8_bin LIMIT 1";
				$result = mysql_query($query);
				debug($debug, $query, mysql_errno(), mysql_error(), $result );
				$row = mysql_fetch_object($result);
				if($debug){
					print_r($row);
				}
				return $row->genero;
			}

			function cantidad($token){
				// global $debug;
				// $debug = true;
				$token = strtolower($token);
				$query = "SELECT * FROM diccionario WHERE token = '{$token}'  collate utf8_bin LIMIT 1";
				$result = mysql_query($query);
				debug($debug, $query, mysql_errno(), mysql_error(), $result );
				$row = mysql_fetch_object($result);
				if($debug){
					print_r($row);
				}
				return $row->cantidad;
			}

			function persona($token){
				// global $debug;
				// $debug = true;
				$token = strtolower($token);
				$query = "SELECT * FROM diccionario WHERE token = '{$token}'  collate utf8_bin LIMIT 1";
				$result = mysql_query($query);
				debug($debug, $query, mysql_errno(), mysql_error(), $result );
				$row = mysql_fetch_object($result);
				if($debug){
					print_r($row);
				}
				return $row->persona;
			}

			function traduccion($token){
				// global $debug;
				// $debug = true;
				$token = strtolower($token);
				$query = "SELECT * FROM diccionario WHERE token = '{$token}'  collate utf8_bin LIMIT 1";
				$result = mysql_query($query);
				debug($debug, $query, mysql_errno(), mysql_error(), $result );
				$row = mysql_fetch_object($result);
				if($debug){
					print_r($row);
				}
				return $row->traduccion;
			}

			function evaluar_sujeto($token1, $token2)
			{
				$mensaje .= "<h2>Evaluacion Genero y Cantidad:</strong> $token2 $token1";
				// var_dump($token1);
				$genero1 = genero($token1);
				$cantidad1 = cantidad($token1);
				// var_dump($genero1);
				// var_dump($cantidad1);

				// var_dump($token2);
				$genero2 = genero($token2);
				$cantidad2 = cantidad($token2);
				// var_dump($genero2);
				// var_dump($cantidad2);

				if($genero1 == $genero2){
					$genero = true;
					$mensaje_genero .= "Corresponde en genero, ambos son $genero1";
				}else{
					$genero = false;
					$mensaje_genero .= "No corresponde en genero, uno es $genero1 y el otro es $genero2";
				}

				// echo "$cantidad1 == $cantidad2";
				if($cantidad1 == $cantidad2){
					$cantidad = true;
					$mensaje_cantidad .= "Corresponde en cantidad, ambos son $cantidad1";
				}else{
					$cantidad = false;
					$mensaje_cantidad .= "No corresponde en cantidad<br>, uno es $cantidad1 y el otro es $cantidad2";
				}

				echo $mensaje;
				if($genero){?><div class="alert alert-success" role="alert"><?=$mensaje_genero?></div><?php }else{
					?><div class="alert alert-danger" role="alert"><?=$mensaje_genero?></div><?php
					exit();
				}

				if($cantidad){?><div class="alert alert-success" role="alert"><?=$mensaje_cantidad?></div><?php }else{
					?><div class="alert alert-danger" role="alert"><?=$mensaje_cantidad?></div><?php
					exit();
				}

				// if($genero == false || $cantidad == false){
				// 	return false;
				// }else{
				// 	return true;
				// }
			}

			function validar_sujeto_verbo($token){
				global $error_sematico;
				$error = false;

				$sujeto = array();
				if( $token[0]['tipo'] == "articulo" && $token[1]['tipo'] == "sustantivo" && $token[0]['genero'] == $token[1]['genero'] && $token[0]['cantidad'] == $token[1]['cantidad'] ){

					$sujeto['persona'] = "3";
					$sujeto['genero'] = $token[0]['genero'];
					$sujeto['cantidad'] = $token[0]['cantidad'];

				}elseif( $token[0]['tipo'] == "pronombre" ){
					$sujeto['persona'] = $token[0]['persona'];
					$sujeto['genero'] = $token[0]['genero'];
					$sujeto['cantidad'] = $token[0]['cantidad'];
				}

				print_r($sujeto);

				if( $token[1]['tipo'] == "verbo" ){
					$verbo['persona'] = $token[1]['persona'];
					$verbo['genero'] = $token[1]['genero'];
					$verbo['cantidad'] = $token[1]['cantidad'];
				}

				if( $token[2]['tipo'] == "verbo" ){
					$verbo['persona'] = $token[2]['persona'];
					$verbo['genero'] = $token[2]['genero'];
					$verbo['cantidad'] = $token[2]['cantidad'];
				}

				if( $token[3]['tipo'] == "verbo" ){
					$verbo['persona'] = $token[3]['persona'];
					$verbo['genero'] = $token[3]['genero'];
					$verbo['cantidad'] = $token[3]['cantidad'];
				}

				if( $sujeto['persona'] == $verbo['persona'] ){
					// echo "persona: true<br>";
				}else{
					// echo "error persona<br>";
					$error = true;
				}

				/*if( $sujeto['genero'] == $verbo['genero'] ){
					echo "genero: true<br>";
				}else{
					$error = true;
				}*/

				if( $sujeto['cantidad'] == $verbo['cantidad'] ){
					// echo "cantidad: true<br>";
				}else{
					// echo "error cantidad<br>";
					$error = true;
				}

				// if ($token[0]['tipo'] == "articulo" && $token[1]['tipo'] == "sustantivo" && ($token[2]['tipo'] == "verbo" || $token[3]['tipo'] == "verbo") ){
				// 		echo "test 1";
				// 	}

				$evaluacion = "{$token[0]['token']} {$token[1]['token']} {$token[2]['token']} {$token[3]['token']}";
				echo $evaluacion;
				echo "<h2>Analisis semantico: ";
				if($error){
					echo "<span class='label label-danger'>Error</span> (sujeto verbo no coinciden)";
					$error_sematico = true;
				}else{
					echo "<span class='label label-success'>Exito</span> (sujeto y verbo coinciden) ";
				}
				echo "</h2>";

			}

			function ordenar_arreglo($token){
				$fin_token = array();
				foreach ($token as $key => $value) {
					// var_dump( $token[$key] );
					$fin_token[$key] = $token[$key];

				}
				// echo "antes";
				// print_r($fin_token);
				$temp = array();
				if($token[1]['tipo']=="sustantivo" && $token[2]['tipo'] == "adjetivo"){
					$temp = $token[1];
					unset($fin_token[1]);
					$fin_token[1] = $token[2];
					// $temp = $token[2];
					unset($fin_token[2]);
					$fin_token[2] = $temp;
				}

				// var_dump ( count($fin_token) );
				echo "<h2>Reordenamiento:";
				$tra = "";
				for ($i=0; $i < count($fin_token); $i++) {
					if($fin_token[$i]['token']!="fin"){

					echo $fin_token[$i]['token'] . " ";


					$tra .= " ".traduccion($fin_token[$i]['token']);
					}
				}
				echo "</h2>";
				echo "<h2>Traduccion: $tra</h2>";
				exit();
			}

			function apply_rules($tokens, $estado = "oracion", $error = false){
				echo "<pre>";

				$pila = array();
				foreach ($tokens as $key => $value) {

					echo "<pre>";

					if($tokens[$key]['token']!="fin"){
						print_r("<br>Palabra:\t".$tokens[$key]['token']);
					}

					// print_r($estado);

					if( $estado == "oracion" && ( $tokens[$key]['tipo'] == "articulo" || $tokens[$key]['tipo'] == "sustantivo" || $tokens[$key]['tipo'] == "pronombre" ) ){
						echo "<br>Simbolo:\t".$tokens[$key]['tipo'];
						print_r("<br>Estado:\t\t".$estado);
						$pila[] = "predicado";
						$pila[] = "sujeto";
						// $estado = 1;
						print_r("<br>Regla:\t\t1 (Sujeto Predicado)");
						echo "<br>";
						echo "pila:\t";
						print_r($pila);
						$estado = end($pila);
					}

					if( $estado == "oracion" && ( $tokens[$key]['tipo'] == "adjetivo" || $tokens[$key]['tipo'] == "adverbio" || $tokens[$key]['tipo'] == "verbo" ) ){
						return false;
					}

					if( $estado == "sujeto" && $tokens[$key]['tipo'] == "articulo" ){
						echo "<br>Simbolo:\t".$tokens[$key]['tipo'];
						print_r("<br>Estado:\t\t".$estado);
						print_r("<br>Regla:\t\t2 (Articulo A)");
						echo "<br>";

						$clave = array_search('sujeto', $pila);
						echo "Reemplaza:\t".$pila[$clave]."<br>";
						unset($pila[$clave]);

						array_push($pila, "A");
						array_push($pila, "articulo");

						echo "pila:\t";
						print_r($pila);

						if( end($pila) == $tokens[$key]['tipo']){
							$clave = array_search( end($pila) , $pila);
							echo "Reduce:\t".$pila[$clave]."<br>";
							$pila[$clave] = $tokens[$key]['token'];
							unset($pila[$clave]);
						}

						echo "Pila:\t";
						print_r($pila);
						$estado = end($pila);
						print_r("<br>estado:\t".$estado);
						echo "<br>";

						continue;
					}

					if( $estado == "sujeto" && $tokens[$key]['tipo'] == "sustantivo" ){
						echo "<br>Simbolo:\t".$tokens[$key]['tipo'];
						print_r("<br>Estado:\t\t".$estado);
						print_r("<br>Regla:\t\t3 (Sustativo)");
						echo "<br>";

						$clave = array_search('sujeto', $pila);
						echo "Reemplaza:\t".$pila[$clave]."<br>";
						unset($pila[$clave]);

						array_push($pila, "sustantivo");

						echo "<br>pila:\t";
						print_r($pila);

						if( end($pila) == $tokens[$key]['tipo']){
							$clave = array_search( end($pila) , $pila);
							$pila[$clave] = $tokens[$key]['token'];
							unset($pila[$clave]);
						}

						echo "<br>";
						print_r($pila);
						$estado = end($pila);
						print_r("<br>estado:\t".$estado);
						echo "<br>";
					}

					if( $estado == "sujeto" && $tokens[$key]['tipo'] == "pronombre" ){
						echo "<br>Simbolo:\t".$tokens[$key]['tipo'];
						print_r("<br>Estado:\t\t".$estado);
						print_r("<br>Regla:\t\t4 (Pronombre)");
						echo "<br>";


						$clave = array_search('sujeto', $pila);
						echo "Reemplaza:\t".$pila[$clave]."<br>";
						unset($pila[$clave]);

						array_push($pila, "pronombre");

						echo "<br>pila:\t";
						print_r($pila);

						if( end($pila) == $tokens[$key]['tipo']){
							$clave = array_search( end($pila) , $pila);
							echo "Reduce:\t".$pila[$clave]." =>\t".$tokens[$key]['token'];
							echo "<br>";
							$pila[$clave] = $tokens[$key]['token'];

							unset($pila[$clave]);
						}

						echo "<br>";
						print_r($pila);
						$estado = end($pila);
						print_r("<br>estado:\t".$estado);
						echo "<br>";

						continue;
					}

					if( $estado == "sujeto" && ( $tokens[$key]['tipo'] == "adjetivo" || $tokens[$key]['tipo'] == "adverbio" || $tokens[$key]['tipo'] == "verbo" ) ){
						return false;
					}

					if( $estado == "A" && $tokens[$key]['tipo'] == "sustantivo" ){
						echo "<br>Simbolo:\t".$tokens[$key]['tipo'];
						print_r("<br>Estado:\t\t".$estado);
						print_r("<br>Regla:\t\t5 (Sustantivo B)");
						echo "<br>";


						$clave = array_search('A', $pila);
						echo "Reemplaza:\t".$pila[$clave]."<br>";
						unset($pila[$clave]);

						array_push($pila, "B");
						array_push($pila, "sustantivo");

						echo "<br>";
						print_r($pila);

						if( end($pila) == $tokens[$key]['tipo']){
							$clave = array_search( end($pila) , $pila);
							$pila[$clave] = $tokens[$key]['token'];
							unset($pila[$clave]);
						}

						echo "<br>";
						print_r($pila);
						$estado = end($pila);
						print_r("<br>estado:\t".$estado);
						echo "<br>";

						evaluar_sujeto($tokens[$key]['token'], $tokens[$key-1]['token']);
						continue;
					}

					if( $estado == "A" && ( $tokens[$key]['tipo'] == "articulo" || $tokens[$key]['tipo'] == "verbo" || $tokens[$key]['tipo'] == "pronombre" || $tokens[$key]['tipo'] == "adjetivo" || $tokens[$key]['tipo'] == "adverbio") ){
						return false;
					}

					if( $estado == "B" && ( $tokens[$key]['tipo'] == "sustantivo" || $tokens[$key]['tipo'] == "articulo" || $tokens[$key]['tipo'] == "adverbio" || $tokens[$key]['tipo'] == "pronombre" ) ){
						return false;
					}

					if( $estado == "B" && $tokens[$key]['tipo'] == "verbo" ){
						echo "<br>Simbolo:\t".$tokens[$key]['tipo'];
						print_r("<br>Estado:\t\t".$estado);
						print_r("<br>Regla:\t\t7 ('Lambda')");
						echo "<br>";

						$clave = array_search('B', $pila);
						echo "Reduce:\t".$pila[$clave]."<br>";
						unset($pila[$clave]);

						// echo "<br>pila:\t";
						// print_r($pila);

						if( end($pila) == $tokens[$key]['tipo']){
							$clave = array_search( end($pila) , $pila);
							$pila[$clave] = $tokens[$key]['token'];
							unset($pila[$clave]);
						}

						echo "<br>pila:\t";
						print_r($pila);
						$estado = end($pila);
						print_r("<br>estado:\t".$estado);
						echo "<br>";
						// validar_sujeto_verbo($tokens);
						// continue;
					}

					if( $estado == "B" && $tokens[$key]['tipo'] == "adjetivo" && $tokens[$key-1]['tipo'] != "adjetivo"){
						echo "<br>Simbolo:\t".$tokens[$key]['tipo'];
						print_r("<br>Estado:\t\t".$estado);
						print_r("<br>Regla:\t\t6 (Adjetivo)");
						echo "<br>";



						$clave = array_search('B', $pila);
						echo "Reemplaza:\t".$pila[$clave]."<br>";
						unset($pila[$clave]);

						// array_push($pila, "A");
						array_push($pila, "adjetivo");

						echo "pila:\t";
						print_r($pila);

						if( end($pila) == $tokens[$key]['tipo']){
							$clave = array_search( end($pila) , $pila);
							echo "Reduce:\t".$pila[$clave]."<br>";
							$pila[$clave] = $tokens[$key]['token'];
							unset($pila[$clave]);
						}


						echo "Pila:\t";
						print_r($pila);
						$estado = end($pila);
						print_r("<br>estado:\t".$estado);
						echo "<br>";
						continue;
					}

					if( $estado == "B" && $tokens[$key]['tipo'] == "" && $tokens[$key]['token'] == "fin" ){

						$clave = array_search('B', $pila);
						// echo "Reemplaza:\t".$pila[$clave]."<br>";
						unset($pila[$clave]);

						// echo "<br>";
						// print_r($pila);

						if( end($pila) == $tokens[$key]['tipo']){
							$clave = array_search( end($pila) , $pila);
							$pila[$clave] = $tokens[$key]['token'];
							unset($pila[$clave]);
						}

						echo "<br>";
						echo "Pila:\t\t";
						print_r($pila);
						$estado = end($pila);
						// print_r("<br>estado:\t".$estado);
						// echo "<br>";
					}

					if( $estado == "predicado" && $tokens[$key]['tipo'] == "verbo" ){
						echo "<br>Simbolo:\t".$tokens[$key]['tipo'];
						print_r("<br>Estado:\t\t".$estado);
						print_r("<br>Regla:\t\t8 (Verbo C)");
						echo "<br>";


						$clave = array_search('predicado', $pila);
						echo "Reemplaza:\t".$pila[$clave]."<br>";
						unset($pila[$clave]);

						array_push($pila, "C");
						array_push($pila, "verbo");

						echo "<br>pila:\t";
						print_r($pila);

						if( end($pila) == $tokens[$key]['tipo']){
							$clave = array_search( end($pila) , $pila);
							echo "Reduce:\t".$pila[$clave]." =>\t".$tokens[$key]['token'];
							echo "<br>";
							$pila[$clave] = $tokens[$key]['token'];
							unset($pila[$clave]);
						}

						echo "<br>";
						print_r($pila);
						$estado = end($pila);
						print_r("<br>estado:\t".$estado);
						echo "<br>";

						validar_sujeto_verbo($tokens);
						continue;
					}

					if( $estado == "predicado" && ( $tokens[$key]['tipo'] == "articulo" || $tokens[$key]['tipo'] == "sustantivo" || $tokens[$key]['tipo'] == "pronombre" || $tokens[$key+1]['tipo'] == "verbo"  ) ){
						return false;
					}

					if( $estado == "predicado" && $tokens[$key]['tipo'] == "" && $tokens[$key]['token'] == "fin" ){

						$clave = array_search('predicado', $pila);
						// echo "Reemplaza:\t".$pila[$clave]."<br>";
						unset($pila[$clave]);

						// echo "<br>";
						// print_r($pila);

						if( end($pila) == $tokens[$key]['tipo']){
							$clave = array_search( end($pila) , $pila);
							$pila[$clave] = $tokens[$key]['token'];
							unset($pila[$clave]);
						}

						// echo "<br>";
						// echo "Pila:\t\t";
						// print_r($pila);
						$estado = end($pila);
						// print_r("<br>estado:\t".$estado);
						// echo "<br>";
					}

					if( $estado == "C" && ( $tokens[$key]['tipo'] == "verbo" || $tokens[$key]['tipo'] == "pronombre" || $tokens[$key]['tipo'] == "sustantivo" || $tokens[$key+1]['tipo'] == "articulo"  ) ){
						return false;
					}

					if( $estado == "C" && $tokens[$key]['tipo'] == "adjetivo" && $tokens[$key+1]['tipo'] == "adjetivo" ){
						return false;
					}

					if( $estado == "C" && $tokens[$key]['tipo'] == "adjetivo" ){
						echo "<br>Simbolo:\t".$tokens[$key]['tipo'];
						print_r("<br>Estado:\t\t".$estado);
						print_r("<br>Regla:\t\t9 (Adjetivo)");
						echo "<br>";

						$clave = array_search('C', $pila);
						echo "Reemplaza:\t".$pila[$clave]."<br>";
						unset($pila[$clave]);

						array_push($pila, "adjetivo");

						echo "<br>Pila:\t";
						print_r($pila);

						if( end($pila) == $tokens[$key]['tipo']){
							$clave = array_search( end($pila) , $pila);
							echo "Reduce:\t".$pila[$clave]." =>\t".$tokens[$key]['token'];
							echo "<br>";
							$pila[$clave] = $tokens[$key]['token'];
							unset($pila[$clave]);
						}

						echo "<br>Pila:\t";
						print_r($pila);
						$estado = end($pila);
						print_r("<br>estado:\t".$estado);
						echo "<br>";

						continue;
					}

					if( $estado == "C" && $tokens[$key]['tipo'] == "adverbio" ){
						echo "<br>Simbolo:\t".$tokens[$key]['tipo'];
						print_r("<br>Estado:\t\t".$estado);
						print_r("<br>Regla:\t\t10 (Adverbio)");
						echo "<br>";


						$clave = array_search('C', $pila);
						echo "Reemplaza:\t".$pila[$clave]."<br>";
						unset($pila[$clave]);

						array_push($pila, "adverbio");

						echo "<br>Pila:\t";
						print_r($pila);

						if( end($pila) == $tokens[$key]['tipo']){
							$clave = array_search( end($pila) , $pila);
							echo "Reduce:\t".$pila[$clave]." =>\t".$tokens[$key]['token'];
							echo "<br>";
							$pila[$clave] = $tokens[$key]['token'];
							unset($pila[$clave]);
						}

						echo "<br>";
						print_r($pila);
						$estado = end($pila);
						print_r("<br>estado:\t".$estado);
						echo "<br>";

						continue;
					}


					if( $estado == "C" && $tokens[$key]['token'] == "fin" ){
						$clave = array_search('C', $pila);
						// echo "Reemplaza:\t".$pila[$clave]."<br>";
						unset($pila[$clave]);

						// echo "<br>";
						// print_r($pila);

						if( end($pila) == $tokens[$key]['tipo']){
							$clave = array_search( end($pila) , $pila);
							$pila[$clave] = $tokens[$key]['token'];
							unset($pila[$clave]);
						}

						// echo "<br>";
						// print_r($pila);
						$estado = end($pila);
						// print_r("<br>estado:\t".$estado);
						// echo "<br>";
						continue;
					}

					echo "</pre>";

				}
				// end foreach


				if($estado == "B" && $tokens[$key]['tipo'] == "fin"){
					echo "B fin<br>";
					$last_key = key( array_slice( $pila, -1, 1, TRUE ) );
					unset($pila[$last_key]);
				}elseif($estado == "C" && $tokens[$key]['tipo'] == "verbo"){
					echo "C verbo<br>";
					$last_key = key( array_slice( $pila, -1, 1, TRUE ) );
					unset($pila[$last_key]);
				}elseif($estado == "predicado" && ( $tokens[$key]['tipo'] == "adjetivo" &&  $tokens[$key]['tipo'] == "adverbio" ) ){
					echo "predicado adjetivo/adverbio<br>";
					$last_key = key( array_slice( $pila, -1, 1, TRUE ) );
					unset($pila[$last_key]);
				}

				$largo = count($pila);

				if($largo == 0 && $error == false){
					return true;
				}else{
					return false;
				}
			}

			function analisis_semantico($tokens){
				echo "<pre>";
				print_r($tokens);
				echo "</pre>";
				exit();
			}

			if(isset($_POST['oracion'])){
				$_POST['oracion'] = trim($_POST['oracion']);
				echo "<pre>";
				print_r("Oracion: <br>");
				print_r($_POST['oracion']);
				echo "</pre>";

				$_POST['oracion'] .= " fin";

				$tokens = explode(" ", $_POST['oracion']);

				$largo = count($tokens);

				echo "<pre>";
				print_r("Tokens: <br>");
				foreach ($tokens as $key => $value) {
					if($value!="fin"){
						$tipo = tipo($value);
						if($tipo==""){
							echo "<h2>Palabra: $value no encontrada en el diccionario<h2>";
							exit();
						}
						$genero = genero($value);
						$cantidad = cantidad($value);
						$persona = persona($value);
						$new_tokens[$key]["token"] = $value;
						$new_tokens[$key]["tipo"] = $tipo;
						$new_tokens[$key]["genero"] = $genero;
						$new_tokens[$key]["cantidad"] = $cantidad;
						$new_tokens[$key]["persona"] = $persona;
						print_r( "{$value}\t= {$tipo}<br>" );
					}else{
						$new_tokens[$key]["token"] = "fin";
						$new_tokens[$key]["tipo"] = "";
					}
				}
				echo "</pre>";

				if( apply_rules($new_tokens) ){
					echo "<h2>Analisis sintactico: <span class='label label-success'>Exito</span></h2>";
				}else
				{
					echo "<h2>Analisis sintactico: <span class='label label-danger'>Error</span></h2>";
					exit();
				}

				if(!$error_sematico){
					ordenar_arreglo($new_tokens);
				}

				/*echo "<pre>";
				print_r($new_tokens);
				echo "</pre>";*/


			}
			?>
		</div>

	</div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="assets/js/ie10-viewport-bug-workaround.js"></script>

</body>
</html>
