<?php


	 (isset($_GET['err']))?($_GET['err']==0)?mensajes("Info","Process Successfully."):mensajes("Info","Invalid file type."):'';

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
	<form action="includes/imglogo.php"  method="post" data-abide enctype="multipart/form-data">
	<?php
	if(empty($_REQUEST['loc'])){
	?>

	<div class="name-field large-8 columns">
					<label>Name: <small>required</small></label>
					<input type="text" name="name" value="<?=$array['name']?>" required/>
					<small class="error">Name is required.</small>
	</div>

	<div class="email-field large-4 columns">
					<label>Email: <small>required</small></label>
					<input type="email" name="email" value="<?=$array['email']?>" required/>
					<small class="error">Email is required.</small>
	</div>

	<div class="tlf-field large-4 columns">
					<label>Phone <small>required</small></label>
					<input type="text" name="tlf" value="<?=$array['tlf']?>" placeholder="1 234-567-8910"  required pattern="number"/> 
					<small class="error">A phone number is required.</small>
	</div>
	<div class="ZipCode-field large-4 columns">
					<label>ZipCode <small>required</small></label>
					<input type="text" name="zipCode" value="<?=$array['zipCode']?>"  pattern="[0-9]+" required/>
					<small class="error">ZipCode is required, Just Numbers.</small>
	</div>
	<div class="address-field large-8 columns">
					<label>Address <small>required</small></label>
					<textarea required name="address" ><?=$array['address']?></textarea>
					<small class="error">An address is required.</small>
	</div>
	<div class="facebook-field large-6 columns">
					<label>Facebook: </label>
					<input type="text" value="<?=$array['facebook']?>" name="facebook"/>
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
			<legend style="position: absolute;background: none"><small>The image size should not exceed 2 MB and dimension 300px X 100px </small></legend>
		</div>
		
	</div>
	<div class="twitter-field large-12 columns">
		<button type="submit" id="submit">Submit</button>
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
	var valid = 1, img = '';
	$('#file').bind('change', function(){
		//alert(this.files[0].type);
		img = 0;
		switch(this.files[0].type){
			case 'image/png':  img = 1;
			case 'image/jpeg': img = 1;
			case 'image/gif':  img = 1;
		}
		if ((this.files[0].size>7500000)||(img!=1)){
			$('#textLogo').html('<span style=" color: #FF0000; font-weight: bold">The size is too big o It is not an image file</span>');
			valid = 0;
		}else{
			$('#textLogo').html('<span style=" color: #00A300; font-weight: bold">'+$('#file').val()+'</span>');
			valid = 1;
		};
	});
	$('button[type="submit"]').click(function(event) {
		//alert($('#file').val());
		if (valid!=1) {
			return false;
		};
	});
})();
</script>