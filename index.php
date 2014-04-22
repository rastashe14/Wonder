<?php
	 include ('includes/config.php');
	 include ('includes/conexion.php');
	 include ('includes/funciones.php');
?> 
<!DOCTYPE html>
<!--[if IE 8]> 				 <html class="no-js lt-ie9" lang="en" > <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en" > <!--<![endif]-->

<head>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  
   <meta http-equiv="cache-control" content="no-cache">

	<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1">

	<meta name="robots" content="all,index,follow">

	<meta name="rating" content="General">

	<meta name="reply-to" content="<?=EMAIL_CONTACTO?>">

	<meta name="copyright" content="<?=COPYRIGHT?>">

	<meta name="Author" content="<?=AUTHOR?>" />

	<meta name="keywords" lang="en" content="<?=KEYWORDS?>" />

	<meta name="description" content="<?=DESCRIPTION?>" />

	<title><?=TITLE?></title> 
  
  <link rel="stylesheet" href="css/foundation.css">
  <link rel="stylesheet" href="css/style.css">
  <script src="js/vendor/custom.modernizr.js"></script>
</head>
<body>
<?php 
	include ('views/header.php');
	include ('views/menu.php'); 
	include ('views/banner.php');
	
	if($_GET['current']=='contact'){
		include ('views/contact.php');
	}elseif($_GET['current']=='booking'){	
		include ('views/booking.php');
	}elseif($_GET['current']=='galery'){	
		include ('views/galery.php');
	}elseif($_GET['current']=='subscription'){	
		include ('views/subscription.php');
	}else{
		include ('views/content.php');
	}
	include ('views/footer.php');	
?>
  <script src="js/jquery.js"></script>
  <script src="js/foundation.min.js"></script>
  <script>
    $(document).foundation();

  </script>
</body>
</html>