<?php
/**
 * Sphere International Functions
 *
 */
  	define('SPHERE_TEMPLATE_DIR',get_template_directory());
  	define('SPHERE_TEMPLATE_DIR_URI',get_template_directory_uri());
  	define('SPHERE_URI',get_site_url());
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! isset( $content_width ) ) {
	$content_width = 800; // pixels
}
add_action( 'wp_enqueue_scripts', 'sphere_enqueue_styles');
function sphere_enqueue_styles() {
	
    wp_enqueue_style('bootstrap', SPHERE_TEMPLATE_DIR_URI . '/assets/css/bootstrap.min.css');
    wp_enqueue_style('font-monia', SPHERE_TEMPLATE_DIR_URI . '/assets/css/font-monia.css');
    wp_enqueue_style('fonts', SPHERE_TEMPLATE_DIR_URI . '/assets/css/fonts.css');

}
add_action( 'wp_enqueue_scripts', 'sphere_enqueue_scripts');
function sphere_enqueue_scripts(){
	//wp_deregister_script( 'jquery' );
	wp_add_inline_script( 'jquery-migrate', 'jQuery(document).ready(function(){});' );
	//wp_enqueue_script('jquery-3.4.1','https://code.jquery.com/jquery-3.4.1.min.js',array(), false, true);
	//wp_enqueue_script('popper','https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js',array(), false, true);
	wp_enqueue_script('popper',SPHERE_TEMPLATE_DIR_URI . '/assets/js/popper.min.js',array(), false, null);
	wp_add_inline_script( 'popper', 'jQuery(document).ready(function(){});' );
	wp_enqueue_script('bootstrap',SPHERE_TEMPLATE_DIR_URI . '/assets/js/bootstrap.min.js',array(), false, null);
	//wp_enqueue_script('jquery',SPHERE_URI.'/wp-includes/js/jquery/jquery.js',array(), false, true);
	//wp_enqueue_script('jquery-migrate',SPHERE_URI.'/wp-includes/js/jquery/jquery-migrate.min.js',array(), false, true);
	wp_enqueue_script( 'jquery-mask', 'https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js', array(), false, null);
	
}
/*
 * Set up theme support
 */
if ( ! function_exists( 'elementor_hello_theme_setup' ) ) {
	function elementor_hello_theme_setup() {
		if ( apply_filters( 'elementor_hello_theme_load_textdomain', true ) ) {
			load_theme_textdomain( 'elementor-hello-theme', get_template_directory() . '/languages' );
		}

		if ( apply_filters( 'elementor_hello_theme_register_menus', true ) ) {
			register_nav_menus( array( 
				'menu-1' => __( 'Primary', 'elementor-hello-theme' ),
				'menu-footer-1' => __('Footer Segunda Coluna', 'elementor-hello-theme' ),
				'menu-footer-2' => __('Footer Terceira Coluna', 'elementor-hello-theme' )
			) );
		}

		if ( apply_filters( 'elementor_hello_theme_add_theme_support', true ) ) {
			add_theme_support( 'post-thumbnails' );
			add_theme_support( 'automatic-feed-links' );
			add_theme_support( 'title-tag' );
			add_theme_support( 'custom-logo' );
			add_theme_support( 'html5', array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			) );
			add_theme_support( 'custom-logo', array(
				'flex-height' => true,
				'flex-width' => true,
			) );

			/*
			 * WooCommerce:
			 */
			if ( apply_filters( 'elementor_hello_theme_add_woocommerce_support', true ) ) {
				// WooCommerce in general:
				add_theme_support( 'woocommerce' );
				// Enabling WooCommerce product gallery features (are off by default since WC 3.0.0):
				// zoom:
				add_theme_support( 'wc-product-gallery-zoom' );
				// lightbox:
				add_theme_support( 'wc-product-gallery-lightbox' );
				// swipe:
				add_theme_support( 'wc-product-gallery-slider' );
			}
		}
	}
}
add_action( 'after_setup_theme', 'elementor_hello_theme_setup' );

/*
 * Theme Scripts & Styles
 */
 
