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
				<?php  $c = count($_BANNER);
					   $cont=0;
				foreach($_BANNER as $bannerItem ){ $cont++;?>
				<dd >
					<a  href="<?=$bannerItem['url']?>" style="padding: 0;margin-right: 5px;margin-left: -5px; font-size: 12px"><?=$bannerItem['caption']?></a>
					<?php if($c!=$cont){ echo '-';}?>
				</dd>

				<?php  }?>

			</dl>
				
		</div>
	</div>
