<?php
/**
 * ----------------------------------
 * Posts widget template partials
 *
 * @package Neville
 * ----------------------------------
 */

/**
 * Hook some template actions ;)
 *
 * @see https://developer.wordpress.org/reference/functions/add_action/
 */
add_action( 'neville__widget_posts', 'neville__widget_posts_title', 10 );
add_action( 'neville__widget_posts', 'neville__widget_posts_query', 20 );

/**
 * Called functions
 *
 * @see https://developer.wordpress.org/reference/functions/do_action/
 */

 // Posts widget title
 if( ! function_exists( 'neville__widget_posts_title' ) ) {
 	function neville__widget_posts_title( $o ) {
		$title = $o[ 'title' ];

		if ( ! empty( $title ) ) {
			echo $o[ 'btitle' ] . $title . $o[ 'atitle' ];
		}
	}
}

// Posts widget query
if( ! function_exists( 'neville__widget_posts_query' ) ) {
	function neville__widget_posts_query( $o ) {
		// Variables
		$selected = $o[ 'side_q' ];
		$args     = [];

		// Change query args based on selected, featured or popular posts
		if( $selected === 'featured' ) {
			$args = [
				'posts_per_page'      => 5,
				'meta_key'            => 'neville_meta_featured_article',
				'meta_value'          => 1,
				'ignore_sticky_posts' => 1,
			];
		} elseif( $selected === 'popular' ) {
			$args = [
				'orderby'             => 'comment_count',
				'posts_per_page'      => 5,
				'ignore_sticky_posts' => 1
			];
		}

		// Filter args
		$args = apply_filters( 'neville___widget_posts_query', $args, $o );

		// Query posts or do something else
		if( array_key_exists( 'not_query', $o ) && $o[ 'not_query' ] ) {
			/**
			 * Make sure we can hook via companion and do something else
			 *
			 * @param array $o    Widget options
			 * @param mixed $args It can be an array or something else if filtered
			 */
			do_action( 'neville__widget_posts_not_query', $o, $args );
		} else {
			// Set-up query
			$query = new WP_Query( $args );
			$count = 0;

			$format = '
				<div class="wid-pl-item">
					<figure class="entry-thumbnail">
						%1$s
						<figcaption class="img-overlay empty-caption no-gradient">
							<a href="%2$s" class="img-link-to" rel="nofollow"></a>
							%3$s
						</figcaption>
					</figure>

					<div class="entry-small-info has-thumbnail">
						<a href="%2$s" class="entry-title t-small" rel="bookmark">%4$s</a>
						<footer class="entry-meta"><time>%5$s</time></footer>
					</div>
				</div>
			';

			$format = apply_filters( 'neville___widget_posts_query_tmpls', [
				'type'     => $selected,
				'start'    => '<div class="wid-posts-lists">',
				'post'     => $format,
				'end'      => '</div>',
				'position' => '<span class="wid-pli-pos">%d</span>'
			], $o );

			echo $format[ 'start' ];

			// Query
			if( $query->have_posts() ) :
				while ( $query->have_posts() ) :
					$query->the_post(); $count++;

					$position = $selected === 'popular' ? sprintf( $format[ 'position'], $count ) : '';

					$thumb = get_the_post_thumbnail( null, 'neville-small-1x' );

					if( $thumb === '' ) {
						$thumb = get_template_directory_uri() . '/images/ph-neville-no-thumb-150.jpg';
						$thumb = '<img src="' . $thumb . '" alt="" />';
					}

					printf(
						$format[ 'post' ],
						$thumb,
						esc_url( get_the_permalink() ),
						$position,
						the_title( '', '', false ),
						get_the_date()
					);

				endwhile;
				// Reset
				wp_reset_postdata();
			endif;

			echo $format[ 'end' ];

		} // not_query

	}
}
