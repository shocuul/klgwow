<?php get_header(); ?>
	<!-- Stuff will go here -->
	<section class="primary">
	<?php if(have_posts()):while(have_posts()):the_post(); ?>
		<article <?php post_class(); ?>>
			<h2 class="title-post"><?php the_title(); ?></h2>
			<?php if(get_the_post_thumbnail( )) : ?>
			<div class="featured-image">
			<?php the_post_thumbnail( 'large' ); ?>
			</div>
		<?php endif; ?>
			<?php the_content(); ?>
		</article>
	<?php endwhile;endif; ?>
	</section>
	<?php get_sidebar( ); ?>
<?php get_footer(); ?>