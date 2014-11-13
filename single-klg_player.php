<?php 
/** 
 * Template KLG Player Single
 */
?>
<?php get_header(); ?>
<?php if(have_posts()): while (have_posts()): the_post(); ?>
	<?php $armory_url = get_post_meta( get_the_ID(), $key = 'klg_player_armory_url', $single = true ); ?>
	<?php $term_list = wp_get_post_terms(get_the_ID(), 'klg_pj_class' ); ?>
	<section class="primary">
	<article <?php post_class(); ?>>
		<ul class="info">
			<li><div class="<?php echo $term_list[0]->slug; ?>"></div>
			</li>
			<li>
				<h1><?php the_title(); ?></h1>
			</li>

			
			<li><h1> - </h1></li>
			<?php $term_list = wp_get_post_terms(get_the_ID(), 'klg_raid_roles' ); ?>
			<li><h1><?php echo $term_list[0]->name; ?><h1></li>
			<?php if ($armory_url != '') : ?>
			<li>
			<a href="<?php echo $armory_url; ?>" target="_blank">
				<span class="armory-icon"></span>
			</a>
			</li>
			<?php endif; ?>
		</ul>
		<?php $armory_url = get_post_meta( get_the_ID(), $key = 'klg_player_stream_url', $single = true ); ?>
		<?php if($armory_url != '') : ?>
		<iframe src="http://www.twitch.tv/<?php echo $armory_url; ?>/embed" frameborder="0" scrolling="no" height="500" width="100%"></iframe>
			
		<?php endif; ?>
		
		<?php if(has_post_thumbnail()): ?>
			<?php the_post_thumbnail(); ?>
		<?php endif; ?>
		<?php the_content(); ?>
		</p>
		
	</article>
	
	</section>
	<?php if($armory_url != '') : ?>
	<aside class="sidebar">
		<div class="widget" style="margin-top: -8px;">
		<h2 class="widget-title">Chat</h2>
		<iframe src="http://www.twitch.tv/<?php echo $armory_url ?>/chat?popout=" frameborder="0" scrolling="no" height="500" width="310"></iframe>
		</div>
	</aside>
	<?php else :  ?>
	<?php get_sidebar(); ?>
	<?php endif; ?>
	<?php endwhile; endif; ?>
<?php get_footer(); ?>