<?php settings_errors(); ?>
<form method="post" action="options.php">
    <?php settings_fields('st_markdown_general_settings_group') ?>
    <?php do_settings_sections('st_markdown_main_menu_slug') ?>
    <?php submit_button(); ?>
</form>

