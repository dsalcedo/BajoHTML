<?php
class Widget_block_news extends WP_Widget
  {
    
    public function __construct()
        { parent::__construct(
            'Widget_block_news',
            'Portada de noticias #1',
            array( 'description' => 'Widget que contiene bloque de noticias' )
          );
        }
    public function form( $instance )
      {
        $rk1 = isset($instance['portada_rank1']) ? $instance['portada_rank1'] : '';
        $rk2 = isset($instance['portada_rank2']) ? $instance['portada_rank2'] : '';
        $rk3 = isset($instance['portada_rank3']) ? $instance['portada_rank3'] : '';
        $rk4 = isset($instance['portada_rank4']) ? $instance['portada_rank4'] : '';
        $rk5 = isset($instance['portada_rank5']) ? $instance['portada_rank5'] : '';
        $rk6 = isset($instance['mundo']) ? $instance['mundo'] : '';
        $rk7 = isset($instance['suave_patria']) ? $instance['suave_patria'] : '';

        $title = isset($instance['title']) ? $instance['title'] : 'Temas relevantes';
        
        $rank1 = get_select_categories($this->get_field_name('portada_rank1'),$rk1);
        $rank2 = get_select_categories($this->get_field_name('portada_rank2'),$rk2);
        $rank3 = get_select_categories($this->get_field_name('portada_rank3'),$rk3);
        $rank4 = get_select_categories($this->get_field_name('portada_rank4'),$rk4);
        $rank5 = get_select_categories($this->get_field_name('portada_rank5'),$rk5);
        $mundo = get_select_categories($this->get_field_name('mundo'),$rk6);
        $suave = get_select_categories($this->get_field_name('suave_patria'),$rk7);
        ?>
          <p>
            <label>
              Título
            </label>
            <input type="text" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title;?>" class="widefat">
          </p>

          <p>
            <label>Rank #1</label>
            <?php echo $rank1; ?>
          </p>
          <p>
            <label>Rank #2</label>
            <?php echo $rank2; ?>
          </p>
          <p>
            <label>Rank #3</label>
            <?php echo $rank3; ?>
          </p>
          <p>
            <label>Rank #4</label>
            <?php echo $rank4; ?>
          </p>
          <p>
            <label>Rank #5</label>
            <?php echo $rank5; ?>
          </p>
          <p>
            <label>Mundo</label>
            <?php echo $mundo; ?>
          </p>
          <p>
            <label>Suave Patria</label>
            <?php echo $suave; ?>
          </p>
        <?php
      }
    public function widget( $args, $ins )
      { 
        function first_rank_portada($act)
          {
            $params = array(
            'numberposts' => 4,
            'showposts'   => 4,
            'post__in'    => get_option( 'sticky_posts'),
            'category'    => $act,
            'orderby'     => 'ID',
            'order'       => 'DESC',
            'post_status' => 'publish');
            $query = get_posts($params);
            $x=0;
            $first_post_image="";
            $first_content="";
            $second_content="";
            foreach ( $query as $bp ) :
              setup_postdata($bp);

              if($x==0):
              $first_post_image='<a href="'.get_permalink($bp->ID).'">'.get_the_post_thumbnail( $bp->ID, 'big_left_img',array('class'=>'img-responsive','title'=>$bp->post_title)).'</a>';
              $first_content='<div class="col-md-12 Arvo padding-10-t bottom-orange right-orange left-orange">
                                        <p>
                                          <a href="'.get_permalink($bp->ID).'" class="Arvo uppercase size-30 bold line-height">
                                            '.$bp->post_title.'
                                          </a>
                                        </p>
                                        <p>
                                          <span class="glyphicon glyphicon-time" aria-hidden="true"></span>
                                          <span class="font-gray-flat">'.get_the_date('H:i // d-m-y').'</span>
                                        </p>
                                        <p class="OpenSans size-16">
                                          '.excerpt(16).'
                                        </p>
                                      </div>';
              else:
                $second_content.='<div class="col-md-12 Arvo padding-10-t bottom-orange right-orange left-orange">
                                  <p>
                                    <a href="'.get_permalink($bp->ID).'" class="Arvo uppercase size-20 bold line-height">
                                      '.$bp->post_title.'
                                    </a>
                                  </p>
                                </div>';
              endif;
              $x++;
            endforeach;
            wp_reset_postdata();
            echo '<div class="col-md-4">
                    <div class="row">
                       '.$first_post_image.'
                    </div>
                  </div>
                  <div class="col-md-8 top-orange padding-20-b">
                    <div class="row">
                      '.$first_content.'
                      '.$second_content.'
                    </div>
                  </div>';
          }
        function second_rank_portada($act)
          {
            $params = array(
            'numberposts' => 1,
            'showposts'   => 1,
            'post__in'    => get_option( 'sticky_posts'),
            'category'    => $act,
            'orderby'     => 'ID',
            'order'       => 'DESC',
            'post_status' => 'publish');
            $query = get_posts($params);
            foreach ( $query as $bp ) :
              setup_postdata( $bp );
              $image='<a href="'.get_permalink($bp->ID).'">'.get_the_post_thumbnail( $bp->ID, 'single_post',array('class'=>'img-responsive','title'=>$bp->post_title)).'</a>';
                  echo '<div class="col-md-12 padding-10-t padding-5-b bottom-orange">
                                              <div class="col-md-3 ">
                                                <div class="row">
                                                  '.$image.'
                                                </div>
                                              </div>
                                              <div class="col-md-9">
                                                <p class="uppercase OpenSans no-p"><a href="'.get_category_link($act).'" class="font-red bold">'.get_cat_name($act).'</a></p>
                                                <p>
                                                  <a href="'.get_permalink($bp->ID).'" class="Arvo uppercase size-20 bold line-height">'.$bp->post_title.'</a>
                                                </p>
                                                <p>
                                                  <span class="glyphicon glyphicon-time" aria-hidden="true"></span>
                                                  <span class="font-gray-flat">'.get_the_date('H:i // d-m-y').'</span>
                                                </p>
                                                <p class="OpenSans size-16">
                                                  '.excerpt(16).'
                                                </p>
                                              </div>
                                            </div>';
            endforeach;
            wp_reset_postdata();
          }
        function suave_patria($act)
          {
            $params = array(
            'numberposts' => 7,
            'showposts'   => 7,
            //'post__in'    => get_option( 'sticky_posts'),
            'category'    => $act,
            'orderby'     => 'ID',
            'order'       => 'DESC',
            'post_status' => 'publish');
            $query = get_posts($params);
            $link=get_category_link($act);
            foreach ($query as $bp):
              setup_postdata( $bp );
              $subcategoria=get_categories("child_of=$act");
              //<p class=" bold OpenSans no-p"><a href="'.get_category_link($act).'" class="font-red uppercase">'.get_cat_name($act).'</a></p>
              echo '<div class="col-md-12 bottom-orange">
                      <p class=" bold OpenSans no-p"><a href="'.get_category_link($act).'" class="font-red uppercase">'.$subcategoria[0]->name.'</a></p>
                      <p class="padding-5-t no-p">
                        <span class="glyphicon glyphicon-time" aria-hidden="true"></span>
                        <span class="font-gray-flat">'.get_the_date('H:i // d-m-y').'</span>
                      </p>
                      <p class="padding-5-t">
                        <a href="'.get_permalink($bp->ID).'" class="size-20 bold line-height-10">'.$bp->post_title.'</a>
                      </p>
                    </div>';

            endforeach;
            wp_reset_postdata();
            echo '<div class="col-md-12 text-center padding-15-t padding-15-b">
                    <a href="'.$link.'" class="btn btn-flat-lg btn-flat-red uppercase OpenSans bold">Ver más</a>
                  </div>';
          }
        function mundo_loop($act)
          {
            $params = array(
            'numberposts' => 4,
            'showposts'   => 4,
            //'post__in'    => get_option( 'sticky_posts'),
            'category'    => $act,
            'orderby'     => 'ID',
            'order'       => 'DESC',
            'post_status' => 'publish');
            $query = get_posts($params);
            $link=get_category_link($act);
            foreach ($query as $bp):
              setup_postdata( $bp );
              $image='<a href="'.get_permalink($bp->ID).'">'.get_the_post_thumbnail( $bp->ID, 'single_post',array('class'=>'img-responsive','title'=>$bp->post_title)).'</a>';
              //<p class=" bold OpenSans no-p"><a href="'.get_category_link($act).'" class="font-red uppercase">'.get_cat_name($act).'</a></p>
              echo '<div class="col-md-3">
                       '.$image.'
                        <p class="padding-10-t">
                          <span class="glyphicon glyphicon-time" aria-hidden="true"></span>
                          <span class="font-gray-flat">'.get_the_date('H:i // d-m-y').'</span>
                        </p>
                        <p>
                          <a href="'.get_permalink($bp->ID).'" class="Arvo size-16 bold line-height line-height-10">'.$bp->post_title.'</a>
                        </p>
                    </div>';

            endforeach;
            wp_reset_postdata();
            echo '<div class="col-md-12 text-center padding-15-t padding-15-b">
                    <a href="'.$link.'" class="btn btn-flat-lg btn-flat-red uppercase OpenSans bold">Ver más</a>
                  </div>';
          }
        echo '<div class="col-md-8 right-orange margin-top-20">';
          if(isset($ins['portada_rank1'])){
            echo '<div class="col-md-12 padding-20-b">
                    <div class="row">'.
                      first_rank_portada($ins['portada_rank1']).'
                    </div>
                  </div>';
          }
          
          if(isset($ins['portada_rank2'])){
            second_rank_portada($ins['portada_rank2']);
          }
          
          if(isset($ins['portada_rank3'])){
            second_rank_portada($ins['portada_rank3']);
          }
    
          if(isset($ins['portada_rank4'])){
            second_rank_portada($ins['portada_rank4']);
          }
   
          if(isset($ins['portada_rank5'])){
            second_rank_portada($ins['portada_rank5']);
          }
          echo '<div class="col-md-12 text-center padding-15-t padding-15-b">
                  <a href="" class="btn btn-flat-lg btn-flat-red uppercase OpenSans bold">Ver más</a>
                </div>';
          echo '<p class="uppercase bold text-center size-20 border-bottom-brown padding-5-b col-md-12">Mundo</p>';
          echo '<div class="col-md-12">
                  <div class="row">';
                    if(isset($ins['mundo'])){
                      mundo_loop($ins['mundo']);
                    }
          echo    '</div>
                </div>';
        echo "</div>";
?>


<div class="col-md-4 margin-top-20">
        <!-- ads -->
        <img src="http://paquetes.bluebayresorts.com/_lib/bluebmx/img/Banner1.jpg" class="img-responsive padding-20-b">
        <img src="assets/img/dummy/burguer.jpg" class="img-responsive">
        <!-- end ads-->
        <!--suave patria-->
        <div class="row">
          <div class="col-md-12">
            <p class="font-green border-bottom-green text-center padding-15-t padding-10-b bold uppercase size-20">¿Suave patria?</p>
            <?php 
              if(isset($ins['suave_patria'])){
                suave_patria($ins['suave_patria']);
              }
            ?> 
          </div>
        </div>

        <!-- end suave patria -->
      </div>      
        <?php
      }

  }
add_action( 'widgets_init', create_function('', 'return register_widget("Widget_block_news");') );
?>