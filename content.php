<article <?php post_class(); ?>>
	<header>
		<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
		<p class="byline">by <?php the_author(); ?> | <?php echo get_the_date(); ?></p>
	</header>

	<?php the_excerpt(); ?>
	<p><a href="<?php the_permalink(); ?>">Read more &raquo;</a></p>
</article>