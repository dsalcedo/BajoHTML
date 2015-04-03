<div class="container single-content">


<div class="col-md-9">
<?php
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
.jumbotron{
    background: url(<?php echo $image;?>);
    background-size: cover;
    width: 100%;
    height: 400px;
}
.header-data{
    width: 100%;
    position: relative;
    top: 10px;
    left: -20px;
    color: #fff;
}
.header-data a{
    color: #fff;
}
</style>
<div class="jumbotron no-radius">
    <div class="header-data">
        <div class="col-md-6">
            <span class="category-note uppercase bold font-white">
                <a href="<?php echo get_category_link($cat_id);?>"><?php echo $category[0]->name;?></a>
            </span>
        </div>
    </div>
</div>
<div class="col-md-12">
	<?php if(function_exists('bcn_display'))
    {
        bcn_display();
    }?>
</div>
<div class="row">
    <div class="col-md-10"><?php the_content();?></div>
    <div class="col-md-2">
        <p>Relacionados</p>
    </div>
</div>
 <?php comments_template(); ?>
</div>
<div class="col-md-3">
    <?php if ( !function_exists('dynamic_sidebar')|| !dynamic_sidebar('Interior_de_notas') ) : ?>
        Sidebar interior de notas
    <?php endif; ?>
</div>

<div class="col-md-12">
    <?php if ( !function_exists('dynamic_sidebar')|| !dynamic_sidebar('Inferior_de_notas') ) : ?>
        Sidebar inferior de notas
    <?php endif; ?>
</div>

</div>