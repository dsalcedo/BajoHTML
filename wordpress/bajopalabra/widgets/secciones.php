<?php
class widget_secciones extends WP_Widget
  {
    public function __construct()
        { parent::__construct(
            'widget_secciones',
            'Secciones',
            array( 'description' => 'Widget que contiene secciones' )
          );
        }
    public function form( $instance )
      {
        $colores=array('Elige','green-flat','dark-blue','lucite');
        $category1 = isset($instance['verde']) ? $instance['verde'] : '';
        $category2 = isset($instance['azul']) ? $instance['azul'] : '';
        $category3 = isset($instance['turquesa']) ? $instance['turquesa'] : '';
        
        $verde = get_select_categories($this->get_field_name('verde'),$category1);
        $azul = get_select_categories($this->get_field_name('azul'),$category2);
        $turquesa = get_select_categories($this->get_field_name('turquesa'),$category3);

        $title = isset($instance['title']) ? $instance['title'] : 'Falta (título)';
        ?>
          <p>
            <label>
              Titulo del widget
            </label>
            <input type="text" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title;?>" class="widefat">
          </p>
          <p>
            <label>Categoria seccion verde</label>
            <p><?php echo $verde; ?></p>
          </p>
          <p>
            <label>Categoria seccion azul</label>
            <p><?php echo $azul; ?></p>
          </p>
          <p>
            <label>Categoria seccion turquesa</label>
            <p><?php echo $turquesa; ?></p>
          </p>
  
        <?php
      }
    public function widget( $args, $ins )
      { 
      	$title = (isset($ins['title'])) ? esc_html($ins['title']) : 'Falta (título)' ;
        $verde = (isset($ins['verde'])) ? ($ins['verde']) : '' ;
        $azul = (isset($ins['azul'])) ? ($ins['azul']) : '' ;
        $turquesa = (isset($ins['turquesa'])) ? ($ins['turquesa']) : '' ;

        /*
  $youtube   = get_post_meta($id, 'youtube_url', true);
            $youtubeid = getYoutubeID($youtube);
        */
        ?>

        <div class="col-md-12">
          <div class="row">
            <div class="col-md-12">
              <p class="Montserrat background-blue-flat no-p h40 text-center bold font-white text-shadow-min size-16 uppercase">
                <?php echo $title;?>
              </p>
            </div>

            <div class="col-md-12">
              <p class="Montserrat text-center font-green-flat border-bottom-green-flat uppercase bold size-20 padding-5-b padding-20-t">
                <?php echo get_cat_name($verde);?>
              </p>
              <div class="row">
                <?php
                  $params = array(
                        'numberposts' => 3,
                        'showposts'   => 3,
                        'category'    => $verde,
                        'orderby'     => 'ID',
                        'order'       => 'DESC',
                        'post_status' => 'publish');
                        $query = get_posts($params);
                        $a=0;
                        foreach ($query as $bp):
                          setup_postdata($bp);
                          if($a==0):
                            $md='col-md-6';
                            $image='<a href="'.get_permalink($bp->ID).'">'.get_the_post_thumbnail( $bp->ID, 'seccion',array('class'=>'img-responsive','title'=>$bp->post_title)).'</a>';
                            else:
                              $md='col-md-3';
                              $image='<a href="'.get_permalink($bp->ID).'">'.get_the_post_thumbnail( $bp->ID, 'seccion_box',array('class'=>'img-responsive','title'=>$bp->post_title)).'</a>';
                              endif;?>
                          <div class="<?php echo $md;?>">
                           <?php echo $image;?>
                            <p class="Arvo background-green-sec text-center padding-15-t padding-15-b size-20 ">
                              <a href="<?php echo get_permalink($bp->ID);?>" class="font-white bold">
                                <?php echo $bp->post_title;?>
                              </a>
                            </p>
                          </div>
                  <?php $a++;
                        endforeach;
                        wp_reset_postdata();
                ?>
              </div>
            </div>

            <!-- azul -->
            <div class="col-md-6">
             <p class="Montserrat text-center font-dark-blue border-bottom-dark-blue uppercase bold size-20 padding-5-b padding-20-t">
              <?php echo get_cat_name($azul);?>
            </p>
            <div class="row">
              <?php
                  $params = array(
                        'numberposts' => 3,
                        'showposts'   => 3,
                        'category'    => $azul,
                        'orderby'     => 'ID',
                        'order'       => 'DESC',
                        'post_status' => 'publish');
                        $query = get_posts($params);
                        $a=0;
                        foreach ($query as $bp):
                          setup_postdata($bp);
                          if($a==0):
                            $md='col-md-12';
                            $image='<a href="'.get_permalink($bp->ID).'">'.get_the_post_thumbnail( $bp->ID, 'seccion',array('class'=>'img-responsive','title'=>$bp->post_title)).'</a>';
                            else:
                              $md='col-md-6';
                              $image='<a href="'.get_permalink($bp->ID).'">'.get_the_post_thumbnail( $bp->ID, 'seccion_box',array('class'=>'img-responsive','title'=>$bp->post_title)).'</a>';
                              endif;?>
                          <div class="<?php echo $md;?>">
                           <?php echo $image;?>
                            <p class="Arvo background-dark-blue text-center padding-15-t padding-15-b size-20 ">
                              <a href="<?php echo get_permalink($bp->ID);?>" class="font-white bold">
                                <?php echo $bp->post_title;?>
                              </a>
                            </p>
                          </div>
                  <?php $a++;
                        endforeach;
                        wp_reset_postdata();
                ?>
            </div>
          </div>
          <!--turquesa-->
          <div class="col-md-6">
             <p class="Montserrat text-center font-lucite border-bottom-lucite uppercase bold size-20 padding-5-b padding-20-t">
              <?php echo get_cat_name($turquesa);?>
            </p>
            <div class="row">
              <?php
                  $params = array(
                        'numberposts' => 3,
                        'showposts'   => 3,
                        'category'    => $turquesa,
                        'orderby'     => 'ID',
                        'order'       => 'DESC',
                        'post_status' => 'publish');
                        $query = get_posts($params);
                        $a=0;
                        foreach ($query as $bp):
                          setup_postdata($bp);
                          if($a==0):
                            $md='col-md-12';
                            $image='<a href="'.get_permalink($bp->ID).'">'.get_the_post_thumbnail( $bp->ID, 'seccion',array('class'=>'img-responsive','title'=>$bp->post_title)).'</a>';
                            else:
                              $md='col-md-6';
                              $image='<a href="'.get_permalink($bp->ID).'">'.get_the_post_thumbnail( $bp->ID, 'seccion_box',array('class'=>'img-responsive','title'=>$bp->post_title)).'</a>';
                              endif;
                          ?>
                          <div class="<?php echo $md;?>">
                           <?php echo $image;?>
                            <p class="Arvo background-lucite text-center padding-15-t padding-15-b size-20 ">
                              <a href="<?php echo get_permalink($bp->ID);?>" class="font-white bold">
                                <?php echo $bp->post_title;?>
                              </a>
                            </p>
                          </div>
                  <?php $a++;
                        endforeach;
                        wp_reset_postdata();
                ?>
            </div>
          </div>
        </div>
      </div>
        <?php
      }
  }
  add_action( 'widgets_init', create_function('', 'return register_widget("widget_secciones");') );