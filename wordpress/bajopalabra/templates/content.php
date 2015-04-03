<div class="container single-content">


<div class="col-md-10 right-orange">
<?php
    wpb_set_post_views(get_the_ID());
    //echo wpb_get_post_views(get_the_ID());

	$youtube   = get_post_meta($post->ID, 'youtube_url', true);
    $youtubeid = getYoutubeID($youtube);
    $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'feature_post' );
    $image = $thumb['0'];
    
    $category=get_the_category( $post->ID);
    $cat_id= $category[0]->cat_ID;
    //get_cat_name($act)
    if($youtubeid):?>
		<div class="embed-responsive embed-responsive-16by9">
        	<iframe class="embed-responsive-item" src="//www.youtube.com/embed/<?php echo $youtubeid;?>?rel=0" allowfullscreen=""></iframe>
		</div>
<?php
    else:
    	//echo get_the_post_thumbnail( $post->ID, 'feature_post',array('class' => "img-responsive") );	
	endif;
?>
<style type="text/css">
.header-data{
    width: 100%;
    position: absolute;
    top: 20px;
    left: 0px;
    color: #fff;
}
.header-data a{
    color: #fff;
}
 .urun-text {
    position: absolute;
    background-color: rgba(93, 119, 153, 0.93);
    color: #fff;
    bottom: 0px;
    text-align: left;
    padding: 20px 15px 20px 15px;
    width:100%;
}
.the-box {
    display:block;
    position:relative;
    width: 100%;
    max-height: 500px;
}
.the-box img{
    max-height: 500px;
}
.blue-cian{
    color:#0DBFF4;
}
</style>
<h1 class="uppercase Arvo font-blue bold OpenSans"><?php the_title();?></h1>
<p>
    <span class="glyphicon glyphicon-time" aria-hidden="true"></span>
    <span class="font-gray-flat"><?php echo get_the_date('H:i // d-m-y');?></span>
</p>
<p>
    <?php if(function_exists('bcn_display'))
    {
        bcn_display();
    }?>
</p>
<div class="the-box">
    <img src="<?php echo $image;?>" alt="Yeni Ürünler" class="align-center img-responsive">
    <div class="header-data">
        <div class="col-md-6">
            <span class="category-note uppercase bold font-white">
                <a href="<?php echo get_category_link($cat_id);?>"><?php echo $category[0]->name;?></a>
            </span>
        </div>
    </div>
    <div class="urun-text"><?php echo get_post(get_post_thumbnail_id())->post_excerpt;?></div>

</div>


<div class="row padding-20-t">
    <div class="col-md-9"><?php the_content();?></div>
    <div class="col-md-3">
        <p class="uppercase bold blue-cian">Notas relacionadas</p>
<?php
//for use in the loop, list 5 post titles related to first tag on current post
    $tags = wp_get_post_tags($post->ID);
    if ($tags) {
        $first_tag = $tags[0]->term_id;
        $arg=array(
            'tag__in' => array($first_tag),
            'post__not_in' => array($post->ID),
            'posts_per_page'=>6,
            'ignore_sticky_posts'=>0
            );
        $the_query = get_posts($arg);
        foreach ($the_query as $qq):
            setup_postdata($qq);
?>
            <p>
                <a href="<?php echo get_permalink($qq->ID); ?>"><?php echo $qq->post_title; ?></a>
            <p>
<?php
        endforeach;
        wp_reset_query();
    }
// end
?>
    </div>
</div>
<div class="col-md-12">
    <div class="row">
        <p class="uppercase text-center bold" style="border-bottom:5px solid rgb(115, 52, 52); color:rgb(115, 52, 52);padding-bottom:10px;padding-top:20px;">
            Lo más relevante
        </p>
    </div>
    <div class="row">
        <?php
            $arg=array(
                'post__not_in' => array($post->ID),
                'exclude' =>array($post->ID),
                'posts_per_page'=>4,
                'meta_key' => 'wpb_post_views_count',
                'orderby' => 'meta_value_num',
                'order' => 'DESC' 
                );
            $popularpost = get_posts($arg);


            foreach ($popularpost as $y):
                setup_postdata($y);
        ?>
        <div class="col-md-3">
            <!-- post thumbnail -->
            <?php if ( has_post_thumbnail($y->ID)) : // Check if thumbnail exists?>
                <a href="<?php echo get_permalink($y->ID); ?>">
                    <?php echo get_the_post_thumbnail($y->ID,'single_post',array('class'=>'img-responsive')); ?>
                </a>
            <?php endif; ?>
            <!-- /post thumbnail -->
            <p>
                <span class="glyphicon glyphicon-time" aria-hidden="true"></span>
                <span class="font-gray-flat"><?php echo get_the_date('H:i // d-m-y',$y->ID);?></span>
            </p>
            <p>
                <a href="<?php echo get_permalink($y->ID); ?>" class="Arvo">
                    <?php echo $y->post_title;?>
                </a>
            </p> 
        </div>
        
        <?php
            endforeach;
            wp_reset_query();
        ?>
    </div>
</div>
<div class="col-md-12 padding-10-t">
    <div class="row">
        <?php comments_template(); ?>
    </div>
</div>
</div>
<div class="col-md-2">
    <?php if ( !function_exists('dynamic_sidebar')|| !dynamic_sidebar('Interior_de_notas') ) : ?>
        Sidebar interior de notas
    <?php endif; ?>
</div>



</div>