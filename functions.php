<?php

// Usar mis propios files del child (JS y CSS)
function mis_files() {
	// Agregar hojas de estilos del parent.
	wp_enqueue_style(
		'parent-style', 
		get_template_directory_uri() . '/style.css',
		array()
	);

	// Hoja de estilos custom (archivo le-css.css)
	// con la dependecia de "parent-style"
	wp_enqueue_style( 
		'le-css',
		get_stylesheet_directory_uri() .'/le-css.css',
		array('parent-style')
	);

	// JS custom (archivo le-script.js)
	wp_enqueue_script(
		'custom-script',
		get_stylesheet_directory_uri() .'/le-script.js',
		array( 'jquery' )
	);
}

// En vez de usar "wp_enqueue_scripts" usamos el "wp_print_styles" para forzar 
// a que cargue estos CSS al final y tengan más prioridad que los del Parent theme.
add_action( 'wp_print_styles', 'mis_files' );

// Un custom excerpt donde cuenta letras máximas, 
// le pone puntos suspensivos y si querés mostrás un red more.
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

	add_image_size( 'custom-image', 450, 140);
}

add_filter( 'image_size_names_choose', 'mis_thumbs' );
function mis_thumbs( $sizes ) {
	return array_merge( $sizes, array(
		'custom-image' => __( 'Custom: Imagen :D' )
	) );
}