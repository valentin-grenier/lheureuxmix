<?php

// == Enqueue stylesheets and scripts
function studio_enqueue_styles()
{
    // == CSS
    wp_enqueue_style("studio-styles-main", get_template_directory_uri() . "/assets/css/main.css");

    // == JS
    wp_enqueue_script("studio-cf7", get_template_directory_uri() . "/assets/js/contact-form-7.js");
    wp_enqueue_script("studio-modal", get_template_directory_uri() . "/assets/js/modal.js");
    wp_enqueue_script("studio-scroll-to-top", get_template_directory_uri() . "/assets/js/scroll-to-top.js");

    if (is_front_page()) {
        wp_enqueue_script('heureux-mix-loader', get_template_directory_uri() . '/assets/js/loader.js', array(), '1.0', true);
    }
}
add_action("wp_enqueue_scripts", "studio_enqueue_styles");

// == Enqueue block editor stylesheets
function studio_enqueue_block_editor_styles()
{
    // == CSS
    wp_enqueue_style("studio-styles-editor", get_template_directory_uri() . "/assets/css/editor.css");
}
add_action("enqueue_block_assets", "studio_enqueue_block_editor_styles");

// == Remove block suggestions
remove_action("enqueue_block_editor_assets", "wp_enqueue_editor_block_directory_assets");

// == Remove default block patterns
remove_theme_support("core-block-patterns");

// == Remove WordPress auto-redirect
remove_action('template_redirect', 'redirect_canonical');
