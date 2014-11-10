<article <?php post_class( 'post' ) ?>>
	<h1 class="title-post"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
	<div class="entry">
		<p><?php the_excerpt(); ?></p>
	</div>
	<?php if(get_the_post_thumbnail( )) : ?>
	<div class="featured-image">
		<?php //the_post_thumbnail( 'large' ); ?>
	</div>
		<?php endif; ?>
	
	<ul class="post-meta">
		<li class="author">
			<span class="klgwow-avatar">
			<?php echo get_avatar( get_the_author_meta('ID'), $size = '40' ); ?>
			</span>
			de <?php the_author_posts_link( ); ?>
		</li>
		<li class="dat">en <?php the_category( ', ' ); ?></li>
		<li class="date">el <?php the_time('F j, Y'); ?></li>
		<li class="more"><a href="<?php the_permalink(); ?>" class="Button">Continuar Leyendo</a></li>	
	</ul>
		
</article>