<?php get_header(); ?>
	<section class="primary">
	<?php 
	if( is_tax() ) {
    global $wp_query;
    $term = $wp_query->get_queried_object();
    $title = $term->name;
	}
	 ?>
	<h3 class="title-raid"><?php echo $title; ?></h3>
	<section class="role-container">
	<?php if ( have_posts() ) :  ?>
		<div class="raid-role-box">
			<h2 class="title">
				Tanque
			</h2>
			<ul class="players">
			<?php while ( have_posts() ) : the_post(); ?>
				<?php if (has_term( 'tanque','klg_raid_roles')) : ?>
					<?php get_template_part( "content-raid-player" ); ?>
				<?php endif; ?>
			<?php endwhile; ?>
			</ul>	
		</div>
		<div class="raid-role-box">
			<h3 class="title">Sanador</h3>
			<ul class="players">
			<?php while ( have_posts() ) : the_post(); ?>
				<?php if (has_term( 'sanador','klg_raid_roles')) : ?>
					<?php get_template_part( "content-raid-player" ); ?>
				<?php endif; ?>
			<?php endwhile; ?>
			</ul>
		</div>
		<div class="raid-role-box">
			<h3 class="title">Daño</h3>
			<ul class="players">
				<?php while ( have_posts() ) : the_post(); ?>
				<?php if ((has_term( 'dps-hechizos','klg_raid_roles')) || (has_term( 'dps-fisico','klg_raid_roles'))) : ?>
					<?php get_template_part( "content-raid-player" ); ?>
				<?php endif; ?>
				<?php endwhile; ?>
			</ul>
		</div>
		<?php  else : ?>
	<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
		<?php endif; ?>
	</section>
		
	</section>

	<?php get_sidebar( ); ?>
<?php get_footer();  ?>