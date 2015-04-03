<?php
    define('BAJOPALABRA_THEME',get_stylesheet_directory_uri());
    define('BAJOPALABRA_THEME_ASSETS',BAJOPALABRA_THEME.'/assets');
    define('BAJOPALABRA_THEME_URL', get_template_directory_uri() );
    define('BAJOPALABRA_THEME_TEMPLATE', get_template_directory() );
    // add_action( 'after_setup_theme', 'custom_theme_features' );
    locate_template('/libs/walker.php', true, true);
    locate_template('/sidebars-theme.php', true, true);

    add_theme_support('post-thumbnails');
    add_theme_support('menus');
    add_theme_support('custom-background');
    add_editor_style('editor-style.css');




    add_action('init', 'custom_image_size');
    
    /* start youtube meta box */
    add_action( 'add_meta_boxes', 'YouTube_meta_box_pg' );  //usage get_post_meta(get_the_ID(), 'youtube_url', true);
    function YouTube_meta_box_pg() {  
        add_meta_box( 'youtube-meta-box-id', 'YouTube link', 'yotube_metabox_print', 'post', 'side', 'high' );  
    }
    function getYoutubeID($url)
      {
        $url_string = parse_url($url, PHP_URL_QUERY);
        parse_str($url_string, $args);
        return isset($args['v']) ? $args['v'] : false;
      }
    function yotube_metabox_print() {
        wp_nonce_field( basename( __FILE__ ), 'youtube_meta_box_nonce' );
        $value = get_post_meta(get_the_ID(), 'youtube_url', true);
        $html = '<input type="text" name="youtube_url" value="'.$value.'" class="widefat" placeholder="ej. http://www.youtube.com/watch?v=Uwli3QL719o">';
        echo $html;
    }
    add_action( 'save_post', 'youtube_metabox_save' );  
    function youtube_metabox_save( $post_id ){   
        if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return; 
        if ( !isset( $_POST['youtube_meta_box_nonce'] ) || !wp_verify_nonce( $_POST['youtube_meta_box_nonce'], basename( __FILE__ ) ) ) return;
        if( !current_user_can( 'edit_post' ) ) return;  
        if( isset( $_POST['youtube_url'] ) )  
            update_post_meta( $post_id, 'youtube_url', esc_attr( $_POST['youtube_url'], $allowed ) );
    }
    function retrive_youtube_thumbs($id)
    {
      if(!$id):
        return array( 'http://cosmoquest.org/x/wp-content/plugins/wysija-newsletters/img/default-newsletter/newsletter/youtube-video.png',
                    'http://cosmoquest.org/x/wp-content/plugins/wysija-newsletters/img/default-newsletter/newsletter/youtube-video.png',
                    'http://cosmoquest.org/x/wp-content/plugins/wysija-newsletters/img/default-newsletter/newsletter/youtube-video.png',
                    'http://cosmoquest.org/x/wp-content/plugins/wysija-newsletters/img/default-newsletter/newsletter/youtube-video.png)',
                    'http://cosmoquest.org/x/wp-content/plugins/wysija-newsletters/img/default-newsletter/newsletter/youtube-video.png',
                    'http://cosmoquest.org/x/wp-content/plugins/wysija-newsletters/img/default-newsletter/newsletter/youtube-video.png',
                    'http://cosmoquest.org/x/wp-content/plugins/wysija-newsletters/img/default-newsletter/newsletter/youtube-video.png',
                    'http://cosmoquest.org/x/wp-content/plugins/wysija-newsletters/img/default-newsletter/newsletter/youtube-video.png',
                    'http://cosmoquest.org/x/wp-content/plugins/wysija-newsletters/img/default-newsletter/newsletter/youtube-video.png');
        else:
          $sizes=array( 'http://img.youtube.com/vi/'.$id.'/0.jpg',
                    'http://img.youtube.com/vi/'.$id.'/1.jpg',
                    'http://img.youtube.com/vi/'.$id.'/2.jpg',
                    'http://img.youtube.com/vi/'.$id.'/3.jpg',
                    'http://img.youtube.com/vi/'.$id.'/default.jpg',
                    'http://img.youtube.com/vi/'.$id.'/hqdefault.jpg',
                    'http://img.youtube.com/vi/'.$id.'/mqdefault.jpg',
                    'http://img.youtube.com/vi/'.$id.'/sddefault.jpg',
                    'http://img.youtube.com/vi/'.$id.'/maxresdefault.jpg');
      return $sizes;

          endif;
      
    }
    /** end youtube meta box **/
    /*
add_theme_support( 'post-thumbnails', array( 'books' ) );
  add_image_size( 'book-thumbnails', 260, 260, false );
    */
