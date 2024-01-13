<?php

class MyThemeProject_Theme_Tags extends WP_Widget
{
    public function __construct()
    {
        $widget_id = 'MyThemeProject_Theme_Tags';
        $widget_name = 'Theme Post Tags';
        $widget_options = [
            'classname'     => 'widget_tag_cloud',
            'description'   => 'Post Tags of My Theme Project'
        ];
        $widget_controls = [];
        parent::__construct($widget_id, $widget_name, $widget_options, $widget_controls);
    }

    // hien thi widget len front page
    public function widget($args, $instance)
    {
        if (!empty($instance['title'])) {
            $title = apply_filters('widget_title', $instance['title']);
        }
        $title = (!empty($title)) ? $title : 'TAGS';

        $tags_items = (int)$instance['tags_items'] <= 0 ? 5 : (int)$instance['tags_items']; 
        
        // lay theo get_terms
        $tags_by_terms = get_terms([
            'taxonomy'  => 'post_tag',
            'orderby'   => 'count',
            'order'     => 'DESC',
            'number'    => $tags_items,
        ]);

        // lay theo get_tags
        $tags_by_getTags = get_tags([
            'orderby'   => 'count',
            'order'     => 'DESC',
            'number'    => $tags_items,
        ]);

        // echo '<pre>';
        // print_r($tags_by_getTags);       // ket qua nhu nhau
        

        // hien thi ket qua
        echo $args['before_widget'];

        if (!empty($title)) {
            echo $args['before_title'] . strtoupper($title) . $args['after_title'];
        }

        require_once THEME_WIDGETS_DIRECTORY . '/views/tags-html.php';

        echo $args['after_widget'];
    }

    // hien thi widget trong trang admin
    public function form( $instance )
    {
        $fields = ['title', 'tags_items'];

        foreach ($fields as $field) {
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
        
        // new value : loc cac html tags va xu ly integer
        $instance['title']          = htmlspecialchars(strip_tags($new_instance['title']));
        $instance['tags_items']     = (!empty($new_instance['tags_items']) && intval($new_instance['tags_items'])>0) 
                                        ? intval($new_instance['tags_items'])
                                        : 0;
            
        return $instance;
    }

    public function getFields_Labels()
    {
        return ['title'             => 'Title',
                'tags_items'        => 'Number of Tags Items'
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
}

