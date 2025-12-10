<?php

# Render modal on body open
function heureux_mix_render_modal()
{
    if (isset($_COOKIE['hm-modal']) || is_admin()) {
        return;
    }
?>
    <div class="hm-modal">
        <div class="hm-modal__container">
            <div class="hm-modal__title">
                <span>Blue Lagoon DJ devient</span>
                <img src="<?php echo get_template_directory_uri() . '/assets/img/logo-lheureux-mix-inline.svg'; ?>" alt="L'Heureux Mix">
            </div>

            <div class="hm-modal__content">
                <p>Nous avons une petite nouveauté à vous annoncer : Blue Lagoon DJ devient L'Heureux Mix. Ce changement de nom est le reflet de notre évolution, mais rassurez-vous, nous sommes toujours là pour vous offrir des prestations musicales de qualité !</p>
            </div>

            <div class="hm-modal__close wp-block-button is-style-secondary">
                <span class="wp-block-button__link wp-element-button">
                    Découvrir L'Heureux Mix
                </span>
            </div>
        </div>
    </div>
<?php
}
//add_action('wp_body_open', 'heureux_mix_render_modal');