function custom_image_size() {       
  add_image_size( 'big_left_img',  245, 335, true );
  add_image_size( 'destacados_slider',  1140, 400, true );
  add_image_size( 'single_post',   415, 240, true );
  add_image_size( 'single_box',    400, 400, true );
  add_image_size( 'small_slider',  540, 300, true );
  add_image_size( 'frontpage_add', 365, 245, true );
  add_image_size( 'feature_post',  1140, 400, true );
  add_image_size( 'seccion',  550, 190, true );
  add_image_size( 'seccion_box',  254, 185, true );
}


function wpb_set_post_views($postID) {
    $count_key = 'wpb_post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}
function wpb_get_post_views($postID){
    $count_key = 'wpb_post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0 visitas";
    }
    return $count.' visitas';
}
add_filter('manage_posts_columns', 'posts_column_views');
//
add_action('manage_posts_custom_column', 'posts_custom_column_views',5,2);

function posts_column_views($defaults){
    $defaults['post_views'] = __('Visitas',1);
    return $defaults;
}
function posts_custom_column_views($column_name, $id){
        if($column_name === 'post_views'){
        echo wpb_get_post_views(get_the_ID());
    }
}
/*
<?php 
$popularpost = new WP_Query( array( 'posts_per_page' => 4, 'meta_key' => 'wpb_post_views_count', 'orderby' => 'meta_value_num', 'order' => 'DESC'  ) );
while ( $popularpost->have_posts() ) : $popularpost->the_post();

the_title();

endwhile;
?>
*/
//To keep the count accurate, lets get rid of prefetching
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

// Pagination for paged posts, Page 1, Page 2, Page 3, with Next and Previous Links, No plugin
function html5wp_pagination()
{
    global $wp_query;
    $big = 999999;
    echo paginate_links(array(
        'base' => str_replace($big, '%#%', get_pagenum_link($big)),
        'format' => '?paged=%#%',
        'current' => max(1, get_query_var('paged')),
        'total' => $wp_query->max_num_pages
    ));
}

add_action('init', 'html5wp_pagination'); // Add our HTML5 Pagination

add_action( 'init', 'register_my_menu' );
function register_my_menu()
  {
    //register_nav_menu( 'primary', 'Header Navigation' );
    register_nav_menus( array(
      'primary' => __( 'Primary Menu', 'BAJOPALABRA' ),
      'footer' => __( 'Footer Menu', 'BAJOPALABRA' ),
    ));
  }

