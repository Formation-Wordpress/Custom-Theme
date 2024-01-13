<div class="wpex-tabs-widget clr">
    <div class="wpex-tabs-widget-inner clr">
        <div class="wpex-tabs-widget-tabs clr">
            <ul>
                <?php 
                    if (!empty($instance['popular_title'])) {
                        echo '<li><a href="#" data-tab="#wpex-widget-popular-tab" class="active">'.ucwords($instance['popular_title']).'</a></li>';
                    }
                    if (!empty($instance['recent_title'])) {
                        echo '<li><a href="#" data-tab="#wpex-widget-recent-tab" class="">'.ucwords($instance['recent_title']).'</a></li>';
                    }
                    if (!empty($instance['comment_title'])) {
                        echo '<li><a href="#" data-tab="#wpex-widget-comments-tab" class="last">'.ucwords($instance['comment_title']).'</a></li>';
                    }
                ?>
            </ul>
        </div>

        <!-- .wpex-tabs-widget-tabs Popular Posts -->
        <?php
        if (!empty($instance['popular_title'])) { ?>

        <div id="wpex-widget-popular-tab" class="wpex-tabs-widget-tab active-tab clr">
            <ul class="clr">

                <?php
                    if ($popular_wp_query->have_posts()) {
                        $i = 1;
                        while ($popular_wp_query->have_posts()) {
                            $popular_wp_query->the_post();                                                
                ?>

                <li class="clr">
                    <a href="<?=the_permalink()?>" title="<?=the_title()?>" class="clr">
                        <span class="counter"> <?php echo $i; $i++; ?> </span>
                        <span class="title strong"><?=the_title()?>:</span> 
                        <?= $this->getExcerpt(get_the_excerpt()) ?>
                    </a>
                </li>

                <?php
                        }
                    }
                wp_reset_postdata();
                ?>

            </ul>
        </div>

        <?php } ?>

        
        <!-- wpex-tabs-widget-tab Recent Posts -->
        <?php
        if (!empty($instance['recent_title'])) { ?>

        <div id="wpex-widget-recent-tab" class="wpex-tabs-widget-tab  clr">
            <ul class="clr">
                <?php
                    if ($recent_wp_query->have_posts()) {
                        while ($recent_wp_query->have_posts()) {
                            $recent_wp_query->the_post();
                            // $post_content = get_the_content(); // se bi han che boi More(link), ko hien content phia sau More
                            $post_content = $recent_wp_query->post->post_content;                              
                ?>
                    <li class="clr">
                        <a href="<?= the_permalink() ?>" title="<?php the_title() ?>" class="clr">
                            <img src="<?= ($this->getImageUrl($post_content)) ?>" alt="<?php the_title() ?>" width="100" height="100" />
                            <span class="title strong"> <?php the_title() ?> : </span>
                            <?= $this->getExcerpt(get_the_excerpt()) ?>
                        </a>
                    </li>
                <?php
                        }
                    }
                wp_reset_postdata();
                ?>
            </ul>
        </div>

        <?php } ?>


        <!-- wpex-tabs-widget-tab Comments -->
        <?php
        if (!empty($instance['comment_title'])) { ?>

        <div id="wpex-widget-comments-tab" class="wpex-tabs-widget-tab clr">
            <ul class="clr">
                <?php
                    if ( count($comments) > 0 ) {
                        foreach ( $comments as $comment ) { ?>
           
                <li class="clr">
                    <a href="<?=get_permalink($comment->comment_post_ID)?>" title="Homepage" class="clr">
                        
                        <?php   // echo get_avatar($comment, 100) 
                                // <img alt="" src="http://0.gravatar.com/avatar/f5036648e6d25ad1f3c4d6fe097788ba?s=100&amp;d=mm&amp;r=g" srcset="http://0.gravatar.com/avatar/f5036648e6d25ad1f3c4d6fe097788ba?s=200&amp;d=mm&amp;r=g 2x" class="avatar avatar-100 photo" height="100" width="100" decoding="async"> -->
                                // Ta can lay ra src cua link phia tren

                                // echo '<pre>';
                                // print_r($this->get_image_url(get_avatar($comment, 100)));
                        ?>

                        <img src="<?= $this->get_image_url(get_avatar($comment, 100)) ?>" class="avatar avatar-100 photo" />
                        <span class="title strong"> <?= $comment->comment_author ?>:</span> 
                        <?= $this->getExcerpt($comment->comment_content) ?>
                    </a>
                </li>
                
                <?php
                        }
                
                    } else {
                        echo '<h3> No comments. </h3>';
                    }
                ?>

            </ul>
        </div>

        <?php } ?>
        <!-- .wpex-tabs-widget-tab -->

    </div>
    <!-- .wpex-tabs-widget-inner -->

</div>
<!-- .wpex-tabs-widget -->