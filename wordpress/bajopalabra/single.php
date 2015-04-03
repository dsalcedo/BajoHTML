<?php
	get_header(); 
		// Start the loop.
		while ( have_posts() ) : the_post();
			get_template_part('templates/content', get_post_format());
		endwhile;
		// End the loop.
	get_footer(); 
?>