function de_script() {
    wp_dequeue_script( 'jquery' );
    wp_deregister_script( 'jquery' );
    wp_dequeue_script( 'bp-legacy-js' );
    wp_deregister_script( 'bp-legacy-js' );
}
function my_assets() {
  add_action( 'wp_print_scripts', 'de_script', 100 );
  /* Styles */
  wp_enqueue_style( 'bootstrap.min.css', BAJOPALABRA_THEME_ASSETS.'/css/bootstrap.min.css', false, 1, false );
  wp_enqueue_style( 'main-css', BAJOPALABRA_THEME_ASSETS.'/css/main.css', false, 1, false );

  /* Javascript */
  wp_register_script('jquery_new', BAJOPALABRA_THEME_ASSETS.'/js/jquery.js', false, '1.11.2', true);
  wp_enqueue_script ( 'jquery_new' );
  wp_enqueue_script( 'bootstrap.min.js',BAJOPALABRA_THEME_ASSETS.'/js/bootstrap.min.js', 'jquery', 'last', true);
  //wp_enqueue_script( 'theme-scripts', get_stylesheet_directory_uri() . '/website-scripts.js', array( 'owl-carousel', 'jquery' ), '1.0', true );
  /*if ( is_front_page() ) {
      //If this evaluates to true, send this script
      wp_enqueue_script ( 'jquery-bxslider' );
      wp_enqueue_script ( 'youtube-playlist' );
  }*/
  //wp_enqueue_script( $handle, $source, $dependencies, $version, $in_footer );
  //wp_enqueue_style( $handle, $source, $dependencies, $version, $media );
  /*wp_enqueue_style( 'theme-style', get_stylesheet_uri(), array( 'reset' ) );
  wp_enqueue_style( 'reset', get_stylesheet_directory_uri() . '/reset.css' ) );
  wp_enqueue_script( 'owl-carousel', get_stylesheet_directory_uri() . '/owl.carousel.js', array( 'jquery' ) );
  wp_enqueue_script( 'theme-scripts', get_stylesheet_directory_uri() . '/website-scripts.js', array( 'owl-carousel', 'jquery' ), '1.0', true );*/
}
add_action( 'wp_enqueue_scripts', 'my_assets' );
  function setup_theme_admin_menus() {
    add_menu_page('Theme settings', 'BajoPalabra', 'manage_options', 'bajo-palabra-theme-admin', 'theme_settings_page');
    add_submenu_page('bajo-palabra-theme-admin','Front Page Elements', 'Front Page', 'manage_options', 'bajo-palabra-theme-admin', 'theme_front_page_settings'); 
  }
  function theme_front_page_settings() {
    locate_template('/templates_admin/theme-options.php',true,true);
  } 
  add_action("admin_menu", "setup_theme_admin_menus");
  function theme_settings_page() {
      // Check that the user is allowed to update options
      if (!current_user_can('manage_options')) {
          wp_die('You do not have sufficient permissions to access this page.');
      }
      if (isset($_POST["update_settings"])):
          $post=$_POST;
          $i = 0;
          foreach ($post as $p => $v):
              $v = (filter_var($v, FILTER_VALIDATE_URL)) ? esc_url($v) : esc_attr($v) ;
              $option="theme_".$p;
              update_option($option, $v);
              $i++;
          endforeach;
      ?>
      <p class="bg-success">Los cambios se efecturaon correctamente</p>
      <?php
      endif;
  }


function get_select_categories($name,$selected)
  {
    $name = (is_array($name)) ? $name[0]."[".$name[1]."]" : $name;
    $args = array(
      'show_option_none' => __( 'Selecciona categoria' ),
      'show_count'       => false,
      'orderby'          => 'ID',
      'echo'             => false,
      'name'=>$name,
      'selected'=>$selected,
      'hierarchical'=>true,
      'class'=>"");
    $select  = wp_dropdown_categories( $args );
    $replace = "<select$1 >";
    $select  = preg_replace( '#<select([^>]*)>#', $replace, $select );
    return $select;
  }



function ThemeTopLogo()
  {
    $home = get_site_url();
    $logo = get_option('theme_top_logo');
    if ($logo):
      echo '<a class="logo-container" href="'.$home.'">
              <img src="'.$logo.'" class="is-img-responsive">
            </a>';
      else:
        echo 'Falta subir el logotipo';
        endif;
  }

