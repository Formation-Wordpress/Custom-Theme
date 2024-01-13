<?php

class MyThemeProject_Theme_Posts_Tabs extends WP_Widget
{
    public function __construct()
    {
        $widget_id = 'MyThemeProject_Theme_Posts_Tabs';
        $widget_name = 'Theme Posts Tabs';
        $widget_options = [
            'classname'     => 'widget_wpex_tabs_widget',
            'description'   => 'Theme Tabs for Popular Posts, Recent Posts and Comments'
        ];
        $widget_controls = [];
        parent::__construct($widget_id, $widget_name, $widget_options, $widget_controls);
    }

    // hien thi widget len front page
    public function widget($args, $instance)
    {
        /*
        echo '<pre>';
        print_r($instance);
        Array
            (
                [popular_title] => Popular
                [popular_items] => 5
                [recent_title] => Recent
                [recent_items] => 0             // ko nhap vao thi gtri la 0
                [comment_title] => Comment
                [comment_items] => 0
            )
        */
        
        $popular_items      = (int)$instance['popular_items'] <= 0 ? 5 : (int)$instance['popular_items']; 
        $popular_wp_query   = $this->getPopularPosts($popular_items);
        
        $recent_items       = (int)$instance['recent_items'] <= 0 ? 5 : (int)$instance['recent_items']; 
        $recent_wp_query    = $this->getRecentPosts($recent_items);

        $comment_items      = (int)$instance['comment_items'] <= 0 ? 5 : (int)$instance['comment_items']; 
        $comments           = $this->getComments($comment_items);
       
        // debug($this->getComments($comment_items));
        // $this->debug_query($popular_wp_query);


        // hien thi ket qua
        echo $args['before_widget'];

        require_once THEME_WIDGETS_DIRECTORY . '/views/posts-tabs.php';

        echo $args['after_widget'];
    }

    // hien thi widget trong trang admin
    public function form( $instance )
    {
        $fields = $this->getFields_Labels();

        foreach ($fields as $field => $label) {
            $input_value = @$instance[$field];
            $this->getInputElement($field, $input_value);
        } 
    }

    // ham xu ly khi nhan vao save widget trong trang admin
    // ham nay se luu gia tri vao database table wp_options
    public function update($new_instance, $old_instance)
    {
        // neu nhap du lieu la empty thi giu lai gia tri old. Important !!!
        $instance = $old_instance;
        
        // new value : loc cac html tags

        foreach ($this->getFields_Labels() as $field => $label) {
            if (str_contains($field, 'items')) {
                $instance[$field]   = (!empty($new_instance[$field]) && intval($new_instance[$field])>=0) 
                                        ? intval($new_instance[$field])
                                        : 0;
            } else {
                $instance[$field]   = htmlspecialchars(strip_tags($new_instance[$field]));
            }
        }
            
        return $instance;
    }

    public function getFields_Labels()
    {
        return ['popular_title'     => 'Popular Post Title',
                'popular_items'     => 'Number of Popular Post Items', 
                'recent_title'      => 'Recent Post Title', 
                'recent_items'      => 'Number of Recent Post Items', 
                'comment_title'     => 'Comment Title', 
                'comment_items'     => 'Number of Comment Items'
            ];
    }

    public function getInputElement(string $field, $input_value) : void
    {
        $field_id = $this->get_field_id($field);
        $field_name = $this->get_field_name($field);
        $input_label = ucfirst(($this->getFields_Labels())[$field]);

        if (str_contains($field, 'items')) {
            $type = 'number';
        } else {
            $type = 'text';
        }

        echo "
        <p>
            <label for='$field_id'> " . translate($input_label) . " </label>
            <input type='$type' id='$field_id' name='$field_name' 
                        value='$input_value' class='widefat' 
                        placeholder='' >
        </p>      
        ";
    }

    public function getPopularPosts($posts_per_page)
    {
        $args = [
            'post_type'             => 'post',
            'post_status'           => 'publish',
            'ignore_sticky_posts'   => true,
            'posts_per_page'        => $posts_per_page,
            'meta_query'            => [
                                            'relation' => 'OR',                  
                                            array(
                                                'key'       => 'post_views_count',
                                                'compare'   => 'NOT EXISTS',      
                                            ),
                                            array(
                                                'key'       => 'post_views_count',
                                            )
                                        ],
            'orderby'               => 'meta_value',
            'order'                 => 'DESC'         
        ];

        return new WP_Query( $args );        
    }

