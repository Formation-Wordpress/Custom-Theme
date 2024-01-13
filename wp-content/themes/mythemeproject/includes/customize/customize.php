<?php

// $theme_mod = get_theme_mod('MyThemeProject_Theme_General', array());
// echo '<pre>';
// print_r($theme_mod);

// $categories = get_categories();
// echo '<pre>';
// print_r($categories);

class MyThemeProject_Theme_Customize
{
    // code ban dau, dc su dung de hoc customize control

    public function __construct()
    {
        add_action('customize_register', [$this, 'customize_register']);
    }

    public function customize_register($wp_customize)
    {
        // echo '<pre>';
        // print_r($wp_customize);
        
        // tao ra 1 section de chua cac phan tu
        $section_id = 'MyThemeProject_Theme_General';
        $wp_customize->add_section($section_id, [
            'title'                 => __('General','wordpress_project'), 
            'description'           => __('Setup the parameters of the theme', 'wordpress_project'),
            'priority'              => 20,      // default: 160
            'capability'            => 'edit_theme_options',
            // 'panel'                 => '', 
            // 'theme_supports'        => '', 
            // 'type'                  => '',
            // 'active_callback'       => '',
            'description_hidden'    => false,   // true la se hien thi o icon help
        ]);

        /*************************************************************************
         * Input Selectbox Multi
        *************************************************************************/
        // Tao ra 1 phan tu
        $inputName = 'category_listbox';
        $setting_id = $section_id .'['.$inputName.']';
        $wp_customize->add_setting($setting_id, [
            'default'               => '0',                  
            'type'                  => 'theme_mod',         // or 'option',
            'capability'            => 'edit_theme_options', 
            'transport'             => 'postMessage',       // or 'refresh',
        ]);

        // Gan phan tu setting vao trong section
        $control_id = $section_id.'_'.$inputName;
        $wp_customize->add_control(new WP_Customize_Category_List_Control($wp_customize, $control_id, [
            'label'             => __('My Categories','wordpress_project'),
            'section'           => $section_id,
            'settings'          => $setting_id,
            'description'       => 'Select the category',
            'multiple'          => true,
            'size'              => 5
        ]));


        /*************************************************************************
         * Input Category Dropdown
        *************************************************************************/
        // get all categories
        $categories = get_categories();
        $catData = ['0' => '--Select--'];
        if (count($categories) > 0) {
            foreach ($categories as $category) {
                $catData[$category->cat_ID] = $category->name;
            }
        }
        // Tao ra 1 phan tu
        $inputName = 'dropdown_select_Category';
        $setting_id = $section_id .'['.$inputName.']';
        $wp_customize->add_setting($setting_id, [
            'default'               => '0',                  
            'type'                  => 'theme_mod',         // or 'option',
            'capability'            => 'edit_theme_options', 
            'transport'             => 'postMessage',       // or 'refresh',
        ]);

        // Gan phan tu setting vao trong section
        $control_id = $section_id.'_'.$inputName;
        $wp_customize->add_control($control_id, [
            'label'             => __('Select Category','wordpress_project'),
            'section'           => $section_id,
            'settings'          => $setting_id,
            'description'       => 'Select the category',
            'type'              => 'select',
            'choices'           => $catData,
        ]);


        /*************************************************************************
         * Input Page Dropdown
        *************************************************************************/
        // Tao ra 1 phan tu
        $inputName = 'dropdown_select_page';
        $setting_id = $section_id .'['.$inputName.']';
        $wp_customize->add_setting($setting_id, [
            'default'               => '0',                  
            'type'                  => 'theme_mod',         // or 'option',
            'capability'            => 'edit_theme_options', 
            'transport'             => 'postMessage',       // or 'refresh',
        ]);

        // Gan phan tu setting vao trong section
        $control_id = $section_id.'_'.$inputName;
        $wp_customize->add_control($control_id, [
            'label'             => __('Pages','wordpress_project'),
            'section'           => $section_id,
            'settings'          => $setting_id,
            'type'              => 'dropdown-pages',
        ]);


        /*************************************************************************
         * Input TEXTAREA
        *************************************************************************/
        // Tao ra 1 phan tu
        $inputName = 'textarea_content';
        $setting_id = $section_id .'['.$inputName.']';
        $wp_customize->add_setting($setting_id, [
            'default'               => '',                  
            'type'                  => 'theme_mod',         // or 'option',
            'capability'            => 'edit_theme_options', 
            'transport'             => 'refresh',           // (default) or 'postMessage',
        ]);

        // Gan phan tu setting vao trong section
        $control_id = $section_id.'_'.$inputName;
        $wp_customize->add_control($control_id, [
            'label'             => __('Content','wordpress_project'),
            'section'           => $section_id,
            'settings'          => $setting_id,
            'type'              => 'textarea',
        ]);


        /*************************************************************************
         * Input SELECT (giong voi Radio)
        *************************************************************************/
        // Tao ra 1 phan tu
        $inputName = 'select_sexe';
        $setting_id = $section_id .'['.$inputName.']';
        $wp_customize->add_setting($setting_id, [
            'default'               => '0',                  
            'type'                  => 'theme_mod',         // or 'option',
            'capability'            => 'edit_theme_options', 
            'transport'             => 'refresh',           // (default) or 'postMessage',
        ]);

        // Gan phan tu setting vao trong section
        $control_id = $section_id.'_'.$inputName;
        $wp_customize->add_control($control_id, [
            'label'             => __('Select Sexe','wordpress_project'),
            'section'           => $section_id,
            'settings'          => $setting_id,
            'type'              => 'select',
            'choices'           => [
                '0'         => '--Select--',
                'male'      => 'Homme',
                'female'    => 'Femme',
                'unknown'   => 'Unknown',
            ]
        ]);


        /*************************************************************************
         * Input COLOR
        *************************************************************************/
        // Tao ra 1 phan tu
        $inputName = 'color';
        $setting_id = $section_id .'['.$inputName.']';
        $wp_customize->add_setting($setting_id, [
            'default'               => '#eaeaea',           // default color             
            'type'                  => 'theme_mod',         // or 'option',
            'capability'            => 'edit_theme_options', 
            'transport'             => 'refresh',           // (default) or 'postMessage',
        ]);

        // Gan phan tu setting vao trong section
        $control_id = $section_id.'_'.$inputName;
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, $control_id, [
            'label'             => __('Choose the color','wordpress_project'),
            'section'           => $section_id,
            'settings'          => $setting_id,
        ]));


        /*************************************************************************
         * Input Image Upload
        *************************************************************************/
        // Tao ra 1 phan tu
        $inputName = 'image_upload';
        $setting_id = $section_id .'['.$inputName.']';
        $wp_customize->add_setting($setting_id, [
            'default'               => '',                  // ta co the de default image vao day              
            'type'                  => 'theme_mod',         // or 'option',
            'capability'            => 'edit_theme_options', 
            'transport'             => 'refresh',           // (default) or 'postMessage',
        ]);

        // Gan phan tu setting vao trong section
        $control_id = $section_id.'_'.$inputName;
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, $control_id, [
            'label'             => __('Upload Image','wordpress_project'),
            'section'           => $section_id,
            'settings'          => $setting_id,
        ]));


        /*************************************************************************
         * Input File Upload
        *************************************************************************/
        // Tao ra 1 phan tu
        $inputName = 'file_upload';
        $setting_id = $section_id .'['.$inputName.']';
        $wp_customize->add_setting($setting_id, [
            // 'default'               => '',                
            'type'                  => 'theme_mod',         // or 'option',
            'capability'            => 'edit_theme_options', 
            'transport'             => 'refresh',           // (default) or 'postMessage',
        ]);

        // Gan phan tu setting vao trong section
        $control_id = $section_id.'_'.$inputName;
        $wp_customize->add_control(new WP_Customize_Upload_Control($wp_customize, $control_id, [
            'label'             => __('Upload File','wordpress_project'),
            'section'           => $section_id,
            'settings'          => $setting_id,
        ]));


        /*************************************************************************
         * Input CHECKBOX
        *************************************************************************/
        // Tao ra 1 phan tu
        $inputName = 'show_description';
        $setting_id = $section_id .'['.$inputName.']';
        $wp_customize->add_setting($setting_id, [
            // 'default'               => '',                  
            'type'                  => 'theme_mod',         // or 'option',
            'capability'            => 'edit_theme_options', 
            'transport'             => 'refresh',           // (default) or 'postMessage',
        ]);

        // Gan phan tu setting vao trong section
        $control_id = $section_id.'_'.$inputName;
        $wp_customize->add_control($control_id, [
            'label'             => __('Show the theme description ?','wordpress_project'),
            'section'           => $section_id,
            'settings'          => $setting_id,
            'type'              => 'checkbox',
        ]);


        /*************************************************************************
         * Input RADIO
        *************************************************************************/
        // Tao ra 1 phan tu
        $inputName = 'sexe';
        $setting_id = $section_id .'['.$inputName.']';
        $wp_customize->add_setting($setting_id, [
            'default'               => 'male',              // selected radio value
            'type'                  => 'theme_mod',         // or 'option',
            'capability'            => 'edit_theme_options', 
            'transport'             => 'refresh',           // (default) or 'postMessage',
        ]);

        // Gan phan tu setting vao trong section
        $control_id = $section_id.'_'.$inputName;
        $wp_customize->add_control($control_id, [
            'label'             => __('Sexe','wordpress_project'),
            'section'           => $section_id,
            'settings'          => $setting_id,
            'type'              => 'radio',
            'choices'           => [
                'male'      => 'Homme',
                'female'    => 'Femme',
                'unknown'   => 'Unknown'    
            ],
        ]);


        /*************************************************************************
         * Input TEXT : site name
        *************************************************************************/
        // Tao ra 1 phan tu
        $inputName = 'site_name';
        $setting_id = $section_id .'['.$inputName.']';
        $wp_customize->add_setting($setting_id, [
            'default'               => 'My Theme Project',
            'type'                  => 'theme_mod',         // or 'option',
            'capability'            => 'edit_theme_options', 
            // 'theme_supports      => rarely used,
            'transport'             => 'refresh',           // (default) or 'postMessage',
            'sanitize_callback'     => [$this, 'sanitize_callback'],
            'sanitize_js_callback'  => '',
        ]);

        // Gan phan tu setting vao trong section
        $control_id = $section_id.'_'.$inputName;
        $wp_customize->add_control($control_id, [
            'label'             => __('Site name','wordpress_project'),
            'section'           => $section_id,
            'settings'          => $setting_id,
            'type'              => 'text',
        ]);
    }

    // exemple: neu nhu gia tri ko co thi value se la 'Spartan'
    public function sanitize_callback($value)
    {
        $value = trim($value);
        if (empty($value)) $value = 'Spartan';
        return $value;
    }
}
