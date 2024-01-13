<div class="footer-widget widget_wpex_recent_news_widget clr">
    <span class="widget-title"><?= !empty($title) ? ucwords($title) : '' ?></span>

    <?php
    if ( $wp_query->have_posts() ) { 
        
        $cat_bg_array = [
            'Asia'              => 'cat-39-bg',
            'Shopping'          => 'cat-3-bg',
            'Global'            => 'cat-31-bg',
            'Model'             => 'cat-25-bg',
            'Formula 1'         => 'cat-29-bg',
            'Health'            => 'cat-36-bg'
        ];    
    
    ?>
        
    <ul class="widget-latest-news clr">

        <?php
        $i = 0;

        while ( $wp_query->have_posts() ) {
            $wp_query->the_post();

            $cat = get_the_category();
            $cat_name = $cat[0]->name;      // cat[0] la phan tu thu 1 (co the co nhieu gia tri category cho 1 post)
                    
            // lay ra background cua category theo array phia tren
            $cat_bg = !empty($cat_bg_array[$cat_name]) ? $cat_bg_array[$cat_name] : 'cat-29-bg';            
            
            // lay ra ID cua category
            $cat_ID = $cat[0]->cat_ID;

            $i++;
            if ($i == 1) {
                // get image
                $post_content = $wp_query->post->post_content;  // lay ra toan bo content, ko bi anh huong boi More

                $post_url = $this->getImageUrl($post_content);

                $imageUrl = has_post_thumbnail() ? get_the_post_thumbnail_url() : $post_url;
                $imageSize = getimagesize($imageUrl);
                // width = $data[0];
                // height = $data[1];

                if ($imageSize[0] > 620 && $imageSize[1] > 350) {
                    $imageUrl = $this->get_new_img_url($imageUrl, 620, 350);
                }
        ?>

        <li class="first-post clr">
            <div class="first-post-media clr">
                <a href="<?php the_permalink() ?>" title="<?php the_title() ?>">
                    <img src="<?=$imageUrl?>" alt="<?php the_title() ?>" width="620" height="350" />
                </a>
                <div class="entry-cat-tag <?=$cat_bg?>">
                    <a href="<?=get_category_link($cat_ID)?>" title="<?=$cat_name?>" > <?=$cat_name?> </a>
                </div>
                <!-- .entry-cat-tag -->
            </div>
            <!-- .first-post-media -->
            <a href="<?php the_permalink() ?>" title="<?php the_title() ?>" class="widget-recent-posts-title"> <?php the_title() ?> </a>
            <p> <?= $this->getExcerpt(get_the_excerpt(), 90) ?> </p>
        </li>

        <?php
            } else {
        ?>

        <li>
            <a href="<?php the_permalink() ?>" title="<?php the_title() ?>" > <?php the_title() ?> </a>
        </li>

        <?php
            } // if ($i == 1)

        } // while ( $$wp_query->have_posts() )
        ?>
    </ul>

    <?php
    } // if ( $$wp_query->have_posts() )
    ?>

</div>