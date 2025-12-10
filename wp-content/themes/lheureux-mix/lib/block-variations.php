<?php

// == Block variation handlers
function studio_register_blocks_variations()
{
    wp_enqueue_script(
        "register-variations",
        get_template_directory_uri() . "/assets/js/register-block-variations.js",
        ['wp-blocks', 'wp-dom-ready'],
        "1.0",
        true
    );

    wp_enqueue_script(
        "unregister-styles",
        get_template_directory_uri() . "/assets/js/unregister-block-styles.js",
        ['wp-blocks', 'wp-dom-ready', 'wp-edit-post'],
        "1.0",
        true
    );

    wp_enqueue_script(
        "block-editor-validations",
        get_template_directory_uri() . "/assets/js/block-editor-validations.js",
        ['wp-blocks', 'wp-dom-ready', 'wp-edit-post'],
        "1.0",
        true
    );
}
add_action("enqueue_block_editor_assets", "studio_register_blocks_variations");

// == Query Loop Block Variations
function heureux_mix_related_posts_query($query)
{
    $query['post_type']           = 'post';
    $query['posts_per_page']      = 3;
    $query['post__not_in']        = array(get_the_ID());
    $query['offset']              = 0;
    $query['ignore_sticky_posts'] = 1;
    $query['orderby']             = 'date';
    $query['order']               = 'DESC';

    // == Remove the filter after it is applied to avoid repeated application
    remove_filter('query_loop_block_query_vars', 'heureux_mix_related_posts_query', 10, 1);

    return $query;
}

add_filter(
    'pre_render_block',
    function ($prerender, $block) {
        if ($block['attrs'] && array_key_exists('namespace', $block['attrs']) && $block['attrs']['namespace'] === 'heureux-mix/related-posts') {
            add_filter('query_loop_block_query_vars', 'heureux_mix_related_posts_query');
        }
    },
    1,
    2
);
