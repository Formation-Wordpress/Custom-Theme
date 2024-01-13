
<div id="topbar-nav" class="cr">

	<?php
	if (has_nav_menu('top_menu')) {
		wp_nav_menu([
			'menu'                 => '', 	// la menu identification (id, slug, name). neu ko co thi goi ra theme_location. 
											// xem document(en rouge, bi nguoc). 20: ID cua menu du phong, 38: id cua top_menu
			'container'            => 'div',
			'container_class'      => 'menu-menu-container',
			'container_id'         => '',
			'container_aria_label' => '',
			'menu_class'           => 'top-nav sf-menu',
			'menu_id'              => 'menu-menu',
			'echo'                 => true,
			'fallback_cb'          => 'wp_page_menu',	// par default
			'before'               => '',
			'after'                => '',
			'link_before'          => '',
			'link_after'           => '',
			'items_wrap'           => '<ul id="%1$s" class="%2$s">%3$s</ul>',	// <ul id="menu-menu" class="top-nav sf-menu">
			'item_spacing'         => 'preserve',
			'depth'                => 0,
			'walker'               => '',			// class cho phep modify file nav-menu-template.php
			'theme_location'       => 'top_menu',	// dc defined trong register_nav_menus() trong functions.php
		]);
	}
	?>

</div>

<!--  
<div id="topbar-nav" class="cr">
	<div class="menu-menu-container">						// container
		<ul id="menu-menu" class="top-nav sf-menu">			// menu
			<li>
				<a href="#">Home</a>
			</li>
			<li class="dropdown">
				<a href="#">Features <i class="fa fa-caret-down nav-arrow"></i></a>
				<ul class="sub-menu">
					<li>
						<a href="#">Standard Post</a>
					</li>
					<li>
						<a href="#">Gallery</a>
					</li>
					<li>
						<a href="#">Audio</a>
					</li>
					<li>
						<a href="#">Video</a>
					</li>
					<li>
						<a href="#">Symple Shortcodes</a>
					</li>
					<li>
						<a href="#">Contributors</a>
					</li>
				</ul>
			</li>
			<li>
				<a href="#">Archives</a>
			</li>
			<li>
				<a href="#">Contact</a>
			</li>
			<li>
				<a target="_blank" href="#">Customize</a>
			</li>
			<li>
				<a href="#" class="nav-loginout-link">
					<span class="fa fa-lock"></span> Login
				</a>
			</li>
		</ul>
	</div>
</div>
-->