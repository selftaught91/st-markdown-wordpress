<?php
/*
 Plugin Name: ST-Markdown
 Version: 0.1
 */

global $wp_version;

//comparing the version

if(version_compare($wp_version,"4.7",">=")){
    //echo "compitable version";
}else{
    exit("The version of plugin needs wordpress version to be greater than 4.7");
}

require_once("vendor/erusev/parsedown/Parsedown.php");
$Parsedown = new Parsedown();
$st_plugin_url=trailingslashit(WP_PLUGIN_URL.'/'.dirname(plugin_basename(__FILE__)));


//Adding the required javascript files for

function st_markdown_add_scipts(){
    wp_enqueue_style('highl',plugin_dir_url(__FILE__).'bower_components/highlightjs/styles/androidstudio.css',null,null,'all');
 wp_enqueue_script("jquery");
  //wp_enqueue_script('showdown',plugin_dir_url(__FILE__).'bower_components/showdown/dist/showdown.js',["jquery"],null,false);
  wp_enqueue_script('highlight',plugin_dir_url(__FILE__).'bower_components/highlightjs/highlight.pack.min.js',["jquery"],null,false);
  wp_enqueue_script('st-markdown-main',plugin_dir_url(__FILE__).'js/st-markdown-main.js',["jquery"],null,false);

}
add_action("wp_enqueue_scripts","st_markdown_add_scipts");

//adding filter
function add_class_in_the_content($data){
    global $post;
    global $Parsedown;
    return $Parsedown->text($post->post_content);
}

add_filter('the_content','add_class_in_the_content');