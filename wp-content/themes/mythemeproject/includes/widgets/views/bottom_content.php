<?php
    if ($wp_query->have_posts()) {
?>

    <div class="featured-carousel-wrap clr">
        <h2 class="heading"> <?= !empty($title) ? strtoupper($title) : 'FEATURED' ?> </h2>
        <div class="featured-carousel owl-carousel clr count-8">
        <?php
            while ($wp_query->have_posts()) {
                $wp_query->the_post();                    

                // get image
                // $post_content = get_the_content();  // neu co read More thi content phia sau ko hien thi, thay the bang More(link)
                $post_content = $wp_query->post->post_content;  // lay ra toan bo content, ko bi anh huong boi More

                $post_url = $this->getImageUrl($post_content);

                $imageUrl = has_post_thumbnail() ? get_the_post_thumbnail_url() : $post_url;
                $imageSize = getimagesize($imageUrl);
                // width = $data[0];
                // height = $data[1];

                if ($imageSize[0] != $width || $imageSize[1] != $height) {
                    $imageUrl = $this->get_new_img_url($imageUrl, $width, $height);
                }
            ?>
                <div class="featured-carousel-slide">
                    <a href="<?php the_permalink() ?>" title="<?php the_title() ?>">
                        <img src="<?=$imageUrl?>" alt="<?php the_title() ?>" />
                        <?php the_title() ?>
                    </a>
                </div>
        <?php
            } // while ($wp_query->have_posts())
        ?>
            
        </div>
        <!-- .featured-carousel -->
    </div>
<!-- .featured-carousel-wrap -->

<?php
    } // if ($wp_query->have_posts())
?>