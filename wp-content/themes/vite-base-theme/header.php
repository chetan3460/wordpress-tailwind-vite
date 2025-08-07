<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="format-detection" content="telephone=no">
    <meta name="theme-url" content="<?php echo esc_url(get_template_directory_uri()); ?>">

    <link rel="profile" href="https://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">



    <?php wp_head(); ?>
</head>


<body <?php body_class(); ?>>


    <script type="text/javascript">
        var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
    </script>

    <header id="header" class="bg-amber-300">
        <nav id="topnav" class="defaultscroll is-sticky">
            <div class="container relative">

                <!-- Logo -->
                <a class="logo" href="<?php echo esc_url(home_url('/')); ?>">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/logo-dark.png"
                        class="inline-block dark:hidden"
                        alt="<?php bloginfo('name'); ?>">
                </a>

                <!-- Mobile Menu Toggle -->
                <div class="menu-extras">
                    <div class="menu-item">
                        <a class="navbar-toggle" id="isToggle">
                            <div class="lines">
                                <span></span><span></span><span></span>
                            </div>
                        </a>
                    </div>
                </div>

                <!-- Navigation -->
                <div id="navigation">
                    <?php
                    wp_nav_menu([
                        'theme_location' => 'primary',
                        'menu_class' => 'navigation-menu',
                        'container' => false,
                        'walker' => new Custom_Nav_Walker(),
                        'fallback_cb' => false,
                    ]);
                    ?>
                </div>
            </div>
        </nav>
    </header>