<?php

class MyThemeProject_Theme_LastPosts extends WP_Widget
{
    public function __construct()
    {
        $widget_id = 'MyThemeProject_Theme_LastPosts';
        $widget_name = 'Theme Last Posts';
        $widget_options = [
            'classname'     => '',
            'description'   => 'Theme Last Posts in Footer, Sidebar'
        ];
        $widget_controls = [];
        parent::__construct($widget_id, $widget_name, $widget_options, $widget_controls);
    }

    // hien thi widget len front page
    // debug cung hien thi o widget trong admin : http://wordpress_project.test/wp-admin/widgets.php
    public function widget($args, $instance)
    {
        // echo '<pre>';
        // print_r($instance);

        if (!empty($instance['title'])) {
            $title = apply_filters('widget_title', $instance['title']);
        }
        $title          = (!empty($title)) ? $title : ''; 
        $category       = (!empty($instance['category'])) ? $instance['category'] : 0;
        $type           = (!empty($instance['type'])) ? $instance['type'] : 'only';
        $post_format    = (!empty($instance['post_format'])) ? $instance['post_format'] : 'standard';
        $show_type      = (!empty($instance['show_type'])) ? $instance['show_type'] : 'sidebar';
        $items          = (!empty($instance['items'])) ? $instance['items'] : 5;


        $query_args = [
            'post_type'             => 'post',
            'post_status'           => 'publish',
            'posts_per_page'        => $items,
            'orderby'               => 'ID',
            'order'                 => 'DESC',
            'ignore_sticky_posts'   => true,
        ];

        // xu ly category
        if ( $category != 0 ) {
            if ( $type == 'child' ) {
                $query_args['cat'] = [$category];   // category (and any children of that category)
            } else {
                $query_args['category__in'] = [$category];  // only category (not children)
            }
        }

        // xu ly Post Format (lien quan den Taxonomy => tax_query)
        if ($post_format != 'standard') {
            $tax_query = [
                [
                    // table terms (field + value-terms) => lay ra term_id
                    'field'         => 'slug',                          // Select taxonomy term by
                    'terms'         => 'post-format-'.$post_format,     // (int/string/array) – Taxonomy term(s).
                    
                    // table term_taxonomy (term_id o tren + taxonomy) => lay ra term_taxonomy_id
                    'taxonomy'      => 'post_format',

                    // voi term_taxonomy_id o tren => via table term_relationships 
                    //                                  => lay ra cac object_id (post_id)

                    'operator'      => 'IN'     // Operator to test. 
                    // Possible values are ‘IN’, ‘NOT IN’, ‘AND’, ‘EXISTS’ and ‘NOT EXISTS’. Default value is ‘IN’.
                ]
            ];

            $query_args['tax_query'] = $tax_query;
        }
        
        $wp_query = new WP_Query($query_args);

        // display widget ra Front
        // echo $args['before_widget'];
        // if (!empty($title)) {
        //     echo $args['before_title'] . ucwords($title) . $args['after_title'];
        // }

        // xu ly vi tri hien thi widget $show_type
        switch ($show_type) {
            case 'sidebar'          :   if (file_exists(THEME_WIDGETS_DIRECTORY . '/views/latest_post_sidebar.php')) {
                                            require THEME_WIDGETS_DIRECTORY . '/views/latest_post_sidebar.php';
                                        }; 
                                        break;

            case 'latest_news'      :   if (file_exists(THEME_WIDGETS_DIRECTORY . '/views/latest_news.php')) {
                                            require THEME_WIDGETS_DIRECTORY . '/views/latest_news.php';
                                        }; 
                                        break;

            case 'lastest_gal'      :   if (file_exists(THEME_WIDGETS_DIRECTORY . '/views/latest_galleries.php')) {
                                            require THEME_WIDGETS_DIRECTORY . '/views/latest_galleries.php';
                                        }; 
                                        break;                        
        }
    
        // echo $args['after_widget'];
        
    }

