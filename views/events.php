<div class="row panel" > 
	<div class="large-11 columns ">	
	<?php
		echo "<h3>Select a event </h3>";
		echo draw_calendar_e($_GET['next']);
	?>
	</div>
	<div class="large-1 columns ">	
		<div class="row radius row-leyend ">
		<label for="">Leyend</label>
			<div class="anc-leyend-past">
				<div class="leyend-past radius label"></div>
				<div class="text-leyend">Past events</div>
			</div>
			<div class="anc-leyend-new">
				<div class="leyend-new radius label"></div>
				<div class="text-leyend">New events</div>
			</div>
		</div>
	</div>
</div>	