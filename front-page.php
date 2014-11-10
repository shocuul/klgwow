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
	<?php if( have_posts() ) : while (have_posts() ) : the_post(); ?>
		<?php get_template_part( "content-home" ); ?>
		

		<?php endwhile; ?>
		<div class="nav-previous alignleft"><?php next_posts_link( 'Older posts' ); ?></div>
          <div class="nav-next alignright"><?php previous_posts_link( 'Newer posts' ); ?></div>
		<?php else: ?>
	<p><?php _e('Esto es embarazoso, no hay paginas encontradas'); ?></p>
	<?php endif; ?>
	</section>
	<?php get_sidebar( ); ?>
<?php get_footer();  ?>

