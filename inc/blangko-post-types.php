<?php

if (!function_exists('blangko_post_types')) {
    /**
     * Define your app's custom post types
     * Just remove the example array
     */
    function blangko_post_types(): array
    {
        return [
            [
                'name' => 'blogs',
                'plural_name' => 'Blogs',
                'singular_name' => 'Blog',
                'icon' => 'welcome-write-blog',
                'public' => false,  // Optional
                'show_in_rest' => false, // Optional
                'show_in_graphql' => false // Optional
            ]
        ];
    }
}

if (!function_exists('register_blangko_post_types')) {
    function register_blangko_post_types(): array
    {
        $slugify = new Slugify();
        $theme = wp_get_theme()->get('Template') . '-child';

        $registered_post_types = [];

        foreach (blangko_post_types() as $post_type) {
            $registered_post_types[] = [
                'name' => $post_type['name'],
                'options' => [
                    'labels' => [
                        'name' => __($post_type['plural_name']),
                        'singular_name' => __($post_type['singular_name']),
                        'menu_name'           => __($post_type['plural_name'], $theme),
                        'parent_item_colon'   => __('Parent ' . $post_type['singular_name'], $theme),
                        'all_items'           => __('All ' . $post_type['plural_name'], $theme),
                        'view_item'           => __('View ' . $post_type['singular_name'], $theme),
                        'add_new_item'        => __('Add New ' . $post_type['singular_name'], $theme),
                        'add_new'             => __('Add New', $theme),
                        'edit_item'           => __('Edit ' . $post_type['singular_name'], $theme),
                        'update_item'         => __('Update ' . $post_type['singular_name'], $theme),
                        // 'search_items'        => __('Search ' . $th, $theme),
                        'not_found'           => __('Not Found', $theme),
                        'not_found_in_trash'  => __('Not found in Trash', $theme)
                    ],
                    'supports' => array('revisions'),
                    'menu_icon' => "dashicons-{$post_type['icon']}",
                    'public' => $post_type['public'] ?? false,
                    'has_archive' => true,
                    'rewrite' => array('slug' => $slugify->slugify($post_type['name'])),
                    'show_in_rest' => $post_type['show_in_rest'] ?? false,
                    'show_ui' => true,
                    'show_in_graphql' => $post_type['show_in_graphql'] ?? false,
                    'graphql_single_name' => $post_type['singular_name'],
                    'graphql_plural_name' => $post_type['plural_name']
                ]
            ];
        }

        return $registered_post_types;
    }
}

if (!function_exists('blangko_acf_slug_fields')) {
    function blangko_acf_slugable_fields(): array
    {
        return [
            [
                'post_type' => 'blogs',
                'sluggable_field' => 'title'
            ]
        ];
    }
}

if (!function_exists('blangko_acf_save_sluggable_fields')) {
    function blangko_acf_save_sluggable_fields($post_id): void
    {
        $post_type = get_post_type($post_id);
        $post_field = null;

        foreach (blangko_acf_slugable_fields() as $field) {
            $post_field = $field['post_type'] === $post_type ? $field['sluggable_field'] : null;
        }

        $field = get_field($post_field, $post_id);
        $post_name = sanitize_title($field);

        $post = array(
            'ID' => $post_id,
            'post_name' => $post_name,
            'post_title' => $field
        );

        wp_update_post($post);
    }
}
