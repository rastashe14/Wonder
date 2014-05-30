<?php

	require_once ('includes/header.php');

	if(isset($_SESSION['wspanel_user'])){
	
	if($_GET['url']=="logout"){
		include('includes/logout.php');
	}

	$imgLogo=campo('config','`keys`','logo','value');
?>
<div id="header-menu">	
	<div class="row">
		<div class="large-10 columns top logo">
			<img src="../img/<?=$imgLogo?>" width="200" style="height:70px;width:200px"/>
		</div>
		<div class="large-2 columns top logo" style="padding: 0;">
			<div class="contain-to-grid" style="background: none">
			  <nav class="top-bar" data-topbar>
			    <section class="top-bar-section">
				    <ul class="right">
				      <li><a href="index.php?url=views/themes/themes.php">Themes</a></li>
				    </ul>
				  </section>
			  </nav>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<?php require_once ('includes/menu.php');?>
</div>
<div class="row panel">
	<div class="large-12 columns">
	<?php
		if(!isset($_GET['url'])){
			include('views/company/profile.php');
		}elseif(file_exists($_GET['url'])){
			include($_GET['url']);
		}else{
			mensajes("Alert!","Sorry this content can't be loaded");
		}
	?>
	</div>
</div>
<?php
	include('includes/footer.php');
	}else{
		redirect('form_login.php');
	}

?>
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

			//amex, visa, diners
			card:/^(?:4[0-9]{12}(?:[0-9]{3})?|5[1-5][0-9]{14}|6(?:011|5[0-9][0-9])[0-9]{12}|3[47][0-9]{13}|3(?:0[0-5]|[68][0-9])[0-9]{11}|(?:2131|1800|35\d{3})\d{11})$/,
			cvv:/^([0-9]){3,4}$/,

			//http://www.whatwg.org/specs/web-apps/current-work/multipage/states-of-the-type-attribute.html#valid-e-mail-address
			email:/^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/,

			url:/(https?|ftp|file|ssh):\/\/(((([a-zA-Z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:)*@)?(((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|((([a-zA-Z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-zA-Z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-zA-Z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-zA-Z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-zA-Z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-zA-Z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-zA-Z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-zA-Z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?)(:\d*)?)(\/((([a-zA-Z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-zA-Z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)?)?(\?((([a-zA-Z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?)*)?(\#((([a-zA-Z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|\/|\?)*)?/,
			//abc.de
			domain:/^([a-zA-Z0-9]([a-zA-Z0-9\-]{0,61}[a-zA-Z0-9])?\.)+[a-zA-Z]{2,6}$/,

			datetime:/([0-2][0-9]{3})\-([0-1][0-9])\-([0-3][0-9])T([0-5][0-9])\:([0-5][0-9])\:([0-5][0-9])(Z|([\-\+]([0-1][0-9])\:00))/,
			//YYYY-MM-DD
			date:/(?:19|20)[0-9]{2}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:30))|(?:(?:0[13578]|1[02])-31))/,
			//HH:MM:SS
			time:/(0[0-9]|1[0-9]|2[0-3])(:[0-5][0-9]){2}/,
			dateISO:/\d{4}[\/\-]\d{1,2}[\/\-]\d{1,2}/,
			//MM/DD/YYYY
			month_day_year:/(0[1-9]|1[012])[- \/.](0[1-9]|[12][0-9]|3[01])[- \/.](19|20)\d\d/,

			//#FFF or #FFFFFF
			color:/^#?([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$/
		}
	}
});
</script>