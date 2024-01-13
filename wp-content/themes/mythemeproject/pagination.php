<?php
global $wp_query;

$big = 999999999;
$base = str_replace($big, '%#%', esc_url(get_pagenum_link($big)));

if (!is_search()) {
    $total_posts = $wp_query->found_posts;
    $total_pages = ceil(($total_posts + 1)/($wp_query->query_vars['posts_per_page'] + 1));

} else {
    $total_pages = $wp_query->max_num_pages;
}

$args = array(
    'base'               => $base,            // http://example.com/all_posts.php%_% : %_% is replaced by format (below).
    'format'             => '?paged=%#%',     // ?paged=%#% : %#% is replaced by the page number.
    'total'              => $total_pages,           
    'current'            => max(1, get_query_var('paged')),                                                             
    'aria_current'       => 'page',
    'show_all'           => false,                                              
    'prev_next'          => false,
    // 'prev_text'          => __( '&laquo; Previous' ),   
    // 'next_text'          => __( 'Next &raquo;' ),
    'end_size'           => 1,                                          
    'mid_size'           => 2,                                          
    'type'               => 'list', 
);

if ( $wp_query->max_num_pages > 1 ) : ?>

    <div class="site-pagination clr">
            <span class="site-pagination-heading">Pages</span>
            <?= paginate_links($args); ?>
    </div>

<?php endif ?>