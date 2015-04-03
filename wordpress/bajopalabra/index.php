<?php get_header(); ?>
	<div class="container-fluid padding-20-b">
		<div class="row">
			<?php if ( !function_exists('dynamic_sidebar')|| !dynamic_sidebar('Home_Page') ) : ?>
				Este es el HOMEPAGE
			<?php endif; ?>
		</div>
	</div>
	
<?php get_footer(); ?>