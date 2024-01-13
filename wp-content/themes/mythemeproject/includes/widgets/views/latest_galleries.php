<div class="footer-widget widget_wpex_recent_posts_thumb_widget clr">
    <span class="widget-title"> <?= !empty($title) ? ucwords($title) : '' ?> </span>

    <?php
    if ( $wp_query->have_posts() ) {  ?>
        
    <ul class="widget-recent-posts clr">

        <?php
        while ( $wp_query->have_posts() ) {
            $wp_query->the_post();

            // get image
            $post_content = $wp_query->post->post_content;  // lay ra toan bo content, ko bi anh huong boi More
            $post_url = $this->getImageUrl($post_content);
            $imageUrl = has_post_thumbnail() ? get_the_post_thumbnail_url() : $post_url;
            $imageSize = getimagesize($imageUrl);
            // width = $data[0]; height = $data[1];
            if ($imageSize[0] >= 620 && $imageSize[1] >= 250) {
                $imageUrl = $this->get_new_img_url($imageUrl, 620, 250);    // dung ra phai la 650
            }
        ?>

        <li class="clr widget-recent-posts-li top-thumbnail format-gallery">
            <a href="<?php the_permalink() ?>" title="<?php the_title() ?>" class="widget-recent-posts-thumbnail clr">
                <img src="<?=$imageUrl?>" alt="<?php the_title() ?>" width="650" height="250" />
            </a>
            <div class="widget-recent-posts-content clr">
                <a href="<?php the_permalink() ?>" title="<?php the_title() ?>" class="widget-recent-posts-title"> <?php the_title() ?> </a>
            </div>
            <!-- .widget-recent-posts-content -->
        </li>

        <?php
        } // while ( $$wp_query->have_posts() )
        ?>
    </ul>

    <?php
    } // if ( $$wp_query->have_posts() )
    ?>

</div>