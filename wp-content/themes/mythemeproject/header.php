<!DOCTYPE html>
<html <?php language_attributes() ?>>
<!-- <meta http-equiv="content-type" content="text/html;charset=UTF-8" /> -->
<head>
	<meta charset="<?php bloginfo('charset')?>" >
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>

			<?php
			/*
			* Print the <title> tag based on what is being viewed.
			*/
			global $page, $paged;

			wp_title( '|', true, 'right' );

			// Add the site name.
			bloginfo( 'name' );

			// Add the site description for the home/front page.
			$site_description = get_bloginfo( 'description', 'display');	// 'display' la de co filter
		if ( $site_description && ( is_home() || is_front_page() ) ) {
			echo " | $site_description";
		}

			// Add a page number if necessary:
		if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
			/* translators: %s: Page number. */
			echo esc_html( ' | ' . sprintf( __( 'Page %s', 'mythemeproject' ), max( $paged, $page ) ) );
		}

		?>

	</title>
	<meta name='robots' content='noindex,follow' />
	
	<?php wp_head(); ?>
	
	<link rel="profile" href="https://gmpg.org/xfn/11" />
	<link rel="stylesheet" type="text/css" media="all" href="<?php echo esc_url( get_stylesheet_uri() ); ?>?ver=20230808" />
	<link rel="pingback" href="<?php echo esc_url( get_bloginfo( 'pingback_url' ) ); ?>">

	<!-- [if lt IE 9]>
		<script src="<?php echo get_template_directory_uri() . '/js/html5.js' ?> " type="text/javascript"></script>
	<![endif]-->
</head>

<body class="home fixed-nav">

	<div id="wrap" class="clr">

		<div id="top-wrap" class="clr">
			<div id="topbar" class="clr">
				<div class="container clr">
					<div id="topbar-date" class="clr">
						<div class="topbar-date-full">
							<span class="fa fa-clock-o"></span>Monday 13th October 2014
						</div>
						<div class="topbar-date-condensed">
							<span class="fa fa-clock-o"></span>13-Oct-2014
						</div>
					</div>
					<!-- .topbar-date -->
					<?php
						require_once THEME_SIDEBARS_DIRECTORY . '/top_menu.php';
					?>
					<!-- #topbar-nav -->
					<div id="topbar-search" class="clr">
						<form method="get" class="topbar-searchform" action="#" role="search">
							<input type="search" class="field topbar-searchform-input" name="s" value="" placeholder="Type your search & hit enter" />
							<button type="submit" class="topbar-searchform-btn">
								<span class="fa fa-search"></span>
							</button>
						</form>
					</div>
					<!-- topbar-search -->
				</div>
				<!-- .container -->
			</div>
			<!-- #topbar -->
			<header id="header" class="site-header clr container" role="banner">
				<div class="site-branding clr">
					<div id="logo" class="clr">
						<div class="site-text-logo clr">
							<h1>
								<a href="#" title="Spartan" rel="home">Spartan</a>
							</h1>
						</div>
					</div>
					<!-- #logo -->
					<div id="blog-description" class="clr">
						Edit your subheading via the theme customizer. <br /> It looks much better when it's 2 lines long.
					</div>
					<!-- #blog-description -->
				</div>
				<!-- .site-branding -->
				<div class="ad-spot header-ad clr">
					<a href="#" title="Ad"><img
						src="http://wordpress_project.test/wp-content/themes/mythemeproject/images/ad-620x80.png" alt="Ad" /></a>
				</div>
				<!-- .ad-spot -->
			</header>
			<!-- #header -->
			<?php
				require_once THEME_SIDEBARS_DIRECTORY . '/center_menu.php';
			?>
			<!-- #site-navigation-wrap -->
		</div>
		<!-- #top-wrap -->