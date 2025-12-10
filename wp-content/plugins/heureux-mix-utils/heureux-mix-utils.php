<?php

/**
 * Plugin Name: Heureux Mix Utils
 * Author: Valentin Grenier • Studio Val
 * Description: Utilitaires pour le site de L'Heureux Mix
 */

if (! defined('ABSPATH')) {
    exit;
}

// == Enqueue scripts and styles ==
function hmu_admin_enqueue_assets($admin_page)
{
    if ('toplevel_page_heureux-mix-utils' !== $admin_page) {
        return;
    }

    $asset_file = plugin_dir_path(__FILE__) . 'build/index.asset.php';
    if (! file_exists($asset_file)) {
        return;
    }
    $asset = include $asset_file;

    wp_enqueue_script(
        'hmu-scripts',
        plugins_url('build/index.js', __FILE__),
        $asset['dependencies'],
        $asset['version'],
        array('in_footer' => true)
    );

    wp_enqueue_style(
        'hmu-style',
        plugins_url('build/index.css', __FILE__),
        array_filter(
            $asset['dependencies'],
            function ($style) {
                return wp_style_is($style, 'registered');
            }
        ),
        $asset['version'],
    );
}
add_action('admin_enqueue_scripts', 'hmu_admin_enqueue_assets');

// == Enqueue stylesheet on front-end
function hmu_enqueue_assets()
{
    wp_enqueue_style(
        'hmu-style',
        plugins_url('build/index.css', __FILE__),
        array(),
        '1.0.0'
    );
}
add_action('wp_enqueue_scripts', 'hmu_enqueue_assets');

// == Add a custom menu page ==
function hmu_add_menu_page()
{
    add_menu_page(
        __('Utils', 'heureux-mix-utils'),
        __('Utils', 'heureux-mix-utils'),
        'manage_options',
        'heureux-mix-utils',
        'hmu_settings_page',
        'dashicons-admin-generic',
        60
    );
}
add_action('admin_menu', 'hmu_add_menu_page');

// == Settings content wrap ==
function hmu_settings_page()
{
    echo '<div class="wrap" id="heureux-mix-utils">' . __('Loading', 'heureux-mix') . '...</div>';
}

// == Register Plugin Settings ==
function hmu_settings()
{
    $default = array(
        'show'     => false,
        'title'  => '',
        'hours' => '',
        'tel' => '',
    );

    $schema  = array(
        'type' => 'object',
        'properties' => array(
            'show'  => array(
                'type' => 'boolean',
            ),
            'title'  => array(
                'type' => 'string',
            ),
            'hours' => array(
                'type' => 'string',
            ),
            'tel' => array(
                'type' => 'string',
            ),
        ),
    );

    register_setting(
        'options',
        'heureux_mix_utils',
        array(
            'type'         => 'object',
            'default'      => $default,
            'show_in_rest' => array(
                'schema' => $schema,
            ),
        )
    );
}
add_action('rest_api_init', 'hmu_settings');

// == Render popup on front-end
function hmu_render_popup()
{
    $hmu_options = get_option('heureux_mix_utils');
    $show = $hmu_options['show'] ?? false;
    $title = $hmu_options['title'] ?? '';
    $hours = $hmu_options['hours'] ?? '';
    $tel = $hmu_options['tel'] ?? '';
    $formatted_tel = '';

    if ($tel !== "") {
        // == Add blank space every two characters ==
        $formatted_tel = preg_replace('/(\d{2})(?=\d)/', '$1 ', $tel);
    }

    if (!$show) {
        return;
    }

    $tag_open = '<div class="hm-popup">';
    $tag_close = '</div>';

    echo $tag_open;
    echo '<span class="hm-popup__title">' . $title . '</span>';
    echo '<span class="hm-popup__hours">' . $hours . '</span>';
    echo '<a class="hm-popup__tel" href="tel:' . $tel . '">' . $formatted_tel . '</a>';
    echo $tag_close;
}
add_action('wp_body_open', 'hmu_render_popup');
