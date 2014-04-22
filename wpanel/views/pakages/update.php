<?php
	 if ($_GET[aptox]!=""){
		 mysql_query("DELETE FROM package WHERE id = '".$_GET[aptox]."'") or die (mysql_error());
		 mysql_query("DELETE FROM package_facilities WHERE id_pack = '".$_GET[aptox]."'") or die (mysql_error());
		 mysql_query("DELETE FROM package_pricing WHERE id_pack = '".$_GET[aptox]."'") or die (mysql_error());		 
		 mensajes("Info!","Process Successfully!");
	 }
	 
	 $_pagi_cuantos         = 12;
     $_pagi_nav_num_enlaces = 4;
     $_pagi_sql             = "SELECT * FROM package ORDER BY name";
	 
	 include('../includes/paginator.inc.php');
?>
<link media="screen" rel="stylesheet" href="../css/paginator.css" />

<fieldset>
<legend>Packages - List</legend>
<table class=" large-12 columns">
  <tr >
    <th  >Name</th>
    <th  >City</th>
    <th width="100">Price</th>
    <th width="120">Date</th>
	<th width="50">Status</th>
    <th width="50">Actions</th>
  </tr>
  <?php while ($apto = mysql_fetch_assoc($_pagi_result)){ ?>
  <tr id="tr_<?=$apto['id']?>" onMouseOver="fondoMenu(this.id, 1)" onMouseOut="fondoMenu(this.id, 0)">
    <td ><?=$apto['name']?></td>
    <td ><?=$apto['city']?></td>
    <td ><?=$apto['price']?></td>
    <td ><small><?=$apto['date']?></small></td>
	<td ><?=campo('status', 'id', $apto[id_status], 'name')?></td>
    <td >
		<a href="?_id=<?=$apto[id]?>&url=views/pakages/add.php"><img src="../img/editar.png" width="16" title="Update" height="16" border="0"  /></a>
    	<a href='#' data-reveal-id='services_<?=$apto['id']?>'  >	
			<img src="../img/salir.gif" width="16" title="Delete."    />
        </a> 
			
		<div id='services_<?=$apto['id']?>' class='reveal-modal small' data-reveal>
						<h3><small>Are you sure to delete this Pakage?</small></h3>
						<p><?=$apto[name]?></p>
						<a href='?url=<?=$_GET[url]?>&aptox=<?=$apto[id]?>'  class='small radius button'>Yes</a>
						<a class='close-reveal-modal'>&#215;</a>
		</div>
		<?php if (file_exists("../img/aptos/".$apto[id]."/".$apto[fotoPrincipal])){ ?>
<!--        <a href="../img/pakages/<?=$apto[id]?>/<?=$apto[mainPhoto]?>"  rel="galeria" style="color:#00F" title="Pakage - <?=$apto[nombre]?>." onfocus="this.blur();">
        <img src="../img/camera.png" title="View main photo." width="16" height="16" border="0" style="cursor:pointer" />
        </a>-->
        <?php } ?>
<!--    	<img src="../img/photo_add.png" width="16" height="16" border="0" title="Add photo." style="cursor:pointer" onClick="redirect('?url=photos&_folder=aptos/<?=$apto[id]?>/&_back=package_upd&_title=Packages&_mainPhoto=<?=$apto[mainPhoto]?>');" />-->
    </td>
  </tr>
  <?php } ?>
</table>
<?php echo $_pagi_navegacion,$_pagi_info; ?>
</fieldset>