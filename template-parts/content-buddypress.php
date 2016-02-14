<?php
/**
 * The template used for displaying page content in buddypress.php
 *
 * @package wpdemo
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="entry-content">
		<?php the_content(); ?>
	</div><!-- .entry-content -->
	
</article><!-- #post-## -->
