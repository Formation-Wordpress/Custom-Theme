<?php
global $mtp_content_support;

if (have_posts()) while (have_posts()) : the_post();

?>

	<header class="post-header clr">
		<h1 class="post-header-title"> <?php the_title(); ?> </h1>
		<div class="post-meta clr">
			<span class="post-meta-date"> <?= __('Posted on') . ' ' . the_modified_date('', ' ', '', false); ?> </span>
			<span class="post-meta-author"> <?= __('by') ?>
				<?= the_author_posts_link(); ?>
			</span>
			<span class="post-meta-category"> <?php echo __('in') . ' ';
												the_category(', '); ?> </span>
			<span class="post-meta-comments"> <?= __('with') ?>
				<a title="<?php the_title(); ?>" href="<?php comments_link(); ?>">
					<?php comments_number('No Comment', '1 Comment', '% Comments') ?>
				</a>
			</span>
		</div>
		<!-- .post-meta -->
	</header>
	<!-- .page-header -->

	<div class="entry clr">
		<div class="ad-spot post-top-ad clr">
			<a title="Ad" href="#"><img alt="Ad" src="<?= THEME_IMAGES_DIRECTORY_URL ?>/ad-250x250.png"></a>
		</div>
		<!-- .ad-spot -->
		<?php
		// the_content(); 
		$content = get_the_content();

		$format = get_post_format();

		// neu Post la Standard
		if (empty($format)) {
			// Kiem tra featured image, neu ko co thi se xoa image dau tien ra khoi content
			$featuredImage = get_the_post_thumbnail($post);
			if (empty($featuredImage)) {
				$content = $mtp_content_support->removeFirstImage($content);
			}
		} else if ($format == 'audio') {
			$content = $mtp_content_support->removeFirstAudio($content);
		} else if ($format == 'video') {
			$content = $mtp_content_support->removeFirstVideo($content);
		} else if ($format == 'gallery') {
			$content = $mtp_content_support->removeFirstGallery($content);
		}

		$carrouselGalleries_display = true;
		if ($format == 'gallery' && $carrouselGalleries_display) {
			// ko filter galleries, chi filter phan noi dung
			$content = $mtp_content_support->modifyLeftGalleries($content);
		} else {
			// filter the content (giong nhu ham the_content())
			$content = apply_filters('the_content', $content);
			$content = str_replace(']]>', ']]&gt;', $content);
		}

		// xuat ra content
		echo $content;
		?>

		<div class="ad-spot post-bottom-ad clr">
			<a title="Ad" href="#"><img alt="Ad" src="<?= THEME_IMAGES_DIRECTORY_URL ?>/ad-620x80.png"></a>
		</div>
		<!-- .ad-spot customized -->

		<div class="post-tags">
			<?php the_tags(); ?>
		</div>
		<!-- tags of the post -->

	</div>
	<!-- .entry -->


	<div class="author-bio clr">
		<div class="author-bio-avatar clr">
			<a title="Visit Author Page" href="<?= get_author_posts_url($post->post_author); ?>">
				<?= get_avatar($post, 60, '', 'user avatar'); ?>
			</a>
		</div>
		<!-- .author-bio-avatar -->
		<div class="author-bio-content clr">
			<div class="author-bio-author clr"><?= __('Authored by', 'mythemeproject') . ' : ' ?>
				<?php the_author_posts_link(); ?>
			</div>
			<div class="author-bio-url">
				<span> <?= __('Website', 'mythemeproject') . ' : ' ?> </span>
				<?php the_author_link(); ?>
			</div>
			<p>
				<?php
				the_author_meta('description');	// ko co break line
				// echo nl2br(get_the_author_meta('description'));  // giu lai break line
				// echo wpautop( get_the_author_meta( 'description' ) ); // giu lai break line + them 1 the <p></p> phia truoc
				?>

			</p>
		</div>
		<!-- .author-bio-content -->
		<div class="author-bio-social clr">
			<a target="_blank" class="twitter" title="Twitter" href="https://twitter.com/WPExplorer">
				<span class="fa fa-twitter"></span></a>
			<a target="_blank" class="facebook" title="Facebook" href="#">
				<span class="fa fa-facebook"></span>
			</a>
			<a target="_blank" class="google-plus" title="Google Plus" href="#">
				<span class="fa fa-google-plus"></span>
			</a>
			<a target="_blank" class="linkedin" title="LinkedIn" href="#">
				<span class="fa fa-linkedin"></span>
			</a>
			<a target="_blank" class="pinterest" title="Pinterest" href="#">
				<span class="fa fa-pinterest"></span>
			</a>
			<a target="_blank" class="instagram" title="Instagram" href="#">
				<span class="fa fa-instagram"></span>
			</a>
		</div>
		<!-- .author-bio-social -->
	</div>
	<!-- .author-bio -->


	<div class="next-prev clr">
		<div class="post-prev">
			<?php
				$format = '<img alt="Previous Article" src="'.THEME_IMAGES_DIRECTORY_URL.'/prev-post.png">';
				previous_post_link($format.' %link', 'Previous Article');
			?>
		</div>

		<div class="post-next">
			<?php
				$format = '<img alt="Next Article" src="'.THEME_IMAGES_DIRECTORY_URL.'/next-post.png">';
				next_post_link($format.' %link', 'Next Article');
			?>
		</div>
	</div>
	<!-- .post-post-pagination -->


	<div class="comments-area clr" id="comments">
		<?php
		// load up the comment template.
		comments_template('/comments.php', true);
		?>
	</div>

<?php endwhile ?>