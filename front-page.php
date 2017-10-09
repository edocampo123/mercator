<?php
   /* Template Name: Home Template */
   get_header();
   while(have_posts()): the_post();
   ?>
   <?php the_post_thumbnail() ?>
   <?php the_content(); ?>
   <?php get_field('background_image'); ?>
   <img src="<?php echo get_field('background_image');?>">


   <?php echo get_field('sponsor_caption'); ?>
   <a href="<?php echo get_field('sponsor_link'); ?>"><img src="<?php echo get_field('sponsor_image'); ?>"></a>

   <hr>
   Latest Shows
   <br>
   <!-- start lastest shows -->
   <?php
   $args = array('post_type' => 'show', 'posts_per_page' => -1);
   $the_query = new WP_Query($args);
   if ( $the_query->have_posts() ) {  while ( $the_query->have_posts() ): $the_query->the_post(); ?>
   <?php the_title(); ?><br>
   <a href="<?php the_permalink(get_the_ID()) ?>"><?php the_post_thumbnail(); ?></a><br>
   <?php endwhile; wp_reset_postdata(); } else { /** no posts found **/ } ?>
   <!-- end lastest shows -->

   <?php 
   endwhile;
   get_footer();

   ?>