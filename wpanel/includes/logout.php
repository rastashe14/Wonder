<?php
	session_start();
	unset($_SESSION['wspanel_user'],$_SESSION['KCF'],$_SESSION['KCFINDER']);
	if($_GET['url']=="logout"){
		redirect('form_login.php');
		die();
	}
	if($_GET['home']==1&&isset($_GET['home'])){
		echo '<META HTTP-EQUIV="refresh" content="0; URL=../../index.php">';
	}
	if($_GET['home']==''&&empty($_GET['home'])){
		echo '<META HTTP-EQUIV="refresh" content="0; URL=../index.php">';
	}
