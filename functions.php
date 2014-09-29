<?php 
/**
 * Kaos Latin Gamers WOW Function Definition
 * 
 * @package klgwow
 */

if (!function_exists('klgwow_setup')):
	function klgwow_setup(){
		/** 
		 * Add default post and coments RSS feed Links to head
		 */
		add_theme_support('automatic-feed-links');
		/** Enable support for Post Shumbnails
		 */
		add_theme_support( 'post-thumbnails' );
		/** This theme uses wp_nav_menu() in one location
		*/
		register_nav_menus(array('primary'=>__( 'MainMenu', 'klg_started' ),));
		/** Enable support for Post Formats
		*/
		add_theme_support('post-formats',array('aside','image','video','quote','link'));
		
	}
	endif; // klgwow_setup
	add_action('after_setup_theme','klgwow_setup');

	
	function simple_copyright(){
		echo "&copy; ". get_bloginfo('name')." ".date("Y");
	}

	/**
	 * Enqueue scripts and styles
	 */
	function klgwow_scripts_and_styles(){
		wp_enqueue_style('style',get_stylesheet_uri());
		/**
		* Better jQuery inclusion
		*/
		if(!is_admin()){
			wp_deregister_script( 'jquery' );
			wp_register_script('jquery',("http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"),false);
			wp_enqueue_script('jquery');
		}
		
	}
	add_action('wp_enqueue_scripts','klgwow_scripts_and_styles');

	/** Custom Post Type Example__
	*/
	register_post_type('ptd_movie',array(
										'labels'=>array(
											'name'=>__('Movies','klgwow'),
											'singular_name'=>__('Movie','klgwow')
											),
										'public'=>true,
										'has_archive'=>true,
										)
	);
	// Register Player KLG
	
function register_klg_players() {

	$labels = array(
		'name'                => _x( 'Jugadores', 'Post Type General Name', 'traslation' ),
		'singular_name'       => _x( 'Jugador', 'Post Type Singular Name', 'traslation' ),
		'menu_name'           => __( 'Jugadores', 'traslation' ),
		'parent_item_colon'   => __( 'Parent Item:', 'traslation' ),
		'all_items'           => __( 'Jugadores', 'traslation' ),
		'view_item'           => __( 'Ver jugador', 'traslation' ),
		'add_new_item'        => __( 'Añadir nuevo jugador', 'traslation' ),
		'add_new'             => __( 'Añadir nuevo jugador', 'traslation' ),
		'edit_item'           => __( 'Editar jugador', 'traslation' ),
		'update_item'         => __( 'Jugador actualizado', 'traslation' ),
		'search_items'        => __( 'Buscar jugadores', 'traslation' ),
		'not_found'           => __( 'Jugador no encontrado', 'traslation' ),
		'not_found_in_trash'  => __( 'Jugador no encontrado en la papelera', 'traslation' ),
	);
	$rewrite = array(
		'slug'                => 'players',
		'with_front'          => true,
		'pages'               => true,
		'feeds'               => true,
	);
	$args = array(
		'label'               => __( 'klg_players', 'traslation' ),
		'description'         => __( 'Jugadores de Wow KLG', 'traslation' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'thumbnail', 'custom-fields', ),
		'taxonomies'          => array( 'category', 'post_tag' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'menu_icon'           => 'http://i.imgur.com/qZ83rda.png',
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'rewrite'             => $rewrite,
		'capability_type'     => 'post',
	);
	register_post_type( 'klg_players', $args );

}

// Hook into the 'init' action
add_action( 'init', 'register_klg_players', 0 );
	
 ?>