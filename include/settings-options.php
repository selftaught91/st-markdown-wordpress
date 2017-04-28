<?php

function st_markdown_settings(){
    st_markdown_register_all_settings();
    st_markdown_all_sections();
    st_markdown_all_fields();

}



function st_markdown_register_all_settings(){
    register_setting(
        'st_markdown_general_settings_group',
        'st_markdown_general_settings_theme_name'
    );
    register_setting(
        'st_markdown_general_settings_group',
        'st_markdown_general_settings_is_markdown_active'
    );

}
function st_markdown_all_sections(){
    add_settings_section(
        'st_markdown_general_settting_section1',
        'ST Markdown General Settings',
        'st_markdown_general_settings_section1_callback',
        'st_markdown_main_menu_slug'
    );

}
function st_markdown_general_settings_section1_callback(){
}

function st_markdown_all_fields(){
    add_settings_field(
        'st_markdown_field_is_markdown_active',
        'Markdown Active',
        'st_markdown_field_is_markdown_active_callback',
        'st_markdown_main_menu_slug',
        'st_markdown_general_settting_section1'
    );
    add_settings_field(
        'st_markdown_field_theme_name',
        'Code Highlight Type',
        'st_markdown_field_theme_name_callback',
        'st_markdown_main_menu_slug',
        'st_markdown_general_settting_section1'
    );
    
}
//function related to field
function st_markdown_field_theme_name_callback(){
    $themesList = array(
        'Android Studio'=>'androidstudio',
        'Dracular'       =>'dracula',
        'GitHub'         =>'github'
    );
    $theme_name = get_option('st_markdown_general_settings_theme_name');
    foreach($themesList as $key=>$value){
        $flag="";
        if($value==$theme_name){
            $flag='checked';
        }
        echo "<div style='padding:5px 0px'><input type='radio' name='st_markdown_general_settings_theme_name' {$flag} value='{$value}'>{$key}</div>";
    }
    
}
function st_markdown_field_is_markdown_active_callback(){
    $isActive = get_option('st_markdown_general_settings_is_markdown_active');
    $flag="";
    if($isActive==1){
        $flag='checked';
    }
    echo "<input type='checkbox' name='st_markdown_general_settings_is_markdown_active' {$flag} value='1'>";
}
