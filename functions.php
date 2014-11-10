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
	 * Creates a nicely formatted and more specific title element text
	 * for output in head of document, based on current view
	 *
	 * @since Twenty Twelve 1.0
	 *
	 * @param string $title Default title text for current view.
	 * @param string $sep Optional separator.
	 * @return string Filtered title
	 */

	function twentytwelve_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() )
		return $title;

	// Add the blog name.
	$title .= get_bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'twentytwelve' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'twentytwelve_wp_title', 10, 2 );

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
		wp_enqueue_script('main_js',get_template_directory_uri() . '/js/app.js',array('jquery'),'',true);
		
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
		'label'               => __( 'klg_player', 'traslation' ),
		'description'         => __( 'Jugadores de Wow KLG', 'traslation' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'thumbnail',),
		//'taxonomies'          => array( 'category', 'post_tag' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'menu_icon'           => 'http://i.imgur.com/VevMcig.png',
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'rewrite'             => $rewrite,
		'capability_type'     => 'post',
	);
	register_post_type( 'klg_player', $args );

}

// Hook into the 'init' action
add_action( 'init', 'register_klg_players', 0 );

function klgwow_taxonomies(){
	$taxs = array(
		'klg_pj_class'=>array(
			'menu_title'=>'Character Class',
			'plural'=>'Classes',
			'singular'=>'Class',
			'hierarchical'=>true,
			'slug'=>'class',
			'post_type'=>'klg_player'),
		'klg_raid_roles'=>array(
			'menu_title'=>'Raid Roles',
			'plural'=>'Roles',
			'singular'=>'Role',
			'hierarchical'=>true,
			'slug'=>'raid-role',
			'post_type'=>'klg_player'));
	foreach ($taxs as $tax => $args) {
		$labels = array(
			'name'=>_x('Item '.$args['plural'],'taxonomy general name'),
			'singular_name'=>_x('Item '.$args['singular'],'taxonomy singular name'),
			'search_items'=>__('Search '.$args['plural']),
			'all_items'=>__('All '.$args['plural']),
			'parent_item'=>__('Parent '.$args['plural']),
			'parent_item_colon'=>__('Parent '.$args['singular'].':'),
			'edit_item'=>__('Edit '.$args['singular']),
			'update_item'=>__('Update '.$args['singular']),
			'add_new_item'=>__('Add New '.$args['singular'].'Name'),
			'menu_name'=>__($args['menu_title']));
		$tax_args = array(
			'hierarchical'=>$args['hierarchical'],
			'labels'=>$labels,
			'public'=>true,
			'rewrite'=>array('slug'=>$args['slug']),
			);
		register_taxonomy( $tax, $args['post_type'], $tax_args );
	}
}

add_action('init','klgwow_taxonomies');

// Se agregan los custom meta box a el post type klg_players
function klgwow_player_meta_box(){
	add_meta_box('klg_player_meta',
	__('Player Info','klgwow'),
	'klgwow_player_meta_fields',//Callback
	'klg_player',
	'normal','core');
}
add_action('add_meta_boxes','klgwow_player_meta_box');

// Fields para los custom meta box
function klgwow_player_meta_fields($post){
	wp_nonce_field( basename(__FILE__),'klg_custom_meta_noncename' );
	$stream_url = get_post_meta( $post->ID,'klg_player_stream_url', true );
	$armory_url = get_post_meta( $post->ID,'klg_player_armory_url',true);
	?>
	<p>
		<label for="klg_player_stream_url">Stream URL</label><br />
		<input type="text" class="all-options" name="klg_player_stream_url" id="klg_player_stream_url" value="<?php echo esc_attr( $stream_url ); ?>"/>
		<span class="description">Ingresa aqui el link del stream del jugador en caso de tenerlo.</span>
	</p>
	<p>
		<label for="klg_player_armory_url">Armory URL</label><br />
		<input type="text" class="all-options" name="klg_player_armory_url" id="klg_player_armory_url" value="<?php echo esc_attr( $armory_url ); ?>"/>
		<span class="description">Ingresa aqui el link del Armory del jugador</span>
	</p>
	<?php
}
// Cambia el titulo del custom post type
function change_default_title($title){
	$screen = get_current_screen();
	if($screen->post_type === 'klg_player'){
		return 'Ingresa el nombre del jugador aqui.';
	}
}

add_filter('enter_title_here','change_default_title');

function klg_player_meta_save($post_id){
	//verify if this is an auto save routine.
	//if it is the post has not been updated, so we dont want to do anything
	if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE){
		return $post_id;
	}
	//verify this came from the screen and with proper authorization,
	//because save_post can be triggered at other times.
	if(!isset($_POST['klg_custom_meta_noncename'])||!wp_verify_nonce( $_POST['klg_custom_meta_noncename'], basename(__FILE__))){
		return $post_id;
	}
	//Get the post type object.
	global $post;
	$post_type = get_post_type_object($post->post_type);
	//Check if the current user has permission to edit the post
	if(!current_user_can( $post_type->cap->edit_post,$post_id )){
		return $post_id;
	}
	//Get the posted data and pass it into an associative array for easy of entry
	$metadata['klg_player_stream_url'] = (isset($_POST['klg_player_stream_url'])?$_POST['klg_player_stream_url']:'');
	$metadata['klg_player_armory_url'] = (isset($_POST['klg_player_armory_url'])?$_POST['klg_player_armory_url']:'');

	// add/update record (both are taken care of by update_post_meta)
	foreach ($metadata as $key => $value) {
		//get current meta value
		$current_value = get_post_meta( $post_id, $key , true);
		if($value && '' == $current_value){
			add_post_meta($post_id,$key,$value,true);
		}elseif ($value && $value != $current_value) {
			update_post_meta($post_id,$key,$value);
		}elseif ('' == $value && $current_value ) {
			delete_post_meta($post_id, $key, $current_value);
		}
	}
}
add_action('save_post','klg_player_meta_save');

