<style type="text/css">
    .archive-header-text {
        margin-left: 90px;
    }
    .archive-header-title {
        font-size: 2.4rem !important;
    }
</style>
<?php
    get_header();
?>
        <!-- #top-wrap -->
		<div class="site-main-wrap clr">
			<div id="main" class="site-main clr container">
				<div id="primary" class="content-area clr">
					<div id="content" class="site-content left-content boxed-content" role="main">

                        <header class="archive-header clr">
                            <div class="author-archive-gravatar clr">
                                <?php
                                    // echo '<pre>';
                                    // print_r($wp_query);
                                    $authorID = get_query_var('author');

                                    echo get_avatar($authorID, 60, '', 'user avatar');
                                ?>
                            </div>
                            <div class="archive-header-text">
                                <h1 class="archive-header-title">
                                    <?php   echo __('Articles writtent by', 'mythemeproject'). ': ';
                                            echo get_the_author_meta('display_name',$authorID); 
                                     ?>
                                </h1>
                                <div class="archive-description clr">
                                    <?php   echo __('This author has written', 'mythemeproject'). ' ';
                                            $posts_count = count_user_posts($authorID);
                                            echo $posts_count > 1 ? $posts_count. ' articles.' : $posts_count . ' article.';
                                    ?>            
                                </div>
                            </div>
    
                            <div class="layout-toggle">
                                <span class="fa fa-bars"></span>
                            </div>
                        </header>
						<?php
							// chay file loop-archive.php de liet ke Posts
                            get_template_part('loop', 'archive');  // chay loop-archive.php truoc, neu ko thi loop.php
                        ?>
						<!-- loop-posts -->

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