<?php

/**
 * Custom admin login header logo
 */
function blangko_change_login_logo()
{
    $filename = 'login-logo.png';
    $templateDirectory = get_template_directory();
    $path = "{$templateDirectory}/{$filename}";

    if (!file_exists($path)) {
        return;
    }

    echo '<style type="text/css">' .
        'h1 a { background-image:url(' . $path . ') !important; }' .
        '</style>';
}
