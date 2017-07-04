<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Neville
 */

get_header(); ?>
<section class="errorMsg">
	<h1 class="page-title"><em><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'neville' ); ?></em></h1>
	<p><?php printf( esc_html__( 'Maybe you want to visit our %s instead.', 'neville' ), '<a href="' . esc_url( home_url( '/' ) ) . '">' . __( 'home page', 'neville' ) . '</a>' ) ?></p>
</section>
<?php
get_footer();
