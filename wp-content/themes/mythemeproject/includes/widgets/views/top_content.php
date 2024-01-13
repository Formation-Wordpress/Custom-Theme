<?php
    if ($wp_query->have_posts()) {

    $cat_bg_array = [
        'Asia'              => 'cat-39-bg',
        'Shopping'          => 'cat-3-bg',
        'Global'            => 'cat-31-bg',
        'Model'             => 'cat-25-bg'
    ];

    $i = 0;
?>
        <div id="home-slider-wrap" class="clr">
			<div id="home-slider" class="owl-carousel">
            <?php
                while ($wp_query->have_posts()) {
                    $i++;

                    $wp_query->the_post();                    
                            
                    $cat = get_the_category();
                    $cat_name = $cat[0]->name;      // cat[0] la phan tu thu 1 (co the co nhieu gia tri category cho 1 post)
                    
                    // lay ra background cua category theo array phia tren
                    $cat_bg = !empty($cat_bg_array[$cat_name]) ? $cat_bg_array[$cat_name] : 'cat-29-bg';
                    
                    // lay ra ID cua category
                    $cat_ID = $cat[0]->cat_ID;

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
                    // echo $imageUrl;

            ?>
                <div class="home-slider-slide" data-dot="<?=$i?>">
                    
                    <?php 
                    if ($cat_name != 'Uncategorized') { ?>
                    <!-- post's category -->
                    <div class="entry-cat-tag <?=$cat_bg?>">
                        <a href="<?=get_category_link($cat_ID)?>" title="<?=$cat_name?>" > <?=ucwords($cat_name)?> </a>
                    </div>
                    <?php } ?>

                    <!-- .entry-cat-tag -->
                    <div class="home-slider-media">
                        <a href="<?php the_permalink() ?>" title="<?php the_title() ?>">
                            <img src="<?=$imageUrl?>" alt="<?php the_title() ?>" />
                        </a>
                    </div>
                    <!-- .home-slider-media -->
                    <div class="home-slider-caption clr">
                        <h2 class="home-slider-caption-title">
                            <a href="<?php the_permalink() ?>#" title="<?php the_title() ?>" rel="bookmark"><?php the_title() ?></a>
                        </h2>
                        <div class="home-slider-caption-excerpt clr">
                            <?= $this->getExcerpt(get_the_excerpt(), 145) ?>
                        </div>
                        <!-- .home-slider-caption-excerpt -->
                    </div>
                    <!--.home-slider-caption -->
                </div>
            <!-- .widget-slider-slide -->

            <?php
                } // while ($wp_query->have_posts())
            ?>
            </div>
            <!-- #home-slider -->
            <div id="home-slider-numbers"></div>
        </div>
        <!-- #home-slider-wrap -->

<?php
    } // if ($wp_query->have_posts())
?>
