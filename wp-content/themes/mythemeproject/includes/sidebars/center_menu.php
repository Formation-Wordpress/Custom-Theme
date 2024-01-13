<div id="site-navigation-wrap" class="clr">
	<div id="site-navigation-inner" class="clr container">
		<nav id="site-navigation" class="navigation main-navigation clr" role="navigation">

			<?php
			if (has_nav_menu('center_menu')) {
				wp_nav_menu([
					'menu'                 => '39', 	// la menu identification (id, slug, name). neu ko co thi goi ra theme_location. 
													// xem document(en rouge, bi nguoc). 20: ID cua menu du phong, 38: id cua top_menu
					'container'            => 'div',
					'container_class'      => 'menu-categories-container',
					'container_id'         => '',
					'container_aria_label' => '',
					'menu_class'           => 'main-nav dropdown-menu sf-menu',
					'menu_id'              => 'menu-categories',
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
					'theme_location'       => 'center_menu',	// dc defined trong register_nav_menus() trong functions.php
				]);
			}
			?>

			<a href="#mobile-nav" class="navigation-toggle">
				<span class="fa fa-bars navigation-toggle-icon"></span>
				<span class="navigation-toggle-text">Browse Categories</span>
			</a>
		</nav>
	</div>
</div>        
			
<!--
<div id="site-navigation-wrap" class="clr">
	<div id="site-navigation-inner" class="clr container">
		<nav id="site-navigation" class="navigation main-navigation clr" role="navigation">
			<div class="menu-categories-container">									// Container
				<ul id="menu-categories" class="main-nav dropdown-menu sf-menu">    // menu
					<li class="menu-item-object-category cat-28">
						<a href="#">Sports</a>
					</li>
					<li class="menu-item-object-category cat-5">
						<a href="#">Photography</a>
					</li>
					<li class="menu-item-object-category cat-6">
						<a href="#">Travel</a>
					</li>
					<li class="menu-item-object-category cat-3">
						<a href="#">Shopping</a>
					</li>
					<li class="menu-item-object-category cat-4">
						<a href="#">Nature</a>
					</li>
					<li class="menu-item-object-category cat-27">
						<a href="#">News</a>
					</li>
					<li class="menu-item-object-category cat-2">
						<a href="#">Videos</a>
					</li>
					<li class="menu-item-object-category cat-26">
						<a href="#">Health</a>
					</li>
				</ul>
			</div>
			<a href="#mobile-nav" class="navigation-toggle">
				<span class="fa fa-bars navigation-toggle-icon"></span>
				<span class="navigation-toggle-text">Browse Categories</span>
			</a>
		</nav>
	</div>
</div>
          
-->