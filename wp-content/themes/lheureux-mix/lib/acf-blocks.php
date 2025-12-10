<?php

// == Register ACF blocks
function heureux_mix_register_acf_block_types()
{
    register_block_type(__DIR__ . '/blocks/link-to-post');
}
add_action('init', 'heureux_mix_register_acf_block_types');
