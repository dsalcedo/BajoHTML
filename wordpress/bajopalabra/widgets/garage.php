<?php
class widget_garage extends WP_Widget
  {
    public function __construct()
        { parent::__construct(
            'widget_garage',
            'Garage',
            array( 'description' => 'Widget que post en garage' )
          );
        }
    public function form( $instance )
      {
        $category = isset($instance['category']) ? $instance['category'] : '';
        $select = get_select_categories($this->get_field_name('category'),$category);
        $title = isset($instance['title']) ? $instance['title'] : 'Garage';
        $count = isset($instance['count']) ? $instance['count'] : 3;
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
        $count = isset($instance['count']) ? $instance['count'] : 3;
        $cat=$ins['category'];
        $init= 0;
        $categories =  get_categories('hide_empty=0&parent='.$cat);


        ?>
 <div class="col-md-12">
        <p class="background-red text-center padding-15-t padding-15-b no-p">
            <a href="" class="Montserrat text-center bold font-white text-shadow-min size-16 uppercase">
              Garage
            </a>
        </p>
        <div class="col-md-12 background-red">
            <ul id="myTab" class="nav nav-tabs element-responsive no-radius" role="tablist">
              <li role="presentation" class=""><a href="#home" id="home-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="false">Home</a></li>
              <li role="presentation" class="active"><a href="#home" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile" aria-expanded="true">Profile</a></li>
              <li role="presentation" class="dropdown">
                <a href="#" id="myTabDrop1" class="dropdown-toggle" data-toggle="dropdown" aria-controls="myTabDrop1-contents">Dropdown <span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu" aria-labelledby="myTabDrop1" id="myTabDrop1-contents">
                  <li><a href="#dropdown1" tabindex="-1" role="tab" id="home" data-toggle="tab" aria-controls="dropdown1">@fat</a></li>
                  <li><a href="#dropdown2" tabindex="-1" role="tab" id="home" data-toggle="tab" aria-controls="dropdown2">@mdo</a></li>
                </ul>
              </li>
            </ul>
          </div>
          <div id="myTabContent" class="tab-content col-md-12  background-red padding-15-b">
            <div class="row ">
              <div role="tabpanel" class="tab-pane fade active in col-md-12 " id="home" aria-labelledby="home-tab">
                <div class="col-md-12 background-white padding-15-t ">
                  <div class="row">
                    <div class="col-md-2">
                      <a href="">
                        <img src="assets/img/dummy/burguer.jpg" class="img-responsive padding-5-t">
                      </a>
                      <p class="OpenSans bold">Se Vende</p>
                      <p class="OpenSans">Chevy 2006 color rojo único dueño equipado</p>
                    </div>
                    <div class="col-md-2">
                      <a href="">
                        <img src="assets/img/dummy/burguer.jpg" class="img-responsive padding-5-t">
                      </a>
                      <p class="OpenSans bold">Se Vende</p>
                      <p class="OpenSans">Chevy 2006 color rojo único dueño equipado</p>
                    </div>
                    <div class="col-md-2">
                      <a href="">
                        <img src="assets/img/dummy/burguer.jpg" class="img-responsive padding-5-t">
                      </a>
                      <p class="OpenSans bold">Se Vende</p>
                      <p class="OpenSans">Chevy 2006 color rojo único dueño equipado</p>
                    </div>
                    <div class="col-md-2">
                      <a href="">
                        <img src="assets/img/dummy/burguer.jpg" class="img-responsive padding-5-t">
                      </a>
                      <p class="OpenSans bold">Se Vende</p>
                      <p class="OpenSans">Chevy 2006 color rojo único dueño equipado</p>
                    </div>
                    <div class="col-md-2">
                      <a href="">
                        <img src="assets/img/dummy/burguer.jpg" class="img-responsive padding-5-t">
                      </a>
                      <p class="OpenSans bold">Se Vende</p>
                      <p class="OpenSans">Chevy 2006 color rojo único dueño equipado</p>
                    </div>
                    <div class="col-md-2">
                      <a href="">
                        <img src="assets/img/dummy/burguer.jpg" class="img-responsive padding-5-t">
                      </a>
                      <p class="OpenSans bold">Se Vende</p>
                      <p class="OpenSans">Chevy 2006 color rojo único dueño equipado</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
      </div>
        <?php
      }
  }
  add_action( 'widgets_init', create_function('', 'return register_widget("widget_garage");') );
?>