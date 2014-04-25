<?php

	$events = mysql_query("SELECT * FROM calendar WHERE id = '".$_GET['id']."'") or die (mysql_error());
	$events  = mysql_fetch_assoc($events);
	 
?>

<div class="row panel">
	<h3 >Details Events :: <?=$events['name']?></h3>
	<div class="large-12 columns  radius" >	
			<div class="row">&nbsp;</div>
			<div class="name-field" style="font-size: 16px !Important">
				<label style="font-size: 16px !Important"><strong>Description:<strong></label>
				<p class="text-justify" style="font-size: 16px !Important"><?=$events['description']?></p>
			</div>
			<div class="row">&nbsp;</div>
			<div class="email-field">
				<label style="font-size: 16px !Important"><strong>Date and Time:</strong></label>
				<p class="text-left" style="font-size: 16px !Important"><?=$events['date_ini']?></p>
			</div>
			<div class="row">&nbsp;</div>
			<div class="email-field">
				<label style="font-size: 16px !Important"><strong>Location:</strong></label>
				<p class="text-left" style="font-size: 16px !Important"><?=$events['location']?></p>
			</div>
			<div class="row">&nbsp;</div>
			<button onclick="window.location.href='?current=events'">Back</button>
	</div>	
	
		
</div>	