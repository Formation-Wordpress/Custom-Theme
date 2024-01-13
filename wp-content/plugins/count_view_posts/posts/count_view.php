
<?php

class WPProject_Posts_Count_Views
{
    private $count_key = 'post_views_count';

    public function __construct()
    {   

        if (!is_admin()) {
            // set view dc thuc hien ben Front Page, su dung hook 'wp_head'
            add_action('wp_head', [$this, 'set_posts_views']);
        } else {
            
            // them cot moi
            add_filter('manage_posts_columns', [$this, 'add_column']);
            // add_filter('manage_post_posts_columns', [$this, 'add_column']);  // tuong tu

            // add the possibility "sortable" for 2 new columns
            add_filter( "manage_edit-post_sortable_columns", [$this, 'set_sortable_columns'] );

            // hien thi gia tri cua cac cot moi
            add_action('manage_posts_custom_column', [$this, 'display_values'], 10, 2);
            
            // activate the sortable for these 2 new columns. set query to sort
            add_action( 'pre_get_posts', [$this, 'sortable_columns_query'] );

            // them css cho 2 columns moi :  views va ID
            if (str_contains($_SERVER['REQUEST_URI'], '/wp-admin/edit.php')) {
                add_action('admin_enqueue_scripts', [$this, 'add_css_file']);
            }
            
        }
    }

    public function set_posts_views()
    {
        if (!is_single()) return;
        
        // phai vao trong trang single (loop-single) cua 1 bai post

        $post = get_post();
        // debug($post);   // lay ve WP_POST cua post hien tai trong loop single, su dung $post = $GLOBALS['post'];  
        // hay su dung:  global $post;  cung dc

        $post_id = $post->ID;
            
        $count = (int) get_post_meta($post_id, $this->count_key, true);

        // ban dau : neu chua co gia tri trong table 'postmeta'
        if( $count=='' ){
            $count = 0;
            delete_post_meta($post_id, $this->count_key);
            add_post_meta($post_id, $this->count_key, '1');

        }else{
            // neu da ton tai views roi thi them +1
            $count++;
            update_post_meta($post_id, $this->count_key, $count);
        }
    }

    // $columns la array chua cac columns hien tai
    // su dung array_merge de them cot moi vao phia sau $columns
    public function add_column($columns) {

        // kiem tra phai la 'posts'. ko phai 'page' hay 'custom product'
        $post_type = get_post_type();

        if ( $post_type == 'post' ) {
            $new_columns = array(
             // 'colume name'   => 'Displayed Name of the column,
                'post_views'    => esc_html__( 'Views', 'mythemeproject' ),
                'post_id'       => esc_html__( 'ID', 'mythemeproject' ),
            );
            
            return array_merge($columns, $new_columns);

            // viet tuong tu nhu tren :
            // $columns['MY_CUSTOM_COLUMN'] = __('Custom Column Header Text');
            // return $columns;
        }
        return $columns;
    }

    public function display_values($column_name, $post_id) 
    {
        if ($column_name == 'post_views') {
            $views = get_post_meta($post_id, $this->count_key, true);
            $views = !empty($views) ? $views : 0;
            echo $views;
        }
        if ($column_name == 'post_id') {
            echo $post_id;
        }
    }
    
    public function set_sortable_columns($columns)
    {
        $columns['post_views']  = 'post_views';
        $columns['post_id']     = 'post_id';
        return $columns;
    }

    public function sortable_columns_query($query)
    {
        $orderby = $query->get( 'orderby' );    // lay gia tri tham so 'orderby' cua query (tren URL cung co). 
                                                // Default cua trang Posts la 'date'

        if ( $orderby == 'post_views' ) {
            $meta_query = array(
                'relation' => 'OR',                     // posts hoac co postmeta hoac ko co postmeta (ko ton tai meta_key)
                array(
                    'key'       => 'post_views_count',  // day la meta_key trong table wp_postmeta
                    'compare'   => 'NOT EXISTS',        // truong hop la post ko co postmeta (ko ton tai)
                ),
                array(
                    'key'       => 'post_views_count',  // co postmeta, co views
                ),
            );

            $query->set( 'meta_query', $meta_query );
            $query->set( 'orderby', 'meta_value' );
        }

        if ( $orderby == 'post_id' ) {
            $query->set( 'orderby', 'ID' );
        }
    }

    public function add_css_file()
    {
        wp_register_style('post_column_count_view', MYHOOK_MP_CSS_URL . 'count_view_posts_columns.css', 
                            [], '1.0', 'all');
        wp_enqueue_style('post_column_count_view');
    }
}

