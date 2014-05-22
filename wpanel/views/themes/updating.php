<?php

if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
// Esto es un ajax!
	 require_once ('../../includes/sesion.php');
	 require_once ('../../../includes/config.php');
	 require_once ('../../../includes/conexion.php');
	 require_once ('../../../includes/funciones.php');
}


if (isset($_GET['t'])) {
	 
	if($_GET['t']!=''){
		mysql_query("UPDATE themes SET `status` = '0'") or die (mysql_error());
		mysql_query("UPDATE themes SET `status` = '1' WHERE `themes` = '".$_GET['t']."'") or die (mysql_error());
		echo '1';
	}else{
		mysql_query("UPDATE themes SET `status` = '0'") or die (mysql_error());
		echo '0';
	}
}else{
	$targetFolder= '/Wonder/wpanel/views/themes/new_zip';

	$targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder;

	//echo $targetPath;

	$nombre =  $_FILES['file']['name'];            //nombre con el que lo subió el usuario
	$tipo =  $_FILES['file']['type'];             //tipo de archivo (jpg,gif,rar,txt,etc)
	$tamano = $_FILES['file']['size'];            //tamaño del archivo en Kb; 1024Kb = 1Mb
	$error = $_FILES['file']['error'];            //si apareció algún error en la subida
	$nombre_temporal = $_FILES['file']['tmp_name'];    //Nombre temporal que se le asigna al archivo cuando sube a tu servidor
	
	$nuevo_nombre =  $targetPath.'/'.$nombre;
	$verificar = explode('.', $nombre);
	$sql = mysql_query("SELECT * FROM themes WHERE themes = '".$verificar[0]."'") or die (mysql_error());

	if(mysql_num_rows($sql)==0){

		// echo '<br> temporal: '.$nombre_temporal;
		// echo '<br> nuevo: '.$nuevo_nombre;

		//Reviso que el archivo sea del tipo ZIP o RAR; y que pese menos de 5Mb
		if (!((strpos($tipo, "rar") || strpos($tipo, "zip")) && ($tamano < 2000000 ))) { 
		       // echo "<br>El tipo de archivo o el tamaño no es correcto."; 
		       $subio = '&subio=1';
		}else{ 
		       //Verifico que pueda mover el archivo y cambiarle el nombre. El archivo se guardará donde esta la pagina
		    if (move_uploaded_file($nombre_temporal, $nuevo_nombre)){ 
		           // echo "<br>El archivo subió!!"; 
		           $subio = '&subio=0&arc='.$nombre;
		       }else{ 
		           // echo "<br>Error al subir el archivo. Inténtelo nuevamente."; 
		           $subio = '&subio=1';
		       } 
		} 

		if ($subio==0) {
			//echo '<br><br><br><br>';
			//Creamos un objeto de la clase ZipArchive()
			$enzipado = new ZipArchive();
			 
			//Abrimos el archivo a descomprimir
			$enzipado->open('views/themes/new_zip/'.$nombre);
			
			//Extraemos el contenido del archivo dentro de la carpeta especificada
			$extraido = $enzipado->extractTo("views/themes/new_css/");
			$nombre = explode('.', $nombre);

			mysql_query("INSERT INTO themes SET themes = '".$nombre[0]."', status = 0") or die (mysql_error());
			 
			 // Si el archivo se extrajo correctamente listamos los nombres de los
			 // * archivos que contenia de lo contrario mostramos un mensaje de error
			
			if($extraido == TRUE){
			 for ($x = 0; $x < $enzipado->numFiles; $x++) {
			 $archivo = $enzipado->statIndex($x);
			 //echo 'Extraido: '.$archivo['name'].'</br>';
			 }
			 //echo '<br>'.$enzipado->numFiles ." archivos descomprimidos en total";
			 $desc = '&desc=0';
			}else {
			 $desc = '&desc=1';
			 //echo 'Ocurrió un error y el archivo no se pudó descomprimir';
			}
		}
		$exist = '&exits=0';
	}else{
		$exist = '&exits=1';
	}

	// echo $nombre;
	// print_r(listar_directorios_ruta('views/themes/new_css/'));
	mensajes("Info","Cargando tema...");
	redirect("?url=views/themes/themes.php".$exist.$desc.$subio);
	
}
?>