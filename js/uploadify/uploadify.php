<?php
/*
Uploadify
Copyright (c) 2012 Reactive Apps, Ronnie Garcia
Released under the MIT License <http://www.opensource.org/licenses/mit-license.php> 
*/

include_once("../../includes/funciones.php");

// Define a destination
$targetFolder = $_POST['folder'];// Relative to the root

$verifyToken = md5('unique_salt' . $_POST['timestamp']);

if (!empty($_FILES) && $_POST['token'] == $verifyToken) {

	$parts = explode('.', $_FILES['Filedata']['name']);
	$ext   = strtolower(end($parts)); 
	$tempFile = $_FILES['Filedata']['tmp_name'];
	$targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder;
	$targetFile =  str_replace('//','/',$targetPath) . md5($parts[0]).'.'.$ext;

	// Validate the file type
	$fileTypes = array('jpg','JPG','jpeg','JEPG','gif','GIF','png','PNG',); // File extensions
	$fileParts = pathinfo($_FILES['Filedata']['name']);
	
	if (in_array($fileParts['extension'],$fileTypes)) {
		@mkdir(str_replace('//','/',$targetPath), 0777, true);
		move_uploaded_file($tempFile,$targetFile);
		//redimensionar($targetFile, $targetFile, 600);
		echo $tempFile.'-'.$targetFile.'-'.$_FILES["Filedata"]["error"];
	} else {
		echo 'Invalid file type.'; 
	}
}
?>