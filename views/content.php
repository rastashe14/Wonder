<?php 
$type=$_GET['type']; 
$id=$_GET['id'];

if($type==''&&$id==''){
	$type=1; 
	$id='home';
	
}

if($type!=''){  
	
	 $content_type = mysql_query("SELECT * FROM content_type WHERE id = '".$type."' ") or die (mysql_error());
	 $content_type = mysql_fetch_assoc($content_type);
			    
				switch ($type){
					
					case 0://Company 
							
							$_conf = array(
								'sql' => "SELECT text, name FROM company WHERE id = '1' ",
								'folder' => false,
								'sql_menu' =>  false,
								'title_menu' => false,
			              	);
					break;
				
					case 1: //News
					case 2:	//Services
					case 3: //Contents
							
							$_conf = array(
								'sql' =>($id!="home") ? "SELECT * FROM contents WHERE id = '".$id."' ":"SELECT * FROM contents WHERE id_type='".$type."' ORDER BY date DESC LIMIT 1" ,
								'folder' => $content_type['folder'],
								'link' => '?type='.$type,
								'sql_menu' =>  ($type==1||$type==2)?"SELECT * FROM contents WHERE id_type='".$type."' ORDER BY id DESC LIMIT 10" : false,
								'title_menu' => '+ '.$content_type['name']
			              	);
					break;
				
					case 4://Location 
							
							$_conf = array(
								'sql' => "SELECT * FROM locations WHERE id = '1' ",
								'folder' => 'locations/',
								'sql_menu' =>  false
			              	);
					break;
				 
					
				}
				
				$query = mysql_query($_conf['sql']) or die (mysql_error());
				$array = mysql_fetch_assoc($query);
			
				
if($id=="home"){				
?>
<div class="row panel text-center titleIni">
	Remember to bring socks
</div>
<?php } ?>
<div class="row panel " > 
       <div class="large-<?= $_conf['sql_menu'] ? 9 : 12 ?> columns ">
       <?php if($type==1&&$id=='home'){ ?>
       		<ul data-orbit data-options="timer_speed: 8000; animation_speed: 4000; pause_on_hover: false;">
	       		<?php 
	       		$query = mysql_query($_conf['sql_menu']) or die (mysql_error());
				while($news = mysql_fetch_assoc($query)){
				?>
				<li>
					<div style="padding: 0 40px">
					   <p>&nbsp;</p>
					   <h3>
					   <a style="color:#ff810a !important;" href="<?=DOMINIO.$_conf['link']?>&id=<?=$news['id']?>"><?=$news[name]?></a>
					   </h3>
					   <p style="color: #868585 !important;padding: 10px 0 0 15px;font-size: 17px !important;"><?=$news[summary]?></p>
					</div>
				</li>
				<?php } ?>
			</ul>
	    <?php }else{?>
			<h3><?=$array[name]?><h3>
			<p><?=$array[text]?></p>
		<?php
		}

		//echo $_conf['folder']."<br>"; $type
		if($_conf['folder']){ 
			$folder='img/'.$_conf['folder'].'/'.$id;
			if (file_exists($folder)) { ?>
<!--				<h4><a href="#galery" >View Gallery</a></h4>-->
			<?php }
		}

		if (file_exists($folder) && $_conf['folder']) { 
			
			if (file_exists($folder)) {
			
                $pics = opendir($folder);
                $cont=0;
                while ($pic = readdir($pics)){
                    if ($pic != "." && $pic != ".."&& $pic != ".svn" && $pic != "Thumbs.db" && trim($pic, ' ') != '' && $pic!='index.html' && $pic!='' && $pic!='.DS_Store' && $pic!='_notes'){  
            
						if($_conf['folder']=='locations/')$data_caption=campo("location_pic_detail", "img", $pic, "description");
						$cont++;
						if($cont==1){echo '<div class="large-12 columns panel radius "><h3>Gallery</h3><ul class="clearing-thumbs " data-clearing>'; }
						?>

                   <li style="width:200px; height:140px; margin:3px; overflow-y:hidden; "><a href="<?=$folder."/".$pic?>" ><img data-caption="<?=$data_caption?>" src="includes/imagen.php?tipo=3&ancho=210&img=../<?=$folder."/".$pic?>"></a></li>
            		<?php 
                    } 
                }    
                if($cont!=0){echo '</ul></div>	';}
            } 
         }
		?>
	 </div>
	 
	 <?php
	 $videos = mysql_query("SELECT * FROM videos WHERE id_contents = '".$_GET['id']."' AND id_content_type = '".$_GET['type']."' ") or die (mysql_error());
		$num = mysql_num_rows($videos);

		if($num!=0){
        ?>
		<div class="row">
		 	<div class="large-12 columns panel radius"><h3>Videos</h3>
				<ul class="small-block-grid-1 medium-block-grid-2 large-block-grid-4">
				<?php
				while($video = mysql_fetch_assoc($videos)){ 
				?>
				    <li>
				   	    <div class="<?=$video['class']?>" style="display: block;">
				   			<iframe src="<?=$video['video']?>" frameborder="0" allowfullscreen webkitAllowFullScreen mozallowfullscreen></iframe>
				   	    </div>
				    </li>
				<?php }?>
				</ul>
			</div>
		</div>
		<?php }?>

<?php 
	if ($_conf['sql_menu']){
		$menus = mysql_query($_conf['sql_menu']) or die (mysql_error()); 
?>
		<div class="large-3 columns ">
			<h3><?=$_conf['title_menu']?></h3>
			<ul class="side-nav">
          <?php while ($menu = mysql_fetch_assoc($menus)){?>
				<li ><a style="color:#B38448 !important; font-weight: bold" href="<?=DOMINIO.$_conf['link']?>&id=<?=$menu['id']?>"><?=$menu['name']?></a></li>
				<li class="divider"></li>
          <?php } ?>
			 
          	</ul>
			
		</div>
<?php } ?>
</div>
<?php

}else{
	 
	mensajes("Alert!","Sorry this content can't be loaded"); 
	 
 }
?>

 <script>
// 	function

// 	$('.orbit-bullets-container').hide();
</script>