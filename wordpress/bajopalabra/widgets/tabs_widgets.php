<?php
class widget_tabs_content extends WP_Widget
  {
    public function __construct()
        { parent::__construct(
            'widget_tabs_content',
            'Tabs',
            array( 'description' => 'Widget que contiene informacion por tabs' )
          );
        }
    public function form( $instance )
      {
        $category = isset($instance['category']) ? $instance['category'] : '';
        $select = get_select_categories($this->get_field_name('category'),$category);
        $title = isset($instance['title']) ? $instance['title'] : 'Falta (título)';
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

        /*
  $youtube   = get_post_meta($id, 'youtube_url', true);
            $youtubeid = getYoutubeID($youtube);
        */
        ?>
      <div class="col-md-9 padding-20-b padding-20-t">
        <p class="background-blue-flat text-center padding-15-t padding-15-b no-p">
          <a href="<?php echo get_category_link($cat);?>" class="text-center bold font-white text-shadow-min size-16 uppercase">
            <?php echo $title;?>
          </a>
        </p>
        <div class="col-md-12 background-blue-flat">
          <ul id="myTab_<?php echo $this->id;?>_slipsum" class="nav nav-tabs no-radius" role="tablist">
            <?php 
              $a=0;
              foreach ($categories as $c):
                $active = ($a==0) ? "active" : "" ;
                $expand = ($a==0) ? "true" : "false" ;
                ?>
                <li role="presentation" class="<?php echo $active;?>">
                  <a href="#<?php echo $this->id.'_'.$c->cat_ID;?>" id="<?php echo $this->id.'_'.$c->cat_ID;?>_tab" role="tab" data-toggle="tab" aria-controls="<?php echo $this->id.'_'.$c->cat_ID;?>" aria-expanded="<?php echo $expand;?>">
                    <?php echo $c->name;?>
                  </a>
                </li>
              <?php
              $a++;
              endforeach;
            ?>
          </ul>
        </div>
        <div id="myTabContent_<?php echo $this->id;?>_slipsum" class="tab-content col-md-12 padding-15-t padding-15-b">

            <?php 
              $b=0;
              foreach ($categories as $cat):
                $contar=0;
                $active = ($b==0) ? "active in" : "" ;
                $expand = ($b==0) ? "true" : "false" ;
                ?>
                <div role="tabpanel" class="tab-pane fade <?php echo $active;?> row" id="<?php echo $this->id.'_'.$cat->cat_ID;?>" aria-labelledby="<?php echo $this->id.'_'.$cat->cat_ID;?>_tab">
                    <?php
                      $params = array(
                      'numberposts' => $count,
                      'showposts'   => $count,
                      //'post__in'    => get_option( 'sticky_posts'),
                      'category'    => $cat->cat_ID,
                      'orderby'     => 'ID',
                      'order'       => 'DESC',
                      'post_status' => 'publish');
                      $query = get_posts($params);
                      $contar=0;
                      $uno="";
                      $dos="";
                      foreach ($query as $bp):
                        setup_postdata($bp);
                        $youtube   = get_post_meta($bp->ID, 'youtube_url', true);
                        $youtubeid = getYoutubeID($youtube);
                        $thumb=retrive_youtube_thumbs($youtubeid);
                        $image=get_the_post_thumbnail( $bp->ID, 'small_slider',array('class'=>'img-responsive','title'=>$bp->post_title));
                        
                        if($contar==0):
                          if(!$youtubeid):
                              $uno=$image;
                            else:
                              $uno='<div class="embed-responsive embed-responsive-16by9">
                                      <iframe class="embed-responsive-item" src="//www.youtube.com/embed/'.$youtubeid.'?rel=0" allowfullscreen=""></iframe>
                                    </div>';
                              endif;
                          $uno=$uno.'<p class="no-p">
                                      <span class="glyphicon glyphicon-time" aria-hidden="true"></span>
                                      <span class="font-gray-flat">'.get_the_date('H:i // d-m-y').'</span>
                                    </p>
                                    <p>
                                      <a href="'.get_permalink($bp->ID).'" class="uppercase size-20 bold line-height">'.$bp->post_title.'</a>
                                    </p>
                                    <p class="OpenSans size-16">
                                      '.excerpt(16).'
                                    </p>';

                          else:
                            $dos.='<div class="col-md-6">
                                      <a href="'.get_permalink($bp->ID).'"><img src="'.$thumb[5].'" class="img-responsive"></a>
                                      <p class="padding-10-t">
                                        <span class="glyphicon glyphicon-time" aria-hidden="true"></span>
                                        <span class="font-gray-flat">'.get_the_date('H:i // d-m-y').'</span>
                                      </p>
                                      <p>
                                        <a href="'.get_permalink($bp->ID).'" class="size-16 bold line-height line-height-10">'.$bp->post_title.'</a>
                                      </p>
                                  </div>';
                            endif;
                        $contar++;
                      endforeach;
                      $contar=0;
                      echo '<div class="row"><div class="col-md-6">'.$uno.'</div>';
                      echo '<div class="col-md-6"><div class="row">'.$dos.'</div></div></div>';
                      $uno="";
                      $dos="";
                      wp_reset_postdata();
                    ?>
                </div>
              <?php

              $b++;
              endforeach;
            ?>
  
          </div>
      </div>
        <?php
      }
  }
  add_action( 'widgets_init', create_function('', 'return register_widget("widget_tabs_content");') );
?>