<?php
	include ('includes/config.php');
	include ('includes/conexion.php');
	include ('includes/funciones.php');
?>
<!DOCTYPE html>
<!--[if IE 8]>			<html class="no-js lt-ie9" lang="en">	<![endif]-->
<!--[if gt IE 8]><!-->	<html class="no-js" lang="en">			<!--<![endif]-->

<head>
	<meta charset="utf-8"/>
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

	<link rel="stylesheet" href="css/foundation.css"/>
	<link rel="stylesheet" href="css/style.css"/>
	<script src="js/vendor/jquery.js"></script>
	<script src="js/vendor/custom.modernizr.js"></script>
</head>
<body>
<?php
	include('views/header.php');
	include('views/menu.php');
	include('views/banner.php');

	if($_GET['current']=='contact'){
		include('views/contact.php');
	}elseif($_GET['current']=='booking'){
		include('views/booking.php');
	}elseif($_GET['current']=='galery'){
		include('views/galery.php');
	}elseif($_GET['current']=='subscription'){
		include('views/subscription.php');
	}elseif($_GET['current']=='events'){
		include('views/events.php');
	}elseif($_GET['current']=='eventsDetails'){
		include('views/eventsDetails.php');
	}else{
		include('views/content.php');
	}
	include('views/footer.php');
?>
	<script src="js/jquery.js"></script>
	<script src="js/foundation.min.js"></script>
	<script src="js/foundation/foundation.clearing.js"></script>
	<script>
		$(document).foundation({
			abide:{
				live_validate:true,
				focus_on_invalid:true,
				error_labels:true,//labels with a for="inputId" will recieve an `error` class
				timeout:1000,
				patterns:{
					alpha:/^[a-zA-Z]+$/,
					alpha_numeric:/^[a-zA-Z0-9]+$/,
					integer:/^[-+]?\d+$/,
					number:/^[-+]?[1-9]\d*$/,

					// http://www.whatwg.org/specs/web-apps/current-work/multipage/states-of-the-type-attribute.html#valid-e-mail-address
					email:/^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/,
					datetime:/([0-2][0-9]{3})\-([0-1][0-9])\-([0-3][0-9])T([0-5][0-9])\:([0-5][0-9])\:([0-5][0-9])(Z|([\-\+]([0-1][0-9])\:00))/,
					// YYYY-MM-DD
					date:/(?:19|20)[0-9]{2}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:30))|(?:(?:0[13578]|1[02])-31))/,
					// HH:MM:SS
					time:/(0[0-9]|1[0-9]|2[0-3])(:[0-5][0-9]){2}/,
				},
				validators:{
					diceRoll:function(el,required,parent){
						var possibilities = [true, false];
						return possibilities[Math.round(Math.random())];
					}
				}
			}
		});
	</script>
</body>
</html>