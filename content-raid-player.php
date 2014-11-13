	<?php
	//$meta = get_post_custom( get_the_ID() );
	$armory_url = get_post_meta( get_the_ID(), $key = 'klg_player_armory_url', $single = true );
	?>
	<?php $term_list = wp_get_post_terms(get_the_ID(), 'klg_pj_class' ); ?>
	<li>
		<div class="<?php echo $term_list[0]->slug; ?> small-icon"></div>
		<a href="<?php the_permalink(); ?>" style="padding-left:10px; padding-right:10px;"> <?php the_title(); ?></a>
		<?php if ($armory_url != '') : ?>
		<a href="<?php echo $armory_url; ?>"><div class="armory-icon small-icon"></div></a>
		<?php endif; ?>
	</li>