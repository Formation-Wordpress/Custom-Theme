<?php

class MyThemeProject_Theme_Customize_Control
{
    private $theme_mods = [];

    public function __construct()
    {
        $this->theme_mods = get_theme_mods();
        // echo '<pre>';
        // print_r($this->theme_mods);

        $controls = [
            'general'       => true,
            'ads'           => true,
            'cat_color'     => true,
        ];

        foreach ($controls as $control => $value) {
            if ($value) {
                $this->$control();
            }
        }
    }

    public function general()
    {
        if (file_exists(THEME_INCLUDES_DIRECTORY.'/customize/controls/general.php')) {
            require THEME_INCLUDES_DIRECTORY.'/customize/controls/general.php';
            new MyThemeProject_Theme_Customize_General($this->theme_mods);
        }
    }

    public function ads()
    {
        if (file_exists(THEME_INCLUDES_DIRECTORY.'/customize/controls/ads.php')) {
            require THEME_INCLUDES_DIRECTORY.'/customize/controls/ads.php';
            new MyThemeProject_Theme_Customize_Ads($this->theme_mods);
        }
    }

    public function cat_color()
    {
        if (file_exists(THEME_INCLUDES_DIRECTORY.'/customize/controls/cat_color.php')) {
            require THEME_INCLUDES_DIRECTORY.'/customize/controls/cat_color.php';
            new MyThemeProject_Theme_Customize_Cat_Color($this->theme_mods);
        }
    }
}