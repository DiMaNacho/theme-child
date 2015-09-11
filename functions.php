<?php

// Usar mis propios files del child (JS y CSS)
function mis_files() {
	wp_enqueue_style( 
		'le-css',
		get_stylesheet_directory_uri() .'/le-css.css',
		array()
	);

	wp_enqueue_script(
		'custom-script',
		get_stylesheet_directory_uri() .'/le-script.js',
		array( 'jquery' )
	);
}

add_action( 'wp_enqueue_scripts', 'mis_files' );

// Un custom excerpt donde cuenta letras máximas, le pone puntos suspensivos y si querés mostrás un red more.
function get_excerpt($count, $more = false){
	$permalink = get_permalink($post->ID);
	$excerpt = get_the_content();
	$excerpt = strip_tags($excerpt);
	$excerpt = substr($excerpt, 0, $count);
	$excerpt = $excerpt.'...'. ($more ? ' <a href="'.$permalink.'">more</a>' : '');
	return $excerpt;
}

// Agregar más tamaños de thumbs
if ( function_exists( 'add_theme_support' ) ) { 
	add_theme_support( 'post-thumbnails' );

	add_image_size( 'woo-products', 300, 300, true ); //300 pixels wide (and unlimited height)
}
