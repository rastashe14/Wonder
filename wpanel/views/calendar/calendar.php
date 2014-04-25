<?php 
     if ($_POST['action']=="update"){
		 //_imprimir($_REQUEST);
			
			$sti = $_POST['start_date'].' '.$_POST['start_time'];
	 		//$ete = $_POST['end_date'].' '.$_POST['end_date'];

			mysql_query("UPDATE calendar SET 
						name = '".$_POST['name']."',
						description = '".$_POST['description']."',
						date_ini = '".$sti."',
						location = '".$_POST['location']."'						  
						WHERE id = '".$_POST['id']."' 
			") or die (mysql_error());
			
			mensajes("Info","Process Successfully.");
	 }

	 if ($_POST['action']=="add"){
	 		$sti = $_POST['start_date'].' '.$_POST['start_time'];
	 		//$ete = $_POST['end_date'].' '.$_POST['end_date'];

		 	mysql_query("INSERT INTO calendar SET 
						name = '".$_POST['name']."',
						description = '".$_POST['description']."',
						date_ini = '".$sti."',
						location = '".$_POST['location']."'	
			") or die (mysql_error());
					
			mensajes("Info","Process Successfully.");
	 }
	 
	 $sql = "SELECT * FROM calendar WHERE id = '".$_GET['id']."' ";
	
	 $query = mysql_query($sql) or die (mysql_error());
	 $array = mysql_fetch_assoc($query);

	 $dti = explode(" ", $array['date_ini']);
	 //fecha fin
	 //$dte = explode(" ", $array['date_end']);
	 
	 // print_r($dti);
	 // print_r($dte);
?>
<fieldset>
	
	<legend>CALENDAR</legend>
	<form action="?url=views/calendar/update.php"  method="post">
		
	<div class="row">
		<div class="name-field large-6 columns">
						<label>Name: <small>required</small></label>
						<input type="text" name="name" value="<?=$array['name']?>" required  >
						<small class="error">Name is required.</small>
		</div>	
	</div>
	<div class="row">
		<div class="description-field large-6 columns">
			<label>Description: <small>required</small></label>
			<textarea name="description" cols="30" rows="10"><?=$array['description']?></textarea>
			<small class="error">Description is required.</small>
		</div>
	</div>
	<div class="row">&nbsp;</div>
	<div class="row">
		<div class="date-field large-8 columns">
			<label>Start Date  <small>required</small></label>
			<div class="date-field large-4 columns">
				<input type="date" name="start_date" value="<?=$dti[0]?>" required>
				<small class="error">Start date is required.</small>
			</div>
			<div class="large-4 columns" style="float:left">
				<input type="time" name="start_time" id="start_time" required>
				<small class="error">Start time is required.</small>
			</div>
			
		</div>
	</div>
	<!-- <div class="row">
		<div class="date-field large-8 columns">
			<label>End date <small>required</small></label>
			<div class="large-4 columns">
				<input type="date" name="end_date" value="<?=$dte[0]?>" required>
			</div>
			<div class="large-4 columns">
				<input type="time" name="end_time" value="<?=$dte[1]?>">
			</div>
			<small class="error">End date required.</small>
		</div>
	</div> -->
	<div class="row">
		<div class="large-6 columns">
			<label>Location:<small>required</small></label>
			<input type="text" name="location" value="<?=$array['location']?>" required>
			<small class="error">End date required.</small>
		</div>
		</div>
    </div>

	<div class="row">
		<div class="twitter-field large-12 columns">
			<button type="submit">Submit</button>
			<input type="hidden" name="id" id="id" value="<?=$_GET['id']?>" />
			<input type="hidden" name="action" id="action" value="<?=($_GET['id']!=''?'update':'add')?>" />
		</div>
    </div>
	</form>
</fieldset>	