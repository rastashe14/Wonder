	<div class="row top">
		<div class="large-4 columns logo">
			<a href="<?=DOMINIO?>"><img src="img/logo.png" /></a>
		</div>
		
		<div class="large-8 columns ">
			<?php if($_NAME_ON_TOP){?>
			
			<h2><?=TITLE?></h2>
			<p><?=SLOGAN?></p>
			
			<?php }?>
			<dl class="sub-nav">
				<?php  foreach($_BANNER as $bannerItem ){?>
				<dd >
					<a  href="<?=$bannerItem['url']?>" style="padding: 0"><?=$bannerItem['caption']?></a>

				</dd>

				<?php  }?>

			</dl>
				
		</div>
	</div>
