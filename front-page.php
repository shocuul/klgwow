<?php get_header(); ?>
	<!-- Stuff will go here -->
	<?php the_post(); ?>
	<article class="page-content">
		<?php the content(); ?>
	</article>
	<aside class="lastest-news">
		<h2>Lastest News</h2>
		<?php 
		//New Query for news articles
		$args = array(
			'post_type' => 'post',
			'orderby' => 'date',
			'order' => 'ASC',
			'posts_per_page' => 2,);
		$lastest_news = WP_Query($args);
		if ($lastest_news->have_posts()):while($lastest_news->have_posts()):$lastest_news->the_post();
		 ?>
		 <article <?php post_class(); ?>>
		 <h3><?php the_title(); ?></h3>
		 <?php the_excerpt(); ?>
		 <a href="<?php the_permalink(); ?>">Read more &raquo;</a>
		 </article>
		<?php endwhile; endif; ?>
		<?php wp_reset_query(); ?>
	</aside>
<?php get_footer(); ?>