    // hien thi widget trong trang admin
    public function form( $instance )
    {
        $fields = $this->getFields_Labels();

        // form for fields in 'getFields_Labels'
        foreach ($fields as $field => $label) {
            $input_value = @$instance[$field];
            $this->getInputElement($field, $label, $input_value);
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
            if ( $field == 'items') {
                $instance[$field]   = ( !empty($new_instance[$field]) && intval($new_instance[$field]) > 0 ) 
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
        return ['title'             => 'Title',
                'category'          => 'Categories', 
                'type'              => 'Show Post in category', 
                'post_format'       => 'Post Format',
                'show_type'         => 'Show Type',
                'items'             => 'Items',
            ];
    }

    public function getInputElement(string $field, $label, $input_value) : void
    {
        $field_id = $this->get_field_id($field);
        $field_name = $this->get_field_name($field);
        $input_label = ucfirst($label);

        if ( $field == 'title' || $field == 'items' ) {
            $type = ($field == 'title') ? 'text' : 'number';
            echo "
            <p>
                <label for='$field_id'> " . translate($input_label) . " </label>
                <input type='$type' id='$field_id' name='$field_name' 
                            value='$input_value' class='widefat' 
                            placeholder='' >
            </p>      
            ";
        }

        if ( $field == 'category' ) {
            $this->showCategoryElement($field_id, $field_name, $input_value, $input_label);
        }

        if ( $field == 'type' ) {
            $options = [
                'only'  => 'Only category',
                'child' => 'Include child'
            ];
            $this->selectbox($field_id, $field_name, $input_value, $input_label, $options);
        }

        if ( $field == 'post_format' ) {
            $theme_post_formats = get_theme_support('post-formats');
            // debug($theme_post_formats);
            /*  Array
                    (
                        [0] => Array
                            (
                                [0] => gallery
                                [1] => audio
                                [2] => video
                            )

                    )
            */
            $options = ['standard' => 'Standard'];

            if (count($theme_post_formats[0]) > 0) {
                foreach ($theme_post_formats[0] as $format) {
                    $options[$format] = ucfirst($format);
                }
            }
            $this->selectbox($field_id, $field_name, $input_value, $input_label, $options);
        }
        
        if ( $field == 'show_type' ) {
            $options = [
				'sidebar' 			=> 'Sidebar',
				'latest_news' 		=> 'Latest News',
				'lastest_gal' 	    => 'Latest Galleries',
            ];
            $this->selectbox($field_id, $field_name, $input_value, $input_label, $options);
        }
    }

    // tao dropdown category
    public function showCategoryElement($field_id, $field_name, $input_value, $input_label)
    {
        $args = [
            'show_option_all'   => translate('All Categories'), // Text to display for showing all categories.
            // 'show_option_none'  => 'No categories found',    // Text to display for showing no categories
            'orderby'           => 'name',  // ID (default), .... See get_terms() for a list of accepted values.
            'order'             => 'ASC',
            'show_count'        => 1,                       // Whether to include post counts
            'hide_empty'        => 1,
            'child_of'          => 0,
            'exclude'           => '',
            'echo'              => 0,                       // Whether to echo or return the generated markup.
                                                            // Neu de 1, roi ta echo, thi se la echo 2 lan.
            'selected'          => $input_value,                    
            'hierarchical'      => 0,                       // Whether to traverse the taxonomy hierarchy
            'name'              => $field_name,
            'id'                => $field_id,
            'class'             => 'widefat',
            'depth'             => 0,                       // 0 : tat ca moi do sau. 1: parent, ...
            'tab_index'         => 0,
            'taxonomy'          => 'category',
            'hide_if_empty'     => false,
            'option_none_value' => -1,                      // Value to use when no category is selected.
            'value_field'       => 'term_id',
            'required'          => false,
            'aria_describedby'  => '',
    
        ];
        echo "
        <p>
            <label for='$field_id'> " . translate($input_label) . " </label>"
            // ham tao html cho Category
            . wp_dropdown_categories($args) .
        "</p>";
    }

    // Tao select element
    public function selectbox($field_id, $field_name, $input_value, $input_label, $options)
    {
        $optionsHtml = '';
        foreach ($options as $key => $item) {
            $selected = ($key == $input_value) ? 'selected' : '';
            $optionsHtml .= "<option value='$key' $selected> $item </option>";
        }

        echo "
        <p>
            <label for='$field_id'> " . translate($input_label) . " </label>
            <select id='$field_id' name='$field_name' class='widefat' > 
                $optionsHtml        
            </select>
        </p>      
        ";
    }


    // get the image url inside the post's content
    public function getImageUrl($post_content)
    {
        $pattern = '/<img.*?src=[\'"](.*?)[\'"].*?\/>/i';        /* '|<img.*?src=[\'"](.*?)[\'"].*?>|i'  */

        if (!empty($post_content)) {
            preg_match_all( $pattern, $post_content, $matches );
        }
        // return $matches;
        if ( !empty($matches[1][0]) ) return $matches[1][0];
        
        return 'http://wordpress_project.test/wp-content/uploads/2023/11/shutterstock_111362132-620x350-1.jpg';
                // image mac dinh
    }

    // resize lai image
    // https://developer.wordpress.org/reference/functions/wp_get_image_editor/
    private function get_new_img_url($imgUrl, $width = 0, $heigt = 0 ,	$suffixes = '-mythemeproject-slider-')
    {
		$suffixes = $suffixes . $width . 'x'. $heigt;
	
		//Lay ten tap tin hinh anh hien tai
		preg_match("/[^\/|\\\]+$/", $imgUrl, $currentName);
		$currentName = $currentName[0];
	
		//Tạo tên mới cho hình ảnh dựa trên tên cũ
		$tmpFileName = explode('.', $currentName);
		$newFileName = $tmpFileName[0] . $suffixes . '.' . $tmpFileName[1];
	
		//Chuyển từ đường dẫn URL sang PATH
		$tmp 	= explode('/wp-content/', $imgUrl);
		$imgDir = ABSPATH.'wp-content/' . $tmp[1];
	
		$newImgDir = str_replace($currentName, $newFileName, $imgDir);
		// echo '<br>' . $newImgDir;

		if(!file_exists($newImgDir)){			
			$wpImageEditor =  wp_get_image_editor( $imgDir);    // dua file goc vao editor duoi ten file trung gian
			if ( ! is_wp_error( $wpImageEditor ) ) {
				$wpImageEditor->resize($width, $heigt, array('center','center'));   // resize file trung gian
				$wpImageEditor->save( $newImgDir);              // luu lai duoi ten file newImage (path = newImgDir)
			}
		}
        
        $newImgUrl= str_replace($currentName, $newFileName, $imgUrl);
        return $newImgUrl;
	}

    // get the excerpt
    public function getExcerpt($post_excerpt = '', $charNum = 40)
    {
        if (!empty($post_excerpt)) {
            if (strlen($post_excerpt) > ($charNum + 10)) {
                $end_word = strpos($post_excerpt, ' ', $charNum);
                if (!empty($end_word)) return substr($post_excerpt, 0, $end_word) . '...';
            }
            else return $post_excerpt;            
        }
        return ' ...';
    }
}


