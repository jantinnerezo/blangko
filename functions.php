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
require get_template_directory() . '/inc/blangko-custom-role.php';
require get_template_directory() . '/inc/blangko-custom-login-logo.php';
require get_template_directory() . '/inc/blangko-tinymce-tailwind.php';

function setup_blangko_post_types()
{
	foreach (register_blangko_post_types() as $post_type) {
		register_post_type($post_type['name'], $post_type['options']);
	}
}

/**
 * Remove unnecessary admin menu item
 */
function blangko_remove_admin_menu()
{
	remove_menu_page('edit.php');
	remove_menu_page('edit.php?post_type=post');
	remove_menu_page('edit.php?post_type=page');
	remove_menu_page('edit-comments.php');
}


// Hooking up our function to theme setup
add_action('login_head', 'change_login_logo');
add_action('init', 'setup_blangko_post_types');
add_action('init', 'blangko_add_site_owner_role');
add_action('admin_menu', 'blangko_remove_admin_menu');

/**
 * Register custom sluggable fields if ACF plugin is activated
 */
if (in_array(
	'advanced-custom-fields/acf.php',
	apply_filters('active_plugins', get_option('active_plugins'))
)) {
	add_action('acf/save_post', 'blangko_acf_save_sluggable_fields');
}
