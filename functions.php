<?php

/**
 * blangko functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package blangko
 */

if (!defined('_S_VERSION')) {
	// Replace the version number of the theme on each release.
	define('_S_VERSION', '1.0.0');
}

require get_template_directory() . '/inc/blangko-post-types.php';

function setup_blangko_post_types()
{
	foreach (register_blangko_post_types() as $post_type) {
		register_post_type($post_type['name'], $post_type['options']);
	}
}

// Hooking up our function to theme setup
add_action('init', 'setup_blangko_post_types');


/**
 * Register custom sluggable fields if ACF plugin is activated
 */
if (in_array(
	'advanced-custom-fields/acf.php',
	apply_filters('active_plugins', get_option('active_plugins'))
)) {
	add_action('acf/save_post', 'blangko_acf_save_sluggable_fields');
}
