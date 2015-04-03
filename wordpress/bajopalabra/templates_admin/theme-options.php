<?php
wp_enqueue_media();
$active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'display_options';
    $logo_top    = (get_option("theme_top_logo")) ? get_option("theme_top_logo") : "http://" ;
    $logo_bottom = (get_option("theme_footer_logo")) ? get_option("theme_footer_logo") : "http://" ;

    $twitter   = (get_option("theme_twitter_acc")) ? esc_url(get_option("theme_twitter_acc")) : "" ;
    $facebook  = (get_option("theme_facebook_acc")) ? esc_url(get_option("theme_facebook_acc")) : "" ;
    $youtube   = (get_option("theme_youtube_acc")) ? esc_url(get_option("theme_youtube_acc")) : "" ;
    $direccion = (get_option("theme_direccion")) ? esc_attr(get_option("theme_direccion")) : "" ;
    $atencion_ciudadana = (get_option("theme_atencion_ciudadana")) ? esc_attr(get_option("theme_atencion_ciudadana")) : "01 800 000 7422" ;
    $emergencias = (get_option("theme_emergencias")) ? esc_attr(get_option("theme_emergencias")) : "066" ;
    $denuncia = (get_option("theme_denuncia")) ? esc_attr(get_option("theme_denuncia")) : "089" ;
    $contacto = (get_option("theme_contacto")) ? esc_attr(get_option("theme_contacto")) : "contacto@guerrero.gob.mx" ;

    
    //$facebook = (get_option("theme_facebook_acc")) ? esc_url(get_option("theme_facebook_acc")) : "" ;
    //$youtube  = (get_option("theme_youtube_acc")) ? esc_url(get_option("theme_youtube_acc")) : "" ;
?>
<style type="text/css">
.bg-success {
background-color: #dff0d8;
padding: 10px;
font-size: 16px;
}
</style>
    <div class="wrap">
<h1>Bajo Palabra - configuración</h1>
<h2 class="nav-tab-wrapper">
    <a href="?page=bajo-palabra-theme-admin&tab=display_options" class="nav-tab <?php echo $active_tab == 'display_options' ? 'nav-tab-active' : ''; ?>">Display Options</a>
    <a href="?page=bajo-palabra-theme-admin&tab=homepage_website" class="nav-tab <?php echo $active_tab == 'homepage_website' ? 'nav-tab-active' : ''; ?>">Homepage</a>
    <a href="?page=bajo-palabra-theme-admin&tab=banners" class="nav-tab <?php echo $active_tab == 'banners' ? 'nav-tab-active' : ''; ?>">Banners</a>
</h2>

<?php
include('tpls/'.$active_tab.'.php');
?>


    </div>
<?php



function m1_customize_register( $wp_customize ) {
    $wp_customize->add_setting( 'm1_logo' ); // Add setting for logo uploader
         
    // Add control for logo uploader (actual uploader)
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'm1_logo', array(
        'label'    => __( 'Upload Logo (replaces text)', 'm1' ),
        'section'  => 'title_tagline',
        'settings' => 'm1_logo',
    ) ) );
}
add_action( 'customize_register', 'm1_customize_register' );

?>




<script type="text/javascript">
jQuery(document).ready(function($){
 
 
    var custom_uploader, to;     
    $('.upload_image_theme').click(function(e) {        
        var id=this.id;
        var selector='#'+id;
        to=id;
        if (custom_uploader) {
            custom_uploader.open();
            return;
        }
        console.log(wp);
 
        custom_uploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose Image',
            button: {
                text: 'Choose Image'
            },
            multiple: false
        });
 
        custom_uploader.on('select', function() {
            attachment = custom_uploader.state().get('selection').first().toJSON();
            $('#src_'+to).val(attachment.url);
            var img= "<img src='"+attachment.url+"'>";
            $("#preview_".to).append(img);
            id=null,selector=null;
        });
 
        custom_uploader.open();
        e.preventDefault();

    });
});
</script>