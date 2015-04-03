<?php
class widget_mini_slider extends WP_Widget
  {
    public function __construct()
        { parent::__construct(
            'widget_mini_slider',
            'Mini slider',
            array( 'description' => 'Widget que contiene un mini slider' )
          );
        }
    public function form( $instance )
      {
        $category = isset($instance['category']) ? $instance['category'] : '';
        $select = get_select_categories($this->get_field_name('category'),$category);
        $title = isset($instance['title']) ? $instance['title'] : 'Falta (título)';
        $count = isset($instance['count']) ? $instance['count'] : 0;
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
          <p>
            <label>#items a mostrar</label>
            <input type="text" name="<?php echo $this->get_field_name('count'); ?>" value="<?php echo $count;?>" class="widefat">
          </p>
        <?php
      }
    public function widget( $args, $ins )
      { 
      	$title = (isset($ins['title'])) ? esc_html($ins['title']) : 'Falta (título)' ;
        $count = (isset($ins['count'])) ? $ins['count'] : 0;
        $cat=$ins['category'];
        $init= 0;
        ?>
      <div class="col-md-6 padding-20-b padding-20-t">
        <p class="background-blue-flat text-center padding-15-t padding-15-b ">
          <a href="<?php echo get_category_link($cat);?>" class="text-center bold font-white text-shadow-min size-16 uppercase">
           <?php echo $title;?>
          </a>
        </p>

        <div id="<?php echo $this->id;?>" class="carousel slide" data-ride="carousel">
          <ol class="carousel-indicators">
            <?php
            while ($init < $count ){
              $active = ($init==0) ? 'active' : '' ;
              echo '<li data-target="#'.$this->id.'" data-slide-to="'.$init.'" class="'.$active.'"></li>';
              $init++;
            }
            $init=0;
            ?>
          </ol>
          <div class="carousel-inner" role="listbox">
            <?php 
              $params = array(
              'numberposts' => $count,
              'showposts'   => $count,
              //'post__in'    => get_option( 'sticky_posts'),
              'category'    => $ins['category'],
              'orderby'     => 'ID',
              'order'       => 'DESC',
              'post_status' => 'publish');
              $query = get_posts($params);
              foreach ($query as $bp):
                setup_postdata( $bp );
                $image=get_the_post_thumbnail( $bp->ID, 'small_slider',array('class'=>'img-responsive','title'=>$bp->post_title));
                $active = ($init==0) ? 'active' : '' ;
              ?>
                <div class="item <?php echo $active;?>">
                  <?php echo $image;?>
                  <div class="carousel-caption">
                     <p class="background-blue-opacity padding-15">
                      <a href="<?php echo get_permalink($bp->ID);?>">
                        <?php echo excerpt(16);?>
                      </a>
                    </p>
                  </div>
                </div>
              <?php
              $init++;
              endforeach;
              wp_reset_postdata();
            ?>

          </div>
          <a class="left carousel-control" href="#<?php echo $this->id;?>" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="right carousel-control" href="#<?php echo $this->id;?>" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
      </div>
        <?php
      }
  }
  add_action( 'widgets_init', create_function('', 'return register_widget("widget_mini_slider");') );
?>