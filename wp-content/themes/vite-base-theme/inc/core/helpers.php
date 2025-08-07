<?php


function render_flex($field_name)
{
    if (have_rows($field_name)) {
        echo '<div class="flex-modules">';
        while (have_rows($field_name)) {
            the_row();
            $layout = get_row_layout();

            // First check local page-specific
            $local_template = "templates/blocks/{$layout}.php";
            // Then check global shared fallback
            $global_template = "templates/blocks/global/{$layout}.php";

            if (locate_template($local_template)) {
                get_template_part("templates/blocks/{$layout}");
            } elseif (locate_template($global_template)) {
                get_template_part("templates/blocks/global/{$layout}");
            } else {
                error_log("[theme] Missing block: {$layout}");
            }
        }
        echo '</div>';
    }
}
