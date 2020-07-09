<?php

/**
 * Disable Frontend and only use WP Admin for total headless CMS
 */
header("Location: " . get_admin_url());
exit();
