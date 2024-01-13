<?php
    get_header();
?>
        <!-- #top-wrap -->
		<div class="site-main-wrap clr">
			<div id="main" class="site-main clr container">
				<div id="primary" class="content-area clr">
					<div id="content" class="site-content left-content boxed-content" role="main">
						<div style="margin: 20px;">
							<?php
								// require THEME_DIRECTORY . '/pagination_method.php';
							?>
						</div>
                        <?php
							if (is_home() || is_front_page()) {
								require_once THEME_SIDEBARS_DIRECTORY . '/top-content.php';
							}

							// echo 'is_archive: ' . is_archive() . '<br>';
							// echo 'is_category: ' . is_category();
                        ?>
						
						<?php
                            get_template_part('loop', 'index');
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