<?php
/******************************
* Template name: Right Content
*******************************/
?>
<style type='text/css'>
.left-content {
    float: right !important;
}
.sidebar-container {
    float: left !important;
}

</style>

<?php
    get_header();
?>
        <!-- #top-wrap -->
		<div class="site-main-wrap clr">
			<div id="main" class="site-main clr container">
				<div id="primary" class="content-area clr">
					<div id="content" class="site-content left-content clr" role="main">

						<?php
							// chay file loop-page.php de detail 1 Page
                            get_template_part('loop', 'page');
                        ?>
						<!-- loop-page -->

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