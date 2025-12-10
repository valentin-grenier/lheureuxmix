<?php

// == Replace Contact Form 7 default select placeholder
function heureux_mix_wpcf7_form_elements($html)
{
    $text = '--';
    $html = str_replace('<option value="">--</option>', '<option disabled selected hidden>' . $text . '</option>', $html);
    return $html;
}
add_filter('wpcf7_form_elements', 'heureux_mix_wpcf7_form_elements');

// == Load Recaptcha script only on contact page
function heureux_mix_dequeue_recaptcha_script()
{
    if (!is_page('contact')) {
        wp_dequeue_script('google-recaptcha');
        wp_deregister_script('google-recaptcha');
        add_filter('wpcf7_load_js', '__return_false');
        add_filter('wpcf7_load_css', '__return_false');
    }
}
add_action('wp_enqueue_scripts', 'heureux_mix_dequeue_recaptcha_script', 99999);
