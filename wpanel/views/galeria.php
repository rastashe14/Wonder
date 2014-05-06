<?php
	
     $content_type = mysql_query("SELECT * FROM content_type WHERE id = '".$_GET['type']."' ") or die (mysql_error());
	 $content_type = mysql_fetch_assoc($content_type);
	
	if($_GET['type']=="galeria"){
		$folder = 'galery';
		$url = '?type='.$_GET[type].'&url='.$_GET[url];		
		$titleSection = ':: General Gallery ::';	
		
	}else{

		$folder = $content_type['folder'].'/'.$_GET[id];
		$url = '?type='.$_GET[type].'&url='.$_GET[url].'&id='.$_GET[id];		
		$titleSection = 'Gallery '.$content_type['name'].' :: '.campo('contents', 'id', $_GET['id'], 'name');
	}
	
	if ($_GET[delimg]=="si"){
	    @unlink("../img/".$folder."/".$_GET['foto']);
		mensajes("Info!","The picture was deleted");
		$busqueda = mysql_query("SELECT * FROM  `location_pic_detail` WHERE  `img` LIKE  '".$_GET['foto']."'") or die (mysql_error());
		if(mysql_num_rows ($busqueda)!=0){
			mysql_query("DELETE FROM location_pic_detail WHERE img = '".$_GET['foto']."' ") or die (mysql_error());
		}
	}
	$timestamp = time();
	$unique = md5('unique_salt' . $timestamp);

	if ($_SERVER['SERVER_NAME']=="www.wonderlandplayground.com" || $_SERVER['SERVER_NAME']=="wonderlandplayground.com"){
		$dominio = '/img/'.$folder.'/';
	}else{
		$dominio = '/Wonder/img/'.$folder.'/';
	}

$jsLibraries="
<link rel='stylesheet'  type='text/css' href='../js/uploadify/uploadify.css'/>
<script type='text/javascript' src='../js/uploadify/jquery.uploadify.js'></script>
<script type='text/javascript'>
	$(function() {
	  $('#file_upload').uploadify({
	  		'queueID'  		 : 'some_file_queue',
		  	'fileSizeLimit'  : '5MB',
		  	'formData'       : {
						'folder' 	: '$dominio',
						'timestamp' : '$timestamp',
						'token'     : '$unique'
		  	},
	        'swf'            : '../js/uploadify/uploadify.swf',
	        'uploader'       : '../js/uploadify/uploadify.php', 
			'fileTypeDesc'   : 'Image Files',
	        'fileTypeExts'   : '*.gif; *.jpg; *.png',
	        'checkExisting'  : '../js/uploadify/check-exists.php',
			'multi'    	 	 : true,
		  	'auto'           : true,
			'removeCompleted': false,
			'queueID'        : 'custom-queue',
			'uploadLimit'    : 10,
			'onUploadError' : function(file, errorCode, errorMsg, errorString) {
	            alert('The file ' + file.name + ' could not be uploaded: ' + errorString);
	        }
	  });
	  
	  	$('#titleWpanel').html('".strtoupper($titleSection)."');
	  
		$('.nombreFoto input').blur(function (){
			id=$(this).attr('target');
			input='#'+id.split('.')[0];	

			$.ajax({
				type    : 'POST',
				url     : 'views/contents/pictureNameUpdate.php?img='+id+'&name='+$(input).val(),
				dataType: 'html',
				success : function (data){ }
			});	
		});
		
		$('.nombreFoto input').focus(function (){		
			if ($.trim($(this).val())=='Description...')
				$(this).val('');		
		});
	});
</script>
" ?>
<style type="text/css">
#custom-demo .uploadifyQueueItem {
  background-color: #FFFFFF;
  border: none;
  border-bottom: 1px solid #E5E5E5;
  font: 11px Verdana, Geneva, sans-serif;
  height: 50px;
  margin-top: 0;
  padding: 10px;
  
}
#custom-demo .uploadifyError {
  background-color: #FDE5DD !important;
  border: none !important;
  border-bottom: 1px solid #FBCBBC !important;
}
#custom-demo .uploadifyQueueItem .cancel {
  float: right;
}
#custom-demo .uploadifyQueue .completed {
  color: #C5C5C5;
}
#custom-demo .uploadifyProgress {
  background-color: #E5E5E5;
  margin-top: 10px;
  width: 100%;
}
#custom-demo .uploadifyProgressBar {
  background-color: #0099FF;
  height: 3px;
  width: 1px;
}
#custom-demo #custom-queue {
  border: 1px solid #E5E5E5;
  height: 213px;
