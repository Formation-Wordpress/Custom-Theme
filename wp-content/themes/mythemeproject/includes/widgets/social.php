<?php

class MyThemeProject_Theme_Social extends WP_Widget
{
    public function __construct()
    {
        $widget_id = 'MyThemeProject_Theme_Social';
        $widget_name = 'Theme Social Links';
        $widget_options = [
            'classname'     => 'widget_wpex_social_widget',
            'description'   => 'Social Links of My Theme Project'
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
        $title = (!empty($title)) ? $title : 'LETS GET SOCIAL';

        // hien thi ket qua
        echo $args['before_widget'];

        if (!empty($title)) {
            echo $args['before_title'] . $title . $args['after_title'];
        }

        require THEME_WIDGETS_DIRECTORY . '/views/socialHtml.php';  
        // ko dung require_once neu nhu ta phai goi nhieu lan widget vao cac area khac nhau

        echo $args['after_widget'];
    }

    // hien thi widget trong trang admin
    public function form( $instance )
    {
        $fields = ['title', 'content', 'twitter', 'facebook', 'google', 'dribbble', 'rss'];

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
        
        // new value : loc cac html tags
        $instance['title']      = htmlspecialchars(strip_tags($new_instance['title']));
        $instance['content']    = sanitize_textarea_field($new_instance['content']);
        $instance['twitter']    = esc_url(strip_tags($new_instance['twitter']));
        $instance['facebook']   = esc_url(strip_tags($new_instance['facebook']));
        $instance['google']     = esc_url(strip_tags($new_instance['google']));
        $instance['dribbble']   = esc_url(strip_tags($new_instance['dribbble']));
        $instance['rss']        = esc_url(strip_tags($new_instance['rss']));
            
        return $instance;
    }

    public function getLabel(string $field) : string
    {
        $labelArray = [
            'title'     => 'Title',
            'content'   => 'Content',
            'twitter'   => 'Twitter link',
            'facebook'  => 'Facebook link',
            'google'    => 'Google Plus link',
            'dribbble'  => 'dribbble link',
            'rss'       => 'RSS link'
        ];
        return (!empty($labelArray[$field])) ? $labelArray[$field] : 'Title';
    }

    public function getInputElement(string $field, $input_value) : void
    {
        $field_id = $this->get_field_id($field);
        $field_name = $this->get_field_name($field);
        $input_label = ucfirst($this->getLabel($field));

        echo "
        <p>
            <label for='$field_id'> " . translate($input_label) . " </label>
            <input type='text' id='$field_id' name='$field_name' 
                        value='$input_value' class='widefat' 
                        placeholder='' >
        </p>      
        ";
    }
}

