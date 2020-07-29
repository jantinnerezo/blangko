<?php

/*
 * TinyMCE: Add Tailwind CSS style
 */
add_editor_style(get_stylesheet_directory_uri() . '/assets/dist/main.css');

/*
 * TinyMCE: Remove WP styles
 */
add_filter('mce_css', 'blangko_tinymce_remove_stylesheets');
function blangko_tinymce_remove_stylesheets($stylesheets)
{

    $stylesheets = explode(',', $stylesheets);

    foreach ($stylesheets as $key => $sheet) {

        if (!preg_match('/wp\-includes/', $sheet))
            continue;

        unset($stylesheets[$key]);
    }

    $stylesheets = implode(',', $stylesheets);

    return $stylesheets;
}

/*
 * TinyMCE: Remove the hardcoded 'lightgray' skin style
 */
add_filter('tiny_mce_before_init', 'blangko_reset_tinymce_skin');
function blangko_reset_tinymce_skin($init)
{
    $init['body_class'] = 'prose container';
    $init['init_instance_callback'] = ''
        . 'function(){'
        . '    jQuery("#content_ifr").contents().find("link[href*=\'content.min.css\']").remove();'
        . '}';

    return $init;
}
