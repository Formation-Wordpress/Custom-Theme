<?php

class MyThemeProject_Theme_Customize_Cat_Color
{
    private $theme_mods = [];
    private $categories = [];

    public function __construct($theme_mods = [])
    {
        $this->theme_mods = $theme_mods;

        // register section in Admin
        add_action('customize_register', [$this, 'customize_register']);

        // tao the style co id <=> 1 DOM => de javascript viet code vao bang append
        add_action('wp_head', [$this, 'add_style']);

        // gan js vao preview customize trong admin
        add_action('customize_preview_init', [$this, 'live_preview']);

        // $categories = get_categories( ['parent' => 0, 'hide_empty' => false] ); // tra ve array voi nhieu infos
        // $categories = get_terms( ['taxonomy' => 'category', 'parent' => 0, 'hide_empty' => false] ); // ket qua tuong tu, nhung infos it hon nhieu
        // echo '<pre>';
        // print_r($categories);

        // css cua Front page
        add_action('wp_head', [$this, 'add_css']);
    }

    // ham register section cho Customize. Chi hoat dong trong Admin
    public function customize_register($wp_customize)
    {
        // Section's definition
        $section_id = 'MyThemeProject_Theme_Cat_Color';
        $wp_customize->add_section($section_id, [
            'title'                 => __('Category Color','wordpress_project'), 
            'description'           => __('Define the color of the categories', 'wordpress_project'),
            'priority'              => 22,
            'capability'            => 'edit_theme_options',
        ]);

        // lay category , top_level (0) va tinh luon ca catagory empty
        $this->categories = get_categories( ['parent' => 0, 'hide_empty' => false] );

        // voi moi Category thi ta tao ra 1 setting item
        if (count($this->categories) > 0) {
            foreach ($this->categories as $category) {
                if ($category->name != 'Uncategorized') {
                    $this->cat_color($wp_customize, $section_id, $category);
                }
            }
        }
    }

    // css cua Front page trong Admin
    public function add_css()
    {
        // cac gia tri theme_mod cua Ads
        $theme_mod = isset($this->theme_mods['MyThemeProject_Theme_Cat_Color']) ? $this->theme_mods['MyThemeProject_Theme_Cat_Color'] : [];
        // echo '<pre>';
        // print_r($theme_mod);

        if (count($theme_mod) > 0) {
            
            echo "\n" . '<style type="text/css" >' . "\n";
            
            foreach ($theme_mod as $category => $color) {
                echo "#site-navigation .bg_{$category}:after, .{$category}-bg { background-color: $color} \n";
            }

            echo '</style>' . "\n";
        }
    }

    // add <style> de javascript cua live preview ghi code css vao 
    public function add_style()
    {
        echo "\n" . '<style type="text/css" id="MyThemeProject_Theme_Cat_Color_style">'. "\n";
                    // code css se dc them vao bang javascript cua live_preview
        echo '</style>' . "\n";
    }

    // js cua preview. Ham nay chi chay khi thay doi gia tri trong Customize (Publish => activated)
    public function live_preview()
    {
        // gan js de thay doi noi dung DOM vao footer cua Front page
        add_action('wp_footer', [$this, 'jsMenu'], 99);

        // neu viet truc tiep code echo vao day, no se hien len dau tien TOP.
        // nhung js thi phai dc chay cuoi cung khi DOM da loaded
        // do vay ta su dung hook wp_footer voi priority la 99 la gan nhu cuoi cung
        // nhu vay thi js preview se chay cuoi cung (document ready)
    }

    public function jsMenu()
    {
        // echo __METHOD__;  // viet xuong bottom cua page

        echo "\n" . '<script type="text/javascript" >' . "\n";

        if (count($this->categories) > 0) {
            foreach ($this->categories as $category) {
                // echo '<pre>';
                echo "
                wp.customize('MyThemeProject_Theme_Cat_Color[cat_".$category->cat_ID."]', function(value){
                    value.bind(function(newValue){
                        let css = '#site-navigation .bg_cat_".$category->cat_ID.":after { background-color: ' + newValue + ' !important }';
                        document.querySelector('#MyThemeProject_Theme_Cat_Color_style').append(css);
                    });
                });
                \n";
            }
        }

        echo '</script>' . "\n";
    }

    public function cat_color($wp_customize, $section_id, $category)
    {
        $inputName = 'cat_'.$category->cat_ID;
        $setting_id = $section_id .'['.$inputName.']';
        $wp_customize->add_setting($setting_id, [
            'default'               => '#9e5a9e',         
            'type'                  => 'theme_mod',
            'capability'            => 'edit_theme_options',
            'transport'             => 'postMessage',
        ]);

        // Gan phan tu setting vao trong section
        $control_id = $section_id.'_'.$inputName;
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, $control_id, [
            'label'             => __(ucfirst($category->name),'wordpress_project'),
            'section'           => $section_id,
            'settings'          => $setting_id,
        ]));
    }

}






