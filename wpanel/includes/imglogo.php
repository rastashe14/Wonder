<?php
 include ('sesion.php');
 include ('../../includes/config.php');
 include ('../../includes/conexion.php');
 include ('../../includes/funciones.php');

 //print_r($_FILES);

if ($_SERVER['SERVER_NAME']=="www.wonderlandplayground.com" || $_SERVER['SERVER_NAME']=="wonderlandplayground.com"){
	$targetFolder = '/img/';
}else{
	$targetFolder= '/Wonder/img/';
}
$er = 0;  //$in = 'no_files';
if ($_FILES['file']['size']!=0) {
	//$in = 'files';
	$parts = explode('.', $_FILES['file']['name']);
	$ext   = strtolower(end($parts)); 
	$tempFile = $_FILES['file']['tmp_name'];
	$targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder;
	//$targetFile =  str_replace('//','/',$targetPath) . md5($parts[0]).'.'.$ext;
	$targetFile =  str_replace('//','/',$targetPath) .md5($parts[0]).'.'.$ext;

	// Validate the file type
	$fileTypes = array('jpg','JPG','jpeg','JEPG','gif','GIF','png','PNG',); // File extensions
	$fileParts = pathinfo($_FILES['file']['name']);
	
	if (in_array($fileParts['extension'],$fileTypes)){
		@mkdir(str_replace('//','/',$targetPath), 0777, true);
		move_uploaded_file($tempFile,$targetFile);
		redimensionar($targetFile, $targetFile, 300,100);
		$img  = campo('config','`keys`', 'logo','value');

		@unlink(REL_PATH.'img/'.$img);

		mysql_query("UPDATE config SET `value` = '".md5($parts[0]).'.'.$ext."' WHERE `keys` = 'logo' ") or die (mysql_error());
		$er = 0;
		//$in = 'files_bello';
		//echo $tempFile.'-'.$targetFile.'-'.$_FILES["file"]["error"];
	} else {
		$er = 1; 
		//$in = 'files_no_bellos';
		//echo 'Invalid file type.'; 
	}
}

mysql_query("UPDATE company SET 
		name = '".$_POST['name']."',
		email = '".$_POST['email']."',
		address = '".$_POST['address']."',
		zipCode = '".$_POST['zipCode']."',
		facebook = '".$_POST['facebook']."',
		twitter = '".$_POST['twitter']."',
		tlf = '".$_POST['tlf']."',
		text = '".$_POST['profile']."'					  
	WHERE id = '1' 
") or die (mysql_error());
$uri = 'views/company/profile.php';

//echo $er.'&in='.$in;
header('Location: ../?err='.$er);

		//($er!=1)?mensajes("Info","Process Successfully."):mensajes("Info","Invalid file type.");




// // print_r($_FILES); filesize
// // echo  $_POST['file'];


?>