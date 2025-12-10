<?php

function heureux_mix_loader()
{
    if (is_front_page() && !is_user_logged_in()) {
        # Render loader
        echo '<script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs" type="module"></script>';
        echo '<div id="hm-loader"><dotlottie-player src="https://lottie.host/0cbc3d8c-c6b3-43f0-8577-39611fc9cded/5T1OkuDoxo.lottie" background="transparent" speed="1" style="width: 300px; height: 300px" loop autoplay></dotlottie-player></div>';
    }
}
add_action('wp_footer', 'heureux_mix_loader');
