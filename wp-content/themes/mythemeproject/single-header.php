<?php
global $mtp_content_support;

// echo '<pre>';
// print_r($post);  // co $wp_query thi co $post tuong ung

// lay format cua post
$format = get_post_format($post);

// neu la Standard Post
if (empty($format)) {
    // lay featured image
    $featuredImage = get_the_post_thumbnail($post);

    // neu ko co feature image thi lay ra image dau tien cua content
    if (empty($featuredImage)) {
        $content = $post->post_content;
        $featuredImage = $mtp_content_support->getFirstImage($content);
    }

    // neu co image thi se xuat ra
    if (!empty($featuredImage)) {  ?>

    <div class="single-post-media clr">
        <div class="post-thumbnail">
            <?= $featuredImage; ?>
        </div>
    </div>
<?php 
    }
} else if ($format == 'audio') {
    $firstAudio = $mtp_content_support->getFirstAudio($post->post_content);
    if (!empty($firstAudio)) {  ?>

        <div class="single-post-media clr">
            <figure class="wp-block-audio">
                <?= $firstAudio; ?>
            </figure>
        </div>
<?php
    }
} else if ($format == 'video') {

    $firstVideo = $mtp_content_support->getFirstVideo($post->post_content);
    
    if (!empty($firstVideo)) { 
        
        // filter the content (giong nhu ham the_content())
		$firstVideo = apply_filters( 'the_content', $firstVideo );
		$firstVideo = str_replace( ']]>', ']]&gt;', $firstVideo );

        // neu la iframe thi them the div de dam bao video hien thi 100%.
        // The div nay chi displayed sau khi filtered ma thoi.
        $open_tag = '<div class="fluid-width-video-wrapper" style="padding-top: 56.2%;"><iframe title';
        $close_tag = '</iframe></div>';

        $firstVideo = str_replace(['<iframe title', '</iframe>'], [$open_tag, $close_tag], $firstVideo);
        echo $firstVideo;
    }
} else if ($format == 'gallery') {
    $choice = false;

    // su dung Gallery cua he thong
    if ($choice) {
        $firstGallery = $mtp_content_support->getFirstGallery($post->post_content);

        if ( !empty($firstGallery) ) { 
            // filter the content (giong nhu ham the_content())
        	$firstGallery = apply_filters( 'the_content', $firstGallery );
        	$firstGallery = str_replace( ']]>', ']]&gt;', $firstGallery );
            echo $firstGallery;
        }

    // su dung Gallery Carrousel cua code source cua theme
    } else {
        $html = $mtp_content_support->createFirstGalleryHTML($post->post_content);

        if ( !empty($html) ) {           
            echo $html;
        }
    }
    
}
?>



