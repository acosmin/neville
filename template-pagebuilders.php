<?php
/**
 * Template name: Page Builders
 *
 * Template for Page Builders
 *
 * @package Neville
 */

get_header(); ?>

	<?php
	if( have_posts() ) :
		while( have_posts() ) :
			the_post();
			the_content();
		endwhile;
	endif;
	?>

<?php
get_footer();