margin-bottom: 10px;
  
}
</style>
<div class="row">
	<a href="<?php echo $_SERVER['HTTP_REFERER']; ?>" class="button small radius">Volver</a>
	<h3><?=$titleSection?></h3>
	<h4><small>Select the picture(s) to upload: </small></h4>	
	<div class="large-12  columns panel" >
			<input id="file_upload" name="file_upload" type="file" />
			<div class="demo-box" >
				<div id="status-message" > </div>
				<div class="uploadifyQueue" id="custom-queue"></div>
				<input style="display: none;" id="custom_file_upload" name="Filedata" height="0" type="file" width="0">
				<object style="visibility: visible;" id="custom_file_uploadUploader" data="../js/uploadify/uploadify.swf" type="application/x-shockwave-flash" height="0" width="0">
					<param value="high" name="quality"><param value="opaque" name="wmode"><param value="sameDomain" name="allowScriptAccess">
					<param value="uploadifyID=custom_file_upload&amp;pagepath=/demos/&amp;script=/uploadify/uploadify.php&amp;folder=/uploads&amp;width=0&amp;height=0&amp;wmode=opaque&amp;method=POST&amp;queueSizeLimit=3&amp;simUploadLimit=3&amp;fileSizeLimit=100KB&amp;fileDesc=Image Files (.JPG, .GIF, .PNG)&amp;fileExt=*.jpg;*.gif;*.png&amp;multi=true&amp;auto=true&amp;fileDataName=Filedata&amp;queueID=custom-queue" name="flashvars">
				</object>        
			</div>
	</div>
	<legend><small>The image size should not exceed 2 MB.</small></legend><br>
	<a href="<?=$url?>" class="button small radius">Refresh</a>
    <h4 ><small>Pictures on web:&nbsp;<em >Click on picture to delete.</em></small></h4>       
    
	<div class="large-12  columns panel" >
		<?php
			$carpeta = '../img/'.$folder;
			$dir     = @opendir($carpeta);

			while ($file = @readdir($dir))
			{
				if ($file != "." && $file != ".." && $file != "Thumbs.db" && trim($file, ' ') != '' && $file!='index.html'&& $file!='.svn' && $file!='' && $file!='.DS_Store' && $file!='_notes' && $file!='principal.jpg' && $file!='index.html')

				{ 

					$aux = explode("_", $file);

					//$borra="onclick=\"confirm('Are you sure to delete this pic? ', 'Confirmation!', '".$url."&delimg=si&foto=".$file."');\""; 
					$inputValue=campo("location_pic_detail", "img", $file, "description");
					$inputId=explode(".",$file);
					$inputId=$inputId[0];

					echo "
						<div style='display:inline; float:left; margin:1px; width:205px; border:1px #ccc;'>
						<a href='#' data-reveal-id='Modal".$inputId."'>
							<img src='../includes/imagen.php?tipo=3&ancho=200&img=$carpeta/$file' border='0' style='cursor:pointer; border:1px solid #CCC'  />
						</a>	
						<div style='float:left; width: 199px; margin: 3px 0 5px 0px; padding 3px 0; height: 20px;' class='nombreFoto' > 

							<input id='".$inputId."' type='text' value='".(trim($inputValue)!=''?$inputValue:'Description...')."' style='width: 198px; border:1px solid #ccc;height: 16px;color: #999;' target='".$file."' />
						</div>
						</div>	
						<div id='Modal".$inputId."' class='reveal-modal small' data-reveal>
							<h3><small>Are you sure to delete this pic?</small></h3>
							<img src='../includes/imagen.php?tipo=3&ancho=200&img=$carpeta/$file'  />
							<a href='".$url."&delimg=si&foto=".$file."'  class='small radius button'>Yes</a>
							<a class='close-reveal-modal'>&#215;</a>
						</div>
					";
				}
			}
			@closedir($dir);
		?>
	</div>
</div>