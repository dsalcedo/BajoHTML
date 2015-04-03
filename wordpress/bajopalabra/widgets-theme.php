<?php
  /*function getYoutubeID($url)
    {
      $url_string = parse_url($url, PHP_URL_QUERY);
      parse_str($url_string, $args);
      return isset($args['v']) ? $args['v'] : false;
    }*/

  function main_widgets() {
        register_sidebar(array( 'id'   => 'home_page_main_theme',
                                'name' => __( 'Home_Page', 'textdomain' ),
                                'description'   => __( 'Pagina de inicio.', 'textdomain' ),
                                'before_widget' => '<div id="%1$s" class="%2$s">',
                                'after_widget'  => '</div>',
                                'before_title'  => '<h3 class="widget-title">',
                                'after_title'   => '</h3>'
                                ));
  }
  add_action( 'widgets_init', 'main_widgets',20,4);

?>