<?php
get_header();
while(have_posts()): the_post();
	?>
	Latest Shows
	<br>

	<!-- start (header) lastest shows -->
	<?php
	$sess=' ';
	$args = array('post_type' => 'show', 'posts_per_page' => -1, 'order' => 'ASC');
	$the_query = new WP_Query($args);
		if ( $the_query->have_posts() ) {  while ( $the_query->have_posts() ): $the_query->the_post(); ?>
		<?php the_title(); ?>
		<a href="<?php the_permalink(get_the_ID()) ?>"><?php the_post_thumbnail(); ?></a>
	<?php endwhile; wp_reset_postdata(); } else { /** no posts found **/ } ?>
	<!-- end (header) lastest shows -->


	<h2>Overview</h2>
   	<?php the_post_thumbnail() ?>
	<?php the_content(); ?>
	<img src="<?php echo get_field('show_banner'); ?>">

	<h2 id="season_caption" hidden="">Seasons</h2>
	<?php
	global $sess, $sess_season;
	$sess_season = array();
	$sess = get_the_title();
	$args = array('post_type' => 'season', 'posts_per_page' => -1, 'order' => 'ASC');
	$the_query = new WP_Query($args);
	if ( $the_query->have_posts() ) {  while ( $the_query->have_posts() ): $the_query->the_post(); ?>
			<?php 
			$parent_show = get_field('parent_show');
			if ($parent_show->post_title == $sess) { #check if SHOW has SEASON (true)
				$link = $_POST['template_dir'] . '?season_view=' . get_the_title();
				echo "<p><a href='{$link}'>".get_the_title()."</a></p>"; #storing the season number in url
				$sess_season[] = get_the_ID(); #storing the ALL seasons ID in $sess_Season[]
				#display the "seasons" na label
				?>
				<script type="text/javascript">
					 document.getElementById("season_caption").removeAttribute("hidden"); 
				</script>
			<?php } ?>
	<?php endwhile; wp_reset_postdata(); } else { /** no posts found **/ } ?>
	<!-- end lastest shows -->



	<?php 
	if (empty($sess_season)) {?>
	     <h2>Episodes</h2>
			<?php
			$args = array('post_type' => 'episode', 'posts_per_page' => -1, 'order' => 'ASC');
			$the_query = new WP_Query($args);
			if ( $the_query->have_posts() ) {  while ( $the_query->have_posts() ): $the_query->the_post(); ?>
			<?php 
			$parent_season = get_field('parent_season');
				if ($parent_season->post_title == $sess) { #if $sess_seasons doesn't have value, compare will be to title of the page
					$repeater_object = get_field('episodes_gallery');
					if (empty($repeater_object)) {
						echo "No available episode/s.";
					}else{
						foreach ($repeater_object as $obj) { ?>
						   <a href="<?php $obj['episode_link'];?>"><?php echo $obj['episode_title']; ?></a>
						 <?php } 
					}
				 
				} ?>
			<?php endwhile; wp_reset_postdata(); } else { /** no posts found **/ } ?>
			<?php 
			if (empty($repeater_object)) {
						echo "No available episode/s.";} ?>
			
	<?php }else{ #execute if $sess_season have values
		if (isset($_GET['season_view'])) { #execute if URL has season var
			$season_num = $_GET['season_view']; ?>
			<h2>Episodes</h2>
			<?php
			$args = array('post_type' => 'episode', 'posts_per_page' => -1, 'order' => 'ASC');
			$the_query = new WP_Query($args);
			if ( $the_query->have_posts() ) {  while ( $the_query->have_posts() ): $the_query->the_post(); 
			$parent_season = get_field('parent_season');
				if ($parent_season->post_title == $season_num) {
					$repeater_object = get_field('episodes_gallery');
				 foreach ($repeater_object as $obj) { ?>
				   <a href="<?php $obj['episode_link'];?>"><?php echo $obj['episode_title']; ?></a>
				 <?php } 
				}
			?>
			<?php endwhile; wp_reset_postdata(); } else { /** no posts found **/ } ?>

		<?php }else{ #execute if URL has no season var ?>
			<h2>Episodes</h2>
			<?php
			$args = array('post_type' => 'episode', 'posts_per_page' => -1, 'order' => 'ASC');
			$the_query = new WP_Query($args);
			if ($the_query->have_posts()) {  while ( $the_query->have_posts() ): $the_query->the_post(); ?>
			<?php 
			$parent_season = get_field('parent_season');
				if (in_array($parent_season->ID, $sess_season)) {
					$repeater_object = get_field('episodes_gallery');
				 foreach ($repeater_object as $obj) { ?>
				   <a href="<?php $obj['episode_link'];?>"><?php echo $obj['episode_title']; ?></a>
				 <?php } 
				}
			?>
			<?php endwhile; wp_reset_postdata(); } else { /** no posts found **/ }
		}
	}
	?>
	



	


	<h2>Trailers</h2>
	<?php if( have_rows('trailers') ): while ( have_rows('trailers') ) : the_row(); ?>
	  <a href="<?php echo get_sub_field('trailer_link'); ?>"><img src="<?php echo get_sub_field('trailer_thumbnail'); ?>"></a>
	  <?php echo get_sub_field('trailer_title'); ?>
	<?php endwhile; else : echo "No available trailer/s."; endif; ?>

	<h2>Details</h2>
	<?php echo get_field('details'); ?>



<?php 
endwhile;
get_footer();