<?php
get_header();
while(have_posts()): the_post();
	?>
	Latest Shows
	<br>
	<!-- start lastest shows -->
	<?php
	$args = array('post_type' => 'show', 'posts_per_page' => -1);
	$the_query = new WP_Query($args);
	if ( $the_query->have_posts() ) {  while ( $the_query->have_posts() ): $the_query->the_post(); ?>
	<?php the_title(); ?>
	<a href="<?php the_permalink(get_the_ID()) ?>"><?php the_post_thumbnail(); ?></a>
	<?php endwhile; wp_reset_postdata(); } else { /** no posts found **/ } ?>
	<!-- end lastest shows -->


	<h2>Overview</h2>
   	<?php the_post_thumbnail() ?>
	<?php the_content(); ?>
	<img src="<?php echo get_field('show_banner'); ?>">
	

	<h2>Episodes</h2>
	<?php if( have_rows('episodes_gallery') ): while ( have_rows('episodes_gallery') ) : the_row(); ?>
	  <a href="<?php echo get_sub_field('episode_link'); ?>"><img src="<?php echo get_sub_field('episode_image'); ?>"></a>
	  <?php echo get_sub_field('episode_title'); ?>
	  <?php echo get_sub_field('episode_summary'); ?>
	<?php endwhile; else : endif; ?>

	<h2>Trailers</h2>
	<?php if( have_rows('trailers') ): while ( have_rows('trailers') ) : the_row(); ?>
	  <a href="<?php echo get_sub_field('trailer_link'); ?>"><img src="<?php echo get_sub_field('trailer_thumbnail'); ?>"></a>
	  <?php echo get_sub_field('trailer_title'); ?>
	<?php endwhile; else : endif; ?>

	<h2>Details</h2>
	<?php echo get_field('details'); ?>



<?php 
endwhile;
get_footer();