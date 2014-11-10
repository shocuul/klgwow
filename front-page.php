<?php get_header(); ?>
	<section class="primary">
	<?php layerslider(2); ?>
	<div class="hover-slider">
		<img src="<?php echo get_template_directory_uri(); ?>/images/marco-slider.png" alt="slider-hover" />
	</div>
	<!--
	<div class="meter orange nostripes">
	<span style="width: 0%"></span>
	</div>-->
	<?php 
	$args = array (
	'post_type'              => 'klg_player',
	'post_status'            => 'publish',
	'meta_query'             => array(
		array(
			'key'       => 'klg_player_stream_url',
		),
	),
);

// The Query
	$query = new WP_Query( $args );

// The Loop
if ( $query->have_posts() ) {
	while ( $query->have_posts() ) {
		$query->the_post();
		the_title();
		$meta = get_post_custom( the_ID() );
	    echo $meta['klg_player_stream_url'][0];

	}
} else {
	// no posts found
}

// Restore original Post Data
wp_reset_postdata();
	 ?>
	<?php if( have_posts() ) : while (have_posts() ) : the_post(); ?>
		<?php get_template_part( "content-home" ); ?>
		

		<?php endwhile; ?>
		<?php 
		 $prev_link = get_previous_posts_link(__('&laquo; Entradas Antiguas')); 
		 $next_link = get_next_posts_link(__('Nuevas Entradas &raquo;')); 
		 if($prev_link){
		 	echo '<div class="Button">' . $prev_link . '</div>';
		 }
		 if($next_link){
		 	echo '<div class="Button align-right">' . $next_link . '</div>';
		 }
		?>
		<?php else: ?>
	<p><?php _e('Esto es embarazoso, no hay paginas encontradas'); ?></p>
	<?php endif; ?>
	</section>
	<?php get_sidebar( ); ?>
<?php get_footer();  ?>

