<?php

class MyThemeProject_Theme_Customize_General
{
    private $theme_mods;

    public function __construct($theme_mods = [])
    {
        add_action('customize_register', [$this, 'customize_register']);
        $this->theme_mods = $theme_mods;

        // echo '<pre>';
        // print_r($this->theme_mods);

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
        $section_id = 'MyThemeProject_Theme_General';
        $wp_customize->add_section($section_id, [
            'title'                 => __('General','wordpress_project'), 
            'description'           => __('More parameters of the theme', 'wordpress_project'),
            'priority'              => 20,      // default: 160
            'capability'            => 'edit_theme_options',
        ]);

        // all Elements of this Section
        $elements = [
            'date_time'         => true,
            'search_form'       => true,
            'theme_logo'        => true,
            'theme_description' => true,
            'description_color' => true,
            'copyright'         => true,
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
        // cac gia tri theme_mod cua General
        $theme_mod = isset($this->theme_mods['MyThemeProject_Theme_General']) ? $this->theme_mods['MyThemeProject_Theme_General'] : [];

        echo "\n" . '<script type="text/javascript" defer="defer">' . "\n";

        // Logo
        if (isset($theme_mod['theme_logo'])) {
            // thay the ' bang \' de ko bi anh huong boi quotes trong '$content'
            $theme_mod['theme_logo'] = str_replace("'", "\'", $theme_mod['theme_logo']);
            echo "document.querySelector('.site-text-logo').innerHTML ='". $theme_mod['theme_logo'] ."';\n";
        }

        // Theme description
        if (isset($theme_mod['theme_description'])) {
            $theme_mod['theme_description'] = str_replace("'", "\'", $theme_mod['theme_description']);
            echo "document.querySelector('#blog-description').innerHTML ='". $theme_mod['theme_description'] ."';\n";
        }

        // Copyright
        if (isset($theme_mod['copyright'])) {
            $theme_mod['copyright'] = str_replace("'", "\'", $theme_mod['copyright']);
            echo "document.querySelector('#copyright').innerHTML ='". $theme_mod['copyright'] ."';\n";
        }

        echo '</script>' . "\n";
    }

    // css cua Front page trong Admin
    public function add_css()
    {
        // cac gia tri theme_mod cua General
        $theme_mod = isset($this->theme_mods['MyThemeProject_Theme_General']) ? $this->theme_mods['MyThemeProject_Theme_General'] : [];

        /********************** Section style css *******************************************/

        $display = '<style type="text/css">';

        // Selectbox date_time
        if (isset($theme_mod['date_time']) && $theme_mod['date_time'] == 'no') {
            $display .= ' #topbar-date{ display: none; } ';
        }

        // Selectbox search_form
        if (isset($theme_mod['search_form']) && $theme_mod['search_form'] == 'no') {
            $display .= ' #topbar-search{ display: none; } ';
        }

        // Select Color
        if (!empty($theme_mod['description_color'])) {
            $display .= ' #blog-description{ color: '.$theme_mod['description_color'].'; } ';
        }

        $display .= '</style>';
        
        echo $display;
    }

    // js cua preview
    public function live_preview()
    {
        // echo 'js of preview';
        wp_enqueue_script('MyThemeProject_Theme_Customize_General', 
                            THEME_INCLUDES_JS_URL.'/general_preview.js',        // path URL
                                ['customize-preview'], '1.0', 
                                ['strategy'=>'defer', 'in_footer'=>true]);
    }

    public function date_time($wp_customize, $section_id)
    {
        $inputName = 'date_time';
        $setting_id = $section_id .'['.$inputName.']';
        $wp_customize->add_setting($setting_id, [
            'default'               => 'yes',                  
            'type'                  => 'theme_mod',         
            'capability'            => 'edit_theme_options', 
            'transport'             => 'postMessage',
        ]);

        // Gan phan tu setting vao trong section
        $control_id = $section_id.'_'.$inputName;
        $wp_customize->add_control($control_id, [
            'label'             => __('Show Date Time','wordpress_project'),
            'section'           => $section_id,
            'settings'          => $setting_id,
            'type'              => 'select',
            'choices'           => [
                'yes'     => 'Yes',
                'no'      => 'No',
            ]
        ]);
    }

    public function search_form($wp_customize, $section_id)
    {
        $inputName = 'search_form';
        $setting_id = $section_id .'['.$inputName.']';
        $wp_customize->add_setting($setting_id, [
            'default'               => 'yes',
            'type'                  => 'theme_mod',         
            'capability'            => 'edit_theme_options', 
            'transport'             => 'postMessage',           
        ]);

        // Gan phan tu setting vao trong section
        $control_id = $section_id.'_'.$inputName;
        $wp_customize->add_control($control_id, [
            'label'             => __('Show Top Search Form','wordpress_project'),
            'section'           => $section_id,
            'settings'          => $setting_id,
            'type'              => 'select',
            'choices'           => [
                'yes'     => 'Yes',
                'no'      => 'No',
            ]
        ]);
    }

    public function theme_logo($wp_customize, $section_id)
    {
        $inputName = 'theme_logo';
        $setting_id = $section_id .'['.$inputName.']';
        $wp_customize->add_setting($setting_id, [
            'default'               => '<a href="#" title="Spartan" rel="home">Spartan</a>',                  
            'type'                  => 'theme_mod',        
            'capability'            => 'edit_theme_options', 
            'transport'             => 'postMessage',           
        ]);

        // Gan phan tu setting vao trong section
        $control_id = $section_id.'_'.$inputName;
        $wp_customize->add_control($control_id, [
            'label'             => __('Theme Logo','wordpress_project'),
            'section'           => $section_id,
            'settings'          => $setting_id,
            'type'              => 'textarea',
        ]);
    }

    public function theme_description($wp_customize, $section_id)
    {
        $inputName = 'theme_description';
        $setting_id = $section_id .'['.$inputName.']';
        $wp_customize->add_setting($setting_id, [
            'default'               => "Edit your subheading via the theme customizer. <br> It looks much better when it's 2 lines long.",                  
            'type'                  => 'theme_mod',        
            'capability'            => 'edit_theme_options', 
            'transport'             => 'postMessage',           
        ]);

        // Gan phan tu setting vao trong section
        $control_id = $section_id.'_'.$inputName;
        $wp_customize->add_control($control_id, [
            'label'             => __('Theme Description','wordpress_project'),
            'section'           => $section_id,
            'settings'          => $setting_id,
            'type'              => 'textarea',
        ]);
    }

    public function description_color($wp_customize, $section_id)
    {
        $inputName = 'description_color';
        $setting_id = $section_id .'['.$inputName.']';
        $wp_customize->add_setting($setting_id, [
            'default'               => '#878787',                      
            'type'                  => 'theme_mod',         
            'capability'            => 'edit_theme_options', 
            'transport'             => 'postMessage',
        ]);

        // Gan phan tu setting vao trong section
        $control_id = $section_id.'_'.$inputName;
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, $control_id, [
            'label'             => __('Theme description text color','wordpress_project'),
            'section'           => $section_id,
            'settings'          => $setting_id,
        ]));
    }

    public function copyright($wp_customize, $section_id)
    {
        $inputName = 'copyright';
        $setting_id = $section_id .'['.$inputName.']';
        $wp_customize->add_setting($setting_id, [
            'default'               => "Copyright 2014 Spartan",                  
            'type'                  => 'theme_mod',        
            'capability'            => 'edit_theme_options', 
            'transport'             => 'postMessage',           
        ]);

        // Gan phan tu setting vao trong section
        $control_id = $section_id.'_'.$inputName;
        $wp_customize->add_control($control_id, [
            'label'             => __('Theme Copyright','wordpress_project'),
            'section'           => $section_id,
            'settings'          => $setting_id,
            'type'              => 'text',
        ]);
    }
}






