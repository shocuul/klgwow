<?php get_header(); ?>
	<?php 

		function klgwow_roster_build(){
			$raid_terms = get_terms('klg_raid_roles');
			if($raid_terms){
				foreach ($raid_terms as $term) {
					$args = array(
						'post_type'=>'klg_player',
						"tax_query"=>array(
							array(
								'taxonomy'=>'klg_raid_roles',
								'field'=>'slug',
								'terms'=>$term->slug
								)),
						'posts_per_page'=>-1,);
					$players = new WP_Query( $args );
					if($players->have_posts()){
						?>
						<h2 id="<?php echo $term->slug; ?>" class="tax_term-heading">
						<?php echo $term->name; ?>
						</h2>
						<?php 
						while ($players->have_posts()):$players->the_post();get_template_part( 'content','player' );
						endwhile;
						
						 
					}
					wp_reset_query();
				}
			}
		}


	 ?>


<?php get_footer(); ?>