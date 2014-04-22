<?php
     if ($_POST[sumito]=="si"){
		if ($_POST['_id']!=""){ 
			
			if (existe('type_facilities', 'id', " WHERE name = '".$_POST[name]."' ")){
				$name = "id_status = '".$_POST[status]."'";
			}else{
				$name = "
					id_status = '".$_POST[status]."',
					name = '".$_POST[name]."'
				";
			}
			
			$update = mysql_query("
				UPDATE type_facilities SET
					$name
				WHERE id = '".$_POST['_id']."' 
			") or die (mysql_error());
			
		}else{
			
			$insert = mysql_query("
					INSERT INTO type_facilities SET 
						id_status = '".$_POST[status]."',
						name = '".$_POST[name]."'
			") or die (mysql_error());
		
		}//insert
		
		mensajes("Process Successfully!", "Informaction!", "?url=type_faci_upd");
		 
	 }//sumito
     
	 $query = mysql_query("SELECT * FROM type_facilities WHERE id = '".$_GET[_id]."'") or die (mysql_error());
	 $array = mysql_fetch_assoc($query);
	 $status = mysql_query("SELECT * FROM status") or die (mysql_error());
?>

<fieldset>
<legend>Type Facilities</legend>
<form method="post" data-abide>
	<div class="row">
		<div class="name-field large-12 columns">
			<label>Name: <small>required</small></label>
			<input type="text" name="name" value="<?=$array['name']?>" required  >
			<small class="error">Name is required.</small>
		</div>	

		<div class="status-field large-12 columns">
			<label>Status: <small>required</small></label>
			<select name="status" id="status" requerido="Status">
				<?php while ($sta = mysql_fetch_assoc($status)){?>					
				<option value="<?=$sta[id]?>" <?php if ($sta[id]==$array[id_status]) echo 'selected'; ?> ><?=$sta[name]?></option>
				<?php } ?>
			</select>
			<small class="error">Status is required.</small>
		</div>

		<div class="large-12 columns">
			<button type="submit">Submit</button>
			<a href="?url=<?=$_GET['url']?>" class="button">Clear</a>
		</div>

		<input name="sumito" type="hidden" id="sumito" value="si" />
		<input type="hidden" name="_id" id="_id" value="<?=$_GET[_id]?>" />
	</div>
</form>
</fieldset>