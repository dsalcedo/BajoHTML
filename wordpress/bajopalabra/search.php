<?php get_header(); ?>
<style type="text/css">
input[type="text"], textarea {
  background-color : #F5F5F5; 
}
.gray-flat{
	color: #8B8B8B;
}
</style>
<div class="container">
	<div class="col-md-9 right-orange">
		<h4 class="uppercase Arvo font-blue bold col-md-12">
			Resultados de búsqueda
		</h4>
		<form method="get"  action="<?php echo home_url( '/' ); ?>" class="col-md-12">
        	<div class="input-group">
            	<input type="text" class="form-control" name="s" value="<?php echo esc_html(get_search_query());?>" placeholder="Search for...">
                <span class="input-group-btn">
					<input type="submit" class="btn btn-danger"  value="BUSCAR">
				</span>
			</div><!-- /input-group -->
        </form>
        <h4 class="col-md-12 font-16">
        	<?php echo "<b>".get_search_query()."</b> - "; echo sprintf( __( '%s resultados encontrados' ), $wp_query->found_posts ); ?>
        </h4>

        <?php if (have_posts()): ?>
			<div class="col-md-12" style="border-bottom:4px solid #d7d7d7;">
				<?php if ($wp_query->max_num_pages>1):  ?>
					<span class="pull-left uppercase gray-flat">Mostrando <?php echo  $wp_query->post_count;?> de <?php echo $wp_query->found_posts; ?> resultados</span>
					<div class="pull-right"><?php  wpc_pagination();?></div>
				<?php endif; ?>
			</div>
        <?php while (have_posts()) : the_post(); ?>
        	<div class="col-md-12" style="border-bottom:2px solid #d7d7d7;padding-bottom:15px;padding-top:15px">
        		<div class="row">
        			<div class="col-md-4">
        				<div class="row">
							<!-- post thumbnail -->
							<?php if ( has_post_thumbnail()) : // Check if thumbnail exists?>
								<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
									<?php the_post_thumbnail('single_post',array('class'=>'img-responsive')); ?>
								</a>
							<?php endif; ?>
							<!-- /post thumbnail -->
						</div>
        			</div>
        			<div class="col-md-8">
        				<p>
        					<a href="<?php the_permalink(); ?>" class="uppercase Arvo bold" title="<?php the_title(); ?>"><?php the_title(); ?></a>
        				</p>
        				<p>
							<span class="glyphicon glyphicon-time" aria-hidden="true"></span>
                            <span class="font-gray-flat"><?php echo get_the_date('H:i // d-m-y');?></span>
						</p>
        				<p class="OpenSans size-16">
        					<?php echo excerpt(30); //custom callback length in functions.php ?>
        				</p>
        			</div>
        		</div>
        	</div>
		<?php endwhile; 
		else:
			echo "<h3 class='col-md-12 text-center'>Lo sentimos, no hay resultados de búsqueda :(</h3>";
		endif;?>
		<div class="col-md-12">
			<div class="row">
				<?php if ( !function_exists('dynamic_sidebar')|| !dynamic_sidebar('Footer_search') ) : ?>
					<span>Este es el sidebar "<b>FOOTER_SEARCH</b>"</span>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<div class="col-md-3"></div>
</div>
<?php get_footer(); ?>