<?php

class MyThemeProject_Theme_Text extends WP_Widget
{
    public function __construct()
    {
        $widget_id = 'MyThemeProject_Theme_Text';
        $widget_name = 'Theme Text';
        $widget_options = [
            'classname'     => 'widget_text',
            'description'   => 'Add Text for My Theme Project'
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
        $title  = (!empty($title)) ? $title : '';
        $text   = (!empty($instance['text'])) ? $instance['text'] : '';

        // hien thi ket qua
        echo $args['before_widget'];
        if (!empty($title)) {
            echo $args['before_title'] . ucfirst($title) . $args['after_title'];
        }
        echo "<div class='textwidget'>$text</div>";
        echo $args['after_widget'];
    }

    // hien thi widget trong trang admin
    public function form( $instance )
    {
        $field = 'title';
        $field_id = $this->get_field_id($field);
        $field_name = $this->get_field_name($field);
        $input_label = ucfirst($field);
        $input_value = @$instance[$field];

        echo "
        <p>
            <label for='$field_id'> " . translate($input_label) . " </label>
            <input type='text' id='$field_id' name='$field_name' 
                        value='$input_value' class='widefat' >
        </p>      
        ";

        // text area
        $field = 'text';
        $field_id = $this->get_field_id($field);
        $field_name = $this->get_field_name($field);
        $input_label = ucfirst($field);
        $input_value = @$instance[$field];

        echo "
        <p>
            <label for='$field_id'> " . translate($input_label) . " </label>
            <textarea id='$field_id' name='$field_name' rows='6' class='widefat'> $input_value </textarea>
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
        $instance['title']  = htmlspecialchars(strip_tags($new_instance['title']));
        $instance['text']   = sanitize_textarea_field($new_instance['text']);

        return $instance;
    }
}

