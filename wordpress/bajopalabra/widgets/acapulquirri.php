<?php
class widget_acapulquirri extends WP_Widget
  {
    public function __construct()
        { parent::__construct(
            'widget_acapulquirri',
            'Acapulquirri',
            array( 'description' => 'Widget que muestra post de acapulquirri' )
          );
        }
    public function form( $instance )
      {
        $category = isset($instance['category']) ? $instance['category'] : '';
        $select = get_select_categories($this->get_field_name('category'),$category);
        $title = isset($instance['title']) ? $instance['title'] : 'Acapulquirri';
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
      	$title = (isset($ins['title'])) ? esc_html($ins['title']) : 'Acapulquirri' ;
        $cat=$ins['category'];

        ?>
        <div class="col-md-12">
        <div class="col-md-3 acapulquirri-bg acapulquirri-bloq">
          <p class="text-center padding-15-t">
            <a href="<?php echo get_category_link($ins['category']);?>" class="Arvo font-black text-center bold font-white text-shadow-min-inverse size-16 uppercase OpenSans">
              <?php echo $title;?>
            </a>
          </p>
        </div>
        <div class="col-md-9 background-blue-flat-2 acapulquirri-bloq">
          <?php 
              $params = array(
              'numberposts' => 3,
              'showposts'   => 3,
              //'post__in'    => get_option( 'sticky_posts'),
              'category'    => $ins['category'],
              'orderby'     => 'ID',
              'order'       => 'DESC',
              'post_status' => 'publish');
              $query = get_posts($params);
              foreach ($query as $bp):
                setup_postdata( $bp );
                $image=get_the_post_thumbnail( $bp->ID, 'single_post',array('class'=>'img-responsive','title'=>$bp->post_title));
              ?>
              <div class="col-md-4 padding-20-t">
                  <?php echo $image;?>
                  <p class="padding-10-t">
                    <a href="<?php echo get_permalink($bp->ID);?>" class="size-16 bold font-white"><?php echo $bp->post_title;?></a>
                  </p>
              </div>
          <?php
              endforeach;
              wp_reset_postdata();
            ?>
        </div>
      </div>
        <?php
      }
  }
  add_action( 'widgets_init', create_function('', 'return register_widget("widget_acapulquirri");') );
?>