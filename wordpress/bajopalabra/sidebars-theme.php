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
  locate_template('/widgets/rudos_y_tecnicos.php', true, true);
  locate_template('/widgets/temas_relevantes.php', true, true);
  locate_template('/widgets/slider_destacados.php', true, true);
  locate_template('/widgets/posts.php', true, true);
  locate_template('/widgets/sangre_fria.php', true, true);
  locate_template('/widgets/carton_del_dia.php', true, true);
  locate_template('/widgets/memeando.php', true, true);
  locate_template('/widgets/buzon.php', true, true);
  locate_template('/widgets/mini-slider.php', true, true);
  locate_template('/widgets/tabs_widgets.php', true, true);
  locate_template('/widgets/encuesta.php', true, true);
  locate_template('/widgets/acapulquirri.php', true, true);
  locate_template('/widgets/perfil_single.php', true, true);
  locate_template('/widgets/twitter.php', true, true);
  locate_template('/widgets/secciones.php', true, true);
  locate_template('/widgets/garage.php', true, true);
?>