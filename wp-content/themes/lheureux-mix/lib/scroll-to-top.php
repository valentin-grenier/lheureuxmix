<?php

# Render scroll to top button
function heureux_mix_scroll_to_top()
{
    $angle_up_icon = file_get_contents(get_template_directory() . '/assets/img/angle-up.svg');

    echo '<button class="hm-scroll-to-top">' . $angle_up_icon . '</button>';
}
add_action('wp_footer', 'heureux_mix_scroll_to_top');
