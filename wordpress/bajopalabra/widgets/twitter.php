<?php 
 function twitter_function_widget(){ echo '<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?\'http\':\'https\';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>';}
        
class Widget_twitter extends WP_Widget
{

  public function __construct()
  {
    parent::__construct(
      'twitter_widget_pg',
      'Twitter widget',
      array( 'description' => 'Bloque sin descripcion' )
    );
  }

  public function widget( $args, $instance )
  {
    $twitter_widget_name=esc_html($instance['twitter_widget_name']);
    $twitter_widget_id=esc_html($instance['twitter_widget_id']);
    $twitter_screen_name=esc_html($instance['twitter_screen_name']);
    $twitter_widget_height=esc_html($instance['twitter_widget_height']);
    $size_widget=esc_html($instance['size_widget']);

   ?>
    <div class="col-md-4 padding-20-t" >
      <p class="background-blue-flat no-p h40 text-center bold font-white text-shadow-min size-16 uppercase">twitter</p>
      <a class="twitter-timeline col-md-12" href="https://twitter.com/search?q=<?php echo $twitter_screen_name;?>" data-widget-id="<?php echo $twitter_widget_id;?>">Tweets sobre <?php echo $twitter_screen_name;?></a>
    </div>
<?php
    add_action('wp_footer','twitter_function_widget');
  }
  public function form( $instance )
  {
    $twitter_widget_name   = isset($instance['twitter_widget_name']) ? $instance['twitter_widget_name'] : '';
    $twitter_widget_id     = isset($instance['twitter_widget_id']) ? $instance['twitter_widget_id'] : '';
    $twitter_screen_name   = isset($instance['twitter_screen_name']) ? $instance['twitter_screen_name'] : '';
    $twitter_widget_height = isset($instance['twitter_widget_height']) ? $instance['twitter_widget_height'] : '';
    $size_widget = isset($instance['size_widget']) ? $instance['size_widget'] : 'col-md-12';
?>
  <p>
    <label>Titulo del widget</label>
    <input type="text" name="<?php echo $this->get_field_name('twitter_widget_name'); ?>" id="<?php echo $this->get_field_id('twitter_widget_name'); ?>" value="<?php echo esc_attr( $twitter_widget_name ); ?>" class="widefat" />
  </p>
  <p>
    <label>Twitter Widget ID:</label>
    <input type="text" name="<?php echo $this->get_field_name('twitter_widget_id'); ?>" id="<?php echo $this->get_field_id('twitter_widget_id'); ?>" value="<?php echo esc_attr( $twitter_widget_id ); ?>" class="widefat" />
  </p>
  <p>
    <label>Twitter Screen Name:</label>
    <input type="text" name="<?php echo $this->get_field_name('twitter_screen_name'); ?>" id="<?php echo $this->get_field_id('twitter_screen_name'); ?>" value="<?php echo esc_attr( $twitter_screen_name ); ?>" class="widefat" />
  </p>
  <p>
    <label>Twitter Widget Height:</label>
    <input type="text" name="<?php echo $this->get_field_name('twitter_widget_height'); ?>" id="<?php echo $this->get_field_id('twitter_widget_height'); ?>" value="<?php echo esc_attr( $twitter_widget_height ); ?>" class="widefat" />
  </p>
  <p>
    <label>Tamaño del widget</label>
      <select name="<?php echo $this->get_field_name('size_widget'); ?>" id="<?php echo $this->get_field_id('size_widget'); ?>"  class="widefat">
        <option value="col-md-1" <?php echo ($size_widget=='col-md-1')? 'selected':''; ?>>1 columna</option>
        <option value="col-md-2" <?php echo ($size_widget=='col-md-2')? 'selected':''; ?>>2 columnas</option>
        <option value="col-md-3" <?php echo ($size_widget=='col-md-3')? 'selected':''; ?>>3 columnas</option>
        <option value="col-md-4" <?php echo ($size_widget=='col-md-4')? 'selected':''; ?>>4 columnas</option>
        <option value="col-md-5" <?php echo ($size_widget=='col-md-5')? 'selected':''; ?>>5 columnas</option>
        <option value="col-md-6" <?php echo ($size_widget=='col-md-6')? 'selected':''; ?>>6 columnas</option>
        <option value="col-md-7" <?php echo ($size_widget=='col-md-7')? 'selected':''; ?>>7 columnas</option>
        <option value="col-md-8" <?php echo ($size_widget=='col-md-8')? 'selected':''; ?>>8 columnas</option>
        <option value="col-md-9" <?php echo ($size_widget=='col-md-9')? 'selected':''; ?>>9 columnas</option>
        <option value="col-md-10" <?php echo ($size_widget=='col-md-10')? 'selected':''; ?>>10 columnas</option>
        <option value="col-md-11" <?php echo ($size_widget=='col-md-11')? 'selected':''; ?>>11 columnas</option>
        <option value="col-md-12" <?php echo ($size_widget=='col-md-12')? 'selected':''; ?>>12 columnas</option>
      </select>
  </p>
<?php
  }
} 
add_action( 'widgets_init', create_function('', 'return register_widget("Widget_twitter");') );