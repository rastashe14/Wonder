<?php 
if($_GET['type']!=''){  //news 1, services 2, Contents 3

if(isset($_GET['del'])){

	mysql_query("DELETE FROM videos WHERE id = '".$_GET['idv']."' and id_content_type = '".$_GET['type']."' AND id_contents = '".$_GET['id']."'") or die (mysql_error());
	mensajes("Info!","The video was deleted successfully");
 }
 //echo $_POST['video'].'<br>';
if($_POST['video']!=''){
	if(!preg_match(regex('video'),$_POST['video'])){
		mensajes("Error!","Invalid video!!!");
	}else{
		if(isVideo('vimeo',$_POST['video'])){
			$video = $resV=preg_replace(regex('vimeo'),'http://player.vimeo.com/video/$5',$_POST['video']);
			//$class = 'flex-video widescreen vimeo';
			//$atr = 'webkitAllowFullScreen mozallowfullscreen';

			mysql_query("INSERT INTO videos SET 
									id_contents = '".$_GET['id']."',
									id_content_type = '".$_GET['type']."',
									video = '".$video."',
									class = 'flex-video widescreen vimeo'
							") or die (mysql_error());

			mensajes("Info!","Your video has been successfully registered!!!");
		}elseif(isVideo('youtube',$_POST['video'])){
			$video=preg_replace(regex('youtube'),'http://youtube.com/embed/$7$9',$_POST['video']);
			//$class = 'flex-video';

			mysql_query("INSERT INTO videos SET 
									id_contents = '".$_GET['id']."',
									id_content_type = '".$_GET['type']."',
									video = '".$video."',
									class = 'flex-video'
							") or die (mysql_error());

			mensajes("Info!","Your video has been successfully registered!!!");
		}else{
			mensajes("Error!","Invalid video!!!"); echo 1;
		}
	}
}


$content_type = mysql_query("SELECT * FROM content_type WHERE id = '".$_GET['type']."' ") or die (mysql_error());
$content_type = mysql_fetch_assoc($content_type);

if($_GET['type']=="video"){
	$url = '?type='.$_GET[type].'&url='.$_GET[url];		
	$titleSection = ':: Video Gallery ::';	
}else{
	$url = '?type='.$_GET[type].'&id='.$_GET[id].'&url='.$_GET[url];		
	$titleSection = 'Video '.$content_type['name'].' :: '.campo('contents', 'id', $_GET['id'], 'name');
}
	
?>

<div class="row">
	<h3><?=$titleSection?></h3>
	<h4><small>Place the url of the video: <small>(youtube o vimeo)</small> </small></h4>	
	<form action="?url=views/video.php&type=<?=$_GET[type]?>&id=<?=$_GET[id]?>"  method="post" id="form" data-abide>
		<div class="name-field large-8 columns">
			<label>Video: <small>required</small></label>
			<input type="text" name="video" id="video" required >
			<small class="error">A url video is required.</small>
		</div>
		<div class="small-12 columns">
			<button type="submit" class="radius" id="send">Submit</button>
			<input type="hidden" name="url" id="url" value="<?=$_GET['url']?>" />
		</div>
	</form>
</div>

<div class="row">
	<div class="small-12 columns panel radius" >
	<?php 
	$videos = mysql_query("SELECT * FROM videos WHERE id_contents = '".$_GET['id']."' AND id_content_type = '".$_GET['type']."' ") or die (mysql_error());
	$num = mysql_num_rows($videos);
	//echo $num;
	
	if($num==0){?>
		<div>
			No video registered!!!
		</div>
	<?php }
	?>
	<ul class="small-block-grid-1 medium-block-grid-2 large-block-grid-3">
	<?php
	while($video = mysql_fetch_assoc($videos)){ 
	?>
	    <li>
	   	    <div class="<?=$video['class']?> th" style="display: block;">
	   			<iframe src="<?=$video['video']?>" frameborder="0" allowfullscreen webkitAllowFullScreen mozallowfullscreen></iframe>
	   	    </div>

	   	   <a href="#" data-reveal-id="Modal<?=$video['id']?>">Delete video</a>

	   	    <div id="Modal<?=$video['id']?>" class="reveal-modal small" data-reveal>
				<h3><small>Are you sure to delete this video?</small></h3>
				<a href='<?=$url.'&del&idv='.$video['id']?>' class='small radius button'>Yes</a>
				<a class='close-reveal-modal'>&#215;</a>
			</div>

		</li>
	<?php }?>
	</ul>
	</div>
</div>
<?php

}else{
	mensajes("Alert!","Sorry this content can't be loaded"); 
 }
?>
<script  type="text/javascript">
$('#txtVideo').bind('change keyup',function(){
		var that=this,URL=that.value;
		console.log(URL);
		if(URL.match(/^https?:\/\/vimeo\.com\/.+\/.+/)){
			var $running=$('#vimeo #running'),
				$success=$('#vimeo #success'),
				$error=$('#vimeo #error');
			function hideMsgs(){
				if(sto) clearTimeout(sto);
				sto=setTimeout(function(){
					$success.fadeOut('slow');
					$error.fadeOut('slow');
				},3000);
			}
			pub=false;
			$success.hide();
			$error.hide();
			if(!vc) $running.show();
			vc++;
			$.ajax({
				url:'http://vimeo.com/api/oembed.json',
				type:'GET',
				data:{url:URL},
				success:function(data){
					if(that.value==URL){
						that.value='http://vimeo.com/'+data['video_id'];
						$success.show();
						hideMsgs();
					}
				},
				error:function(){
					$error.show();
					hideMsgs();
				},
				complete:function(){
					vc--;
					if(!vc) $running.hide();
					pub=true;
				}
			});
		}
	}).trigger('change');
</script>