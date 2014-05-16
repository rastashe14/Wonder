<?php
if($_GET['type']!=''){//news 1, services 2, Contents 3
	$gid=$_GET['id'];
	$content_type = mysql_query('SELECT * FROM content_type WHERE id = "'.$_GET['type'].'"') or die (mysql_error());
	$content_type = mysql_fetch_assoc($content_type);

	if($_POST['action']=='add'){//insert
		//_imprimir($_POST);
		mysql_query("
			INSERT INTO contents SET
				id_status = '".$_POST['status']."',
				name = '".$_POST['name']."',
				summary = '".$_POST['resumen']."',
				text = '".$_POST['des']."',
				id_type = '".$_GET['type']."'
		") or die (mysql_error());
		mensajes("Info","Process Successfully.");	
	}
	if($_POST['action']=='update'){//update
		mysql_query("
			UPDATE contents SET
				id_status = '".$_POST['status']."',
				summary = '".$_POST['resumen']."',
				text = '".$_POST['des']."',
				name = '".$_POST['name']."'
			WHERE id = '".$_POST['id']."' and id_type = '".$_GET['type']."'
		") or die (mysql_error());
		mensajes("Info","Process Successfully.");
	}
	$query = mysql_query("SELECT * FROM contents WHERE id = '".$_GET['id']."' and id_type = '".$_GET['type']."' ") or die (mysql_error());
	$array = mysql_fetch_assoc($query);
	$titleSection = $_GET['id']!=''?'Update '.$content_type['name'].' :: '.$array['name']:'Add '.$content_type['name'];
	$status = mysql_query("SELECT * FROM status ORDER BY id") or die (mysql_error());

	$type=$content_type['folder'];
	if($gid==''){
		@mkdir("../img/$type/new",0777,true);
		$gid='new/n'.date('YmdHis').rand(0,9);
	}
	$dir="$type/$gid";
	if($gid!=''){//id de galeria
		@mkdir("../img/$type/$gid",0777,true);
	}
?>
<fieldset>
	<legend><?=$titleSection?></legend>
	<form action="?url=views/contents/update.php&type=<?=$_GET['type']?>" method="post" enctype="multipart/form-data" class="custom" data-abide>
		<?php if($_GET['id']==''){ ?>
		<input type="hidden" name="img_folder" value="<?=$gid?>"/>
		<?php } ?>
		<div class="row">
			<div class="name-field large-8 columns">
				<label>Name: <small>required</small></label>
				<input type="text" name="name" value="<?=$array['name']?>" required/>
				<small class="error">Name is required.</small>
			</div>
			<div class="address-field large-8 columns">
				<label>Summary <small>required</small></label>
				<textarea required name="resumen" ><?=$array['summary']?></textarea>
				<small class="error">Summary is required.</small>
			</div>
			<div class="twitter-field large-12 columns">
				<label>Description: <small>required</small></label>
				<textarea id="description" name="des" class="ckeditor"><?=$array['text']?></textarea>
			<?php /*
				include("fckeditor/fckeditor.php");
				$oFCKeditor = new FCKeditor('des') ; // es el id y name del campo de texto
				$oFCKeditor->BasePath = 'fckeditor/'; // ruta al script fckeditor
				//$cuerpo= html_entity_decode($cuerpo); // Para que se muestre como elementos HTML y no como 'codigo HTML'
				$oFCKeditor->Width  = '100%' ; // ancho del formulario
				$oFCKeditor->Height = '250' ; // alto del formulario
				$oFCKeditor->Value  = $array['text']; // '$cuerpo' Contenido del textarea
				$oFCKeditor->Config['AutoDetectLanguage']    = false ;
				$oFCKeditor->Config['DefaultLanguage']        = 'es' ;
				$oFCKeditor->Create() ; //  se crea el textarea    
			*/ ?>
			</div>
			<div class="large-4 columns">
				<label for="status">Status:</label>
				<select name="status" id="status" >
					<?php while ($statu = mysql_fetch_assoc($status)){ ?>
					<option value="<?=$statu['id']?>" <?php if ($statu['id']==$array[id_status]){ echo "selected"; } ?>><?=$statu['name']?></option>
					<?php } ?>
				</select>
			</div>
			<div class="large-12 columns">
				<button type="submit">Submit</button>
				<input type="hidden" name="id" id="id" value="<?=$_GET['id']?>"/>
				<input type="hidden" name="url" id="url" value="<?=$_GET['url']?>"/>
				<input type="hidden" name="action" id="action" value="<?=$_GET['id']?"update":"add";?>"/>
				<?php if($gid!=''){ ?>
					<span id="gallery" class="pointer"><img src="../img/photoGalery.png"/></span>
					<!-- <a href="index.php?type=<?=$_GET['type']?>&id=<?=$_GET['id']?>&url=views/galeria.php"><img src="../img/photoGalery.png"/></a> -->
				<?php if($_GET['type']!=1){?>
					<div id="videoIMG" style="float: right;position: absolute;top: 0;left: 240px;"><img src="../img/videoGalery.png"/></div>
				<?php } } ?>
			</div>
		</div>			
	</form>
	<style type="text/css">
	#kcfinder_div,#kcfinder_title{
		display:none;
		margin-top:5px;
	}
	#kcfinder_div{
		position:relative;
		background:#e0dfde;
		border:2px solid #3687e2;
		-webkit-border-radius:6px;
		-moz-border-radius:6px;
		border-radius:6px;
		padding:1px;
	}
	#kcfinder_div iframe{
		width:100%;
		height:400px;
	}
	</style>
	<div id="kcfinder_title">Gallery Folder: <b><?=$dir?></b></div>
	<div id="kcfinder_div"></div>
</fieldset>
<script type="text/javascript">
(function(){
	var dir='<?=$dir?>',
		get='type=<?=$type?>&dir='+dir,
		kcf_path='../ckeditor/kcfinder',
		gallery=kcf_path+'/browse.php?'+get;
	CKEDITOR.replace('description',{
		filebrowserImageBrowseUrl:kcf_path+'/browse.php?opener=ckeditor&'+get,
		filebrowserImageUploadUrl:kcf_path+'/upload.php?opener=ckeditor&'+get
	});
	$('#gallery').click(function(){
		if($('#kcfinder_div iframe').length&&$('#kcfinder_div iframe').attr('src')==gallery){
			$('#kcfinder_title').hide();
			$('#kcfinder_div').empty().hide();
		}else{
			$('#kcfinder_title').show();
			$('#kcfinder_div').empty().html('<iframe src="'+gallery+'" frameborder="0" marginwidth="0" marginheight="0" scrolling="no"/>').show();
		}
	});
	$('#videoIMG').click(function(){
		$( "#video" ).toggle( "slide" );
	});
})();
</script>
<div id="video" style="display:none;">
	<?php include('views/video.php');?>
</div>
<?php
}else{
	mensajes("Alert!","Sorry this content can't be loaded"); 

}
?>
