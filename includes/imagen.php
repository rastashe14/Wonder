<?php
	include_once("resizeimage.inc.php");
	$rimg=new RESIZEIMAGE($_GET['img']);
	echo $rimg->error();
	switch ($_GET['tipo']){
	        case 1:	$rimg->resize_percentage($_GET['porc']);       break;
	        case 2: $rimg->resize($_GET['ancho'], $_GET['alto']); break;
			case 3: $rimg->resize_limitwh($_GET['ancho'], 0);
	}
			
	$rimg->close();
	/*
	<!-- 
			+ --------------------------------------------------------- +
			|                                                           |
			| 	Desarrollado por: Gustavo A. Ocanto C.                  |
			| 	Email: gustavoocanto@gmail.com / info@websarrollo.com   |
			| 	Teléfono: 0414-428.42.30 / 0245-511.38.40               |
			| 	Web: http://www.gustavoocanto.com                       |
			|        http://www.websarrollo.com                         |
			| 	Valencia, Edo. Carabobo - Venezuela                     |
			|                                                           |
			+ --------------------------------------------------------- +
	-->
	*/	
?>