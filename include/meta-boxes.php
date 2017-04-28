<?php

function st_markdown_metabox_general(){
    add_meta_box(
        'st_markdown_metabox_is_markdown_id',
        'ST Markdown Post Settings',
        'st_markdown_metabox_general_callback',
        'post',
        'side',
        'default'
    );
}

function st_markdown_metabox_general_callback($post){
    wp_nonce_field(
        'st_markdown_save_data_isMarkdownPost',
        'st_markdown_save_data_isMarkdown_nonce'
    );

    $isMarkdownPost = get_post_meta($post->ID,'_st_markdown_metabox_field_isMarkdown',true);
    $checked = "";
    if($isMarkdownPost==1){
        $checked='checked';
    }

    echo  "<label for='st_markdown_isMarkdown_active_label'>Is Markdown Post </label>";
    echo "<input type='checkbox' id='st_markdown_isMarkdown_active_label' name='st_markdown_isMarkdown_active_label' {$checked} value='1'>";
}
function st_markdown_save_data_isMarkdownPost($post_id){
    //chceking if the nonce is set or not 
    if(!isset($_POST['st_markdown_save_data_isMarkdown_nonce'])){
        return;
    }
    if(!wp_verify_nonce($_POST['st_markdown_save_data_isMarkdown_nonce'],'st_markdown_save_data_isMarkdownPost')){
        return;
    }
    if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE){
        return;
    }
    if(!current_user_can('edit_post',$post_id)){
        return;
    }
    if(!isset($_POST['st_markdown_isMarkdown_active_label'])){
        return;
    }
    $data = sanitize_text_field($_POST['st_markdown_isMarkdown_active_label']);

    update_post_meta($post_id,_st_markdown_metabox_field_isMarkdown,$data);
}






