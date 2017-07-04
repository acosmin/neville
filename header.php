<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Neville
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<?php
	/**
	 * Hooked:
	 * neville__head_elements - 0
	 *
	 * @see ../template-parts/partials/__global.php
	 */
	wp_head();
	?>
</head>

<body <?php body_class(); ?>>

<?php
/**
 * Hooked:
 * neville__global_start_wrap - 10
 *
 * @see ../template-parts/partials/__global.php
 */
do_action( 'neville__global_start' );

	/**
	 * Display header template
	 *
	 * @see ../inc/helper-functions.php
	 */
	neville_get_tmpl_partials(
		'headers/header-tmpl',
		'header_tmpl'
	);
