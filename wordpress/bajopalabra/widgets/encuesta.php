<?php
class widget_encuesta extends WP_Widget
  {
    public function __construct()
        { parent::__construct(
            'widget_encuesta',
            'Encuesta',
            array( 'description' => 'Widget que contiene una encuesta' )
          );
        }
    public function form( $instance )
      {
        $title = isset($instance['title']) ? $instance['title'] : 'Sondeo';
        $code = isset($instance['code']) ? $instance['code'] : '';
        ?>
          <p>
            <label>
              Titulo del widget
            </label>
            <input type="text" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title;?>" class="widefat">
          </p>
          <p>
            <label>Encuesta</label>
            <input type="text" name="<?php echo $this->get_field_name('code'); ?>" value="<?php echo esc_html($code);?>" class="widefat">
          </p>
        <?php
      }
    public function widget( $args, $ins )
      { 
      	$title = (isset($ins['title'])) ? esc_html($ins['title']) : 'Sondeo' ;
        $code = (isset($ins['code'])) ? ($ins['code']) :'';
        ?>
<div class="col-md-3 ">
        <div class="col-md-12 background-green-cian">
          <p class=" text-center padding-15-t  border-bottom-blue">
            <a href="" class="font-blue text-center bold font-white text-shadow-min size-16 uppercase OpenSans">
              <?php echo $title;?>
            </a>
          </p>
          <?php echo do_shortcode($code);?>
          <!--<p class="Arvo text-shadow-mini font-black size-16 text-center">
            ¿Crees que existen condiciones para que se realicen elecciones seguras el 7 de junio en Guerrero?
          </p>
          <p class="border-bottom-red border-bottom-size-2 padding-20-t padding-20-b">
            <label class="radio-inline">
              <input type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1"> No, el clima de violencia que impera podria afectar el proceso
            </label>
          </p>
          <p class="border-bottom-red border-bottom-size-2 padding-20-t padding-20-b">
            <label class="radio-inline">
              <input type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1"> Si, el calendario electoral no debe sufrir modifciaciones
            </label>
          </p>
          <p>
            <label class="radio-inline">
              <input type="radio" name="inlineRadioOptions padding-20-t padding-20-b" id="inlineRadio1" value="option1"> Ayer me comí una manzana
            </label>
          </p>
          <p class=" text-center padding-20-t padding-20-b">
              <a href="" class="btn btn-flat-lg btn-flat-red uppercase OpenSans bold">Votar</a>
          </p>-->
        </div>
      </div>
        <?php
      }
  }
  add_action( 'widgets_init', create_function('', 'return register_widget("widget_encuesta");') );
?>