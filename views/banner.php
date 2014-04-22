<div class="row" >
	<ul data-orbit data-options="timer_speed: 3000; animation_speed: 1500; pause_on_hover: false;">
	<?php  foreach($_BANNER as $bannerItem ){?>
	<li>
		<a  href="<?=$bannerItem['url']?>"><img src="<?=$bannerItem['src']?>" /></a>
		<div class="orbit-caption"><?=$bannerItem['caption']?></div>
	</li>

	<?php  }?>

	</ul>
</div>
<div class="row panel text-center titleIni">
	Remember to bring socks
</div>
