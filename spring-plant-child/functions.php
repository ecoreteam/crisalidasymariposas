<?php
add_action( 'wp_enqueue_scripts', 'spring_plant_child_theme_enqueue_styles', 1000 );
function spring_plant_child_theme_enqueue_styles() {
    wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array( 'spring-plant-main' ) );
}

add_action( 'after_setup_theme', 'spring_plant_child_theme_setup');
function spring_plant_child_theme_setup(){
    $language_path = get_stylesheet_directory() .'/languages';
    if(is_dir($language_path)){
        load_child_theme_textdomain('spring-plant', $language_path );
    }
}
// if you want to add some custom function




/* Cambiar el texto SKU en WooCommerce por otra palabra
*/

add_filter('gettext', 'change_sku', 999, 3);

function change_sku( $translated_text, $text, $domain ) {
if( $text == 'SKU' || $text == 'SKU:' ) return 'Referencia';
return $translated_text;
}

/* Cambiar el texto SKU en WooCommerce por otra palabra

 
add_filter('gettext', 'change_sku', 999, 3);
 
function change_sku( $translated_text, $text, $domain ) {
    if( $text == 'SKU' || $text == 'SKU:' ) return 'REFERENCIA';
return $translated_text;
}*/

add_action( 'woocommerce_after_main_content', 'linkCuidados' );
function linkCuidados() {
echo '<div class="cuidados">
<a href="/cuidados" target="_blank">Instrucciones, garantias y recomendaciones</a>
</div>';
}



add_filter( 'woocommerce_product_tabs', 'woo_rename_tabs', 98 );
function woo_rename_tabs( $tabs ) {
  $tabs['reviews']['title'] = 'Comentarios'; 
return $tabs; 
}

//Añadimos informacion sobre producto cantidad minima
$cantidadMinima = get_field('cantidad_minima');
if( $cantidadMinima != null){
	add_action('woocommerce_product_meta_start','infoCantidadMinima' );
	function infoCantidadMinima() {
		
	    echo '<div class="cantidad__minima">'.$cantidadMinima.'</div>';
	}
}


//Añadimos boton whatsapp para mas info
add_action('woocommerce_share','botonHaztuPedido' );
function botonHaztuPedido() {
	$cantidadMinima = get_field('cantidad_minima');
    echo '<div class="haztupedido"><a href="https://web.whatsapp.com/send?phone=573105040857&text=Hola%21%21%21%20Estoy%20interesado%20en%20informaci%C3%B3n%20sobre%20Crisalidas" target="_blank"><i class="fa fa-whatsapp"></i>Haz tu pedido</a></div>';
}



