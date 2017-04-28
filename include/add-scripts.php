<?php


// This function will add all the scripts releted to the plugin
function st_markdown_add_scripts(){
    //TODO == Need to find the value saved in database for which style we need to use and then apply it
    $name_of_theme_file = get_option('st_markdown_general_settings_theme_name');
    if(empty($name_of_theme_file)){
        $name_of_theme_file='solarized-light';
    }
    wp_enqueue_style(
        'highl',
        plugin_dir_url(__FILE__).'../bower_components/highlightjs/styles/'.$name_of_theme_file.'.css',
        null,
        null,
        'all'
    );

    wp_enqueue_script("jquery");

    wp_enqueue_script(
        'highlight',
        plugin_dir_url(__FILE__).'../bower_components/highlightjs/highlight.pack.min.js',
        ["jquery"],
        null,
        false
    );
    wp_enqueue_script(
        'st-markdown-main',
        plugin_dir_url(__FILE__).'../js/st-markdown-main.js',
        ["jquery"],
        null,
        false
    );

}
