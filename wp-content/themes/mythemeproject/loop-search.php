<?php
global $mtp_image_support;
global $mtp_content_support;
// echo '<pre>';
// print_r($wp_query);  // query dc wordpress auto lam theo tap tin 
?>


	<div class="clr" id="blog-wrap">
		<?php
		$i = 1;
		while (have_posts()) : 
			the_post();

			// chi lay category dau tien neu post co nhieu categories
			$first_category = get_the_category()[0];

			// get image
			// su dung $wp_query->post  tuong duong $post  => $post->post_content
            $post_content = $wp_query->post->post_content;  // lay ra toan bo content, ko bi anh huong boi More
			$imageURL = $mtp_image_support->handleImage($post_content, $wp_query->post, 620, 350);

			// handle col
			$col = ($i % 2 == 0) ? 2 : 1;
			$i++; 

		?>
			<article class="clr loop-entry col-<?=$col; //col-1?>">
				<div class="loop-entry-media clr">
					<figure class="loop-entry-thumbnail">
						<a title="<?php the_title();?>" href="<?php the_permalink();?>">
							<div class="post-thumbnail">
								<img width="620" height="350" alt="<?php the_title();?>" 
										src="<?= $imageURL ?>">
							</div>
							<!-- .post-thumbnail -->
						</a>
					</figure>
					<!-- .loop-entry-thumbnail -->
				</div>
				<!-- .loop-entry-media -->
				<div class="loop-entry-content clr">
					<header>
						<h2 class="loop-entry-title">
							<a title="<?php the_title();?>" href="<?php the_permalink();?>"><?php the_title();?></a>
						</h2>
						<div class="loop-entry-meta clr">
							<div class="loop-entry-meta-date">
								<span class="fa fa-clock-o"></span> <?php the_modified_date();  //September 23, 2014 ?>
							</div>
							<div class="loop-entry-meta-comments">
								<span class="fa fa-comments"></span>
								<a title="Comment on <?php the_title();?>" href="<?= get_comments_link(); ?>">
									<?= comments_number('No comments', '1 comment', '% comments'); //3 Comments ?>
								</a>
							</div>
						</div>
						<!-- .loop-entry-meta -->
					</header>
					<div class="loop-entry-excerpt entry clr">
						<?= $mtp_content_support->getExcerpt(get_the_excerpt(), 120); ?>
					</div>
					<!-- .loop-entry-excerpt -->
				</div>
				<!-- .loop-entry-content -->
			</article>
			<!-- .loop-entry -->

		<?php
		endwhile;
		?>

	</div>
	<!-- #blog-wrap -->

	<?php
		require THEME_DIRECTORY . '/pagination.php';
	?>
	<!-- Pagination -->

	<div class="ad-spot archive-bottom-ad clr">
		<?php 
		// <a title="Ad" href="#">
		// 	<img alt="Ad" src="images/ad-620x80.png">
		// </a>
		?>
	</div>
	<!-- .ad-spot -->
