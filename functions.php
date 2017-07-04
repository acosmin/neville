<?php
/**
 * -------------------------
 * Neville Functions INIT
 *
 * @package Neville
 * -------------------------
 */

/**
 * Neville only works on PHP v5.4.0 or later.
 */
if ( version_compare( PHP_VERSION, '5.4.0', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
	return;
}

/**
 * Define some constats
 */
if( ! defined( 'NEVILLE_AUTHOR' ) ) {
	define( 'NEVILLE_AUTHOR', 'http://www.acosmin.com' );
}
if( ! defined( 'NEVILLE_THEME_URL' ) ) {
	define( 'NEVILLE_THEME_URL', 'http://www.acosmin.com/theme/neville/' );
}
if( ! defined( 'NEVILLE_VERSION' ) ) {
	define( 'NEVILLE_VERSION', '1.0.1' );
}
if( ! defined( 'NEVILLE_DIR' ) ) {
	define( 'NEVILLE_DIR', trailingslashit( get_template_directory() ) );
}
if( ! defined( 'NEVILLE_SECTIONS' ) && defined( 'NEVILLE_DIR' ) ) {
	define( 'NEVILLE_SECTIONS', NEVILLE_DIR . 'sections/' );
}
if( ! defined( 'NEVILLE_DIR_URI' ) ) {
	define( 'NEVILLE_DIR_URI', trailingslashit( get_template_directory_uri() ) );
}
if( ! defined( 'NEVILLE_INC' ) && defined( 'NEVILLE_DIR' ) ) {
	define( 'NEVILLE_INC', NEVILLE_DIR . 'inc/' );
}
if( ! defined( 'NEVILLE_WIDGETS' ) && defined( 'NEVILLE_INC' ) ) {
	define( 'NEVILLE_WIDGETS', NEVILLE_INC . 'widgets/' );
}
if( ! defined( 'NEVILLE_CUSTOMIZER' ) && defined( 'NEVILLE_INC' ) ) {
	define( 'NEVILLE_CUSTOMIZER', NEVILLE_INC . 'customizer/' );
}
if( ! defined( 'NEVILLE_CUSTOMIZER_URI' ) && defined( 'NEVILLE_DIR_URI' ) ) {
	define( 'NEVILLE_CUSTOMIZER_URI', NEVILLE_DIR_URI . 'inc/customizer/' );
}
if( ! defined( 'NEVILLE_PARTIALS' ) && defined( 'NEVILLE_DIR' ) ) {
	define( 'NEVILLE_PARTIALS', NEVILLE_DIR . 'template-parts/partials/' );
}

/**
 * Theme Setup
 */
require NEVILLE_INC . 'modules/tgmpa/class-tgm-plugin-activation.php';
require NEVILLE_INC . 'theme-setup.php';
require NEVILLE_INC . 'helper-functions.php';
require NEVILLE_INC . 'sanitization.php';

/**
 * Customizer Setup
 */
require NEVILLE_CUSTOMIZER . 'customizer.php';

/**
 * Include necessary files after theme setup.
 */
require NEVILLE_INC . 'metaboxes/post-options.php';
require NEVILLE_INC . 'sidebars/sidebars.php';
require NEVILLE_INC . 'enqueue/enqueue-frontend.php';
require NEVILLE_INC . 'enqueue/enqueue-backend.php';
require NEVILLE_INC . 'modules/breadcrumbs/breadcrumbs.php';
require NEVILLE_INC . 'entry/meta.php';

/**
 * Sections
 */
require NEVILLE_SECTIONS . 'init.php';

/**
 * Partial template files/functions
 */
require NEVILLE_PARTIALS . 'loop-types.php';
require NEVILLE_PARTIALS . 'partials.php';
