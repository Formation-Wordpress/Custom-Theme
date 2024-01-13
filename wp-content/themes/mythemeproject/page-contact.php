<?php

/**********************************************
 * Template name: Theme Contact Page
 *********************************************/
?>
<?php

get_header();

?>
<!-- #top-wrap -->
<div class="site-main-wrap clr">
    <div id="main" class="site-main clr container">
        <div id="primary" class="content-area clr">
            <div id="content" class="site-content left-content clr" role="main">

                <article class="clr" id="post-19">
                    <header class="page-header clr">
                        <h1 class="page-header-title">Contact</h1>
                    </header>
                    <!-- #page-header -->
                    <div class="entry clr">
                        <div style="width: 100%" class="googlemap  symple-all" id="map_canvas_32">
                            <input type="hidden" value="" class="title">
                            <input type="hidden" value="" class="location">
                            <input type="hidden" value="10" class="zoom">
                            <div class="map_canvas">
                                <?php
                                if (have_posts()) while (have_posts()) : the_post();
                                the_content();
                                endwhile
                                ?>
                            </div>
                        </div>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                            Pellentesque nec diam non velit vestibulum sagittis. Nunc
                            ullamcorper ac risus nec suscipit. Nam tellus augue, placerat
                            ultrices condimentum at, consequat blandit purus. Interdum et
                            malesuada fames ac ante ipsum primis in faucibus. Quisque
                            ullamcorper diam in massa porta accumsan.&nbsp;Lorem ipsum
                            dolor sit amet, consectetur adipiscing elit. Pellentesque nec
                            diam non velit vestibulum sagittis. Nunc ullamcorper ac risus
                            nec suscipit. Nam tellus augue, placerat ultrices condimentum
                            at, consequat blandit purus. Interdum et malesuada fames ac
                            ante ipsum primis in faucibus. Quisque ullamcorper diam in
                            massa porta accumsan.</p>
                        <h2>Contact Form </h2>
                        <div lang="en-US" dir="ltr" id="wpcf7-f355-p19-o1" class="wpcf7">
                            <div class="screen-reader-response" role="alert">
                                Validation errors occurred. Please confirm the fields and submit it again.
                                <ul>
                                    <li>Please fill the required field.</li>
                                    <li>Please fill the required field.</li>
                                </ul>
                            </div>
                            <form novalidate="novalidate" class="wpcf7-form" method="post" action="#" name="">
                                <div style="display: none;">
                                    <input type="hidden" value="" name="_wpcf7">
                                    <input type="hidden" value="" name="_wpcf7_version">
                                    <input type="hidden" value="" name="_wpcf7_locale">
                                    <input type="hidden" value="" name="_wpcf7_unit_tag">
                                    <input type="hidden" value="" name="_wpnonce">
                                </div>
                                <p>
                                    Your Name (required)<br>
                                    <span class="wpcf7-form-control-wrap your-name">
                                        <input type="text" aria-invalid="false" aria-required="true" 
                                                class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" 
                                                size="40" value="" name="your-name">
                                    </span>
                                </p>
                                <p>
                                    Your Email (required)<br>
                                    <span class="wpcf7-form-control-wrap your-email">
                                        <input type="email" aria-invalid="false" aria-required="true" 
                                                class="wpcf7-form-control wpcf7-text wpcf7-email wpcf7-validates-as-required wpcf7-validates-as-email" 
                                                size="40" value="" name="your-email">
                                    </span>
                                </p>
                                <p>
                                    Your Message<br>
                                    <span class="wpcf7-form-control-wrap your-message">
                                        <textarea aria-invalid="false" class="wpcf7-form-control wpcf7-textarea" 
                                                rows="10" cols="40" name="your-message"></textarea>
                                    </span>
                                </p>
                                <p>
                                    <input type="submit" class="wpcf7-form-control wpcf7-submit" value="Submit Form">
                                    <img class="ajax-loader" style="visibility: hidden;">
                                    <img class="ajax-loader" src="<?=THEME_IMAGES_DIRECTORY_URL?>/ajax-loader.gif" 
                                            alt="Sending ..." style="visibility: hidden;">
                                </p>
                                <div class="wpcf7-response-output wpcf7-display-none wpcf7-validation-errors" style="display: block;" role="alert">
                                    Validation errors occurred. Please confirm the fields and submit it again.
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- .entry -->
                </article>

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