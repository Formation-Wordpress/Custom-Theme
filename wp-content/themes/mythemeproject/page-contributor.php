<?php

/******************************
 * Template name: Contributor
 *******************************/
?>

<?php
get_header();
?>
<!-- #top-wrap -->
<div class="site-main-wrap clr">
    <div id="main" class="site-main clr container">
        <div id="primary" class="content-area clr">
            <div id="content" class="site-content left-content clr" role="main">
                <?php
                if (have_posts()) while (have_posts()) : the_post(); ?>
                    
                    <article id="post-<?php the_ID() ?>" <?php post_class('clr') ?>>
                        <header class="page-header clr">
                            <h1 class="page-header-title"> <?php the_title() ?> </h1>
                        </header>

                        <div class="entry clr">
                            <?php the_content() ?>
                        </div>
                    </article>

                    <?php
                        // lay ra toan bo users
                        $user_args = [
                            'orderby'   => 'post_count',
                            'order'     => 'DESC',
                        ];
                        $all_users = get_users($user_args);     // array of users Objets
                        // echo '<pre>';
                        // print_r($all_users);                                                 
                    ?>

                    <div id="contributors-template-wrap" class="clr">
                        <?php
                        if (count($all_users) > 0) {
                            foreach ($all_users as $user) {
                                $userID = $user->ID;
                                $user_posts = count_user_posts($userID);
                        ?>
                        <article class="contributor-entry boxed-content clr">
                            <div class="contributor-entry-inner clr">
                                <div class="contributor-entry-avatar">
                                    <?= get_avatar($userID, 60, '', 'user avatar'); ?>    

                                    <div class="contributor-entry-count">
                                        <a href="<?=get_author_posts_url($userID)?>" 
                                            title="Posts by <?= get_the_author_meta('display_name', $userID)?>"> 
                                            <?= $user_posts == 1 ? '1 article' : $user_posts.' articles'; ?>
                                        </a>
                                    </div>
                                </div>
                            

                                <div class="contributor-entry-desc">
                                    <h2 class="contributor-entry-title">
                                        <a href="<?=get_author_posts_url($userID)?>" 
                                            title="Posts by <?= get_the_author_meta('display_name', $userID)?>"> 
                                            <?= get_the_author_meta('display_name', $userID)?>
                                        </a>
                                    </h2>
                                </div>

                                <div class="contributor-entry-url">
                                    <span>Website:</span>
                                    <a href="<?= get_the_author_meta('url', $userID)?>" target="_blank">
                                        <?= get_the_author_meta('url', $userID)?>
                                    </a>
                                </div>

                                <p> <?= get_the_author_meta('description', $userID)?> </p>

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

                            </div>
                        </article>
                        <?php
                            } // foreach ($all_users as $user)
                        } // if (count($all_users) > 0)
                        ?>
                    </div>

                <?php
                    endwhile;
                ?>

                <div class="ad-spot home-bottom-ad clr">
                    <a href="#" title="Ad">
                        <img src="<?= THEME_IMAGES_DIRECTORY_URL ?>/ad-620x80.png" alt="Ad" />
                    </a>
                </div>
                <!-- .ad-spot -->

            </div>
            <!-- #content -->

            <?php
            get_sidebar();
            ?>
            <!-- #secondary -->
        </div>
        <!-- #primary -->
    </div>
    <!--.site-main -->
</div>
<!-- .site-main-wrap -->
</div>
<!-- #wrap -->

<?php
get_footer();
?>