//if('klg_player'=== $post_type->name){
//	$metadata['klg_player_stream_url'] = (isset($_POST['klg_player_stream_url']) ? $_POST['klg_player_stream_url']:'');

//}


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
// Columnas custom para el post type klg_player

add_filter('manage_edit-klg_player_columns','edit_klg_player_columns');

function edit_klg_player_columns($columns){
	$columns = array(
		'cb'=>'<input type="checkbox"/>',
		'title'=>__( 'Player' ),
		'class'=>__( 'Class' ),
		'raidrole'=>__( 'Raid Role' ),
		'streamurl'=>__( 'Stream' ),
		'date'=>__( 'Date' )
		);
	return $columns;
}

add_action('manage_klg_player_posts_custom_column','manage_klg_player_column',10,2);

function manage_klg_player_column($column, $post_id){
	global $post;

	switch ($column) {
		case 'class':
			/* Get the pj class for the post */
			$classes = get_the_terms( $post_id, 'klg_pj_class' );

			/* If termes were found */
			if(!empty($classes)){
				$out = array();

				/* Loop through each term, linking to the 'edit post' page 
				for the specific term. */
				foreach ($classes as $class) {
					$out[] = sprintf('<a href="%s">%s</a>',
						esc_url(add_query_arg(array('post_type'=>$post->post_type,'klg_pj_class'=>$class->slug),'edit.php')),
						esc_html(sanitize_term_field('name',$class->name,$class->term_id,'klg_pj_class','display'))
						);
				}
				echo join(', ', $out);
			}else{
				_e('No class');
			}
			break;
		case 'raidrole':
			//klg_raid_roles
			/* Get the raid roles for the post */
			$raidroles = get_the_terms($post_id,'klg_raid_roles');
			/* If termes were found */
			if(!empty($raidroles)){
				$out = array();

				foreach ($raidroles as $role) {
					$out[] = sprintf('<a href="%s">%s</a>',
						esc_url(add_query_arg(array('post_type'=>$post->post_type,'klg_raid_roles'=>$role->slug),'edit.php')),
						esc_html( sanitize_term_field( 'name', $role->name, $role->term_id,'klg_raid_roles','display' ))
						);
				}
				echo join(', ', $out);
			}else{
				_e('No Raid Role');
			}
			break;
		case 'streamurl':
			/* Get the post meta */
			$streamurl = get_post_meta( $post_id, $key = 'klg_player_stream_url', $single = true );
			/* If no stream url found, output a default message. */
			if(empty($streamurl)){
				echo __('This player dont have stream');
			}else{
				printf('<a href="%s" target="_blank"><img src="http://i.imgur.com/Q4Q7gHb.png"/></a>',$streamurl);
			}
			break;
		default:
			break;
	}
}

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
/*
 Side Bar Funcionts
 ============================================================================
 */

function klgwow_create_widget($name, $id, $description){
	register_sidebar( array(
		'name' => __($name),
		'id'=>$id,
		'description' => __($description),
		'before_widget'=>'<div class="widget">',
		'after_widget'=>'</div>',
		'before_title'=>'<h2 class="widget-title">',
		'after_title'=>'</h2>'
		) );
}

klgwow_create_widget('Home Sidebar','home','Widget en la sidebar principal');
klgwow_create_widget('Footer 1 Sidebar','footer1','Widget en el footer 1');
klgwow_create_widget('Footer 2 Sidebar','footer2','Widget en el footer 2');
klgwow_create_widget('Footer 3 Sidebar','footer3','Widget en el footer 3');


function klgwow_say_hello(){
	return '<h3>HOLA</h3>';
}


add_filter( 'wp_trim_excerpt', 'my_custom_excerpt', 10, 2 );
 
function my_custom_excerpt($text, $raw_excerpt) {
    if( ! $raw_excerpt ) {
        $content = apply_filters( 'the_content', get_the_content() );
        $text = substr( $content, 0, strpos( $content, '</p>' ) + 4 );
    }
    return $text;
}

function add_facebook_sdk(){
	?>
	<div id="fb-root"></div>
	<script>
  		window.fbAsyncInit = function() {
    		FB.init({
      			appId      : '1648156448744674',
      			xfbml      : true,
      			version    : 'v2.2'
    		});
 		 };

  		(function(d, s, id){
    		var js, fjs = d.getElementsByTagName(s)[0];
    		if (d.getElementById(id)) {return;}
    		js = d.createElement(s); js.id = id;
     		js.src = "//connect.facebook.net/en_US/sdk.js";
     		fjs.parentNode.insertBefore(js, fjs);
   		}(document, 'script', 'facebook-jssdk'));
	</script>
	<?php 
}

add_action('thesis_hook_before_html','add_facebook_sdk');

// Widgets
// 
// 
include (TEMPLATEPATH . '/includes/widgets.php');


//add_action( "manage_klg_staff_post_custom_columns", "klgwow_custom_column_content", $priority = 10, $accepted_args = 2 );
//add_action( "manage_klg_menu_post_custom_columns", "klgwow_custom_column_content", $priority = 10, $accepted_args = 2 );




 ?>