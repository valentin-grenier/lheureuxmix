<?php

// == Autoload composer packages
if (file_exists(__DIR__ . "/vendor/autoload.php")) {
    require_once __DIR__ . "/vendor/autoload.php";
}

// == Theme assets
require_once get_template_directory() . "/lib/theme-assets.php";

// == Block bindings
require_once get_template_directory() . "/lib/block-bindings.php";

// == Block variations
require_once get_template_directory() . "/lib/block-variations.php";

// == Post type admin columns
require_once get_template_directory() . "/lib/post-type-admin-columns.php";

// == Contact Form 7
require_once get_template_directory() . "/lib/contact-form-7.php";

// == ACF Blocks
require_once get_template_directory() . "/lib/acf-blocks.php";

// == Loader
require_once get_template_directory() . "/lib/loader.php";

// == Modal for old domain name users
require_once get_template_directory() . "/lib/modal.php";

// == Scroll to top
require_once get_template_directory() . "/lib/scroll-to-top.php";
