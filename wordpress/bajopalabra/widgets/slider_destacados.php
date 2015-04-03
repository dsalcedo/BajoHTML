<?php
class widget_slider_destacados extends WP_Widget
  {
    public function __construct()
        { parent::__construct(
            'widget_slider_destacados',
            'Slider destacados',
            array( 'description' => 'Widget que contiene muestra un slider con noticias destacadas' )
          );
        }
    public function form( $instance )
      {
        $category = isset($instance['category']) ? $instance['category'] : '';
        $size   = isset($instance['size']) ? $instance['size'] : 'col-md-12';
        $select = get_select_categories($this->get_field_name('category'),$category);
        $title = isset($instance['title']) ? $instance['title'] : 'Temas relevantes';
        $count  = isset($instance['count']) ? $instance['count'] : 4;
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
        $params = array(
                  'numberposts' => $ins['count'],
                  'category'    => $ins['category'],
                  'orderby'     => 'ID',
                  'order'       => 'DESC',
                  'post_status' => 'publish',
                  'post_type'        => 'post',
                  );
        $res = get_posts($params);
        $con = count($res);
        $con = $con-1;
        ?>
          <div class="custom-container padding-20-7">
<div class="col-md-12">
        <div id="<?php echo $this->id;?>" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        <?php
        $x=0;
        while($x <=$con) {
          $act = ($x==0) ? 'active' : '';
            echo '<li data-target="#'.$this->id.'" data-slide-to="'.$x.'" class="'.$act.'"></li>';
          $x++;
        }  
        ?>
      </ol>
      <div class="carousel-inner" role="listbox">
<?php 
  $y=0;
  foreach ( $res as $bp ) : setup_postdata( $bp );
  $act = ($y==0) ? 'active' : '';
  $category = get_the_category($bp->ID);

     ?>
    <div class="item <?php echo $act;?>">
       <?php echo get_the_post_thumbnail( $bp->ID, 'destacados_slider',array('class' => "img-responsive") ); ?> 
              <div class="header-carousel">
              <div class="col-md-2">
                <span class="category-note uppercase bold font-white">
                  <a href="<?php echo get_category_link($category[0]->term_id);?>"><?php echo $category[0]->name;?></a>
                </span>
              </div>
              <div class="col-md-8">
                <h3 class="no-top font-white text-shadow Arvo font-weight-700 size-30 uppercase text-left">
                  <a href="<?php echo get_permalink($bp->ID);?>"><?php echo $bp->post_title;?></a>
                </h3>
              </div>
            </div>
            <div class="carousel-caption">
              <p class="background-blue-opacity padding-15"><?php echo excerpt(25); ?></p>
            </div>
    </div>
    <?php $y++;
  endforeach; 
  wp_reset_postdata();
?>
      <a class="left carousel-control ctrl" href="#<?php echo $this->id;?>" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="right carousel-control ctrl" href="#<?php echo $this->id;?>" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
      </div>
          </div>
        <?php
      }

  }
add_action( 'widgets_init', create_function('', 'return register_widget("widget_slider_destacados");') );
?>