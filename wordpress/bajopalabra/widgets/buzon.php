<?php
class widget_buzon extends WP_Widget
  {
    public function __construct()
        { parent::__construct(
            'widget_buzon',
            'Buzon',
            array( 'description' => 'Widget que contiene el buzón' )
          );
        }
    public function form( $instance )
      {
        $category = isset($instance['category']) ? $instance['category'] : '';
        $select = get_select_categories($this->get_field_name('category'),$category);
        $title = isset($instance['title']) ? $instance['title'] : 'Memeando';
        ?>
          <p>
            Este widget es de buzom, falta programar
          </p>
        <?php
      }
    public function widget( $args, $ins )
      { 
      	$title = (isset($ins['title'])) ? esc_html($ins['title']) : 'Memeando' ;
        ?>
		<div class="col-md-4">
<div class="col-md-12 background-blue">
              <p class="border-bottom-white no-p h40 text-center bold font-white text-shadow-min size-16 uppercase ">buzon</p>
            </div>
<div class="background-blue h300 col-md-12">
              <p class="font-white padding-5-t padding-5-b">Envianos tus quejas, denuncias y sugerencias</p>
              <form class="app-form">
                <div class="row">
                  <div class="col-md-12">
                    <div class="row">
                      <div class="col-md-8">
                        <div class="form-group">
                          <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Nombre">
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-8">
                    <div class="form-group">
                      <input type="email" class="form-control" id="exampleInputPassword1" placeholder="Correo electrónico">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <input type="submit" class="btn btn-default col-md-12" value="enviar">
                    </div>
                  </div>
                  <div class="col-md-12">
                      <textarea class="form-control" rows="3"></textarea>
                  </div>
                </div>
              </form>
              <div class="row buzon">
                <div class="col-md-12 buzon-int background-white">
                  <div class="col-md-4">
                    <img data-src="holder.js/80x80" class="img-rounded" alt="140x140" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iMTQwIiBoZWlnaHQ9IjE0MCIgdmlld0JveD0iMCAwIDE0MCAxNDAiIHByZXNlcnZlQXNwZWN0UmF0aW89Im5vbmUiPjxkZWZzLz48cmVjdCB3aWR0aD0iMTQwIiBoZWlnaHQ9IjE0MCIgZmlsbD0iI0VFRUVFRSIvPjxnPjx0ZXh0IHg9IjQ0LjA0Njg3NSIgeT0iNzAiIHN0eWxlPSJmaWxsOiNBQUFBQUE7Zm9udC13ZWlnaHQ6Ym9sZDtmb250LWZhbWlseTpBcmlhbCwgSGVsdmV0aWNhLCBPcGVuIFNhbnMsIHNhbnMtc2VyaWYsIG1vbm9zcGFjZTtmb250LXNpemU6MTBwdDtkb21pbmFudC1iYXNlbGluZTpjZW50cmFsIj4xNDB4MTQwPC90ZXh0PjwvZz48L3N2Zz4=" data-holder-rendered="true" style="width: 80px; height: 80px;">
                  </div>
                  <div class="col-md-8">
                    <div class="row">
                      <p class="font-red no-p">De: lorem ipsum</p>
                      <p class="no-p">se necesita su apoyo para ozalizarlo</p>
                    </div>
                  </div>
                  
                  
                </div>
              </div>
            </div>
          <p class="background-blue text-center padding-15-t padding-15-b">
              <a href="" class="btn btn-flat-lg btn-flat-red uppercase OpenSans bold">Ver más cartones</a>
            </p>
      </div>
        <?php
      }
  }
add_action( 'widgets_init', create_function('', 'return register_widget("widget_buzon");') );
?>