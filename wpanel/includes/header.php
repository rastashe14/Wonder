<?php
	 require_once ('includes/sesion.php');
	 require_once ('../includes/config.php');
	 require_once ('../includes/conexion.php');
	 require_once ('../includes/funciones.php');
?> 

<!DOCTYPE html>
<!--[if IE 8]>			<html class="no-js lt-ie9" lang="en">	<![endif]-->
<!--[if gt IE 8]><!-->	<html class="no-js" lang="en">			<!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width"/>
	<meta http-equiv="cache-control" content="no-cache"/>
	<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1"/>
	<meta name="robots" content="all,index,follow"/>
	<meta name="rating" content="General"/>
	<meta name="reply-to" content="<?=EMAIL_CONTACTO?>"/>
	<meta name="copyright" content="<?=COPYRIGHT?>"/>
	<meta name="Author" content="<?=AUTHOR?>"/>
	<meta name="keywords" lang="en" content="<?=KEYWORDS?>"/>
	<meta name="description" content="<?=DESCRIPTION?>"/>

	<title><?=TITLE?></title>

	<link rel="stylesheet" href="../css/foundation.css"/>
	<link rel="stylesheet" href="../css/style.css"/>
	<?php
		$themenew  = campo('themes','status', '1','themes');
		//echo 'tema: '.$themenew;
		if ($themenew!='') { 
	?>
		<link rel="stylesheet" href="../wpanel/views/themes/new_css/<?=$themenew?>/style.css"/>
	<?php
		}
	?>
	<script src="../js/vendor/custom.modernizr.js"></script>
	<script src="../js/jquery.js"></script>
	<script src="../ckeditor/ckeditor.js"></script>

	<script src="../js/foundation.min.js"></script>
	<script>
		$(document).foundation();
	</script>
</head>
<body class="bckwpanel">