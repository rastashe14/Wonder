<?php
	/*
		<!-- 
			+ ------------------------------------------------ +
			|                                                  |
			| 	Developed By: Websarrollo.com                  |
			|                                                  |
			+ ------------------------------------------------ +
		-->	
	*/
	
	if ($_SERVER['SERVER_NAME']=="www.wonderlandplayground.com" || $_SERVER['SERVER_NAME']=="wonderlandplayground.com"){
		$_wuser = 'wonderlandpl_db';
		$_wpass = '7412374123';
		$_wdata = 'wonderlandpl_db';
		$_path	= '/';
	}else{
		$_wuser = 'root';
		$_wpass = 'root';
		$_wdata = 'dbfasti';
		$_path	= '/Wonder';
	}
	define('DOMINIO', 'http://'.$_SERVER['SERVER_NAME'].$_path);
	$_url=array_shift(explode('.php',$_SERVER['REQUEST_URI']));
	$_url=array_shift(explode('?',$_url));
	
	define('REL_PATH',str_repeat('../',substr_count(substr($_url,strlen($_path)+1),'/')));
	unset($_url,$_path);
	
	#Configuración principal del sitio
	define("HREF_DEFAULT", "javascript:void(0);");
	define("DIRECTORIO", "/");
	define("CARPETA_ADMIN", "wpanel/");
	define("EMAIL_CONTACTO", "contact@almacenadoraadonai.com");
	define("EMAIL_NO_RESPONDA", "noreply@almacenadoraadonai.com");
	define("PERSONA_CONTACTO", "The team Websarrollo");
	define("RETARDO", 0);
	
	#Configuración de metas de la pagina principal
	define("TITLE", "Wonderland Playground");
	define("SLOGAN", "Slogan here...");
	define("COPYRIGHT", "");
	define("AUTHOR", "Websarrollo.com");
	define("DESCRIPTION", "");
	define("KEYWORDS", "");
	
	#Configuracion de la conexion a la bd
	define("HOST", "localhost");
	define("USER", $_wuser);
	define("PASS", $_wpass);
	define("DATA", $_wdata);
	
	#menu
	$_LEFT_MENU[0]['LINK']=DOMINIO."?id=4&type=3";
	$_LEFT_MENU[0]['TITLE']="Parties";
	$_LEFT_MENU[0]['CLASS']="menuOption1";
	//$_LEFT_MENU[0]['TOOLTIP']="Smart devices repair";

	$_LEFT_MENU[1]['LINK']=DOMINIO."?id=5&type=3";
	$_LEFT_MENU[1]['TITLE']="Pricing";
	$_LEFT_MENU[1]['CLASS']="menuOption2";
	//$_LEFT_MENU[1]['TOOLTIP']="Smart devices repair";

	$_LEFT_MENU[2]['LINK']=DOMINIO."?id=6&type=3";
	$_LEFT_MENU[2]['TITLE']="Groups";
	$_LEFT_MENU[2]['CLASS']="menuOption3";
	//$_LEFT_MENU[2]['TOOLTIP']="Smart devices repair";

	$_LEFT_MENU[3]['LINK']=DOMINIO."?current=galery";
	$_LEFT_MENU[3]['TITLE']="Gallery";
	$_LEFT_MENU[3]['CLASS']="menuOption4";
	//$_LEFT_MENU[3]['TOOLTIP']="";
	
	$_LEFT_MENU[4]['LINK']=DOMINIO."?current=booking";
	$_LEFT_MENU[4]['TITLE']="Booking";
	$_LEFT_MENU[4]['CLASS']="menuOption6";
	//$_LEFT_MENU[0]['TOOLTIP']="Smart devices repair";

	$_LEFT_MENU[5]['LINK']=DOMINIO."?id=7&type=3";
	$_LEFT_MENU[5]['TITLE']="FAQs";
	$_LEFT_MENU[5]['CLASS']="menuOption7";
	//$_LEFT_MENU[1]['TOOLTIP']="Smart devices repair";

	$_LEFT_MENU[6]['LINK']=DOMINIO."?current=contact";
	$_LEFT_MENU[6]['TITLE']="Contact Us";
	$_LEFT_MENU[6]['CLASS']="menuOption5";
	//$_LEFT_MENU[2]['TOOLTIP']="Smart devices repair";
	
	///// RIGHT 
	
    $_RIGHT_MENU[0]=null;
	//$_RIGHT_MENU[0]['LINK']=DOMINIO."?current=contact";
	//$_RIGHT_MENU[0]['TITLE']="Contact Us";
	//$_RIGHT_MENU[0]['TOOLTIP']="Smart devices repair";
	
	#Banner
	
	$_BANNER[0]['src']="img/banner/1.jpg";
	$_BANNER[0]['url']="?current=booking";
	$_BANNER[0]['caption']="Book a Party"; 
	
	$_BANNER[1]['src']="img/banner/2.jpg";
	$_BANNER[1]['url']="?";
	$_BANNER[1]['caption']="News"; 

	$_BANNER[2]['src']="img/banner/6.jpg";
	$_BANNER[2]['url']="?current=events";
	$_BANNER[2]['caption']="Events"; 
	
	$_BANNER[3]['src']="img/banner/3.jpg";
	$_BANNER[3]['url']="?current=subscription";
	$_BANNER[3]['caption']="Subscription of Special Promotions"; 
	
	$_BANNER[4]['src']="img/banner/4.jpg";
	$_BANNER[4]['url']="?id=9&type=3";
	$_BANNER[4]['caption']="Mommy & Me Activities";  
	
	
	
	$_NAME_ON_TOP=false;


?>