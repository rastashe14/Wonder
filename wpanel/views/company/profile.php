<?php
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
			
			
			mensajes("Info","Process Successfully.");	
		 
	 }//sumito
	 
	 include("fckeditor/fckeditor.php");
	 
	 if ($_REQUEST['loc']!=''){
		 $sql = "SELECT * FROM locations WHERE id = '".$_REQUEST['loc']."' ";
	 }else{
		 $sql = "SELECT * FROM company WHERE id = '1' ";
	 }
	 
	 $query = mysql_query($sql) or die (mysql_error());
	 $array = mysql_fetch_assoc($query);
	 
?>
<fieldset>
	
	<legend>COMPANY <?=($_GET['loc']!=''?'LOCATIONS':'PROFILE')?></legend>
	<form action=""  method="post" data-abide>
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
					<input type="tel" name="tlf" value="<?=$array['tlf']?>" placeholder="1 234-567-8910" pattern="[0-9]+" required>
					<small class="error">A phone number is required.</small>
	</div>
	<div class="ZipCode-field large-4 columns">
					<label>ZipCode <small>required</small></label>
					<input type="text" name="zipCode" value="<?=$array['zipCode']?>"  pattern="[0-9]+" required>
					<small class="error">ZipCode is required, Just Numbers.</small>
	</div>
	<div class="address-field large-8 columns">
					<label>Address <small>required</small></label>
					<textarea required name="address"  pattern="[a-zA-Z]+"><?=$array['address']?></textarea>
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
	<?php
		$oFCKeditor = new FCKeditor('profile') ; // es el id y name del campo de texto
		$oFCKeditor->BasePath = 'fckeditor/'; // ruta al script fckeditor
		//$cuerpo= html_entity_decode($cuerpo); // Para que se muestre como elementos HTML y no como 'codigo HTML'
		$oFCKeditor->Width  = '100%' ; // ancho del formulario
		$oFCKeditor->Height = '300' ; // alto del formulario
		$oFCKeditor->Value  = $array['text']; // '$cuerpo' Contenido del textarea
		$oFCKeditor->Config['AutoDetectLanguage']    = false ;
		$oFCKeditor->Config['DefaultLanguage']        = 'en' ;
		$oFCKeditor->Create() ; //  se crea el textarea    
	?>
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