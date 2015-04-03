<?php
class widget_perfil_single extends WP_Widget
  {
    public function __construct()
        { parent::__construct(
            'widget_perfil_single',
            'Widget Perfil',
            array( 'description' => 'Widget que contiene un perfil de historia' )
          );
        }
    public function form( $instance )
      {
        $category = isset($instance['category']) ? $instance['category'] : '';
        $select = get_select_categories($this->get_field_name('category'),$category);
        $title = isset($instance['title']) ? $instance['title'] : 'Guerrerenses en EUA';
        ?>
          <p>
            <label>
              Titulo del widget
            </label>
            <input type="text" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title;?>" class="widefat">
          </p>
          <p>
            <label>Categoria</label>
            <?php echo $select; ?>
          </p>
        <?php
      }
    public function widget( $args, $ins )
      { 
        $title = (isset($ins['title'])) ? esc_html($ins['title']) : 'Guerrerenses en EUA' ;
      	$category = (isset($ins['category'])) ? $ins['category'] : 0 ;
        $params = array(
            'numberposts' => 1,
            'showposts'   => 1,
            //'post__in'    => get_option( 'sticky_posts'),
            'category'    => $category,
            'orderby'     => 'ID',
            'order'       => 'DESC',
            'post_status' => 'publish');
        $query = get_posts($params); 
        ?>

        <div class="col-md-4 padding-20-t">
            <p class="background-blue-flat no-p h40 text-center  text-shadow-min size-16 uppercase">
              <a href="<?php echo get_category_link($category);?>" class="bold font-white">
                <?php echo $title; ?>
              </a>
            </p>
            <?php
            foreach ( $query as $bp ) :
              setup_postdata( $bp );
              echo '<a href="'.get_permalink($bp->ID).'">'.get_the_post_thumbnail( $bp->ID, 'single_box',array('class'=>'img-responsive','title'=>$bp->post_title)).'</a>';
            ?>
            <p class="background-blue-flat text-center padding-15-t padding-15-b">
              <a href="<?php echo get_permalink($bp->ID);?>" class="font-white Arvos"><?php echo esc_html($bp->post_title);?></a>
              <a href="<?php echo get_category_link($category);?>" class="btn btn-flat-lg btn-flat-red uppercase OpenSans bold">Ver más historias</a>
            </p>
            <?php
            endforeach;
            wp_reset_postdata();
            ?>
      </div>




        <?php
      }

  }
add_action( 'widgets_init', create_function('', 'return register_widget("widget_perfil_single");') );
?>