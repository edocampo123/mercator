<?php
get_header();
while(have_posts()): the_post();
	?>
	<?php the_title(); ?>
	<h2>Episodes</h2>
	<?php if( have_rows('episodes_gallery') ): while ( have_rows('episodes_gallery') ) : the_row(); ?>
	  <a href="<?php echo get_sub_field('episode_link'); ?>"><img src="<?php echo get_sub_field('episode_image'); ?>"></a>
	  <?php echo get_sub_field('episode_title'); ?>
	  <?php echo get_sub_field('episode_summary'); ?>
	<?php endwhile; else : endif; ?>



<?php 
endwhile;
get_footer();