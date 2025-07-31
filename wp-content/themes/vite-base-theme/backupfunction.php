<?php // functions.php
function is_dev_mode()
{
    // force prod if manifest.json exists
    $manifest_path = get_template_directory() . '/dist/.vite/manifest.json';
    if (file_exists($manifest_path)) return false;

    return defined('WP_ENV') && WP_ENV === 'development';
}

add_action('wp_enqueue_scripts', function () {
    if (is_admin()) return;

    if (is_dev_mode()) {
        echo '<script type="module" src="http://localhost:3000/js/main.js"></script>';
        return;
    }

    $manifest_path = get_template_directory() . '/dist/.vite/manifest.json';
    if (!file_exists($manifest_path)) {
        echo '<!-- Manifest file not found -->';
        return;
    }

    $manifest = json_decode(file_get_contents($manifest_path), true);
    if (!is_array($manifest)) {
        echo '<!-- Invalid manifest format -->';
        return;
    }

    foreach ($manifest as $key => $entry) {
        if (!empty($entry['isEntry'])) {
            if (!empty($entry['css'])) {
                foreach ($entry['css'] as $css) {
                    echo '<link rel="stylesheet" href="' . get_template_directory_uri() . '/dist/assets/' . basename($css) . '">' . PHP_EOL;
                }
            }
            echo '<script type="module" src="' . get_template_directory_uri() . '/dist/assets/' . basename($entry['file']) . '"></script>' . PHP_EOL;
        }
    }
});
