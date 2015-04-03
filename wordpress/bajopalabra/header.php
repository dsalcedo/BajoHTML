<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>
      <?php get_title_site(); ?>

    </title>
    <meta name="description" content="<?php bloginfo('description'); ?>">

    <!-- Bootstrap -->
    <?php wp_head(); ?>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
  <body>

    <!-- Fixed navbar -->
    <nav class="navbar navbar-default navbar-static-top header-menu Montserrat">
      <div class="container">
        <div class="navbar-header header-logo">

            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <div class="col-md-3 hidde-for-mobile">
              <div id="weather"></div>
            </div>
            <div class="col-md-6 text-center logo-header-mobile">
              <?php ThemeTopLogo(); ?>
            </div>
            <!-- search and social media-->
            <div class="col-md-3 search-social hidde-for-mobile">
              <p  class="pull-right">
              <img src="https://es.wmspanel.com/assets/twitter-icon-33babcf8b2e80b11a3e307f40560b050.png">
              <img src="http://www.americanbar.org/content/dam/aba/images/graphics/icons/facebook.png">
              <img src="https://addons.cdn.mozilla.net/user-media/addon_icons/375/375984-64.png?modified=1368573287">
              </p>
              
              <div class="col-lg-12">
                <form method="get"  action="<?php echo home_url( '/' ); ?>" class="row">
                <div class="input-group">
                  <input type="text" class="form-control" name="s" value="<?php echo esc_html(get_search_query());?>" placeholder="Search for...">
                  <span class="input-group-btn">

                    <input type="submit" class="btn btn-default"  value="Buscar">
                  </span>
                </div><!-- /input-group -->
                </form>
              </div><!-- /.col-lg-12-->
            </div>
        </div>
        <?php
            wp_nav_menu( array(
                'menu'              => 'primary',
                'theme_location'    => 'primary',
                'depth'             => 2,
                'container'         => 'div',
                'container_class'   => 'collapse navbar-collapse navigacija',
                'container_id'      => 'bs-example-navbar-collapse-1',
                'menu_class'        => 'nav navbar-nav col-md-12 bs-navbar-collapse ',
                'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
                'items_wrap'      => '<ul id="%1$s" class="nav navbar-nav col-md-12 menu">%3$s</ul>',
                'walker'            => new wp_bootstrap_navwalker())
            );
        ?>
      </div>
    </nav>