<?php

if(isset($_GET['del'])){
	//eliminarDir('views/themes/new_css/'.($_GET['idv']));
	
	eliminarDir('views/themes/new_css/'.($_GET['idv']));

	mysql_query('DELETE FROM `themes` WHERE `themes`="'.$_GET['idv'].'"');
	mensajes("Info","El tema se elimino correctamente.");
}


if(isset($_GET['desc'])||isset($_GET['exits'])||isset($_GET['subio'])){
	if($_GET['desc']==0&&$_GET['exits']==0&&$_GET['subio']==0){
		mensajes("Info","El tema se cargo correctamente.");
		@unlink('views/themes/new_zip/'.$_GET['arc']);
	}elseif ($_GET['exits']==1) {
		mensajes("Error!","El nombre de archivo esta duplicado.");
	}elseif ($_GET['subio']==1) {
		mensajes("Error!","Ocurrio un error al subir el archivo intente de nuevo.");
	}elseif ($_GET['desc']==1) {
		mensajes("Error!","Ocurrió un error y el archivo no se pudó descomprimir.");
	}
}
?>
<style>
	#listThemes>div:last-child{
		float: left;
	}
</style>
<fieldset>
	<legend>THEMES</legend>
	<form action="?url=views/themes/updating.php" method="post" enctype="multipart/form-data">

	<div class="logo-field large-12 columns" style="margin: 20px 0">
		<label>Select the zip file: </label>
		<div style="border: 1px solid #ccc; height: 80px; border-radius: 5px">
			<div class="founFile">
				Search
				<input type="file" accept=".zip" name="file" id="file">
			</div>
			<div id="textLogo" style="margin-top: 30px; color: #A3A3A3">
				No file selected
			</div><br>
			<legend style="position: absolute;background: none">
				<small class="wpanel-msg-small">The image size should not exceed 2 MB</small>
			</legend>
		</div>	
	</div>
	<input type="hidden" value="1" name="hidden"><br>
	<button type="submit" id="submit">Submit</button>
	<button type="button" id="reset">Reset</button>
	<!-- <div style="height: 55px; width: 100%"> -->
		<button data-reveal-id="helpTheme">Help</button>
		<div id="helpTheme" class="reveal-modal small" data-reveal>
			<div data-reveal-id="cssTheme" style="margin-bottom: 20px;font-weight: bold;cursor: pointer;">Ver codigo css</div>
			<img src="../img/ayudaTheme.png" alt="Help">
			<div class='close-reveal-modal'>&#215;</div>
		</div>
		<div id="cssTheme" class="reveal-modal medium" data-reveal>
			<pre style="margin-left: -250px">
				body{
					background: url('img/images.jpg') !important;
				}


				/* menu superior */
				#sub-nav-top dd a{
					color: #eee !important;
					padding: 0;
					margin-right: 5px;
					margin-left: -5px; 
					font-size: 12px;
					font-family: "Lucida Console", Monaco, monospace !important;
					margin-left: -8px;
				}
				#sub-nav-top dd a:hover{ 
					color: #A6B5CC !important;

				}
				/* fin menu superior */


				.top-bar, .top-bar-section, .left {
					background:transparent !important;
				}


				/* menu principal */
				.menuParties a , .menuPricing a, .menuGroups a, .menuGallery a, 
				.menuLocation a, .menuFAQs a, .menuContact a{
					background: url('img/menu.png') no-repeat !important;
					border:0 !important;
					color:#4E5197 !important;
					font-family: "Lucida Console", Monaco, monospace !important;
					font-size:22px !important;
					font-weight:700 !important;
					padding:10px 0px 10px !important;
					text-decoration:none !important;
					text-align: center;
				}
			</pre>
			<div class='close-reveal-modal'>&#215;</div>
		</div>
	<!-- </div> -->
	</form>
</fieldset>
<fieldset>
<div id="loader" style="position: absolute;left: 440px;top: 200px; display: none"><img src="../img/loader.gif" width="80" height="80"></div>
<?php 

$ruta = $_SERVER['DOCUMENT_ROOT'].'/Wonder/wpanel/views/themes/new_css';
//echo $ruta;
$valor = listar_directorios_ruta($ruta);
if(count($valor)>0){
	//print_r($valor);
	$nonActive = $themenew==''?"There isn't theme active ":"";

	echo '<legend>Theme List</legend><small class="wpanel-msg-small">Click to activate the theme. '.$nonActive.'</small><br><br><div class="row" id="listThemes">';
	foreach ($valor as $key) {
		if ($themenew==$key) {
			$class = "font-weight:bold; color:#ACACAC;";
			$msgActive = " - Selected Theme.";
			$imgDel = "<span style='margin-right: 29px;'></span>";
		}else{
			$class = "";
			$msgActive = "";
			$imgDel = "<img class='imgdeleteWpanel'  data-reveal-id='$key' />";
		}
		?>
		<div class="small-11 columns" style="<?=$class?> border-bottom: 1px solid #ccc;padding: 10px 20px;font-size: 16px;margin-left: 16px;">
			<?=$imgDel?>
			<span style="color: #87bff3; cursor: pointer" key="<?=$key?>"><?=$key?></span><?=$msgActive?>
		</div>

		<div id="<?=$key?>" class="reveal-modal small" data-reveal>
			<h3><small>Are you sure to delete <?=$key?>?</small></h3>
			<a href='<?='?url=views/themes/themes.php&del&idv='.$key?>' class='small radius button'>Yes</a>
			<div class='close-reveal-modal'>&#215;</div>
		</div>
	
	<?php }
	echo '</div>';
}else{
	echo 'Not loaded theme.';
}
//print_r(listar_directorios_ruta($ruta));
?>
</fieldset>
<script type='text/javascript'>
	$(function() {
		var valid = 1, zip = '';
		
		$('#listThemes span').click(function(event) {
			
			$('#loader').show();
			$('body').addClass('opacityOver');

			var a = $(this).attr('key');

			$.ajax({
			  type: "POST",
			  url: "views/themes/updating.php?t="+a,
			  success: function(data) {
			  		//alert(data);
			  		location.href='?url=views/themes/themes.php';
			  },
			  dataType: "html"
			});

		});

		$('#file').bind('change', function(){
			
			zip = 0;
			switch(this.files[0].type){
				case 'application/x-zip-compressed':  zip = 1;
			}

			if ((this.files[0].size>2000000)||(zip!=1)){
				$('#textLogo').html('<span style=" color: #FF0000; font-weight: bold">The size is too big or It is not an zip file</span>');
				valid = 0;
			}else{
				$('#textLogo').html('<span style=" color: #00A300; font-weight: bold">'+$('#file').val()+'</span>');
				valid = 1;
			};
		});

		$('button[type="submit"]').click(function(event) {
			return (zip!=0)?(valid!=1)?false:'':false;
		});

		$('button[type="button"]').click(function(event) {
			$('#loader').show();
			$('body').addClass('opacityOver');

			// var a = $(this).attr('key');

			$.ajax({
			  type: "POST",
			  url: "views/themes/updating.php?t=0",
			  success: function(data) {
			  		//alert(data);
			  		location.href='?url=views/themes/themes.php';
			  },
			  dataType: "html"
			});

			//alert('1');
			//location.href='?url=views/themes/updating.php&t=0';
		});	
	});
</script>