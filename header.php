<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

?>

<head>
	<style type="text/css">
		body  {
  background: #0a243b;
}
	</style>
</head>
<br>
<br>
<br>
<ul>
	<li><a href="<?php the_permalink(2) ?>"><label>LATEST SHOWS</label></a></li>
	<li><a href="<?php the_permalink(2) ?>"><label>GENRE</label></a></li>
	<li><a href="<?php the_permalink(41) ?>"><label>BROWSE BY</label></a></li>
	<li>
		<?php $unique_id = esc_attr( uniqid( 'search-form-' ) ); ?>

		<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
			<label for="<?php echo $unique_id; ?>">
				<span class="screen-reader-text"></span>
			</label>
			<input type="search" id="<?php echo $unique_id; ?>" class="search-field" value="<?php echo get_search_query(); ?>" name="s" placeholder="Search Videos..."/>
			<button type="submit" class="search-submit"><span class="screen-reader-text"><?php echo _x( 'Search', 'submit button', 'twentyseventeen' ); ?></span></button>
</form>
	</li>
</ul>