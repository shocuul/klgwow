<?php 
/** 
* Template KLG Player Archive
*/
?>
<?php get_header(); ?>
	<h1>Nuestros Jugadores</h1>
	<?php if(have_posts()): ?>
		<?php while(have_posts()): the_post(); ?>
			<?php get_template_part( 'content','player'); ?>
		<?php endwhile; ?>
	<?php else: ?>
		<article class="error">
			<h1>Sorry there were no news articles found</h1>
		</article>
	<?php endif; ?>
<?php get_footer(); ?>