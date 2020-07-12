<?php

function blangko_add_site_owner_role()
{
    if (get_option('custom_roles_version') < 1) {
        $capabilities = get_role('administrator')->capabilities;

        $incapabilities = [
            'activate_plugins' => 1,
            'delete_plugins' => 1,
            'install_plugins' => 1,
            'update_plugins' => 1,
            'update_core' => 1,
            'edit_theme_options' => 1,
            'install_themes' => 1,
            'delete_themes' => 1,
            'customize' => 1
        ];

        $capabilities = array_diff_key(
            $capabilities,
            $incapabilities
        );

        add_role('site_owner', 'Site Owner', $capabilities);
        update_option('custom_roles_version', 1);
    }
}
