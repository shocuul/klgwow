<?php get_header(); ?>
	<!-- Stuff will go here -->
	<section class="primary">
	<?php if(have_posts()):while(have_posts()):the_post(); ?>
		<article <?php post_class(); ?>>
			<h1 class="title-post"><?php the_title(); ?></h1>
			<?php the_content(); ?>
		</article>
	<?php endwhile;endif; ?>
	</section>
	<?php get_sidebar(); ?>
<?php get_footer(); ?>