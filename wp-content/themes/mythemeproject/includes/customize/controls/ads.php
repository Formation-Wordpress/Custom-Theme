<?php

class MyThemeProject_Theme_Customize_Ads
{
    private $theme_mods;

    public function __construct($theme_mods = [])
    {
        $this->theme_mods = $theme_mods;

        // register section in Admin
        add_action('customize_register', [$this, 'customize_register']);

        // gan css vao header cua Front page
        add_action('wp_head', [$this, 'add_css']);

        // gan js de thay doi noi dung DOM vao footer cua Front page
        add_action('wp_footer', [$this, 'add_js']);

        // gan js vao preview customize trong admin
        add_action('customize_preview_init', [$this, 'live_preview']);
    }

    // ham register section cho Customize. Chi hoat dong trong Admin
    public function customize_register($wp_customize)
    {
        // Section's definition
        $section_id = 'MyThemeProject_Theme_Ads';
        $wp_customize->add_section($section_id, [
            'title'                 => __('Ads Banner','wordpress_project'), 
            'description'           => __('All Ads banners of the theme', 'wordpress_project'),
            'priority'              => 21,
            'capability'            => 'edit_theme_options',
        ]);

        // all Elements of this Section
        $elements = [
            'top_banner'            => true,
            'content_banner'        => true,
            'footer_banner'         => true,
            'post_banner'           => true,
            'bottom_post_banner'    => true,
        ];

        // execute the creation of the Elements
        foreach ($elements as $element => $value) {
            if ($value) {
                $this->$element($wp_customize, $section_id);
            }
        }
    }

    public function add_js()
    {
        // cac gia tri theme_mod cua Ads
        $theme_mod = isset($this->theme_mods['MyThemeProject_Theme_Ads']) ? $this->theme_mods['MyThemeProject_Theme_Ads'] : [];
    
        echo "\n" . '<script type="text/javascript" defer="defer">' . "\n";

        // Top banner Image
        if (isset($theme_mod['top_banner'])) {
            if (!empty($theme_mod['top_banner'])) {
                // thay the ' bang \'
                $theme_mod['top_banner'] = str_replace("'", "\'", $theme_mod['top_banner']);
                echo "document.querySelector('.header-ad img').setAttribute('src', '".$theme_mod['top_banner']."');\n";
            }
        }

        // Top banner image Link
        if (isset($theme_mod['top_banner_link'])) {
            // xoa khoang trang
            $theme_mod['top_banner_link'] = trim($theme_mod['top_banner_link']);

            if (!empty($theme_mod['top_banner_link'])) {
                // thay the " bang \' boi vi the href hay su dung ""
                $theme_mod['top_banner_link'] = str_replace('"', "'", $theme_mod['top_banner_link']);
                echo 'document.querySelector(".header-ad a").setAttribute("href", "'.$theme_mod['top_banner_link'].'");'."\n";
            }
        }


        // Content banner Image
        if (isset($theme_mod['content_banner'])) {
            if (!empty($theme_mod['content_banner'])) {
                // thay the ' bang \'
                $theme_mod['content_banner'] = str_replace("'", "\'", $theme_mod['content_banner']);
                echo "document.querySelector('.home-bottom-ad img').setAttribute('src', '".$theme_mod['content_banner']."');\n";
            }
        }

        // Content banner image Link
        if (isset($theme_mod['content_banner_link'])) {
            // xoa khoang trang
            $theme_mod['content_banner_link'] = trim($theme_mod['content_banner_link']);

            if (!empty($theme_mod['content_banner_link'])) {
                // thay the " bang \' boi vi the href hay su dung ""
                $theme_mod['content_banner_link'] = str_replace('"', "'", $theme_mod['content_banner_link']);
                echo 'document.querySelector(".home-bottom-ad a").setAttribute("href", "'.$theme_mod['content_banner_link'].'");'."\n";
            }
        }


        // Footer banner Image
        if (isset($theme_mod['footer_banner'])) {
            if (!empty($theme_mod['footer_banner'])) {
                // thay the ' bang \'
                $theme_mod['footer_banner'] = str_replace("'", "\'", $theme_mod['footer_banner']);
                echo "document.querySelector('.widget_text img').setAttribute('src', '".$theme_mod['footer_banner']."');\n";
            }
        }

        // Footer banner image Link
        if (isset($theme_mod['footer_banner_link'])) {
            // xoa khoang trang
            $theme_mod['footer_banner_link'] = trim($theme_mod['footer_banner_link']);

            if (!empty($theme_mod['footer_banner_link'])) {
                // thay the " bang \' boi vi the href hay su dung ""
                $theme_mod['footer_banner_link'] = str_replace('"', "'", $theme_mod['footer_banner_link']);
                echo 'document.querySelector(".widget_text a").setAttribute("href", "'.$theme_mod['footer_banner_link'].'");'."\n";
            }
        }

        // Top Ads banner Image in Post
        if (isset($theme_mod['post_banner'])) {
            if (!empty($theme_mod['post_banner'])) {
                // thay the ' bang \'
                $theme_mod['post_banner'] = str_replace("'", "\'", $theme_mod['post_banner']);
                echo "document.querySelector('.post-top-ad img').setAttribute('src', '".$theme_mod['post_banner']."');\n";
            }
        }

        // Top Ads banner Image Link in Post
        if (isset($theme_mod['post_banner_link'])) {
            // xoa khoang trang
            $theme_mod['post_banner_link'] = trim($theme_mod['post_banner_link']);

            if (!empty($theme_mod['post_banner_link'])) {
                // thay the " bang \' boi vi the href hay su dung ""
                $theme_mod['post_banner_link'] = str_replace('"', "'", $theme_mod['post_banner_link']);
                echo 'document.querySelector(".post-top-ad a").setAttribute("href", "'.$theme_mod['post_banner_link'].'");'."\n";
            }
        }

            // Bottom Ads banner Image in Post
            if (isset($theme_mod['bottom_post_banner'])) {
                if (!empty($theme_mod['bottom_post_banner'])) {
                    // thay the ' bang \'
                    $theme_mod['bottom_post_banner'] = str_replace("'", "\'", $theme_mod['bottom_post_banner']);
                    echo "document.querySelector('.post-bottom-ad img').setAttribute('src', '".$theme_mod['bottom_post_banner']."');\n";
                }
            }
    
            // Bottom Ads banner Image Link in Post
            if (isset($theme_mod['bottom_post_banner_link'])) {
                // xoa khoang trang
                $theme_mod['bottom_post_banner_link'] = trim($theme_mod['bottom_post_banner_link']);
    
                if (!empty($theme_mod['bottom_post_banner_link'])) {
                    // thay the " bang \' boi vi the href hay su dung ""
                    $theme_mod['bottom_post_banner_link'] = str_replace('"', "'", $theme_mod['bottom_post_banner_link']);
                    echo 'document.querySelector(".post-bottom-ad a").setAttribute("href", "'.$theme_mod['bottom_post_banner_link'].'");'."\n";
                }
            }

        echo '</script>' . "\n";
    }

