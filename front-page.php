<?php get_header(); ?>
	<section class="primary">
	<?php layerslider(2); ?>
	<div class="hover-slider">
		<img src="<?php echo get_template_directory_uri(); ?>/images/marco-slider.png" alt="slider-hover" />
	</div>
	<?php if( have_posts() ) : while (have_posts() ) : the_post(); ?>
		<article <?php post_class( 'post' ) ?>>
		<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
		<div class="entry">
			
		</div>
		<p><?php the_excerpt(); ?></p>
		<ul class="post-meta">
			<span class="klgwow-avatar">
				<?php echo get_avatar( get_the_author_meta('ID'), $size = '24' ); ?>
				de <?php the_author_posts_link( ); ?>
			</span>
		</ul>
		<?php if(get_the_post_thumbnail( )) : ?>
		<div class="featured-image">
			<?php the_post_thumbnail( 'large' ); ?>
		</div>
		<?php endif; ?>
		</article>
		<div class="nav-previos"><?php next_post_link( 'Viejas Entradas' ); ?></div>
		<div class="nav-next"><?php previous_posts_link( 'Nuevas entradas' ); ?></div>
		<?php endwhile; else: ?>
	<p><?php _e('Esto es embarazoso, no hay paginas encontradas'); ?></p>
	<?php endif; ?>
	</section>
	<?php get_sidebar( ); ?>
<?php get_footer();  ?>

