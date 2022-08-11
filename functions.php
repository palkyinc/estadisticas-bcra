<?php

function startDb () {

$link = mysqli_connect(IP_BASE_DATOS, USUARIO_DB, PASSWORD_DB);
mysqli_set_charset($link, DB_CHARSET);
if ($link) {
	echo '<p>Conectado MySql OK</p>';
} else {
	echo '<p class="error">Error al conectar a MySql | '.mysqli_connect_error().'</p>';
	die;
}

if (!$link->select_db(DB)) {
	$sql = "CREATE DATABASE ".DB;  
    if(mysqli_query($link, $sql)){  
		echo "<p>Data Base ".DB." created successfully</p>";  
	} else {  
	    echo '<p class="error">Data Base was not created successfully</p>';
	    die;
	}
} else {
	echo "<p>Data Base ".DB." was selected OK</p>";  
}

return($link);
}

function estadisticasBcra ($sql_create, $tabla) {
	$resource = '/'.$tabla;
	if ($link = new mysqli(IP_BASE_DATOS, USUARIO_DB, PASSWORD_DB, DB)) {
		mysqli_set_charset($link, DB_CHARSET);
		$sql_query = 'SELECT COUNT(*) as cantidad FROM information_schema.TABLES WHERE table_schema ="' . DB . '" AND table_name= "' . $tabla . '"';
		$rs = ($link->query($sql_query));
		if (!mysqli_fetch_assoc($rs)['cantidad']){
			if(mysqli_query($link, $sql_create)){  
				echo "<p>Table <strong>".$tabla."</strong> created successfully</p>";  
			} else {
			    echo '<p class="error">Table is NOT created successfully | '.mysqli_info($link).'</p>';
			    die;
			}
		}

		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, WS.$resource);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: '.TOKEN));

		$json = curl_exec($ch);
		$info = curl_getinfo($ch, CURLINFO_HTTP_CODE);

		$mensaje = "<p>Solicitando URL ".WS.$resource."...HTTP Response Status Code\t".$info."</p>";

		if ($info == 200) {
			$json = json_decode($json);
			$total_agregados = 0;
			foreach ($json as $value) {
				if ($tabla === 'milestones') {
					$sql_save_query = "INSERT INTO ".$tabla." SET Date = '".$value->d."', Event = '".$value->e."', type = '".$value->t."'";
				} else {
					$sql_save_query = "INSERT INTO ".$tabla." SET Date = '".$value->d."', Value = ".$value->v;
				}
				$sql_exit_query = "select * from ".$tabla." where Date = '".$value->d."'";
				$rs = ($link->query($sql_exit_query));
				if(!isset(mysqli_fetch_assoc($rs)['id'])) {
					if(!mysqli_query($link, $sql_save_query)){  
					    echo '<p class="error">Error to insert data | '.mysqli_info($link).'</p>';
					    die;
					} else {
						$total_agregados ++;
					}
				}
			}
		} else {
			echo '<<p class="error">Error to access URL '.WS.$resource.'...HTTP Response Status Code\t'.$info.'</p>';
	  		echo curl_error($ch);
	  		mysqli_close($link);
	  		curl_close($ch);
	  		die;
		}
	} else {
		echo '<p class="error">ERROR to connect data Base '.DB.' | '.mysqli_connect_error().'</p>';
	}
	curl_close($ch);
	mysqli_close($link);
	echo '<p>Tabla <strong>'.$tabla.'</strong> FINALIZADA. <strong>'.$total_agregados.'</strong> elements added</p>';
}

function createBaseFloat ($tabla) {
	return "CREATE TABLE ".$tabla."(
		            id INT AUTO_INCREMENT,
		            Date DATE UNIQUE,
		            Value FLOAT(10,4),
		            primary key (id))";
}

function createBaseInt ($tabla) {
	return "CREATE TABLE ".$tabla."(
		            id INT AUTO_INCREMENT,
		            Date DATE UNIQUE,
		            Value INT(255),
		            primary key (id))";
}

function createBaseMilestones ($tabla) {
	return "CREATE TABLE ".$tabla."(
		        id INT AUTO_INCREMENT,
	            Date DATE UNIQUE,
	            Event CHAR(50),
	            Type CHAR(4),
	            primary key (id))";
}

