<?php

// == Custom meta bindings
add_action('init', 'heureux_mix_register_metas_custom');
function heureux_mix_register_metas_custom()
{
    // == Meta Service: Title
    register_block_bindings_source(
        'service/title',
        array(
            'label' => 'Titre',
            'get_value_callback' => 'heureux_mix_callback_meta_title'
        )
    );

    // == Meta Service: Introduction short
    register_block_bindings_source(
        'service/introduction-short',
        array(
            'label' => 'Introduction courte',
            'get_value_callback' => 'heureux_mix_callback_meta_introduction_short'
        )
    );

    // == Meta Service: Introduction long
    register_block_bindings_source(
        'service/introduction-long',
        array(
            'label' => 'Introduction longue',
            'get_value_callback' => 'heureux_mix_callback_meta_introduction_long'
        )
    );

    // == Meta Service: Details
    register_block_bindings_source(
        'service/details',
        array(
            'label' => 'Details',
            'get_value_callback' => 'heureux_mix_callback_meta_details'
        )
    );
}

// == Service Title callback
function heureux_mix_callback_meta_title($source_args)
{
    $service_title = get_the_title();

    return $service_title;
}

// == Service Introduction callbacks
function heureux_mix_callback_meta_introduction_short($source_args)
{
    if (!function_exists('get_field')) return;

    $service_introduction_short = get_field('hm_introduction_short');

    return $service_introduction_short;
}

function heureux_mix_callback_meta_introduction_long($source_args)
{
    if (!function_exists('get_field')) return;

    $service_introduction_long = get_field('hm_introduction_long');

    return $service_introduction_long;
}

// == Service Details callback
function heureux_mix_callback_meta_details($source_args)
{
    if (!function_exists('get_field')) return;

    $service_details = get_field('hm_prestations_text');

    return $service_details;
}
