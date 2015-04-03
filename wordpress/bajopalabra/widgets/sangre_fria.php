<?php
class widget_a_sangre_fria extends WP_Widget
  {
    public function __construct()
        { parent::__construct(
            'widget_a_sangre_fria',
            'A sangre fria',
            array( 'description' => 'Widget que contiene las notas relacionadas de "a sangre fría"' )
          );
        }
    public function form( $instance )
      {
        $category = isset($instance['category']) ? $instance['category'] : '';
        $select = get_select_categories($this->get_field_name('category'),$category);
        $title = isset($instance['title']) ? $instance['title'] : 'A sangre fría';
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
      	$title = (isset($ins['title'])) ? esc_html($ins['title']) : 'A sangre fría' ;
        ?>
		<div class="col-md-12">
        	<p class="text-center font-green-flat border-bottom-green-flat uppercase bold size-20 padding-5-b">
        		<?php echo $title; ?>
        	</p>
        <div class="row">
        	<?php
	        	$params = array(
	            'numberposts' => 4,
	            'showposts'   => 4,
	            //'post__in'    => get_option( 'sticky_posts'),
	            'category'    => $ins['category'],
	            'orderby'     => 'ID',
	            'order'       => 'DESC',
	            'post_status' => 'publish');
	            $query = get_posts($params);
	            foreach ($query as $bp):
	            	$image='<a href="'.get_permalink($bp->ID).'">'.get_the_post_thumbnail( $bp->ID, 'single_post',array('class'=>'img-responsive','title'=>$bp->post_title)).'</a>';
					setup_postdata( $bp );
				?>
					<div class="col-md-2">
			            <?php echo $image;?>
			            <p class="padding-10-t">
			              <span class="glyphicon glyphicon-time" aria-hidden="true"></span>
			              <span class="font-gray-flat"><?php echo get_the_date('H:i // d-m-y');?></span>
			            </p>
			            <p>
			              <a href="<?php echo get_permalink($bp->ID);?>" class="size-16 bold line-height line-height-10"><?php echo $bp->post_title;?></a>
			            </p>
			         </div>
				<?php
				endforeach;
				wp_reset_postdata();
        	?>
        </div>
        <div class="col-md-12 text-center padding-15-t padding-15-b">
          <a href="<?php echo get_category_link($ins['category']);?>" class="btn btn-flat-lg btn-flat-red uppercase OpenSans bold">Ver más</a>
        </div>
      </div>
        <?php
      }

  }
add_action( 'widgets_init', create_function('', 'return register_widget("widget_a_sangre_fria");') );

?>