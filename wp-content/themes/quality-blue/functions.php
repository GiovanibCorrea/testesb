<?php 
add_action( 'wp_enqueue_scripts', 'qualityblue_enqueue_styles', 9999 );
function qualityblue_enqueue_styles() {
    wp_enqueue_style('bootstrap', QUALITY_TEMPLATE_DIR_URI . '/css/bootstrap.css');
	wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
	wp_enqueue_style( 'child-style',get_stylesheet_directory_uri() . '/style.css',array('parent-style'));
	wp_enqueue_style('theme-menu', QUALITY_TEMPLATE_DIR_URI . '/css/theme-menu.css');
}

add_action( 'after_setup_theme', 'qualityblue_setup' );
function qualityblue_setup()
{	
		load_theme_textdomain( 'quality-blue', get_stylesheet_directory() . '/languages' );
		require( get_stylesheet_directory() . '/functions/customizer/customizer-copyright.php' );
}


function quality_blue_default_data(){
	return array(
	// general settings
	'footer_copyright_text' => '<p>'.__( '<a href="https://wordpress.org">Proudly powered by WordPress</a> | Theme: <a href="https://webriti.com" rel="designer">Quality Blue</a> by Webriti', 'quality-blue' ).'</p>',
	);
}

add_action( 'customize_register', 'quality_blue_remove_custom', 1000 );
function quality_blue_remove_custom($wp_customize) {
 $wp_customize->remove_section( 'theme_color' );
}
?>