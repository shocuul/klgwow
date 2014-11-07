<?php get_header(); ?>
	<!-- Stuff will go here -->
	<section class="primary">
	<h1>Latest news</h1>
	<?php if(have_posts()): ?>
		<?php while(have_posts()):the_post(); ?>
			<?php get_template_part('content', get_post_format()); ?>
		<?php endwhile ?>
	<?php else: ?>
		<article class="error">
			<h2>Sorry there were no news articles found</h2>
		</article>
	<?php endif; ?>
	<p class="post-page-navigation">
		<?php previous_post_link("Past news &raquo;"); ?>
	</p>
	</section>
	<?php get_sidebar(); ?>

<?php get_footer(); ?>