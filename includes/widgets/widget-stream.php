<?php 
add_action( 'widgets_init','klgwow_stream_widget' );

function klgwow_stream_widget(){
	register_widget('klgwow_stream');
}

class klgwow_stream extends WP_Widget{

	function klgwow_stream(){
		$widget_ops = array('classname' => 'stream','description'=>'Para mostrar Stream' );
		$control_ops = array('width' => 250 , 'height' => 350, 'id_base' => 'stream-widget' );
		$this->WP_Widget('stream-widget', 'KLGWOW - Stream', $widget_ops, $control_ops);
	}

	function widget($args, $instance){
		extract($args);
		$title = apply_filters( 'widget_title', $instance['title'] );


				// WP_Query arguments
		$args = array (
			'post_type'              => 'klg_player',
			'meta_query'             => array(
				array(
					'key'       => 'klg_player_stream_url',
				),
			),
		);

		$api_twitch_url = 'https://api.twitch.tv/kraken/streams/';

		// The Query
		$query = new WP_Query( $args );
			echo $before_widget;
			echo $before_title;
			echo $title;
			echo $after_title;
		// The Loop
		if ( $query->have_posts() ) {

			while ( $query->have_posts() ) {
				$query->the_post();
				$meta = get_post_custom( get_the_ID() );
				$jsonObj = file_get_contents($api_twitch_url . $meta['klg_player_stream_url'][0]);
				$response = json_decode($jsonObj, true);
				if($response['stream']){
					echo '<iframe src="http://www.twitch.tv/'.$meta['klg_player_stream_url'][0].'/embed" frameborder="0" scrolling="no" height="210" width="100%"></iframe>';
					echo 'Hay Stream';
				}else{
					echo 'No hay Stream';
				}
				//var_dump($response);
	    		echo '<h2>' . $meta['klg_player_stream_url'][0] . '</h2>';
				
			}
		} else {
			// no posts found
			echo '<h4>Ningun jugador encontrado :C </h4>';
		}
			

		// Restore original Post Data
		wp_reset_postdata();
		echo $after_widget;

	}

	function update($new_instance, $old_instance){
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		return $instance;
	}

	function form($instance){
		$defaults = array('title' => __('Stream','klgwow'));
		$instance = wp_parse_args( (array) $instance , $defaults); ?>

		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>">Titulo : </label>
			<input id="<?php echo $this->get_field_id('title') ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php if(!empty($instance['title']) ) echo $instance['title']; ?>" class="widefat" type="text">
		</p>
		<small>Stream Videos</small>

		<?php
	}
}


?>