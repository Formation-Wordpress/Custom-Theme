
<?php
	if (has_nav_menu('footer_menu')) {
		wp_nav_menu([
			'menu'                 => '',
			'container'            => '',
			'container_class'      => '',
			'container_id'         => '',
			'container_aria_label' => '',
			'menu_class'           => 'footer-nav clr',
			'menu_id'              => 'menu-footer',
			'echo'                 => true,
			'fallback_cb'          => 'wp_page_menu',	// par default
			'before'               => '',
			'after'                => '',
			'link_before'          => '',
			'link_after'           => '',
			'items_wrap'           => '<ul id="%1$s" class="%2$s">%3$s</ul>',
			'item_spacing'         => 'preserve',
			'depth'                => 0,
			'walker'               => '',
			'theme_location'       => 'footer_menu',
		]);
	}
?>
			

<!-- 
	<ul id="menu-footer" class="footer-nav clr">
		<li><a href="#">Home</a></li>
		<li><a href="#">Archives</a></li>
		<li><a href="#">Contact</a></li>
	</ul> 
-->