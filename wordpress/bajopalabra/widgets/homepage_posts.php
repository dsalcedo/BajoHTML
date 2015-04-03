<?php
class widget_homepage_posts extends WP_Widget
  {
    public function __construct()
        { parent::__construct(
            'widget_homepage_posts',
            'Rudos y tecnicos',
            array( 'description' => 'Este bloque contiene el contenido de rudos y tecnicos' )
          );
        }
    public function form( $instance )
      {
        $category = isset($instance['category']) ? $instance['category'] : '';
        $count    = 8;
        $size     = isset($instance['size']) ? $instance['size'] : 'col-md-12';
        $select   = get_select_categories($this->get_field_name('category'),$category);
        //$title    = isset($instance['title']) ? $instance['title'] : 'Rudos y técnicos';
        ?>
          <p>
            <label>Tamaño del widget</label>
              <select name="<?php echo $this->get_field_name('size'); ?>" id="<?php echo $this->get_field_id('size'); ?>"  class="widefat">
                <option value="col-md-1" <?php echo ($size=='col-md-1')? 'selected':''; ?>>1 columna</option>
                <option value="col-md-2" <?php echo ($size=='col-md-2')? 'selected':''; ?>>2 columnas</option>
                <option value="col-md-3" <?php echo ($size=='col-md-3')? 'selected':''; ?>>3 columnas</option>
                <option value="col-md-4" <?php echo ($size=='col-md-4')? 'selected':''; ?>>4 columnas</option>
                <option value="col-md-5" <?php echo ($size=='col-md-5')? 'selected':''; ?>>5 columnas</option>
                <option value="col-md-6" <?php echo ($size=='col-md-6')? 'selected':''; ?>>6 columnas</option>
                <option value="col-md-7" <?php echo ($size=='col-md-7')? 'selected':''; ?>>7 columnas</option>
                <option value="col-md-8" <?php echo ($size=='col-md-8')? 'selected':''; ?>>8 columnas</option>
                <option value="col-md-9" <?php echo ($size=='col-md-9')? 'selected':''; ?>>9 columnas</option>
                <option value="col-md-10" <?php echo ($size=='col-md-10')? 'selected':''; ?>>10 columnas</option>
                <option value="col-md-11" <?php echo ($size=='col-md-11')? 'selected':''; ?>>11 columnas</option>
                <option value="col-md-12" <?php echo ($size=='col-md-12')? 'selected':''; ?>>12 columnas</option>
              </select>
          </p>
          <p>
            <label>Categoria</label>
            <?php echo $select; ?>
          </p>
        <?php
      }
    public function widget( $args, $ins )
      {  ?>
       
        <?php
        $params = array(
                  'numberposts' =>8,
                  'category' =>$ins['category'],
                  'orderby'    => 'ID',
                  'order'    => 'DESC',
                  'post_status'=>'publish'
                  );
        $res = get_posts($params);
        /*$arg = array(
            'type'                     => 'post',
            'child_of'                 => $ins['category'],
            'parent'                   => '',
            'orderby'                  => 'name',
            'order'                    => 'ASC',
            'hide_empty'               => 1,
            'hierarchical'             => 1,
            'exclude'                  => '',
            'include'                  => '',
            'number'                   => '',
            'taxonomy'                 => 'category',
            'pad_counts'               => false 

          );*/
        $arg = array('parent' => $ins['category'],'pad_counts'=>true);
          $categories = get_categories( $arg );
        echo json_encode($categories['0']->category_count);
?>
        <?php 
        foreach($categories as $category) { 
          //echo '<li data-target="#myCarousel" data-slide-to="0" class="active"><a href="#">'.$category->name.'<small>'. $category->description . '</small></a></li>';
        }
        ?>


      <?php 
          foreach($categories as $category) { 
            //echo json_encode($category);
              echo '<p>Category: <a href="' . get_category_link( $category->term_id ) . '" title="' . sprintf( __( "View all posts in %s" ), $category->name ) . '" ' . '>' . $category->name.'</a> </p> ';
              echo '<p> Description:'. $category->description . '</p>';

              echo '<p> Post Count: '. $category->count . '</p>'; 
              
          }
          /*
$args = array('parent' => 17);
$categories = get_categories( $args );
foreach($categories as $category) { 
    echo '<p>Category: <a href="' . get_category_link( $category->term_id ) . '" title="' . sprintf( __( "View all posts in %s" ), $category->name ) . '" ' . '>' . $category->name.'</a> </p> ';
    echo '<p> Description:'. $category->description . '</p>';
    echo '<p> Post Count: '. $category->count . '</p>';  
}
          */
        ?>
      <div class="custom-container">
        <div class="<?php echo $ins['size'];?>">
          <h4 class="text-center uppercase font-red bold border-bottom-red padding-bottom"><?php echo $ins['title']; ?></h4>
        </div>
        <div class="row">
          <?php foreach ( $res as $post ) :
                setup_postdata( $post ); ?>
                <div class="col-md-6">
                  <div class="row">
                  <div class="col-md-4">
                      <img data-src="holder.js/80x80" class="img-circle" alt="80x80" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iMTQwIiBoZWlnaHQ9IjE0MCIgdmlld0JveD0iMCAwIDE0MCAxNDAiIHByZXNlcnZlQXNwZWN0UmF0aW89Im5vbmUiPjxkZWZzLz48cmVjdCB3aWR0aD0iMTQwIiBoZWlnaHQ9IjE0MCIgZmlsbD0iI0VFRUVFRSIvPjxnPjx0ZXh0IHg9IjQ0LjA0Njg3NSIgeT0iNzAiIHN0eWxlPSJmaWxsOiNBQUFBQUE7Zm9udC13ZWlnaHQ6Ym9sZDtmb250LWZhbWlseTpBcmlhbCwgSGVsdmV0aWNhLCBPcGVuIFNhbnMsIHNhbnMtc2VyaWYsIG1vbm9zcGFjZTtmb250LXNpemU6MTBwdDtkb21pbmFudC1iYXNlbGluZTpjZW50cmFsIj4xNDB4MTQwPC90ZXh0PjwvZz48L3N2Zz4=" data-holder-rendered="true" style="width: 80px; height: 80px;">
                  </div>
                  <div class="col-md-8">
                    <h6 class="uppercase font-red bold"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h6>
                    <p class="font-gray-flat">Ciro gomez leyva</p>
                    <p class="font-blue Arvo font-weight-400">¿Tiene realmente futuro Luis Videgaray?</p>
                  </div>
                  </div>
                </div>
                
          <?php endforeach; 
                wp_reset_postdata(); ?>
        </div>
      </div>
        <?php
      }

  }
add_action( 'widgets_init', create_function('', 'return register_widget("widget_homepage_posts");') );