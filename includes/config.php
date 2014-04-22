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
	    $_wuser = "wonderlandpl_db";
		$_wpass = "6234838";	
	    $_wdata = "wonderlandpl_db";
	    $_wdomi = "http://wonderlandplayground.com/";
	}else{
	    $_wuser = "root";
		$_wpass = "root";	
	    $_wdata = "dbfasti";
	    $_wdomi = "http://192.168.1.123/wonder/";
	}
	
	#Configuración principal del sitio
	define("DOMINIO", $_wdomi);
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
	$_LEFT_MENU[0]['CLASS']="menuParties";
	//$_LEFT_MENU[0]['TOOLTIP']="Smart devices repair";

	$_LEFT_MENU[1]['LINK']=DOMINIO."?id=5&type=3";
	$_LEFT_MENU[1]['TITLE']="Pricing";
	$_LEFT_MENU[1]['CLASS']="menuPricing";
	//$_LEFT_MENU[1]['TOOLTIP']="Smart devices repair";

	$_LEFT_MENU[2]['LINK']=DOMINIO."?id=6&type=3";
	$_LEFT_MENU[2]['TITLE']="Groups";
	$_LEFT_MENU[2]['CLASS']="menuGroups";
	//$_LEFT_MENU[2]['TOOLTIP']="Smart devices repair";

	$_LEFT_MENU[3]['LINK']=DOMINIO."?current=galery";
	$_LEFT_MENU[3]['TITLE']="Gallery";
	$_LEFT_MENU[3]['CLASS']="menuGallery";
	//$_LEFT_MENU[3]['TOOLTIP']="";
	
	$_LEFT_MENU[4]['LINK']=DOMINIO."?current=booking";
	$_LEFT_MENU[4]['TITLE']="Booking";
	$_LEFT_MENU[4]['CLASS']="menuLocation";
	//$_LEFT_MENU[0]['TOOLTIP']="Smart devices repair";

	$_LEFT_MENU[5]['LINK']=DOMINIO."?id=7&type=3";
	$_LEFT_MENU[5]['TITLE']="FAQs";
	$_LEFT_MENU[5]['CLASS']="menuFAQs";
	//$_LEFT_MENU[1]['TOOLTIP']="Smart devices repair";

	$_LEFT_MENU[6]['LINK']=DOMINIO."?current=contact";
	$_LEFT_MENU[6]['TITLE']="Contact Us";
	$_LEFT_MENU[6]['CLASS']="menuContact";
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
	$_BANNER[1]['caption']="News and Events"; 
	
	$_BANNER[2]['src']="img/banner/3.jpg";
	$_BANNER[2]['url']="?current=subscription";
	$_BANNER[2]['caption']="Subscription of Special Promotions"; 
	
	$_BANNER[3]['src']="img/banner/4.jpg";
	$_BANNER[3]['url']="?id=9&type=3";
	$_BANNER[3]['caption']="Mommy & Me Activities"; 
	
//	$_BANNER[4]['src']="img/banner/5.jpg";
//	$_BANNER[4]['caption']="..."; 
	
	$_NAME_ON_TOP=false;


?>