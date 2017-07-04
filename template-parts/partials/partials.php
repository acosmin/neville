<?php
/**
 * Partial templates hooked into actions.
 *
 * @link https://developer.wordpress.org/reference/functions/add_action/
 */

/**
 * Global
 */
require NEVILLE_PARTIALS . '__global.php';

/**
 * Blog/Index/Archive view.
 */
require NEVILLE_PARTIALS . '__index_archive.php';

/**
 * Post content
 */
require NEVILLE_PARTIALS . '__post_content.php';
require NEVILLE_PARTIALS . '__post_content_single.php';

/**
 * Page content
 */
require NEVILLE_PARTIALS . '__page_content.php';
require NEVILLE_PARTIALS . '__page_content_page.php';

/**
 * Posts content
 */
require NEVILLE_PARTIALS . '__posts_content_index.php';
require NEVILLE_PARTIALS . '__posts_content_index_big.php';

/**
 * Post extensions
 */
require NEVILLE_PARTIALS . '__post_extensions.php';

/**
 * Page templates
 */
require NEVILLE_PARTIALS . '__tmpl_front_page.php';
