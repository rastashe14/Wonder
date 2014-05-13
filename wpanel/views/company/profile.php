<?php

	//unlink('./images/'.$this->input->post('logo_name'));
	 if ($_SERVER['SERVER_NAME']=="www.wonderlandplayground.com" || $_SERVER['SERVER_NAME']=="wonderlandplayground.com"){
		$targetFolder = '/img/';
	}else{
		$targetFolder= '/Wonder/img/';
	}


	 if (!empty($_FILES)) {

		$parts = explode('.', $_FILES['file']['name']);
		$ext   = strtolower(end($parts)); 
		$tempFile = $_FILES['file']['tmp_name'];
		$targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder;
		//$targetFile =  str_replace('//','/',$targetPath) . md5($parts[0]).'.'.$ext;
		$targetFile =  str_replace('//','/',$targetPath) .md5($parts[0]).'.'.$ext;

		// Validate the file type
		$fileTypes = array('jpg','JPG','jpeg','JEPG','gif','GIF','png','PNG',); // File extensions
		$fileParts = pathinfo($_FILES['file']['name']);
		
		if (in_array($fileParts['extension'],$fileTypes)){
			@mkdir(str_replace('//','/',$targetPath), 0777, true);
			move_uploaded_file($tempFile,$targetFile);
			redimensionar($targetFile, $targetFile, 300,100);
			$img  = campo('config','`keys`', 'logo','value');

			@unlink(REL_PATH.'img/'.$img);

			mysql_query("UPDATE config SET `value` = '".md5($parts[0]).'.'.$ext."' WHERE `keys` = 'logo' ") or die (mysql_error());
			//echo $tempFile.'-'.$targetFile.'-'.$_FILES["file"]["error"];
		} else {
			$er = 1;
			//echo 'Invalid file type.'; 
		}
	}


     if ($_POST['sumito']=="si"){
		 //_imprimir($_REQUEST);
		
				mysql_query("UPDATE company SET 
						name = '".$_POST['name']."',
						email = '".$_POST['email']."',
						address = '".$_POST['address']."',
						zipCode = '".$_POST['zipCode']."',
						facebook = '".$_POST['facebook']."',
						twitter = '".$_POST['twitter']."',
						tlf = '".$_POST['tlf']."',
						text = '".$_POST['profile']."'					  
					WHERE id = '1' 
				") or die (mysql_error());
				$uri = 'views/company/profile.php';
			
			
			($er!=1)?mensajes("Info","Process Successfully."):mensajes("Info","Invalid file type.");	
		 
	 }//sumito
	
	
	// print_r($_FILES);
	// echo  $_POST['file'];


	 if ($_REQUEST['loc']!=''){
		 $sql = "SELECT * FROM locations WHERE id = '".$_REQUEST['loc']."' ";
	 }else{
		 $sql = "SELECT * FROM company WHERE id = '1' ";
	 }
	 
	 $query = mysql_query($sql) or die (mysql_error());
	 $array = mysql_fetch_assoc($query);
	 $timestamp = time();
?>
<fieldset>
	
	<legend>COMPANY <?=($_GET['loc']!=''?'LOCATIONS':'PROFILE')?></legend>
	<form action=""  method="post" data-abide enctype="multipart/form-data">
	<?php
	if(empty($_REQUEST['loc'])){
	?>	

	<div class="name-field large-8 columns">
					<label>Name: <small>required</small></label>
					<input type="text" name="name" value="<?=$array['name']?>" required  >
					<small class="error">Name is required.</small>
	</div>	

	<div class="email-field large-4 columns">
					<label>Email: <small>required</small></label>
					<input type="email" name="email" value="<?=$array['email']?>" required  >
					<small class="error">Email is required.</small>
	</div>

	<div class="tlf-field large-4 columns">
					<label>Phone <small>required</small></label>
					<input type="text" name="tlf" value="<?=$array['tlf']?>" placeholder="1 234-567-8910"  required pattern="number"> 
					<small class="error">A phone number is required.</small>
	</div>
	<div class="ZipCode-field large-4 columns">
					<label>ZipCode <small>required</small></label>
					<input type="text" name="zipCode" value="<?=$array['zipCode']?>"  pattern="[0-9]+" required>
					<small class="error">ZipCode is required, Just Numbers.</small>
	</div>
	<div class="address-field large-8 columns">
					<label>Address <small>required</small></label>
					<textarea required name="address" ><?=$array['address']?></textarea>
					<small class="error">An address is required.</small>
	</div>
	<div class="facebook-field large-6 columns">
					<label>Facebook: </label>
					<input type="text" value="<?=$array['facebook']?>" name="facebook"   >
	</div>

	<div class="twitter-field large-6 columns">
					<label>Twitter: </label>
					<input type="text" value="<?=$array['twitter']?>" name="twitter"   >
	</div>

	<?php }?>	
	<div class="twitter-field large-12 columns">	
	<label>Sumary: <small>required</small></label>
	<textarea id="profile" name="profile" class="ckeditor"><?=$array['text']?></textarea>
	<?php /*
		include("fckeditor/fckeditor.php");
		$oFCKeditor = new FCKeditor('profile2') ; // es el id y name del campo de texto
		$oFCKeditor->BasePath = 'fckeditor/'; // ruta al script fckeditor
		//$cuerpo= html_entity_decode($cuerpo); // Para que se muestre como elementos HTML y no como 'codigo HTML'
		$oFCKeditor->Width  = '100%' ; // ancho del formulario
		$oFCKeditor->Height = '300' ; // alto del formulario
		$oFCKeditor->Value  = $array['text']; // '$cuerpo' Contenido del textarea
		$oFCKeditor->Config['AutoDetectLanguage']    = false ;
		$oFCKeditor->Config['DefaultLanguage']        = 'en' ;
		$oFCKeditor->Create() ; //  se crea el textarea    
	*/ ?>
	</div>
	<div class="logo-field large-12 columns" style="margin: 20px 0">
		<label>Change logo: </label>
		<div style="border: 1px solid #ccc; height: 80px; border-radius: 5px">
			<div class="founFile">
				Search
				<input type="file" id="file" name="file">
			</div>
			<div id="textLogo" style="margin-top: 30px; color: #A3A3A3">
				No file selected
			</div><br>
			<legend style="position: absolute;background: none"><small>The image size should not exceed 2 MB and dimension 300 X 100 </small></legend>
		</div>
		
	</div>
	<div class="twitter-field large-12 columns">
		<button type="submit">Submit</button>
		<input type="hidden" name="sumito" id="sumito" value="si" />
		<input type="hidden" name="url" id="url" value="<?=$_GET['url']?>" />
		<input type="hidden" name="loc" id="loc" value="<?=($_GET['loc']!=''?$_GET['loc']:'')?>" />
		<input type="hidden" name="action" id="action" value="<?=($_GET['action']!=''?$_GET['action']:'add')?>" />		
    </div>
</form>
	
</fieldset>
<script type="text/javascript">
(function(){
	CKEDITOR.replace('profile',{
		removeButtons:'Image,Table'
	});
	$('#file').change(function(event){
		$('#textLogo').html($('#file').val());
		//alert($('#file').val());
	});
})();
</script>