<div class="row "> <!-- Footer -->
	    <div class="large-12">
			<ul class="breadcrumbs">
				
				<?php
	foreach($_LEFT_MENU as $menuItem ){
	?>	
	  <li  class="<?=$menuItem['CLASS']?>Footer"><a  href="<?=$menuItem['LINK']?>"><?=$menuItem['TITLE']?></a></li>
      
	<?php } 
		
	foreach($_RIGHT_MENU as $menuItem ){
	?>	
	  <li  class="<?=$menuItem['CLASS']?>Footer"><a  href="<?=$menuItem['LINK']?>"><?=$menuItem['TITLE']?></a></li>
      
	<?php }?>   

			</ul>
			
	<div class="large-12 panel "><small>
		<?php
	$empresas = mysql_query("SELECT * FROM company WHERE id = '1'") or die (mysql_error());
	$empresa  = mysql_fetch_assoc($empresas);
?>
		
	<?=$empresa[address]?>.&nbsp;
	<strong>Zip Code: </strong>&nbsp;<?=$empresa[zipCode]?>
	
    <strong>Phone: </strong>&nbsp;<?=$empresa[tlf]?></td>
    <strong>Email: </strong>&nbsp;<a href="mailto:<?=$empresa[email]?>"><?=$empresa[email]?></a>
    <strong>Social: </strong>&nbsp;<a href="<?=$empresa[facebook]?>" target="_blank" onfocus="this.blur();">Facebook</a>, <a href="<?=$empresa[twitter]?>" target="_blank" onfocus="this.blur();">Twitter</a>
    </br>
	<strong>Developed by: </strong>&nbsp;<a href="http://maoghost.com/" target="_blank" onfocus="this.blur();">Maoghost.com</a>
	</small>
	</div>	
			
		</div>

	</div>	