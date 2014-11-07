<?php get_header(); ?>
	<section class="primary">
	<?php layerslider(2); ?>
	<div class="hover-slider">
		<img src="<?php echo get_template_directory_uri(); ?>/images/marco-slider.png" alt="slider-hover" />
	</div>
	<?php if( have_posts() ) : while (have_posts() ) : the_post(); ?>
		<?php get_template_part( "content-home" ); ?>
		<div class="nav-previos"><?php next_post_link( 'Viejas Entradas' ); ?></div>
		<div class="nav-next"><?php previous_posts_link( 'Nuevas entradas' ); ?></div>
		<?php endwhile; else: ?>
	<p><?php _e('Esto es embarazoso, no hay paginas encontradas'); ?></p>
	<?php endif; ?>
	</section>
	<?php get_sidebar( ); ?>
<?php get_footer();  ?>

