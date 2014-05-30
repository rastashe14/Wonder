	<?php $imgLogo  = campo('config','`keys`', 'logo','value'); ?>
	<div id="header-menu">
		<div class="row top">
			<div class="large-4 columns logo">
				<a href="<?=DOMINIO?>"><img src="img/<?=$imgLogo?>" width="300" style="height: 100px; width: 300px" /></a>
			</div>
			<div class="large-8 columns ">
				<?php if($_NAME_ON_TOP){?>
				
				<h2><?=TITLE?></h2>
				<p><?=SLOGAN?></p>
				
				<?php }?>
				<dl class="sub-nav" id="top-menu-sup">
					<?php  $c = count($_BANNER);
						   $cont=0;
					foreach($_BANNER as $bannerItem ){ $cont++;?>
					<dd>
						<a  href="<?=$bannerItem['url']?>" ><?=$bannerItem['caption']?></a>
						<?php if($c!=$cont){ echo '-';}?>
					</dd>

					<?php  }?>

				</dl>
					
			</div>
		</div>
	</div>