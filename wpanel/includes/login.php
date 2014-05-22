<?php
	session_start();
	include ('../../includes/config.php');
	include ('../../includes/conexion.php');
	include ('../../includes/funciones.php');

	$query = mysql_query('SELECT * FROM users WHERE email = "'.$_REQUEST['user'].'" AND password = "'.$_REQUEST['password'].'"') or die(mysql_error());
	if(mysql_num_rows($query)>0){
		$array = mysql_fetch_assoc($query);
		$_SESSION['wspanel_user']['nombre']	= $array['name'].' '.$array['last_name'];
		$_SESSION['wspanel_user']['tipo']	= $array['id_wprofile'];
		redirect('../index.php');
	}else{
		redirect('../form_login.php?error');
	}
