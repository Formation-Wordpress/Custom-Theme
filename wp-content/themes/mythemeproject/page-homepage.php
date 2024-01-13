<?php
/******************************
* Template name: Homepage
*******************************/
?>

<?php
    get_header();
?>
        <!-- #top-wrap -->
		<div class="site-main-wrap clr">
			<div id="main" class="site-main clr container">
				<div id="primary" class="content-area clr">
					<div id="content" class="site-content left-content boxed-content" role="main">
                        <?php
							if (is_home() || is_front_page()) {
								require_once THEME_SIDEBARS_DIRECTORY . '/top-content.php';
							}
                        ?>
						
						<?php
                            // echo 'is_home: '. is_home() . '<br>';
                            // echo 'is_front_page: '. is_front_page() . '<br>';
                            // echo '<br>'. __FILE__;
                            // echo '<pre>';
                            // print_r($wp_query);
                            if (have_posts()) while (have_posts()): 
                                the_post();
                                the_content();
                            endwhile;
                        ?>
						<!-- loop-posts -->

                        <?php
                            require_once THEME_SIDEBARS_DIRECTORY . '/bottom-content.php';
                        ?>
						<!-- .featured-carousel-wrap -->
						<div class="ad-spot home-bottom-ad clr">
							<a href="#" title="Ad">
								<img src="<?=THEME_IMAGES_DIRECTORY_URL?>/ad-620x80.png" alt="Ad" />
							</a>
						</div>
						<!-- .ad-spot -->
					</div>
					<!-- #content -->
                        <?php
                            get_sidebar();
                        ?>
					<!-- #secondary -->
				</div>
				<!-- #primary -->

			</div>
			<!--.site-main -->
		</div>
		<!-- .site-main-wrap -->
	</div>
	<!-- #wrap -->

<?php
    get_footer();
?>