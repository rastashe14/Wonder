<?php   
	if($_GET['status']!='' & $_GET['id']!=''){

		mysql_query("UPDATE  `reservations` SET  `status` =  '".$_GET['status']."' WHERE  `id` =".$_GET['id'].";") or die (mysql_error());
	}

	 $_pagi_cuantos         = 12;
     $_pagi_nav_num_enlaces = 4;
     $_pagi_sql             = "SELECT * FROM  reservations ORDER BY datetime DESC";
	 
	 include('../includes/paginator.inc.php');
?>
<link media="screen" rel="stylesheet" href="../css/paginator.css" />

<fieldset>	
<legend>Booking List</legend>	
<table class=" large-12 columns">
<thead>
	<tr>
		<th >Package</th>
		<th >Date</th>
		<th >Name</th>
		<th >Note</th>
		<th >Status</th>
	</tr>
</thead>
<tbody>
  <?php while ($content = mysql_fetch_assoc($_pagi_result)){ ?>
  <tr >
    <td  ><?=$content['pakage']?></td>
    <td  ><?=$content['date']?></td>
    <td  ><?=$content['name']?><br> 
    	  Email: <a href="mailto:<?=$content['email']?>"><?=$content['email']?></a><br>
    	  Phone: <?=$content['phone']?></td>
    <td  ><?=$content['note']?></td>
    
    <td  >
    	<?php 
    	switch ($content['status']) {
     		case 1:
    			$_class='success';
    			$_status='Approved';
    			break;
    		case 2:
    			$_class='alert';
    			$_status='Disapprove';
    			break;   			
    		case 0:
    		default:
    			$_class='secondary';
    			$_status='Waiting';
    			break;
    	}
   ?>
		<a href="#" class="button split tiny round <?=$_class?>"><?=$_status?> <span data-dropdown="drop<?=$content['id']?>"></span></a><br>
		<ul id="drop<?=$content['id']?>" class="f-dropdown" data-dropdown-content>
		  <li class="secondary"><a href="?url=views/booking.php&id=<?=$content['id']?>&status=0">Waiting</a></li>
		  <li class="success"><a href="?url=views/booking.php&id=<?=$content['id']?>&status=1">Approved</a></li>
		  <li class="alert"><a href="?url=views/booking.php&id=<?=$content['id']?>&status=2">Disapprove</a></li>
		</ul>
	</td>
  </tr>
  <?php } ?>
  </tbody>
</table>
<?php echo $_pagi_navegacion,$_pagi_info; ?>
</fieldset>	