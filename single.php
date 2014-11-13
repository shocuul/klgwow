<?php get_header(); ?>
	<!-- Stuff will go here -->
	<section class="primary">
	<?php if(have_posts()):while(have_posts()):the_post(); ?>
		<article <?php post_class(); ?>>
			<h2 class="title-post"><?php the_title(); ?></h2>
			<?php if(get_the_post_thumbnail( )) : ?>
			<div class="featured-image">
			<?php //the_post_thumbnail( 'large' ); ?>
			</div>
		<?php endif; ?>
		<?php remove_filter( 'the_content', 'sharing_display', 19 ); ?>
			<?php the_content(); ?>
		<ul class="post-meta">
		<li class="author">
			<span class="klgwow-avatar">
			<?php echo get_avatar( get_the_author_meta('ID'), $size = '40' ); ?>
			</span>
			de <?php the_author_posts_link( ); ?>
		</li>
		<li class="dat">en <?php the_category( ', ' ); ?></li>
		<li class="date">el <?php the_time('F j, Y'); ?></li>
		<li class="share"><?php echo sharing_display(); ?> </li>
	</ul>
		<?php comments_template(); ?>
		</article>
	<?php endwhile;endif; ?>
	</section>
	<?php get_sidebar( ); ?>
<?php get_footer(); ?>