      <?php
        wp_nav_menu([
            'theme_location' => 'primary',
            'menu_class' => 'navigation-menu',
            'container' => false,
            'walker' => new Custom_Nav_Walker(),
            'fallback_cb' => false,
        ]);
        ?>