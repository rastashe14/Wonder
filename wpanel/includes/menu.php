<nav class="top-bar" data-topbar data-options="is_hover: false" style="background: #333 !important;">
	<ul class="title-area">
		<li class="name">
		<h1><a style="cursor: default"><?=$_SESSION['wspanel_user']['nombre']?></a></h1>
		</li>
		<li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
	</ul>

	<section class="top-bar-section" id="menu-wpanel">
		<!-- Left Nav Section -->
		<ul class="left " >
			<li class="divider"></li>
			<li ><a href="index.php?url=views/company/profile.php">Company</a></li>
			<li class="divider"></li>
			<li ><a href="index.php?url=views/galeria.php&type=galeria">Gallery</a></li>
			<!-- <li class="divider"></li>
			<li ><a href="index.php?url=views/video.php&type=video">Videos</a></li> -->
			
<!--			
			<li class="divider"></li>
			<li class="has-dropdown"><a href="#">Locations</a>
				<ul class="dropdown">

					<li><a href="index.php?loc=1&action=update&url=views/company/profile.php">Update</a></li>

					<li><a href="index.php?type=1&url=views/galeria.php">Gallery</a></li>       

				</ul>
			</li>
			<li class="divider"></li>
			<li class="has-dropdown"><a href="#">Services</a>
				<ul class="dropdown">
					<li><a href="index.php?url=views/contents/add.php&type=2">Add</a></li>
					<li><a href="index.php?url=views/contents/update.php&type=2">Update</a></li>
				</ul>
			</li>-->
			<li class="divider"></li>
			<li class="has-dropdown"><a href="#">Packages</a>
				<ul class="dropdown">
					<li><a href="index.php?url=views/pakages/add.php">Add</a></li>
					<li><a href="index.php?url=views/pakages/update.php">Update</a></li>
					<li class="divider"></li>
					<li class="has-dropdown">
						<a href="#">Facilities</a>
						<ul class="dropdown">
							<li><a href="index.php?url=views/facilities/add.php">Add</a></li>
							<li><a href="index.php?url=views/facilities/update.php">Update</a></li>
						</ul>
					</li>
					<li class="divider"></li>
					<li class="has-dropdown">
						<a href="#">Type Facilities</a>
						<ul class="dropdown">
							<li><a href="index.php?url=views/type_faci/add.php">Add</a></li>
							<li><a href="index.php?url=views/type_faci/update.php">Update</a></li>
						</ul>
					</li>
				</ul>
			</li>
			<li class="divider"></li>
			<li class="has-dropdown"><a href="#">News</a>
				<ul class="dropdown">
					<li><a href="index.php?url=views/contents/add.php&type=1">Add</a></li>
					<li><a href="index.php?url=views/contents/update.php&type=1">Update</a></li>
				</ul>
			</li>
			<li class="divider"></li>
			<li class="has-dropdown"><a href="#">Contents</a>
				<ul class="dropdown">
					<li><a href="index.php?url=views/contents/add.php&type=3">Add</a></li>
					<li><a href="index.php?url=views/contents/update.php&type=3">Update</a></li>
				</ul>
			</li>
			<li class="divider"></li>
			<li ><a href="index.php?url=views/email_list.php">Mail List</a></li>
			<li class="divider"></li>
			<li ><a href="index.php?url=views/booking.php">Booking List</a></li>
			<li class="divider"></li>
			<li class="has-dropdown"><a href="#">Events</a>
				<ul class="dropdown">
					<li><a href="index.php?url=views/calendar/calendar.php">Add</a></li>
					<li><a href="index.php?url=views/calendar/update.php">Update</a></li>
				</ul>
			</li>
		</ul>
		<ul class="right" >
			<li class="divider"></li>
			<li ><a href="includes/logout.php">Logout</a></li>
		</ul>
	</section>
</nav>