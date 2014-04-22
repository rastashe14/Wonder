<?php
	 include ('includes/header.php');
	 
	 if (isset($_SESSION['wspanel_user'])){
	 
	 if ($_GET['url']=="logout"){
	     unset($_SESSION["wspanel_user"]);
		 redirect("form_login.php");
		 die();
	 }
?> 

<div class="row ">
	<div class="large-12  columns  top logo">
		<img src="../img/logo.png" width="200" />
			
	</div>
</div>	
<div class="row ">	
	
		<?php include ('includes/menu.php');?>
			
	
</div>	
<div class="row panel">	
	<div class="large-12  columns ">
		<?php if(!isset($_GET['url'])){
		include ('views/company/profile.php');
			}elseif(file_exists($_GET['url'])){
				include ($_GET['url']);
			}else{
				
				mensajes("Alert!","Sorry this content can't be loaded"); 
			}
	?>
		
	</div>
</div>
<?php 	  
	 include ('includes/footer.php'); 
     
	 }else{
	 
	       redirect("form_login.php");
	 
	 }
?>