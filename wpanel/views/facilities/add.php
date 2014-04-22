<?php
     if ($_POST[sumito]=="si"){
		if ($_POST['_equi']!=""){ 
			
			if (existe('facilities', 'id', " WHERE id_type = '".$_POST[faci]."' AND name = '".$_POST[name]."' ")){
				$name = "id_status = '".$_POST[status]."'";
			}else{
				$name = "
					id_status = '".$_POST[status]."',
					id_type = '".$_POST[faci]."',
					name = '".$_POST[name]."'
				";
			}
			
			$update = mysql_query("
				UPDATE facilities SET
					$name
				WHERE id = '".$_POST['_equi']."' 
			") or die (mysql_error());
			
		}else{
			
			$insert = mysql_query("
					INSERT INTO facilities SET 
						id_status = '".$_POST[status]."',
						id_type = '".$_POST[faci]."',
						name = '".$_POST[name]."'
			") or die (mysql_error());
		
		}//insert
		
		mensajes("Process Successfully!", "Informaction!", "?url=facilities_upd");
		 
	 }//sumito
     
	 $query = mysql_query("SELECT * FROM facilities WHERE id = '".$_GET[_faci]."'") or die (mysql_error());
	 $array = mysql_fetch_assoc($query);
	 
	 $type_faci = mysql_query("SELECT * FROM type_facilities") or die (mysql_error());
	 $status = mysql_query("SELECT * FROM status") or die (mysql_error());
?>

<fieldset>
<legend>Facilities</legend>
<form method="post" data-abide>
	
	<div class="row">
		
		<div class="status-field large-12 columns">
			<label>Type: <small>required</small></label>
			<select name="faci" id="faci" requerido="Type">
				<?php while ($faci = mysql_fetch_assoc($type_faci)){?>					
				<option value="<?=$faci[id]?>" <?php if ($faci[id]==$array[id_type]) echo 'selected'; ?> ><?=$faci[name]?></option>
				<?php } ?>
			</select>
			<small class="error">type is required.</small>
		</div>
		
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
		<input type="hidden" name="_equi" id="_equi" value="<?=$_GET[_faci]?>" />
		
	</div>	

</form>
</fieldset>