if ( ! function_exists( 'elementor_hello_theme_scripts_styles' ) ) {
	function elementor_hello_theme_scripts_styles() {
		if ( apply_filters( 'elementor_hello_theme_enqueue_style', true ) ) {
			wp_enqueue_style( 'elementor-hello-theme-style', get_stylesheet_uri() );
		}
	}
}
add_action( 'wp_enqueue_scripts', 'elementor_hello_theme_scripts_styles' );

/*
 * Register Elementor Locations
 */
if ( ! function_exists( 'elementor_hello_theme_register_elementor_locations' ) ) {
	function elementor_hello_theme_register_elementor_locations( $elementor_theme_manager ) {
		if ( apply_filters( 'elementor_hello_theme_register_elementor_locations', true ) ) {
			$elementor_theme_manager->register_all_core_location();
		}
	}
}
add_action( 'elementor/theme/register_locations', 'elementor_hello_theme_register_elementor_locations' );



add_action( 'init', 'unidades_post_type' );

function unidades_post_type() {
	$labels = array(
		'name'               => "Unidades",
		'singular_name'      => "Unidades",
		'menu_name'          => "Unidades",
		'name_admin_bar'     => "Unidades",
		'add_new'            => "Adicionar nova",
		'add_new_item'       => "Adicionar nova Unidade",
		'new_item'           => "Nova Unidade",
		'edit_item'          => "Editar Unidade",
		'view_item'          => "Ver Unidade",
		'all_items'          => "Todas as Unidades",
		'search_items'       => "Procurar Unidades"
	);

	$args = array(
		'labels'             => $labels,
		'description'        => __( 'Description.', 'your-plugin-textdomain' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'unidade' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'thumbnail', 'editor')
	);

	register_post_type( 'unidades', $args );
}

register_taxonomy( 'cidade', array( 'unidades' ), array(
	'hierarchical'      => false,
	'labels'            => array(
		'name'              => _x( 'Cidades', 'taxonomy general name', 'textdomain' ),
		'singular_name'     => _x( 'Cidade', 'taxonomy singular name', 'textdomain' ),
		'search_items'      => __( 'Buscar Cidade', 'textdomain' ),
		'all_items'         => __( 'Todas as Cidades', 'textdomain' ),
		'parent_item'       => __( 'Cidade', 'textdomain' ),
		'parent_item_colon' => __( 'Cidade Pai:', 'textdomain' ),
		'edit_item'         => __( 'Editar Cidades', 'textdomain' ),
		'update_item'       => __( 'Atualizar Cidades', 'textdomain' ),
		'add_new_item'      => __( 'Inserir Cidades', 'textdomain' ),
		'new_item_name'     => __( 'Nova Cidade', 'textdomain' ),
		'menu_name'         => __( 'Cidades', 'textdomain' ),
	),
	'show_ui'           => true,
	'show_admin_column' => false,
	'query_var'         => true,
	'rewrite'           => array( 'slug' => 'cidade' ),
));

register_taxonomy( 'estado', array( 'unidades' ), array(
	'hierarchical'      => false,
	'labels'            => array(
		'name'              => _x( 'Estados', 'taxonomy general name', 'textdomain' ),
		'singular_name'     => _x( 'Estado', 'taxonomy singular name', 'textdomain' ),
		'search_items'      => __( 'Buscar Estado', 'textdomain' ),
		'all_items'         => __( 'Todas Estados', 'textdomain' ),
		'parent_item'       => __( 'Estado', 'textdomain' ),
		'parent_item_colon' => __( 'Estado Pai:', 'textdomain' ),
		'edit_item'         => __( 'Editar Estados', 'textdomain' ),
		'update_item'       => __( 'Atualizar Estados', 'textdomain' ),
		'add_new_item'      => __( 'Inserir Estados', 'textdomain' ),
		'new_item_name'     => __( 'Novo Estado', 'textdomain' ),
		'menu_name'         => __( 'Estados', 'textdomain' ),
	),
	'show_ui'           => true,
	'show_admin_column' => false,
	'query_var'         => true,
	'rewrite'           => array( 'slug' => 'estado' ),
));

