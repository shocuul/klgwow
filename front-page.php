<?php get_header(); ?>
	<section class="primary">
	<?php layerslider(1); ?>
	<div class="hover-slider">
		<img src="<?php echo get_template_directory_uri(); ?>/images/marco-slider.png" alt="slider-hover" />
	</div>
	<!--
	<div class="meter orange nostripes">
	<span style="width: 0%"></span>
	</div>-->
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

