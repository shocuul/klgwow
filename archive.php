<?php get_header(); ?>
	<!-- Stuff will go here -->
	<section class="primary">
	<?php if( have_posts() ) : while (have_posts() ) : the_post(); ?>
		<?php get_template_part( "content-home" ); ?>
		

		<?php endwhile; ?>
		<div class="nav-previous alignleft"><?php next_posts_link( 'Older posts' ); ?></div>
          <div class="nav-next alignright"><?php previous_posts_link( 'Newer posts' ); ?></div>
		<?php else: ?>
	<p><?php _e('Esto es embarazoso, no hay paginas encontradas'); ?></p>
	<?php endif; ?>
	</section>
		<?php get_sidebar(); ?>
<?php get_footer(); ?>