<?php
class widget_memeando extends WP_Widget
  {
    public function __construct()
        { parent::__construct(
            'widget_memeando',
            'Memeando',
            array( 'description' => 'Widget que contiene el meme' )
          );
        }
    public function form( $instance )
      {
        $category = isset($instance['category']) ? $instance['category'] : '';
        $select = get_select_categories($this->get_field_name('category'),$category);
        $title = isset($instance['title']) ? $instance['title'] : 'Memeando';
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
      	$title = (isset($ins['title'])) ? esc_html($ins['title']) : 'Memeando' ;
        ?>
		<div class="col-md-4">
        	<p class="background-blue-flat no-p h40 text-center bold font-white text-shadow-min size-16 uppercase">
        		<?php echo $title; ?>
        	</p>
        	<?php
	        	$params = array(
	            'numberposts' => 1,
	            'showposts'   => 1,
	            //'post__in'    => get_option( 'sticky_posts'),
	            'category'    => $ins['category'],
	            'orderby'     => 'ID',
	            'order'       => 'DESC',
	            'post_status' => 'publish');
	            $query = get_posts($params);
	            foreach ($query as $bp):
	            	$image='<a href="'.get_permalink($bp->ID).'">'.get_the_post_thumbnail( $bp->ID, 'single_box',array('class'=>'img-responsive','title'=>$bp->post_title)).'</a>';
                setup_postdata( $bp );
                echo $image;
				      endforeach;
				      wp_reset_postdata();
        	?>
        <p class="background-blue-flat text-center padding-15-t padding-15-b">
          <a href="<?php echo get_category_link($ins['category']);?>" class="btn btn-flat-lg btn-flat-red uppercase OpenSans bold">Ver más cartones</a>
        </p>
      </div>
        <?php
      }
  }
add_action( 'widgets_init', create_function('', 'return register_widget("widget_memeando");') );
?>