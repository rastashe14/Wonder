<?php
	 
	 
     include ('../../../includes/config.php');
	 include ('../../../includes/funciones.php');
     include ('../../../includes/conexion.php');

	 
	 if($_GET['name']!=''&&$_GET['img']!=''){
		 
		 
		 
		 
		$busqueda = mysql_query("SELECT * FROM  `location_pic_detail` WHERE  `img` LIKE  '".$_GET['img']."'") or die (mysql_error()); 
		 
	   if(mysql_num_rows ($busqueda)!=0){	 
		  
			$update = mysql_query("UPDATE location_pic_detail SET description = '".$_GET['name']."'

						WHERE img = '".$_GET[img]."' 

					") or die (mysql_error());
	   }else{
		   
		   
		   mysql_query("INSERT INTO  `location_pic_detail` (
						`id` ,
						`img` ,
						`description`
						)
						VALUES (
						NULL ,  '".$_GET['img']."',  '".$_GET['name']."'
						);") or die (mysql_error());
	   }
	 } 
?> 
