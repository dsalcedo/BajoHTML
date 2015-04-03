<?php

/*
'post__in' => get_option( 'sticky_posts' ),
'ignore_sticky_posts' => 1, 
*/
class widget_rudos_y_tecnicos extends WP_Widget
  {
    public function __construct()
        { parent::__construct(
            'widget_rudos_y_tecnicos',
            'Rudos y tecnicos',
            array( 'description' => 'Este bloque contiene el contenido de rudos y tecnicos' )
          );
        }
    public function form( $instance )
      {
        $category = isset($instance['category']) ? $instance['category'] : '';
        $count  = isset($instance['count']) ? $instance['count'] : 4;
        $size   = isset($instance['size']) ? $instance['size'] : 'col-md-12';
        $select = get_select_categories($this->get_field_name('category'),$category);
        $title = isset($instance['title']) ? $instance['title'] : 'Rudos y técnicos';
        ?>
          <p>
            <label>
              Titulo del widget
            </label>
            <input type="text" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title;?>" class="widefat">
          </p>
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
          <p>
            <label>Entradas a mostar</label>
            <input type="text" name="<?php echo $this->get_field_name('count'); ?>" value="<?php echo $count;?>" class="widefat">
          </p>
        <?php
      }
    public function widget( $args, $ins )
      { 
        $child_of=array(
          'child_of' => $ins['category'],
          'hide_empty' => true,
          'orderby' => 'name',
          'order' => 'ASC');
        $child_categories=get_categories($child_of);
        $cctv = get_terms( 'category', array('parent' => $ins['category']));
    
        ?>
        <div class="custom-container">
        <div class="<?php echo $ins['size'];?>">
          <h4 class="text-center uppercase font-red bold border-bottom-red padding-bottom"><?php echo $ins['title']; ?></h4>
        </div>
 <div id="<?php echo $this->id;?>" class="carousel slide" data-ride="carousel">
        <!-- Wrapper for slides -->
        <div class="carousel-inner">
          <?php 
          $y=0; $z=0;
          foreach( $cctv as $category ) {

                    $params = array(
                      'numberposts' =>4,
                      'category' => $category->term_id,
                      'orderby'  => 'ID',
                      'order'    => 'DESC',
                      'post_status'=>'publish'
                    );
                  $response = get_posts($params);
                  //$arg = array('parent' => $ins['category'],'pad_counts'=>fañse);
                  //$categories = get_categories( $arg );
                  $act = ($y==0) ? 'active' : '' ;
                  echo '<div class="item '.$act.'">';
                  foreach ( $response as $res ) : setup_postdata( $res );?>
                  <?php  
                    $cat = get_the_category($res->ID);
                    $author_url=get_author_posts_url($res->post_author); 
                    $categoria=$cat[$z]->name;
                    $z++;
                  ?>
                  <div class="col-md-3">
                    <div class="row">
                    <div class="col-md-4">
                      <a href="<?php echo $author_url;?>">
                        <img data-src="holder.js/80x80" class="img-circle" alt="80x80" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iMTQwIiBoZWlnaHQ9IjE0MCIgdmlld0JveD0iMCAwIDE0MCAxNDAiIHByZXNlcnZlQXNwZWN0UmF0aW89Im5vbmUiPjxkZWZzLz48cmVjdCB3aWR0aD0iMTQwIiBoZWlnaHQ9IjE0MCIgZmlsbD0iI0VFRUVFRSIvPjxnPjx0ZXh0IHg9IjQ0LjA0Njg3NSIgeT0iNzAiIHN0eWxlPSJmaWxsOiNBQUFBQUE7Zm9udC13ZWlnaHQ6Ym9sZDtmb250LWZhbWlseTpBcmlhbCwgSGVsdmV0aWNhLCBPcGVuIFNhbnMsIHNhbnMtc2VyaWYsIG1vbm9zcGFjZTtmb250LXNpemU6MTBwdDtkb21pbmFudC1iYXNlbGluZTpjZW50cmFsIj4xNDB4MTQwPC90ZXh0PjwvZz48L3N2Zz4=" data-holder-rendered="true" style="width: 80px; height: 80px;">
                      </a>
                    </div>
                    <div class="col-md-8">
                      <h6 class="uppercase  no-top">
                        <a href="<?php echo $cat[0]->slug; ?>" class="font-red bold"><?php echo $categoria; ?></a>
                      </h6>
                      <p class="font-gray-flat"><?php echo the_author_posts_link(); ?></p>
                      <p class="font-blue Arvo font-weight-400"><?php echo $res->post_title;?></p>
                    </div>
                  </div>
                </div>
                  <?php

                  endforeach;
                  $y++;
                  wp_reset_postdata();
                  echo '</div>';
                  
      } ?>

        </div>
        <!-- End Carousel Inner -->
        <ul class="nav nav-pills nav-justified no-radius">
          <?php 
            $x=0;
            foreach($cctv as $category){
              $act = ($x==0) ? 'active' : '' ;
              echo '<li data-target="#'.$this->id.'" data-slide-to="'.$x.'" class="'.$act.' no-radius"><a href="#" class="no-radius">'.$category->name.'<small>'. $category->description . '</small></a></li>';
              $x++;
            }
          ?>
        </ul>
    </div>
  </div>

        <?php
        
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
        //$arg = array('parent' => $ins['category'],'pad_counts'=>true);
       // $categories = get_categories( $arg );

        //echo json_encode($categories['0']->category_count);
?>
        <?php 
 
        ?>


      <?php 
          /*foreach($categories as $category) { 
            //echo json_encode($category);
              echo '<p>Category: <a href="' . get_category_link( $category->term_id ) . '" title="' . sprintf( __( "View all posts in %s" ), $category->name ) . '" ' . '>' . $category->name.'</a> </p> ';
              echo '<p> Description:'. $category->description . '</p>';

              echo '<p> Post Count: '. $category->count . '</p>'; 
              
          }*/
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

        <?php
      }

  }
add_action( 'widgets_init', create_function('', 'return register_widget("widget_rudos_y_tecnicos");') );

/*

*/?>