add_action( 'init', 'whatsup_post_type' );

function whatsup_post_type() {
	$labels = array(
		'name'               => "What's Up!",
		'singular_name'      => "What's Up!",
		'menu_name'          => "What's Up!",
		'name_admin_bar'     => "What's Up!",
		'add_new'            => "Adicionar novo",
		'add_new_item'       => "Adicionar novo What's Up!",
		'new_item'           => "Nova What's Up!",
		'edit_item'          => "Editar What's Up!",
		'view_item'          => "Ver What's Up!",
		'all_items'          => "Todos os What's Up!",
		'search_items'       => "Procurar What's Up!"
	);

	$args = array(
		'labels'             => $labels,
		'description'        => __( 'Description.', 'your-plugin-textdomain' ),
		'public'             => true,
		'publicly_queryable' => false,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'capability_type'    => 'post',
		'menu_icon'			 => "dashicons-welcome-widgets-menus",
		'has_archive'        => false,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'thumbnail')
	);

	register_post_type( 'whatsup', $args );
}



add_filter( 'upload_mimes', 'my_myme_types', 1, 1 );
function my_myme_types( $mime_types ) {

$mime_types['svg'] = 'image/svg+xml';  // Adiciona extensão .svg
$mime_types['json'] = 'application/json';  // Adiciona extensão .json
$mime_types['pdf'] = 'application/pdf';  // Adiciona extensão .pdf

unset( $mime_types['exe'] ); // Remove extensão .exe

return $mime_types;
}


class Elementor_Forms_Input_Classes {

	public $allowed_fields = [
		'text',
		'email',
		'url',
		'password',
        'select',
        'date'
	];

	public function __construct() {
		// Add class attribute to form field render
		add_filter( 'elementor_pro/forms/render/item', [ $this, 'maybe_add_css_class' ], 10, 3 );

		add_action( 'elementor/element/form/section_form_fields/before_section_end', [ $this, 'add_css_class_field_control' ], 100, 2 );
	}

	/**
	 * add_css_class_field_control
	 * @param $element
	 * @param $args
	 */
	public function add_css_class_field_control( $element, $args ) {
		$elementor = \Elementor\Plugin::instance();
		$control_data = $elementor->controls_manager->get_control_from_stack( $element->get_name(), 'form_fields' );

		if ( is_wp_error( $control_data ) ) {
			return;
		}
		// create a new css class control as a repeater field
		$tmp = new Elementor\Repeater();
		$tmp->add_control(
			'field_css_class',
			[
				'label' => 'CSS class',
				'inner_tab' => 'form_fields_advanced_tab',
				'tab' => 'content',
				'tabs_wrapper' => 'form_fields_tabs',
				'type' => 'text',
				'conditions' => [
					'terms' => [
						[
							'name' => 'field_type',
							'operator' => 'in',
							'value' => $this->allowed_fields,
						],
					],
				],
			]
		);

		$pattern_field = $tmp->get_controls();
		$pattern_field = $pattern_field['field_css_class'];

		// insert new class field in advanced tab before field ID control
		$new_order = [];
		foreach ( $control_data['fields'] as $field_key => $field ) {
			if ( 'custom_id' === $field['name'] ) {
				$new_order['field_css_class'] = $pattern_field;
			}
			$new_order[ $field_key ] = $field;
		}
		$control_data['fields'] = $new_order;

		$element->update_control( 'form_fields', $control_data );
	}

	public function maybe_add_css_class( $field, $field_index, $form_widget ) {
		if ( ! empty( $field['field_css_class'] ) && in_array( $field['field_type'], $this->allowed_fields ) ) {

			$form_widget->add_render_attribute( 'input' . $field_index, 'class', $field['field_css_class'] );
            $form_widget->add_render_attribute( 'select' . $field_index, 'class', $field['field_css_class'] );
            $form_widget->add_render_attribute( 'date' . $field_index, 'class', $field['field_css_class'] );
		}
		return $field;
	}
}
new Elementor_Forms_Input_Classes();