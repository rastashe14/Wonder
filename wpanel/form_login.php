<?php include ('includes/header.php'); ?>
<div class="row ">
		<div class="small-8 small-centered columns logo panel">
			<img src="../img/logo.png" />
		</div>
	
	<div class="small-8 small-centered columns panel" style="float: none">
		<form name="login" id="login" method="post" action="includes/login.php" data-abide >
			
			<div class="user-field">
				<label>User: <small>required</small></label>
				<input type="text" name="user" required  >
				<small class="error">User is required.</small>
			</div>
			<div class="password-field">
				<label>Password: <small>required</small></label>
				<input type="password" name="password" required  data-invalid>
				<small class="error">Passwords must be at least 5 characters with 1 capital letter, 1 number, and one special character.</small>
			</div>
		<button type="submit">Submit</button>
		
			<?php if (isset($_GET['error'])){ mensajes("Error.", "The user doesn't exists!"); }?>


		</form>
	</div>
</div>

<?php  include ('includes/footer.php'); ?>