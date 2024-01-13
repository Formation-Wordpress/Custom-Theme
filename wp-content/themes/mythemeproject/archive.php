<?php
    get_header();
?>
        <!-- #top-wrap -->
		<div class="site-main-wrap clr">
			<div id="main" class="site-main clr container">
				<div id="primary" class="content-area clr">
					<div id="content" class="site-content left-content boxed-content" role="main">

						<?php
							// Add archive header
							require_once THEME_DIRECTORY . '/archive-header.php';

							// chay file loop-archive.php de liet ke Posts
                            get_template_part('loop', 'archive');  // chay loop-archive.php truoc, neu ko thi loop.php
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