function get_title_site()
  {
    if(is_home()):
        $title=get_bloginfo().' - '.get_bloginfo ( 'description' );
      elseif(is_page()):
        $title = get_the_title();
        elseif(is_single()):
            $title=get_the_title();
          elseif(is_archive()):
            
            elseif (is_search()):
                $title = 'Búsqueda: '.esc_html(get_search_query());
        else:
          endif;
    echo $title;
  }

      // Numbered Pagination
    function wpc_pagination($pages = '', $range = 2){
   
    
        $showitems = ($range * 2)+1;
        global $paged;

        if( empty($paged)) $paged = 1;
        if($pages == '')
         {
            global $wp_query;

            $pages = $wp_query->max_num_pages;                     
            if(!$pages)
             {
                $pages = 1;
             }
         }

         if(1 != $pages)
         {
             echo '<ul class="pagination pagination-sm text-center" style="margin: 0px 0px;" >';
             echo '<li >'.get_previous_posts_link('<<').'</li>';
             if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo '<li><a href="'.get_pagenum_link(1).'">FIRST</a></li>';
             if($paged > 1 && $showitems < $pages) echo '<li><a href="' .get_pagenum_link($paged - 1). '" rel="prev">previous</a></li>';
             for ($i=1; $i <= $pages; $i++)
             {
                 if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
                 {
                     echo ($paged == $i)? '<li class="active"><a href="#">'. $i .'</a></li>':'<li><a href="'.get_pagenum_link($i).'">'.$i.'</a></li>';
                 }
             }

             if ($paged < $pages && $showitems < $pages) echo '<li><a href="'.get_pagenum_link($paged + 1).'" rel="next">next</a></li>';
             if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo '<li><a href="'.get_pagenum_link($pages).'">LAST</a></li>';
            echo '<li >'.get_next_posts_link('>>').'</li>';
            echo '</ul>';
         }
    }
// profile fields
  // http://ross.my/2014/09/customize-wordpress-user-profile-fields-without-using-a-plugin/
function tweak_contact_detail($contact_fields)
  {
    $contact_fields['twitter'] = 'Twitter Username';
    $contact_fields['facebook'] = 'Facebook URL';
    return $contact_fields;
  }
add_filter('user_contactmethods','tweak_contact_detail',10,1);





function excerpt($limit) {
      $excerpt = explode(' ', get_the_excerpt(), $limit);
      if (count($excerpt)>=$limit) {
        array_pop($excerpt);
        $excerpt = implode(" ",$excerpt).'';
      } else {
        $excerpt = implode(" ",$excerpt);
      } 
      $excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
      return $excerpt;
    }

    function content($limit) {
      $content = explode(' ', get_the_content(), $limit);
      if (count($content)>=$limit) {
        array_pop($content);
        $content = implode(" ",$content).'...';
      } else {
        $content = implode(" ",$content);
      } 
      $content = preg_replace('/\[.+\]/','', $content);
      $content = apply_filters('the_content', $content); 
      $content = str_replace(']]>', ']]&gt;', $content);
      return $content;
    }

    function the_breadcrumbs() {
 
        global $post;
 
        if (!is_home()) {
 
            echo "<a href='";
            echo get_option('home');
            echo "'>";
            echo "Site's name here";
            echo "</a>";
 
            if (is_category() || is_single()) {
 
                echo " > ";
                $cats = get_the_category( $post->ID );
 
                foreach ( $cats as $cat ){
                    echo $cat->cat_name;
                    echo " > ";
                }
                if (is_single()) {
                    the_title();
                }
            } elseif (is_page()) {
 
                if($post->post_parent){
                    $anc = get_post_ancestors( $post->ID );
                    $anc_link = get_page_link( $post->post_parent );
 
                    foreach ( $anc as $ancestor ) {
                        $output = " > <a href=".$anc_link.">".get_the_title($ancestor)."</a> > ";
                    }
 
                    echo $output;
                    the_title();
 
                } else {
                    echo ' > ';
                    echo the_title();
                }
            }
        }
    elseif (is_tag()) {single_tag_title();}
    elseif (is_day()) {echo"Archive: "; the_time('F jS, Y'); echo'</li>';}
    elseif (is_month()) {echo"Archive: "; the_time('F, Y'); echo'</li>';}
    elseif (is_year()) {echo"Archive: "; the_time('Y'); echo'</li>';}
    elseif (is_author()) {echo"Author's archive: "; echo'</li>';}
    elseif (isset($_GET['paged']) && !empty($_GET['paged'])) {echo "Blogarchive: "; echo'';}
    elseif (is_search()) {echo"Search results: "; }
}
?>