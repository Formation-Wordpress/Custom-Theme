<?php

class MyThemeProject_Theme_Widgets_Main
{
    private $widget_options_name = 'MyThemeProject_Theme_Widgets';
    private $widget_options = [];

    private $widget_options_default = [
            'searchForm'        => true,
            'social'            => true,
            'posts_tabs'        => true,
            'tags'              => true,
            'sliders'           => true,
            'text'              => true,
            'last_post'         => true,
    ];

    public function __construct()
    {
        $this->widget_options = get_option($this->widget_options_name, $this->widget_options_default);

        foreach ( $this->widget_options as $widget => $value) {
            if ($value) {
                add_action('widgets_init', [$this, $widget]);
            }
        }
    }

    public function searchForm()
    {
        require_once THEME_WIDGETS_DIRECTORY . '/searchForm.php';
        if (class_exists('MyThemeProject_Theme_SearchForm')) {
            register_widget('MyThemeProject_Theme_SearchForm');
        }
        
    }

    public function social()
    {
        require_once THEME_WIDGETS_DIRECTORY . '/social.php';
        if (class_exists('MyThemeProject_Theme_Social')) {
            register_widget('MyThemeProject_Theme_Social');
        }
        
    }

    public function posts_tabs()
    {
        require_once THEME_WIDGETS_DIRECTORY . '/posts-tabs.php';
        if (class_exists('MyThemeProject_Theme_Posts_Tabs')) {
            register_widget('MyThemeProject_Theme_Posts_Tabs');
        }
        
    }

    public function tags()
    {
        require_once THEME_WIDGETS_DIRECTORY . '/tags.php';
        if (class_exists('MyThemeProject_Theme_Tags')) {
            register_widget('MyThemeProject_Theme_Tags');
        }
        
    }

    public function sliders()
    {
        require_once THEME_WIDGETS_DIRECTORY . '/sliders.php';
        if (class_exists('MyThemeProject_Theme_Sliders')) {
            register_widget('MyThemeProject_Theme_Sliders');
        }
        
    }

    public function text()
    {
        require_once THEME_WIDGETS_DIRECTORY . '/text.php';
        if (class_exists('MyThemeProject_Theme_Text')) {
            register_widget('MyThemeProject_Theme_Text');
        }
        
    }

    public function last_post()
    {
        require_once THEME_WIDGETS_DIRECTORY . '/last_post.php';
        if (class_exists('MyThemeProject_Theme_LastPosts')) {
            register_widget('MyThemeProject_Theme_LastPosts');
        }
        
    }
}