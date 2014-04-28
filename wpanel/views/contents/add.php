<?php
if($_GET['type']!=''){  //news 1, services 2, Contents 3
	
	 $content_type = mysql_query("SELECT * FROM content_type WHERE id = '".$_GET['type']."' ") or die (mysql_error());
	 $content_type = mysql_fetch_assoc($content_type);
	 
     if ($_POST['sumito']=="si" && $_POST['id']==''){ //insert
		 //_imprimir($_POST);
		
			

				mysql_query("INSERT INTO contents SET 
									id_status = '".$_POST['status']."',
									name = '".$_POST['name']."',
									summary = '".$_POST['resumen']."',
									text = '".$_POST['des']."',
									id_type = '".$_GET['type']."'	
							") or die (mysql_error());
				
				mensajes("Info","Process Successfully.");	

			
			
	 }elseif ($_POST[sumito]=="si" && $_POST['id']!=''){ //update
	 
		

			mysql_query("UPDATE contents SET 
							id_status = '".$_POST['status']."',
							summary = '".$_POST['resumen']."',
							text = '".$_POST['des']."',
							name = '".$_POST['name']."'

						WHERE id = '".$_POST['id']."' and id_type = '".$_GET['type']."'
					") or die (mysql_error());
			
			mensajes("Info","Process Successfully.");	

	 }
	 
	 include("fckeditor/fckeditor.php");
     
	 $query = mysql_query("SELECT * FROM contents WHERE id = '".$_GET['id']."' and id_type = '".$_GET['type']."' ") or die (mysql_error());
	 $array = mysql_fetch_assoc($query);
	 $titleSection = 'Update '.$content_type['name'].' :: '.$array['name'];
	 
	 $status = mysql_query("SELECT * FROM status ORDER BY id") or die (mysql_error());
?>

<fieldset>
	
	<legend><?=$titleSection?></legend>
	
	<form action="" method="post" enctype="multipart/form-data" class="custom" data-abide>
		<div class="row">
		<div class="name-field large-8 columns">
			<label>Name: <small>required</small></label>
			<input type="text" name="name" value="<?=$array['name']?>" required  >
			<small class="error">Name is required.</small>
		</div>

		<div class="address-field large-8 columns">
			<label>Summary <small>required</small></label>
			<textarea required name="resumen" ><?=$array['summary']?></textarea>
			<small class="error">Summary is required.</small>
		</div>	

		<div class="twitter-field large-12 columns">	
			<label>Description: <small>required</small></label>
		<?php
			$oFCKeditor = new FCKeditor('des') ; // es el id y name del campo de texto
			$oFCKeditor->BasePath = 'fckeditor/'; // ruta al script fckeditor
			//$cuerpo= html_entity_decode($cuerpo); // Para que se muestre como elementos HTML y no como 'codigo HTML'
			$oFCKeditor->Width  = '100%' ; // ancho del formulario
			$oFCKeditor->Height = '250' ; // alto del formulario
			$oFCKeditor->Value  = $array['text']; // '$cuerpo' Contenido del textarea
			$oFCKeditor->Config['AutoDetectLanguage']    = false ;
			$oFCKeditor->Config['DefaultLanguage']        = 'es' ;
			$oFCKeditor->Create() ; //  se crea el textarea    
		?>
		</div>


		<div class="large-4 columns">
			<label for="status">Status:</label>

			<select name="status" id="status" >
				<?php while ($statu = mysql_fetch_assoc($status)){ ?>
				<option value="<?=$statu['id']?>" <?php if ($statu['id']==$array[id_status]){ echo "selected"; } ?> ><?=$statu['name']?></option>
				<?php } ?>
			</select>

		</div>



		<div class="large-12 columns">
			<button type="submit">Submit</button>
			<input name="sumito" type="hidden" id="sumito" value="si" />
			<input type="hidden" name="id" id="id" value="<?=$_GET['id']?>" />
			<input type="hidden" name="url" id="url" value="<?=$_GET['url']?>" />

				<?php if ($_GET['id']!=''){ ?>	
				<a href="index.php?type=<?=$_GET['type']?>&id=<?=$_GET['id']?>&url=views/galeria.php"><img src="../img/photoGalery.png"/><a/>
				<?php if($_GET['type']!=1){?>
				<a href="index.php?type=<?=$_GET['type']?>&id=<?=$_GET['id']?>&url=views/video.php"><img src="../img/videoGalery.png"/><a/>
				<?php } } ?>
		</div>
	</div>			
	</form>
</fieldset>
<?php

}else{
	 
	mensajes("Alert!","Sorry this content can't be loaded"); 
	 
 }
?>