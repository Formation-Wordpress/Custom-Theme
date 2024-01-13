<?php

class MyThemeProject_Theme_SearchForm extends WP_Widget
{
    public function __construct()
    {
        $widget_id = 'MyThemeProject_Theme_SearchForm';
        $widget_name = 'Theme Search Form';
        $widget_options = [
            'classname'     => 'widget_search',
            'description'   => 'Search Form of My Theme Project'
        ];
        $widget_controls = [
            
        ];
        parent::__construct($widget_id, $widget_name, $widget_options, $widget_controls);
    }

    // hien thi widget len front page
    public function widget($args, $instance)
    {
        if (!empty($instance['title'])) {
            $title = apply_filters('widget_title', $instance['title']);
        }
        $title = (!empty($title)) ? $title : ''; 

        // hien thi ket qua
        echo $args['before_widget'];

        if (!empty($title)) {
            echo $args['before_title'] . $title . $args['after_title'];
        }

        require_once THEME_WIDGETS_DIRECTORY . '/views/searchForm-front.php';

        echo $args['after_widget'];
    }

    // hien thi widget trong trang admin
    public function form( $instance )
    {
        // require_once THEME_WIDGETS_DIRECTORY . '/views/searchForm-admin.php';   // ko nen su dung

        // print_r($instance);     // Array ( [search] => Search )   ['search'] = value

        $field = 'title';
        $field_id = $this->get_field_id($field);
        $field_name = $this->get_field_name($field);
        $input_label = ucfirst($field);
        $input_value = @$instance[$field];

        echo "
        <p>
            <label for='$field_id'> " . translate($input_label) . " </label>
            <input type='text' id='$field_id' name='$field_name' 
                        value='$input_value' class='widefat' 
                        placeholder='Label to be displayed in Front Page ...' >
        </p>      
        ";
    }

    // ham xu ly khi nhan vao save widget trong trang admin
    // ham nay se luu gia tri vao database table wp_options
    public function update($new_instance, $old_instance)
    {
        // neu nhap du lieu la empty thi giu lai gia tri old. Important !!!
        $instance = $old_instance;
        
        // new value : loc cac html tags
        $instance['title'] = htmlspecialchars(strip_tags($new_instance['title']));    
            
        return $instance;
    }

}

