<div class="new-menu">
	<div class="row">
		<nav class="top-bar" data-topbar data-options="is_hover: false">
		
			<ul class="title-area">
				<li class="name"></li>
				<li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
			</ul>

			<section class="top-bar-section" >
				<ul class="left" id="ul-menu-principal">
				<?php
				$s=1;
				foreach($_LEFT_MENU as $menuItem ){
				?>	
					<li class="<?=$menuItem['CLASS']?>" ><a <?php if($menuItem['TOOLTIP']!=''){?>data-tooltip class="has-tip" title="<?=$menuItem['TOOLTIP']?>" <?php } ?> href="<?=$menuItem['LINK']?>"><?=$menuItem['TITLE']?></a></li>
				<?php }?>  	
				</ul>	
			</section>
		</nav>
	</div>
</div>