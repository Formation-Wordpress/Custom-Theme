<?php
    if ($wp_query->have_posts()) {

    $cat_bg_array = [
        'Formula 1'         => 'cat-29-bg',
        'Shopping'          => 'cat-3-bg',
        'Featured Slider'   => 'cat-40-bg',
    ];
?>
        <div class="slider-widget owl-carousel clr">
            <?php
                while ($wp_query->have_posts()) {
                    $wp_query->the_post();                    
                            
                    $cat = get_the_category();
                    $cat_name = $cat[0]->name;      // cat[0] la phan tu thu 1 (co the co nhieu gia tri category cho 1 post)
                    
                    // lay ra background cua category theo array phia tren
                    if (has_post_thumbnail()) {
                        $cat_bg = 'cat-40-bg';
                        $cat_name = 'Featured Slider';
                    } else {
                        $cat_bg = !empty($cat_bg_array[$cat_name]) ? $cat_bg_array[$cat_name] : 'cat-29-bg';
                    }
                    
                    
                    // lay ra ID cua category
                    $cat_ID = $cat[0]->cat_ID;

                    // get image
                    // $post_content = get_the_content();  // neu co read More thi content phia sau ko hien thi, thay the bang More(link)
                    $post_content = $wp_query->post->post_content;  // lay ra toan bo content, ko bi anh huong boi More

                    $post_url = $this->getImageUrl($post_content);

                    $imageUrl = has_post_thumbnail() ? get_the_post_thumbnail_url() : $post_url;
                    $imageSize = getimagesize($imageUrl);
                    // $width = $data[0];
                    // $height = $data[1];
                    if ($imageSize[0] != 620 || $imageSize[1] != 350) {
                        $imageUrl = $this->get_new_img_url($imageUrl, $width, $height);
                    }                    

                    // echo get_the_post_thumbnail();   // tra ve image tag
                    // <img width="620" height="350" 
                    //      src="http://wordpress_project.test/wp-content/uploads/2023/12/shutterstock_136240700-620x350-1.jpg" 
                    //      class="attachment-post-thumbnail size-post-thumbnail wp-post-image" 
                    //      alt="" decoding="async" fetchpriority="high" 
                    //      srcset="http://wordpress_project.test/wp-content/uploads/2023/12/shutterstock_136240700-620x350-1.jpg 620w, 
                    //              http://wordpress_project.test/wp-content/uploads/2023/12/shutterstock_136240700-620x350-1-300x169.jpg 300w" 
                    //      sizes="(max-width: 620px) 100vw, 620px">

                    // echo get_the_post_thumbnail_url();  // tra ve url cua image
                            // http://wordpress_project.test/wp-content/uploads/2023/12/shutterstock_136240700-620x350-1.jpg

            ?>
            <div class="slider-widget-slide clr">
                <a href="<?php the_permalink() ?>" title="<?php the_title() ?>" class="widget-recent-posts-thumbnail clr">
                    <?php // lay ra feature image cua post, neu ko co thi lay ra image ben trong content ?>
                    <img src="<?= $imageUrl ?>" 
                            alt="<?php the_title() ?>" width="<?=$width?>" height="<?=$height?>" />
                    <div class="slider-widget-title"> <?php the_title() ?> </div>
                </a>
                <div class="entry-cat-tag <?= $cat_bg ?>">
                    <a href="<?=get_category_link($cat_ID)?>" title="<?= $cat_name ?>"> <?= $cat_name ?> </a>
                </div>
            </div>
            <!-- .widget-slider-slide -->

            <?php
                } // while ($wp_query->have_posts())
            ?>
        </div>

<?php
    } // if ($wp_query->have_posts())
?>
<!-- .widget-slider -->





<?php

/*
Ham get_the_category()  tra ve array tat ca category cua 1 post

Array
(
    [0] => WP_Term Object
        (
            [term_id] => 14
            [name] => Featured Slider
            [slug] => featured-slider
            [term_group] => 0
            [term_taxonomy_id] => 14
            [taxonomy] => category
            [description] => Category 2
            [parent] => 0
            [count] => 3
            [filter] => raw
            [cat_ID] => 14
            [category_count] => 3
            [category_description] => Category 2
            [cat_name] => Featured Slider
            [category_nicename] => featured-slider
            [category_parent] => 0
        )

)
*/
?>