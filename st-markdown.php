<?php
/*
 Plugin Name: ST-Markdown
 Version: 0.1
 Plugin URI: www.selftuts.com
 Description: ST-Markdown helps to create your markdown in a easy user interface
 Author: SelfTuts

 */

global $wp_version;

//comparing the version

if(version_compare($wp_version,"4.7",">=")){
    //echo "compitable version";
}else{
    exit("The version of plugin needs wordpress version to be greater than 4.7");
}

$st_plugin_url=trailingslashit(WP_PLUGIN_URL.'/'.dirname(plugin_basename(__FILE__)));
//Including the markdown parser
require_once("vendor/erusev/parsedown/Parsedown.php");
require_once("include/add-menu.php");
require_once("include/add-scripts.php");
require_once("include/settings-options.php");
require_once("include/meta-boxes.php");



#add_action('admin_init','st_markdown_on_admin_init');
add_action('admin_menu','st_markdown_on_admin_menu');
add_action('add_meta_boxes','st_markdown_meta_boxes');
add_action('save_post','st_markdown_save_data_isMarkdownPost');
//applying the filter
add_filter('the_content','st_markdown_add_class_in_the_content');
add_action("wp_enqueue_scripts","st_markdown_add_scripts");


$Parsedown = new Parsedown();

function st_markdown_add_class_in_the_content($data){
    global $post;
    $isMarkdownActive = get_option('st_markdown_general_settings_is_markdown_active');
    $isPostSupportMarkdown=get_post_meta($post->ID,'_st_markdown_metabox_field_isMarkdown',true);
    if($isMarkdownActive!=1 || $isPostSupportMarkdown!=1){
        return $data;
    }
    global $Parsedown;
    return $Parsedown->text($post->post_content);
}


function st_markdown_on_admin_menu(){
    //calling function for adding main menu
    st_markdown_add_menu_page();
    
    st_markdown_settings();
}

function st_markdown_meta_boxes(){
    //checking if user has selected the markdown to be active of not it the settings
    $isMarkdownActive = get_option('st_markdown_general_settings_is_markdown_active');
    if($isMarkdownActive==1){
        st_markdown_metabox_general();
    }
}