    // css cua Front page trong Admin
    public function add_css()
    {

    }

    // js cua preview
    public function live_preview()
    {
        wp_enqueue_script('MyThemeProject_Theme_Customize_Ads', 
                            THEME_INCLUDES_JS_URL.'/ads_preview.js',        // path URL
                                ['customize-preview'], '1.0',
                                ['strategy'=>'defer', 'in_footer'=>true]);
    }

    public function top_banner($wp_customize, $section_id)
    {
        // Top banner Image
        $inputName = 'top_banner';
        $setting_id = $section_id .'['.$inputName.']';
        $wp_customize->add_setting($setting_id, [
            'default'               => THEME_IMAGES_DIRECTORY_URL. '/ad-620x80.png',                  
            'type'                  => 'theme_mod',         
            'capability'            => 'edit_theme_options', 
            'transport'             => 'postMessage',
        ]);

        $control_id = $section_id.'_'.$inputName;
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, $control_id, [
            'label'             => __('Top Banner Image','wordpress_project'),
            'section'           => $section_id,
            'settings'          => $setting_id,
        ]));

        // Top banner Image Link
        $inputName = 'top_banner_link';
        $setting_id = $section_id .'['.$inputName.']';
        $wp_customize->add_setting($setting_id, [
            'default'               => '#',                  
            'type'                  => 'theme_mod',         
            'capability'            => 'edit_theme_options', 
            'transport'             => 'postMessage',
        ]);

        $control_id = $section_id.'_'.$inputName;
        $wp_customize->add_control($control_id, [
            'label'             => __('Top banner Image Link','wordpress_project'),
            'section'           => $section_id,
            'settings'          => $setting_id,
            'type'              => 'textarea',
        ]);
    }


    public function content_banner($wp_customize, $section_id)
    {
        // Top banner Image
        $inputName = 'content_banner';
        $setting_id = $section_id .'['.$inputName.']';
        $wp_customize->add_setting($setting_id, [
            'default'               => THEME_IMAGES_DIRECTORY_URL. '/ad-620x80.png',                  
            'type'                  => 'theme_mod',         
            'capability'            => 'edit_theme_options', 
            'transport'             => 'postMessage',
        ]);

        $control_id = $section_id.'_'.$inputName;
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, $control_id, [
            'label'             => __('Content Banner Image','wordpress_project'),
            'section'           => $section_id,
            'settings'          => $setting_id,
        ]));

        // Top banner Image Link
        $inputName = 'content_banner_link';
        $setting_id = $section_id .'['.$inputName.']';
        $wp_customize->add_setting($setting_id, [
            'default'               => '#',                  
            'type'                  => 'theme_mod',         
            'capability'            => 'edit_theme_options', 
            'transport'             => 'postMessage',
        ]);

        $control_id = $section_id.'_'.$inputName;
        $wp_customize->add_control($control_id, [
            'label'             => __('Content banner Image Link','wordpress_project'),
            'section'           => $section_id,
            'settings'          => $setting_id,
            'type'              => 'textarea',
        ]);
    }


    public function footer_banner($wp_customize, $section_id)
    {
        // Top banner Image
        $inputName = 'footer_banner';
        $setting_id = $section_id .'['.$inputName.']';
        $wp_customize->add_setting($setting_id, [
            'default'               => THEME_DIRECTORY_URL. '/files/uploads/2014/09/total-theme.png',                  
            'type'                  => 'theme_mod',         
            'capability'            => 'edit_theme_options', 
            'transport'             => 'postMessage',
        ]);

        $control_id = $section_id.'_'.$inputName;
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, $control_id, [
            'label'             => __('Footer Banner Image','wordpress_project'),
            'section'           => $section_id,
            'settings'          => $setting_id,
        ]));

        // Top banner Image Link
        $inputName = 'footer_banner_link';
        $setting_id = $section_id .'['.$inputName.']';
        $wp_customize->add_setting($setting_id, [
            'default'               => '#',                  
            'type'                  => 'theme_mod',         
            'capability'            => 'edit_theme_options', 
            'transport'             => 'postMessage',
        ]);

        $control_id = $section_id.'_'.$inputName;
        $wp_customize->add_control($control_id, [
            'label'             => __('Footer banner Image Link','wordpress_project'),
            'section'           => $section_id,
            'settings'          => $setting_id,
            'type'              => 'textarea',
        ]);
    }

    public function post_banner($wp_customize, $section_id)
    {
        // Banner Image
        $inputName = 'post_banner';
        $setting_id = $section_id .'['.$inputName.']';
        $wp_customize->add_setting($setting_id, [
            'default'               => '',                  
            'type'                  => 'theme_mod',         
            'capability'            => 'edit_theme_options', 
            'transport'             => 'postMessage',
        ]);

        $control_id = $section_id.'_'.$inputName;
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, $control_id, [
            'label'             => __('Top Banner Image in Post','wordpress_project'),
            'section'           => $section_id,
            'settings'          => $setting_id,
        ]));

        // Banner Image Link
        $inputName = 'post_banner_link';
        $setting_id = $section_id .'['.$inputName.']';
        $wp_customize->add_setting($setting_id, [
            'default'               => '#',                  
            'type'                  => 'theme_mod',         
            'capability'            => 'edit_theme_options', 
            'transport'             => 'postMessage',
        ]);

        $control_id = $section_id.'_'.$inputName;
        $wp_customize->add_control($control_id, [
            'label'             => __('Top Banner Image Link in Post','wordpress_project'),
            'section'           => $section_id,
            'settings'          => $setting_id,
            'type'              => 'textarea',
        ]);
    }

    public function bottom_post_banner($wp_customize, $section_id)
    {
        // Banner Image
        $inputName = 'bottom_post_banner';
        $setting_id = $section_id .'['.$inputName.']';
        $wp_customize->add_setting($setting_id, [
            'default'               => '',                  
            'type'                  => 'theme_mod',         
            'capability'            => 'edit_theme_options', 
            'transport'             => 'postMessage',
        ]);

        $control_id = $section_id.'_'.$inputName;
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, $control_id, [
            'label'             => __('Bottom Banner Image in Post','wordpress_project'),
            'section'           => $section_id,
            'settings'          => $setting_id,
        ]));

        // Banner Image Link
        $inputName = 'bottom_post_banner_link';
        $setting_id = $section_id .'['.$inputName.']';
        $wp_customize->add_setting($setting_id, [
            'default'               => '#',                  
            'type'                  => 'theme_mod',         
            'capability'            => 'edit_theme_options', 
            'transport'             => 'postMessage',
        ]);

        $control_id = $section_id.'_'.$inputName;
        $wp_customize->add_control($control_id, [
            'label'             => __('Bottom Banner Image Link in Post','wordpress_project'),
            'section'           => $section_id,
            'settings'          => $setting_id,
            'type'              => 'textarea',
        ]);
    }

}






