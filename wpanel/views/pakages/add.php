<?php
     if ($_POST[sumito]=="si"){
		 //_imprimir($_POST);
		if ($_POST['_apto']!=""){ 
			$update = mysql_query("
					UPDATE package SET
						name = '$_POST[nombre]',
						des = '$_POST[descripcion]',
						maxchi = '$_POST[personas]',
						conditions = '$_POST[condiciones]',
						city = '$_POST[ciudad]', 
						price = '$_POST[precio_venta]',
					    price2 = '$_POST[precio_venta2]',
						id_status = '$_POST[status]'
					WHERE id = '".$_POST['_apto']."' 
			") or die ("Update (44): ".mysql_error());
			
			$id = $_POST['_apto'];
			
			
		}else{
			
			$insert = mysql_query("
				INSERT INTO package SET
					name = '$_POST[nombre]',
					des = '$_POST[descripcion]',
					maxchi = '$_POST[personas]',
					conditions = '$_POST[condiciones]',
					city = '$_POST[ciudad]', 
					price = '$_POST[precio_venta]',
					price2 = '$_POST[precio_venta2]',
					id_status = '$_POST[status]'
			") or die (mysql_error());
			
			$id = mysql_insert_id();
						

		}	
		
		//facilities
		mysql_query("DELETE FROM package_facilities WHERE id_pack = '$id' ");
		if (isset($_POST["facilities"])){
			
			foreach ($_POST["facilities"] as $indice => $valor){
				mysql_query("INSERT INTO package_facilities SET 
						id_pack = '$id',
						id_faci = '$valor'
				") or die (mysql_error());
			}
		}

		
		mensajes( "Info!","Process Successfully!");		
		 
	 }//sumito
	 
	 $aptos = mysql_query("SELECT * FROM package WHERE id = '".$_GET['_id']."'") or die (mysql_error());
	 $apto  = mysql_fetch_assoc($aptos);
	 
	 $status = mysql_query("SELECT * FROM status") or die (mysql_error());

?>
<fieldset>
<legend>Packages</legend>

<form method="post" enctype="multipart/form-data" data-abide>
	<div class="row">
		
<!--	<div class="photo-field large-4 columns">
		<label>Main photo: <small>required</small></label>
			<?php if ($_GET['_id']!="" && $_GET['foto']=="" && file_exists("../img/pakages/".$apto['id']."/".$apto['mainPhoto'])){ ?>
		<img src="../img/search.png" width="20"  border="0"  />&nbsp;<a href="../img/aptos/<?=$apto['id']?>/<?=$apto['mainPhoto']?>"  rel="galeria" style="color:#00F" onfocus="this.blur();">View main photo</a>
		&nbsp;|&nbsp;
		<input type="button" name="eliminaf" id="eliminaf" value="Delete"  onclick="confirmar('&iquest; Are you sure to delete this item ?', 'Confirmation!', '?url=package_add&_id=<?=$_GET['_id']?>&foto=1&_file=<?=$apto['mainPhoto']?>');" />
		<?php }else{ $foto = $_GET[_id]; ?>
		<input type="file"  name="photo"  />
		<?php } ?>
		<small class="error">Main photo is required.</small>
	</div>	-->

    <div class="nombre-field large-8 columns">
		<label>Name: <small>required</small></label>
		<input type="text"  name="nombre" id="nombre" value="<?=$apto['name']?>" required/>
		<small class="error">Name is required.</small>
	</div>	
	<div class="ciudad-field large-4 columns">
		<label>City: <small>required</small></label>
		<input type="text"  name="ciudad" id="ciudad" value="<?=$apto['city']?>" required/>
		<small class="error">City is required.</small>
	</div>
    <div class="precio_venta-field large-4 columns">
		<label>Price(Monday – Thursday): <small>required</small></label>
		<input type="text"  name="precio_venta" id="precio_venta" value="<?=$apto['price']?>" pattern="^\d+(\.\d{1,2})?$" required/>
		<small class="error">Price is required.</small>
	</div>	
	<div class="precio_venta2-field large-4 columns">
		<label>Price(Friday - Sunday): <small>required</small></label>
		<input type="text"  name="precio_venta2" id="precio_venta2" value="<?=$apto['price2']?>" pattern="^\d+(\.\d{1,2})?$" required/>
		<small class="error">Price is required.</small>
	</div>

	

	<div class="personas-field large-4 columns">
		<label>Max children allowed: <small>required</small></label>
		<input type="number"  name="personas" id="personas" value="<?=$apto['maxchi']?>" required/>
		<small class="error">Max children allowed is required.</small>
	</div>
		


    

	
<!--	<div class="condiciones-field large-12 columns">
		<label>Not Permitted Activities: <small>required</small></label>
		<textarea name="condiciones" id="condiciones"  required><?=$apto[conditions]?></textarea>
		<small class="error">Not Permitted Activities are required.</small>
	</div>	-->
	<div class="descripcion-field large-12 columns">
		<label>Description: <small>required</small></label>
		<textarea name="descripcion" id="descripcion" required><?=$apto[des]?></textarea>
		<small class="error">Description is required.</small>
	</div>
   
		<div class="facilities-field large-12 columns "><label>Facilities:</label>
			
	<?php
		$types = mysql_query("
			SELECT *
			FROM type_facilities
			WHERE id_status = '1'
			ORDER BY name 
		") or die (mysql_error());
	
		while ($type = mysql_fetch_assoc($types)){
			$facilis = mysql_query("
				SELECT *
				FROM facilities
				WHERE id_status = '1' AND id_type = '".$type['id']."'
				ORDER BY name 
			") or die (mysql_error());
			
	?>
			<div class="large-6 columns panel "><label>* <?=formatoCadena($type['name'])?></label> 
	<?php	
			while ($faci = mysql_fetch_assoc($facilis)){
	?>
    <input  name="facilities[]" type="checkbox" 
				value="<?=$faci['id']?>" <?php if (existe("package_facilities", "id_pack", " WHERE id_pack = '".$apto['id']."' AND id_faci = '".$faci['id']."'")and $apto['id']!='') echo 'checked="checked"'; ?>  
			/>
			<label><small><?=formatoCadena($faci['name'])?></small></label> 

	<?php
			}//facilities
	?>
		</div>
		<?php		
		}//type_facilities
	
	?>
	</div>

	<div class="status-field large-6 columns">
		<label>Status: <small>required</small></label>
		<select name="status" id="status"  requerido="Status" >
			
			<?php while ($sta = mysql_fetch_assoc($status)){?>					
			<option value="<?=$sta[id]?>" <?php if ($sta[id]==$apto[id_status]) echo 'selected'; ?> ><?=$sta[name]?></option>
			<?php } ?>
		</select>
		<small class="error">Status is required.</small>
	</div>
	<div class="large-6 columns">
		<button type="submit">Submit</button>
		<a href="?url=<?=$_GET['url']?>" class="button">Clear</a>
	</div>
	
	<input name="sumito" type="hidden" id="sumito" value="si" />
	<input type="hidden" name="_apto" id="_apto" value="<?=$_GET[_id]?>" />
	<input type="hidden" name="_file" id="_file" value="<?=$_GET[_file]?>" />
	
</div>
</form>
</fieldset>