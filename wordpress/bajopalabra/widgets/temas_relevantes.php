<?php
class widget_temas_relevantes extends WP_Widget
  {
    public function __construct()
        { parent::__construct(
            'widget_temas_relevantes',
            'Temas relevantes',
            array( 'description' => 'Widget que contiene categorias de los temas más relevantes' )
          );
        }
    public function form( $instance )
      {
        $category = isset($instance['category']) ? $instance['category'] : '';
        $size   = isset($instance['size']) ? $instance['size'] : 'col-md-12';
        $select = get_select_categories($this->get_field_name('category'),$category);
        $title = isset($instance['title']) ? $instance['title'] : 'Temas relevantes';
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
        <?php
      }
    public function widget( $args, $ins )
      { 
        ?>
          <div class="container-fluid temas-relevantes padding-20-b">
                <div class="row height-50 background-blue">
                  <div class="col-md-2">
                    <div class="row uppercase triangulo-azul-rojo bold Arvo">
                        Temas relevantes
                      </div>
                  </div>
                  <div class="col-md-10 Arvo">
                    <a href="" class="col-md-2">Ayotzinapa</a>
                <a href="" class="col-md-2">Turismo</a>
                    <a href="" class="col-md-2">CETEG</a>
                <a href="" class="col-md-2">Semana Santa</a>
                    <a href="" class="col-md-2">Chilpancingo</a>
                    <a href="" class="col-md-2">Rogelio Ortega</a>
              </div>
                </div>
          </div>
        <?php
      }

  }
add_action( 'widgets_init', create_function('', 'return register_widget("widget_temas_relevantes");') );
?>