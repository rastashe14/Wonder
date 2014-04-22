<div class="row panel" > 
<?php 
						
		$folder='img/galery'; 

		if (file_exists($folder)) { 
			
			
			?>
                  <div class="large-12 columns panel radius">
					<h3>Gallery</h3>
					<ul class="clearing-thumbs " data-clearing>
                <?php 
					
					if (file_exists($folder)) {
					
                        $pics = opendir($folder);
                        while ($pic = readdir($pics)){
                            if ($pic != "." && $pic != ".."&& $pic != ".svn" && $pic != "Thumbs.db" && trim($pic, ' ') != '' && $pic!='index.html' && $pic!='' && $pic!='.DS_Store' && $pic!='_notes'){  
                    ?>
                            <li style="width:210px; height:140px; margin:3px; overflow-y:hidden; "><a href="<?=$folder."/".$pic?>" ><img data-caption="<?=$data_caption?>" src="includes/imagen.php?tipo=3&ancho=210&img=../<?=$folder."/".$pic?>"></a></li>
                         
                    <?php 
                            } 
                        }
                    } ?>
							
					</ul>
				</div>		
			<?php }?> 					
	 </div>