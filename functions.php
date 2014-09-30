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

	function my_rewrite_flush(){
		flush_rewrite_rules();
	}
	//add_action( 'after_switch_theme', 'klgwow_flush_rewrite_rules' );

	
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
	
	register_post_type('ptd_movie',array(
										'labels'=>array(
											'name'=>__('Movies','klgwow'),
											'singular_name'=>__('Movie','klgwow')
											),
										'public'=>true,
										'has_archive'=>true,
										)
	);
    */
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

function klg_post_types(){
	$types = array(
			'klg_staff'=>array(
				'menu_title'=>'Staff',
				'plural'=>'People',
				'single'=>'Person',
				'supports'=>array('title','editor','excerpt','thumbnail','author','page-attributes'),
				'slug'=>'staff'),
			'klg_menu'=>array(
				'menu_title'=>'Menu',
				'plural'=>'Items',
				'singular'=>'Item',
				'supports'=>array('title','editor','excerpt','thumbnail','author','page-attributes'),
				'slug'=>'menu')
		);
	$counter = 0;
	foreach ($types as $type => $arg) {
		# code...
		$labels = array(
			'name'=>$arg['menu_title'],
			'singular_name'=>$arg['singular'],
			'add_new'=>'Add new',
			'add_new_item'=>'Add new'.strtolower($arg['singular']),
			'edit_item'=>'Edit'.strtolower($arg['singular']),
			'new_item'=>'New '.strtolower($arg['singular']),
			'all_items'=>'All '.strtolower($arg['plural']),
			'view_item'=>'View '.strtolower($arg['plural']),
			'search_items'=>'Search '.strtolower($arg['plural']),
			'not_found'=>'No '.strtolower($arg['plural']). 'found',
			'not_found_in_trash'=>'No '.strtolower($arg['plural']).'found in trash',
			'parent_item_colon'=>'',
			'menu_name'=>$arg['menu_title']
			);

		register_post_type($type,array(
			'labels'=>$labels,
			'public'=>true,
			'has_archive'=>true,
			'capability_type'=>'post',
			'supports'=>$arg['supports'],
			'rewrite'=>array('slug'=>$arg['slug']),
			'menu_position'=>(20 + $counter),
			));
		$counter++;
	}
}
// add_action('init','klg_post_types');
/**
function klgwow_updated_messages($messages) {
	global $post, $post_ID;
	$types = array(
		'klg_staff'=>'Person',
		'klg_menu'=>'Item',);

	foreach ($types as $type => $title) {
		$messages[$type] = array(
			0 => "",
			1 => sprintf(__('%s updated. <a href="%s">View %s</a>'),$title,esc_url(get_permalink($post_ID)),$title),
			2 => __('Custom field updated.'),
			3 => __('Custom field deleted.'),
			4 => __(strtolower($title).'updated.'),
			5 => isset($_GET['revision']) ? sprintf(__('%s restored to revision from %s'),$title,wp_post_revision_title((int)$_GET['revision'],false)):false,
			6 => sprintf(__('%s published. <a href="%s"> View %s </a>'),$title, esc_url(get_permalink($post_ID)),strtolower($title)),
			7 => __($title.' saved.'),
			8 => sprintf(__('%s submitted. <a target="_blank" href="%s">Preview %s </a>'),$title,esc_url( add_query_arg('preview','true',get_permalink( $post_ID ))),strtolower($title)),
			9 => sprintf(__('%s scheduled for: <strong>%2$s</strong>. <a target="_blank" href="%3$s">Preview %1$s</a>'),$title,date_i18n(__('M j,Y @G:i'),strtolower($post->post_date)),esc_url(get_permalink( $post_ID ))),
			10 => sprintf(__('%s draft update. <a target="_blank" href="%s">Preview %s </a>'),$title, esc_url(add_query_arg('preview','true',get_permalink( $post_ID))),strtolower($title)),
			);
	}
	return $messages
}
*/
//add_filter('post_updated_messages','klgwow_updated_messages');


function klg_custom_columns($cols){
	$cols = array(
		'cb' => '<input type="checkbox"/>',
		'title' => __('Title','klgwow'),
		'photo' => __('Thumbnail','klgwow'),
		'date' => __('Date','klgwow'),
		);
		return $cols;
}

//add_filter("manage_klg_staff_post_columns","klg_custom_columns");
//add_filter("manage_klg_menu_posts_columns","klg_custom_columns");

function klgwow_custom_column_content($column, $post_id){
	switch ($column) {
		case "photo":
			if (has_post_thumbnail( $post_id )) {
				# code...
				echo get_the_post_thumbnail( $post_id, array(50,50) );
			}
			break;
		
		default:
			# code...
			break;
	}
}
//add_action( "manage_klg_staff_post_custom_columns", "klgwow_custom_column_content", $priority = 10, $accepted_args = 2 );
//add_action( "manage_klg_menu_post_custom_columns", "klgwow_custom_column_content", $priority = 10, $accepted_args = 2 );


 ?>