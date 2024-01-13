<?php
global $wp_query;
// echo '<pre>';
// print_r($wp_query);      // [max_num_pages] => 4
$big = 999999999;
// echo get_pagenum_link($big);
                    // tuy thuoc vao dinh dang permalink trong setup
                        // http://wordpress_project.test/page/999999999/            
                        // http://wordpress_project.test/?paged=999999999
$base = str_replace($big, '%#%', esc_url(get_pagenum_link($big)));
// echo $base;         // http://wordpress_project.test/?paged=%#%
$page_total = 

$args = array(
    'base'               => $base,            // http://example.com/all_posts.php%_% : %_% is replaced by format (below).
    'format'             => '?paged=%#%',     // ?paged=%#% : %#% is replaced by the page number.
    'total'              => $wp_query->max_num_pages,           // tong so trang cua query hien tai
    'current'            => max(1, get_query_var('paged')),     // hoac la paged neu ko la 1 
                                                                // (boi vi trang dau tien ko co paged thi la paged=0)
    'aria_current'       => 'page',
    'show_all'           => false,      // true: 1 2 3 4 5 6 7 8 9 Next »
                                        // false : 1 2 3 … 9 Next »
    'prev_next'          => false,       // hien thi Previous va Next
    // 'prev_text'          => __( '&laquo; Previous' ),   
    // 'next_text'          => __( 'Next &raquo;' ),
    'end_size'           => 1,      // so luong so o dau moi ben.  « Previous 1 … 7 8 9 (chi co 1 con so '1').
                                    // 1 2 3 … 9 Next »   (chi co 1 con so '9')
    'mid_size'           => 2,      // so luong trang nam o 2 ben cua trang hien tai. Neu la 2 :  
                                    // « Previous 1 … 3 4 5 6 7 … 9 Next »   (hien tai la 5, 2 ben la 3 4 va 6 7)
    'type'               => 'list',
    
    // 'add_args'           => array('num'=>'truoc', 'display'=>'no'), // Array of query args to add.
    // 'add_fragment'       => '&test=abc',
    // 'before_page_number' => '[',
    // 'after_page_number'  => ']',
);
echo paginate_links($args);
echo '<br>';