    public function getRecentPosts($posts_per_page)
    {
        $args = [
            'post_type'             => 'post',
            'post_status'           => 'publish',
            'ignore_sticky_posts'   => true,
            'posts_per_page'        => $posts_per_page,
            'orderby'               => 'date', // hay 'ID' cung dc
            'order'                 => 'desc'
        ];

        return new WP_Query( $args );        
    }

    public function getComments($posts_per_page)
    {
        $args = array(
            'number'    => $posts_per_page,     // so luong comments lay ra
            'status'    => 'approve',           // comment dc approved trong bang wp_comments
            'order'     => 'DESC',              // gia tri default
            'orderby'   => 'comment_date_gmt'   // gia tri default
        );

        $comment_query = new WP_Comment_Query($args);
        return $comment_query->comments;
    }


    // get the image url inside the post's content
    public function getImageUrl($post_content)
    {
        $pattern = '/<img.*?src=[\'"](.*?)[\'"].*?>/i';        /* '|<img.*?src=[\'"](.*?)[\'"].*?>|i'  */

        if (!empty($post_content)) {
            preg_match_all( $pattern, $post_content, $matches );
        }
        
        if ( !empty($matches[1][0]) ) return $matches[1][0];
        
        return 'http://wordpress_project.test/wp-content/uploads/2023/11/shutterstock_111362132-620x350-1.jpg';
                // image mac dinh
    }


    // get the excerpt
    public function getExcerpt($post_excerpt)
    {
        if (!empty($post_excerpt)) {
            if (strlen($post_excerpt) > 50) {
                $end_word = strpos($post_excerpt, ' ', 40);
                if (!empty($end_word)) return substr($post_excerpt, 0, $end_word) . '...';
            }
            else return $post_excerpt;            
        }
        return ' ...';
    }

    // get the URL of an image (avatar) from its image tag <img src="  " ..... />
    public function get_image_url($image_tag)
    {
        $pattern = '/src=[\'\"](.*?)[\'\"]/i';
        preg_match_all($pattern, $image_tag, $matches);

        if (!empty($matches[1][0])) return $matches[1][0];

        return 'http://0.gravatar.com/avatar/f5036648e6d25ad1f3c4d6fe097788ba?s=100&amp;d=mm&amp;r=g';
    }

    /*  model :
    <img alt="" src="http://0.gravatar.com/avatar/f5036648e6d25ad1f3c4d6fe097788ba?s=100&amp;d=mm&amp;r=g" 
    srcset="http://0.gravatar.com/avatar/f5036648e6d25ad1f3c4d6fe097788ba?s=200&amp;d=mm&amp;r=g 2x" 
    class="avatar avatar-100 photo" height="100" width="100" decoding="async">
    */


    public function debug_query($wp_query)
    {
        if ($wp_query->have_posts()) {
            while ($wp_query->have_posts()) {
                $wp_query->the_post();
                echo the_title(). '<br>';
            }
            wp_reset_postdata();
        }
    }

}


/*
<img src="http://wordpress_project.test/wp-content/uploads/2023/11/shutterstock_80791570-100x100-1.jpg" alt="" class="wp-image-10"/>
*/

/*
    <!-- wp:paragraph -->
    <p><strong>Quisque pellentesque fringilla scelerisque. Donec porta urna eu fringilla adipiscing.…</strong></p>
    <!-- /wp:paragraph -->
*/




    // get the excerpt
    // public function getExcerpt($post_content)
    // {
    //     if (!empty($post_content)) {
    //         $start  = strpos($post_content, '<!-- wp:paragraph -->');
    //         $end    = strpos($post_content, '<!-- /wp:paragraph -->');
    
    //         $first_paragraph = substr($post_content, $start, $end - $start);
    //         if (!empty($first_paragraph)) {
    //             $first_paragraph = str_replace(['<!-- wp:paragraph -->', '<!-- /wp:paragraph -->'], ['',''], $first_paragraph);
    //             $first_paragraph = strip_tags($first_paragraph);
                
    //             $end_word = strpos($first_paragraph, ' ', 40);
    //             return substr($first_paragraph, 0, $end_word) . '...';
    //         }
    //     }

    //     return ' ...';
    // }