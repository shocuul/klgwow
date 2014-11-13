<?php 
/*
 * Template Name: Multi Twich Template
 * Description: A page with All Stream Avalible
 */
get_header( );

$args = array (
			'post_type'              => 'klg_player',
			'meta_query'             => array(
				array(
					'key'       => 'klg_player_stream_url',
				),
			),
		);

$query = new WP_Query( $args );
$api_twitch_url = 'https://api.twitch.tv/kraken/streams?channel=';
$multitwitch_url = 'http://multitwitch.tv/';
if ( $query->have_posts() ) {
	$channel_names = array();
	while ( $query->have_posts() ) {
		$query->the_post();
		$meta = get_post_custom( get_the_ID() );

		$channel_names[] = $meta['klg_player_stream_url'][0];
		//print_r($channel_names);
	}

}else{
	echo '<h1>No hay jugadores transmitiendo :C</h1>';
}
// Restore original Post Data
		wp_reset_postdata();

foreach ($channel_names as $name) {
			$api_twitch_url .= $name . ',';
		}
$jsonObj = file_get_contents($api_twitch_url);
		$response = json_decode($jsonObj, true);
if($response['streams']){
	foreach ($response['streams'] as $stream){
		$multitwitch_url .= $stream['channel']['name'] . '/';
	}
}
 ?>
 </div>
 <iframe src="<?php echo $multitwitch_url; ?>" frameborder="0" width="100%"
 height="800"></iframe>
 <div class="separador">


 <?php get_footer(  ); ?>