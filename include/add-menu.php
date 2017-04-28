<?php
function st_markdown_add_menu_page(){

    // creating a brand new menu
    add_menu_page(
        "ST-Markdown",
        "ST Markdown",
        "manage_options",
        "st_markdown_main_menu_slug",
        "st_markdown_add_menu_callback",
        "dashicons-image-filter",
        50
    );
    add_submenu_page(
        "st_markdown_main_menu_slug",
        "General Settings",
        "General",
        "manage_options",
        "st_markdown_general_submenu_slug",
        "st_markdown_general_submenu_callback"
    );

}


//this function helps us to add a new menu
function st_markdown_add_menu_callback(){

}

function st_markdown_general_submenu_callback(){
    require_once('templates/general-options-settings.php');
}

