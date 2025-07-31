<?php
// Define WP_ENV
if (!defined('WP_ENV')) {
    $host = $_SERVER['HTTP_HOST'] ?? 'localhost';
    define('WP_ENV', preg_match('/localhost|\.local|\.test|127\.0\.0\.1/', $host) ? 'development' : 'production');
}

// Detect if Vite dev server is running
function is_dev_mode()
{
    if (defined('WP_ENV') && WP_ENV === 'production') return false;

    $fp = @fsockopen('localhost', 3000, $errno, $errstr, 1);
    $is_up = $fp !== false;
    if ($fp) fclose($fp);
    return $is_up;
}

// Load Vite manifest
function get_vite_manifest()
{
    $path = get_template_directory() . '/dist/.vite/manifest.json';
    if (!file_exists($path)) return [];
    return json_decode(file_get_contents($path), true);
}

// Enqueue CSS from Vite manifest
add_action('wp_enqueue_scripts', function () {
    if (is_admin() || is_dev_mode()) return;
    $manifest = get_vite_manifest();
    if (!isset($manifest['js/main.js'])) return;
    foreach ($manifest['js/main.js']['css'] ?? [] as $css) {
        wp_enqueue_style(
            'vite-style-' . md5($css),
            get_template_directory_uri() . '/dist/' . ltrim($css, '/'),
            [],
            null // No ?ver
        );
    }
});

// Inject JS in footer
add_action('wp_footer', function () {
    if (is_admin()) return;

    if (is_dev_mode()) {
        echo '<script type="module" src="http://localhost:3000/js/main.js"></script>';
    } else {
        $manifest = get_vite_manifest();
        if (isset($manifest['js/main.js']['file'])) {
            $src = get_template_directory_uri() . '/dist/' . ltrim($manifest['js/main.js']['file'], '/');
            echo '<script type="module" src="' . esc_url($src) . '"></script>';
        }
    }

    // Fallback error logging
    echo '<script>
    document.querySelectorAll("script[type=\'module\']").forEach(tag => {
      tag.onerror = () => console.error("[vite-theme] JS load error:", tag.src);
    });
    document.querySelectorAll("link[rel=\'stylesheet\']").forEach(tag => {
      tag.onerror = () => console.error("[vite-theme] CSS load error:", tag.href);
    });
  </script>';

    echo '<!-- WP_ENV: ' . WP_ENV . ', Dev: ' . (is_dev_mode() ? 'yes' : 'no') . ' -->';
});



add_action('after_setup_theme', function () {
    register_nav_menus([
        'primary' => __('Primary Menu', 'yourtheme'),
    ]);
});

class Custom_Nav_Walker extends Walker_Nav_Menu
{
    function start_lvl(&$output, $depth = 0, $args = null)
    {
        $output .= "\n<ul class=\"submenu\">\n";
    }

    function start_el(&$output, $item, $depth = 0, $args = null, $id = 0)
    {
        $classes = empty($item->classes) ? [] : (array) $item->classes;
        $has_children = in_array('menu-item-has-children', $classes);

        // Append your custom classes
        if ($has_children) {
            $classes[] = 'has-submenu';
            $classes[] = $depth === 0 ? 'parent-menu-item' : 'child-menu-item';
        }

        $classes[] = 'sub-menu-item';

        $class_names = join(' ', array_unique(array_filter($classes)));
        $output .= '<li class="' . esc_attr($class_names) . '">';

        $atts = [
            'title'  => $item->attr_title ?: '',
            'target' => $item->target ?: '',
            'rel'    => $item->xfn ?: '',
            'href'   => $item->url ?: '#',
            'class'  => 'sub-menu-item',
        ];

        $attributes = '';
        foreach ($atts as $attr => $value) {
            if (!empty($value)) {
                $attributes .= ' ' . $attr . '="' . esc_attr($value) . '"';
            }
        }

        $output .= '<a' . $attributes . '>';
        $output .= apply_filters('the_title', $item->title, $item->ID);
        $output .= '</a>';

        if ($has_children && $depth === 0) {
            $output .= '<span class="menu-arrow"></span>';
        }
    }

    function end_el(&$output, $item, $depth = 0, $args = null)
    {
        $output .= "</li>\n";
    }

    function end_lvl(&$output, $depth = 0, $args = null)
    {
        $output .= "</ul>\n";
    }
}
