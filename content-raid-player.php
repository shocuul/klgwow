	<?php
	//$meta = get_post_custom( get_the_ID() );
	$armory_url = get_post_meta( get_the_ID(), $key = 'klg_player_armory_url', $single = true );
	?>
	<?php $term_list = wp_get_post_terms(get_the_ID(), 'klg_pj_class' ); ?>
	<li>
		<img src="<?php echo get_template_directory_uri(); ?>/images/class/<?php echo $term_list[0]->slug; ?>.png" alt="class-image">
		<a href="<?php the_permalink(); ?>"> <?php the_title(); ?></a>
		<?php if ($armory_url != '') : ?>
		<a href="<?php echo $armory_url; ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/armory.png" alt="armory"></a>
		<?php endif; ?>
	</li>