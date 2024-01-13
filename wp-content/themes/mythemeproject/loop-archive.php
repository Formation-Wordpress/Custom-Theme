<?php
global $mtp_image_support;
global $mtp_content_support;
// echo '<pre>';
// print_r($wp_query);  // query dc wordpress auto lam theo tap tin
// die;

$posts_per_page = $wp_query->query_vars['posts_per_page'];

// thiet lap lai query bang cach them / sua cac thong so
$paged = max(1, get_query_var('paged'));
if ( $paged > 1 ) {
	$offset = 0;
	if ( $paged == 2 ) {
		$offset = (get_query_var('paged') - 1) * $posts_per_page;
		
	} else if ( $paged > 2 ) {
		$offset = (get_query_var('paged') - 1) * $posts_per_page + (get_query_var('paged') - 2);
	}

	// update query_vars da co + voi cac thong so moi trong array
	$args = array_merge( $wp_query->query_vars, array( 'posts_per_page' => 4, 'offset' => $offset) );
	query_posts( $args );	// setup lai query da dc updated voi thong so moi
}

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
			if (max(1, get_query_var('paged')) == 1) {
				$col = ($i % 2 == 0) ? 1 : 2;
			} else {
				$col = ($i % 2 == 0) ? 2 : 1;
			}

			// display the featured image for the first post
			if ( $i == 1 && max(1, get_query_var('paged')) == 1 ) {
		?>
			
			<article class="archive-featured-post clr">
				<div class="archive-featured-post-media clr">
					<figure class="archive-featured-post-thumbnail">
						<?php 
						// chi hien thi category trong trang Category, ko co trong tags va search
						if (is_archive() && !is_tag()) { ?>
						<div class="entry-cat-tag cat_<?=$first_category->cat_ID // cat_15-bg?>-bg">
							<a title="<?=$first_category->name?>" href="<?= get_category_link($first_category) ?>">
								<?=$first_category->name?>
							</a>
						</div>
						<?php } ?>
						<!-- .entry-cat-tag -->
						<a title="<?php the_title();?>" href="<?php the_permalink();?>">
							<div class="post-thumbnail">
								<img width="620" height="350" alt="<?php the_title();?>"
									src="<?= $imageURL ?>">
							</div>
							<!-- .post-thumbnail -->
						</a>
					</figure>
					<!-- .archive-featured-post-thumbnail -->
				</div>
				<!-- .archive-featured-post-media -->
				<div class="archive-featured-post-content clr">
					<header>
						<h2 class="archive-featured-post-title">
							<a title="<?php the_title();?>" href="<?php the_permalink();?>"><?php the_title();?></a>
						</h2>
					</header>
					<div class="archive-featured-post-excerpt clr">
						<?= $mtp_content_support->getExcerpt(get_the_excerpt(), 100); ?>
					</div>
					<!-- .archive-featured-post-excerpt -->
				</div>
				<!-- .archive-featured-post-content -->
			</article>
			<!-- .archive-featured-post -->
		<?php } else { ?>

			<article class="clr loop-entry col-<?=$col; //col-1?>">
				<div class="loop-entry-media clr">
					
					<?php 
					// chi hien thi category trong trang Category, ko co trong tags va search
					if (is_archive() && !is_tag()) { ?>
					<div class="entry-cat-tag cat_<?=$first_category->cat_ID // cat_15-bg?>-bg">
						<a title="<?=$first_category->name?>" href="<?= get_category_link($first_category) ?>">
							<?=$first_category->name?>
						</a>
					</div>
					<?php } ?>
					<!-- .entry-cat-tag -->

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
			}
			$i++; 
		endwhile;

		wp_reset_query();	// reset lai query voi thong so ban dau de chay pagination
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
