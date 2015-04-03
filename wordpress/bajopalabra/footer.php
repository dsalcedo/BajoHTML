	<footer class="footer background-white top-blue">
		<div class="container">
			<?php
	            wp_nav_menu( array(
	                'menu'              => 'primary',
	                'theme_location'    => 'footer',
	                'depth'             => 2,
	                'container'         => 'div',
	                'container_class'   => 'collapse navbar-collapse navigacija',
	                'container_id'      => 'bs-example-navbar-collapse-1',
	                'menu_class'        => 'nav navbar-nav col-md-12',
	                'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
	                'items_wrap'      => '<ul id="%1$s" class="nav navbar-nav col-md-12 menu">%3$s</ul>',
	                'walker'            => new wp_bootstrap_navwalker())
	            );
     		?>
		</div>
	</footer>
	<?php wp_footer(); ?>
	<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/plugins/weather/jquery.simpleWeather.min.js"></script>
	<script type="text/javascript">
		jQuery(document).ready(function() {
		  var meses = new Array ("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
		  var diasSemana = new Array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
		  var f=new Date();
		  var fecha=diasSemana[f.getDay()] + ", " + f.getDate() + " de " + meses[f.getMonth()] + " de " + f.getFullYear();

		  jQuery.simpleWeather({
		    location: 'Chilpancingo guerrero, MX',
		    woeid: '',
		    unit: 'c',
		    success: function(weather) {
		      html = '<h2 style="margin-bottom:0px;margin-top:0px;"><span class="w-deg">'+weather.temp+'&deg;'+weather.units.temp+'</span> <i class="icon-'+weather.code+'"></i></h2>';
		      html += '<ul class="w-list"><li>'+weather.city+' '+weather.region+'</li>';
		      html += '<li>'+fecha+'</li>';
		      html += '</ul>';
		      jQuery("#weather").html(html);
		    },
		    error: function(error) {
		      jQuery("#weather").html('<p>'+error+'</p>');
		    }
		  });
		});
		</script>
	<script type="text/javascript">
	/*$(document).ready( function() {
    $('#myCarousel').carousel({
		interval:   false
	});
	
	var clickEvent = false;
	$('#widget_rudos_y_tecnicos-4').on('click', '.nav a', function() {
			clickEvent = true;
			$('.nav li').removeClass('active');
			$(this).parent().addClass('active');		
	}).on('slid.bs.carousel', function(e) {
		if(!clickEvent) {
			var count = $('.nav').children().length -1;
			var current = $('.nav li.active');
			current.removeClass('active').next().addClass('active');
			var id = parseInt(current.data('slide-to'));
			if(count == id) {
				$('.nav li').first().addClass('active');	
			}
		}
		clickEvent = false;
	});
});*/
	</script>
	</body>
</html>