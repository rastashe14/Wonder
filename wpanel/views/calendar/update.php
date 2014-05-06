<?php
 	if(isset($_GET['del'])){

		mysql_query("DELETE FROM calendar WHERE id = '".$_GET['id']."'") or die (mysql_error());
		mensajes("Info!","The event was deleted successfully");
	 }

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

	 $sql = "SELECT * FROM calendar ORDER BY id DESC ";

	 $calendar = mysql_query($sql) or die (mysql_error());
	 $calendar = mysql_fetch_assoc($calendar);

	 // if ($_GET[id]!=""){
		//  deleteDir('../img/'.$content_type['folder'].'/'.$_GET['id'], true);
		//  mysql_query("DELETE FROM contents WHERE id = '".$_GET['id']."' and id_type = '".$_GET['type']."'") or die (mysql_error());
		//  mensajes("Info!","The ".rtrim($content_type['name'],"s")." was deleted");
	 // }
	 
	 $_pagi_cuantos         = 12;
     $_pagi_nav_num_enlaces = 4;
     $_pagi_sql             = $sql;
	 
	 include('../includes/paginator.inc.php');
?>


<link media="screen" rel="stylesheet" href="../css/paginator.css" />

<fieldset>
	
	<legend> Calendar Panel </legend>
	
<table class=" large-12 columns">
<thead>
	<tr >
		<th width="180">Name</th>
		<th width="250">Description</th>
		<th width="130">Date Time</th>
		<!-- <th width="100">End Date</th> -->
		<th width="140">Location</th>
		<th width="100">Actions</th>
	</tr>
</thead>
<tbody>
  <?php while ($calendars = mysql_fetch_assoc($_pagi_result)){ ?>
  <tr >
    <td><?=$calendars[name]?></td>
    <td><?=substr($calendars[description],0,40)?>...</td>
    <td style="font-size:10px"><?=$calendars[date_ini]?></td>
    <!-- <td><small><?=$calendars[date_end]?></small></td> -->
    <td><?=substr($calendars[location],0,20)?></td>
    <td class="text-center">
		<a href="?url=views/calendar/calendar.php&id=<?=$calendars[id]?>"><img src="../img/editar.png" width="16" title="Update."  />
		<a href='#' data-reveal-id='services_<?=$calendars[id]?>'  >	
			<img src="../img/salir.gif" width="16" title="Delete."    />
        </a> 
			
		<div id='services_<?=$calendars[id]?>' class='reveal-modal small' data-reveal>
			<h3><small>Are you sure to delete this <?=rtrim($calendars['name'],"s");?>?</small></h3>
			<p><?=$calendars[name]?></p>
			<a href='?url=views/calendar/update.php&id=<?=$calendars[id]?>&del'  class='small radius button'>Yes</a>
			<a class='close-reveal-modal'>&#215;</a>
		</div>	
	</td>
  </tr>
  <?php } ?>
  </tbody>
</table>

<?php echo $_pagi_navegacion,$_pagi_info; ?>
</fieldset>	