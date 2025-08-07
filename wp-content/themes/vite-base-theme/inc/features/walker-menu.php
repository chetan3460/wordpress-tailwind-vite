<?php

add_action('after_setup_theme', function () {
    register_nav_menus([
        'primary' => __('Primary Menu', 'vite-base-theme'),
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
            'title' => $item->attr_title ?: '',
            'target' => $item->target ?: '',
            'rel' => $item->xfn ?: '',
            'href' => $item->url ?: '#',
            'class' => 'sub-menu-item',
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
