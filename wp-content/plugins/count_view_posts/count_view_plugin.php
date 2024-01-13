<?php

/*
Plugin Name: Posts Count View
Plugin URI: http://wordpress.org/plugins/count-view-posts/
Description: Customized plugin for counting the views of a post 
Author: Trong Hung VU	
Version: 1.0
Author URI: http://wordpress_project.test/
*/

define('MYHOOK_MP_PLUGIN_URL', plugin_dir_url(__FILE__));
define('MYHOOK_MP_PLUGIN_DIR', plugin_dir_path(__FILE__));

define('MYHOOK_MP_POSTS_DIR', MYHOOK_MP_PLUGIN_DIR . 'posts/');

define('MYHOOK_MP_CSS_URL', MYHOOK_MP_PLUGIN_URL . 'css/');

// debug the values
function debug($val) {
    echo '<pre>';
    print_r($val);
    echo '</pre>';
    die;
}

// show the values
function show($val) {
    echo "<h2> $val </h2>";
}


// activate the count_views plugin
if (file_exists(MYHOOK_MP_POSTS_DIR . 'count_view.php')) {
    require_once MYHOOK_MP_POSTS_DIR . 'count_view.php';
    if (class_exists('WPProject_Posts_Count_Views')) {
        new WPProject_Posts_Count_Views();
    }
}