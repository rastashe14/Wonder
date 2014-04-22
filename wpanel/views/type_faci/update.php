<?php
	 if ($_GET[_id]!=""){
		 $delete = mysql_query("DELETE FROM type_facilities WHERE id = '".$_GET[_id]."'") or die (mysql_error());
		 mensajes("Process Successfully!", "Informaction!", "?url=type_faci_upd");
	 }
	 
	 $_pagi_cuantos         = 12;
     $_pagi_nav_num_enlaces = 4;
     $_pagi_sql             = "SELECT * FROM type_facilities ORDER BY name";
	 
	 include('../includes/paginator.inc.php');
?>

<link media="screen" rel="stylesheet" href="../css/paginator.css" />

<fieldset>
	<legend>Type Facilities - Update</legend>
	<table class=" large-12 columns">
		<thead>
			<tr>
			<th>Name</th>
			<th>Status</th>
			<th>Actions</th>
			</tr>
		</thead>
		<tbody>
			<?php while ($apto = mysql_fetch_assoc($_pagi_result)){ ?>
			<tr id="tr_<?=$apto[id]?>" onMouseOver="fondoMenu(this.id, 1)" onMouseOut="fondoMenu(this.id, 0)">
			<td><?=$apto[name]?></td>
			<td><?=campo('status', 'id', $apto[id_status], 'name')?></td>
			<td>

				<a href="?_id=<?=$apto[id]?>&url=views/type_faci/add.php"> <img src="../img/editar.png" width="16" title="Edit." /></a>
				<a href='#' data-reveal-id='alert_<?=$apto[id]?>'><img src="../img/salir.gif" width="16" title="Delete."    /></a>

				<div id='alert_<?=$apto[id]?>' class='reveal-modal small' data-reveal>
					<h3><small>Are you sure to delete this item ?</small></h3>
					<p><?=$apto[name]?></p>
					<a href='?_id=<?=$apto[id]?>&url=views/type_faci/update.php'  class='small radius button'>Yes</a>
					<a class='close-reveal-modal'>&#215;</a>
				</div>

			</td>
			</tr>
			<?php } ?>
		</tbody>
	</table>

	<?php echo $_pagi_navegacion,$_pagi_info; ?>
</fieldset>