<?php get_header(); ?>
	<!-- Stuff will go here -->
	<?php if(have_posts()):the_post(); ?>
		<?php if(is_category()): ?>
			<h1>Archive for category: <?php single_cat_title(); ?></h1>
		<?php elseif(is_tag()): ?>
			<h1>Posts tagged: <?php single_cat_title(); ?></h1>
		<?php elseif(is_day()): ?>
			<h1>Archive for <?php the_time('FjS,Y'); ?></h1>
		<?php elseif(is_month()): ?>
			<h1>Archive for <?php the_time('Y'); ?></h1>
		<?php elseif(is_author()): ?>
			<h1>Author Archive</h1>
		<?php elseif(isset($_GET['paged'])&& !empty($_GET['paged'])): ?>
			<h1>Archives</h1>
		<?php endif; ?>
		<?php rewind_posts(); ?>
		<?php while(have_posts()): the_post(); ?>
			<?php get_template_part('content',get_post_format()); ?>
		<?php else: ?>
			<?php if(is_category()): ?>
				<h1>Sorry, but there aren't any posts <?php single_cat_title(); ?> category yet.</h1>
			<?php elseif(is_date()): ?>
				<h1>sorry, but there arent any posts with this date</h1>
			<?php elseif(is_author()): ?>
				<?php get_userdatabylogin(get_query_var('author_name')); ?>
				<h1>Sorry, but there arent any posts by <?php echo $userdata->display_name; ?> yet.</h1>
			<?php else: ?>
				<h1>No posts found</h1>
			<?php endif; ?>
		<?php endif; ?>
<?php get_footer(); ?>