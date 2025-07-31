<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <header id="header" class="bg-amber-300">
        <!-- Start Navbar -->
        <nav id="topnav" class="defaultscroll is-sticky">
            <div class="container relative">
                <!-- Logo container-->
                <a class="logo" href="index.html">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/logo-dark.png" class="inline-block dark:hidden" alt="">

                </a>

                <!-- End Logo container-->
                <div class="menu-extras">
                    <div class="menu-item">
                        <!-- Mobile menu toggle-->
                        <a class="navbar-toggle" id="isToggle">
                            <div class="lines">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                        </a>
                        <!-- End mobile menu toggle-->
                    </div>
                </div>



                <div id="navigation">
                    <!-- Navigation Menu-->
                    <ul class="navigation-menu">
                        <li><a href="__REL_PATH__/index.html" class="sub-menu-item">Home</a></li>



                        <li class="has-submenu parent-menu-item">
                            <a href="__REL_PATH__/about-us.html" class="sub-menu-item">About Us</a>
                            <!-- <ul class="submenu">



                            <li class="has-submenu parent-menu-item">
                                <a href="javascript:void(0)"> Multi Level
                                    Menu</a><span class="submenu-arrow"></span>
                                <ul class="submenu">
                                    <li><a href="javascript:void(0)" class="sub-menu-item">Level 1.0</a></li>
                                    <li class="has-submenu child-menu-item"><a href="javascript:void(0)"> Level
                                            2.0 </a><span class="submenu-arrow"></span>
                                        <ul class="submenu">
                                            <li><a href="javascript:void(0)" class="sub-menu-item">Level 2.1</a>
                                            </li>
                                            <li><a href="javascript:void(0)" class="sub-menu-item">Level 2.2</a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>

                        </ul> -->
                        </li>
                        <li><a href="__REL_PATH__/service/service.html" class="sub-menu-item">Service</a></li>



                        <li class="has-submenu parent-menu-item">
                            <a href="javascript:void(0)">Docs</a><span class="menu-arrow"></span>
                            <ul class="submenu">
                                <li><a href="__REL_PATH__/components/ui-components.html" class="sub-menu-item">Components
                                    </a>
                                </li>
                                <li><a href="__REL_PATH__/documentation.html" class="sub-menu-item">Documentation</a></li>
                                <li><a href="__REL_PATH__/changelog.html" class="sub-menu-item">Changelog</a></li>
                                <li><a href="__REL_PATH__/widget.html" class="sub-menu-item">Widget</a></li>
                            </ul>
                        </li>

                        <li><a href="__REL_PATH__/contact-us.html" class="sub-menu-item">Contact</a></li>
                    </ul><!--end navigation menu-->
                </div><!--end navigation-->
            </div><!--end container-->
        </nav><!--end header-->
        <!-- End Navbar -->
    </header>