
<?php
    get_header();
?>
        <!-- #top-wrap -->
		<div class="site-main-wrap clr">
			<div id="main" class="site-main clr container">
				<div id="primary" class="content-area clr">
					<div id="content" class="site-content left-content boxed-content" role="main">

						<?php if ( have_posts() ) :
							
							// Add archive header
							require_once THEME_DIRECTORY . '/archive-header.php';
							
							// run loop-search.php
							get_template_part( 'loop', 'search' );
							?>
						<?php else : ?>
										<div id="post-0" class="post no-results not-found">
											<h2 class="entry-title"><?= translate( 'Nothing Found', 'mythemeproject' ); ?></h2>
											<div class="entry-content">
												<p>
													<?php _e( 'Sorry, but nothing matched your search criteria. 
																Please try again with some different keywords.', 'mythemeproject' ); 
													?>
												</p>
												<?php get_search_form(); ?>
											</div><!-- .entry-content -->
										</div><!-- #post-0 -->
						<?php endif; ?>

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