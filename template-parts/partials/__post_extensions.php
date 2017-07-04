<?php
/**
 * -------------------
 * Post extensions
 *
 * @package Neville
 * -------------------
 */

if( ! function_exists( 'neville_about_the_author' ) ) {
	/**
	 * `About the author` box displayed in single view
	 *
	 * @since  1.0.0
	 * @param  boolean $echo Echo or return the output
	 * @return string        HTML output displaying info about the author
	 */
	function neville_about_the_author( $echo = true ) {
		/* Some variables */
		$avatar        = get_avatar( get_the_author_meta( 'email' ), apply_filters( 'neville_about_the_author___size', 60 ) );
		$author        = get_the_author();
		$website       = get_the_author_meta( 'url' );
		$author_prefix = _x( 'Author: ', 'author box, pre name', 'neville' );
		$author_format = '%1$s<a href="%2$s">%3$s</a>';
		$description   = get_the_author_meta( 'description' );
		$sa            = get_option( 'show_avatars' );
		$full_width    = $sa ? '' : 'atb-full-width';

		/* Display author's website url, or not */
		if( $website ) {
			$author_tmpl = sprintf(
				$author_format,
				esc_html( $author_prefix ),
				esc_url( $website ),
				esc_html( $author )
			);
		} else {
			$author_tmpl = esc_html( $author_prefix . $author );
		}

		/* Avatar */
		$avatar_tmpl = $sa ? sprintf( '<div class="avatar">%s</div>', $avatar ) : '';

		/* Description */
		$descip_tmpl = $description ? sprintf( '<div class="info-about">%s</div>', wpautop( wp_kses_post( $description ) ) ) : '';

		/* Main format */
		$format = '
			<section id="about-the-author" class="entry-author">
				%1$s
				<div class="info %2$s">
					<h3 class="small-upper-heading">%3$s</h3>
					%4$s
				</div>
			</section><!-- .entry-author -->
		';

		/* Output */
		$output = sprintf( $format, $avatar_tmpl, $full_width, $author_tmpl, $descip_tmpl );
		$output = apply_filters(
			'neville_about_the_author___tmpl',
			$output,
			[
				'format'      => $format,
				'avatar'      => $avatar,
				'avatar_tmpl' => $avatar_tmpl,
				'full_width'  => $full_width,
				'author'      => $author,
				'author_tmpl' => $author_tmpl,
				'description' => $description,
				'descip_tmpl' => $descip_tmpl,
			]
		);

		/* Return or echo output */
		if( $echo ) {
			echo $output;
		} else {
			return $output;
		}
	}
}

/**
 * Related posts
 */
if( ! function_exists( 'neville_related_posts' ) ) {
	/**
	 * `Related posts` box displaying random posts based on category
	 *
	 * @since  1.0.0
	 * @param  array  $args WP_Query arguments
	 * @return string       HTML output
	 */
	function neville_related_posts( $args = array(), $echo = true ) {
		/* Some variables */
		$cats     = wp_get_post_categories( get_queried_object_id() );
		$template = '';

		if( empty( $cats ) ) return;
		
		/* Parsing WP_Query arguments to defaults */
		$defaults = apply_filters( 'neville_related_posts___defaults', array(
			'title' => __( 'Related Posts', 'neville' ),
			'tmpl'  => 'tmpl-1',
			'query' => [
				'post_type' => 'post',
				'posts_per_page' => 4,
				'orderby' => 'rand',
				'category__in' => $cats[0]
			],
		) );
		$args = wp_parse_args( $args, $defaults );

		/* Creating a custom WP_Query */
		$query = new WP_Query( $args[ 'query' ] );

		/* HTML Output */
		if ( $query->have_posts() ) :
		$template .= '<section id="related-posts" class="related-posts ' . esc_attr( $args[ 'tmpl' ] ) . '">';
			$template .= '<header class="section-header sh1x with-margin">';
				$template .= '<h2 class="section-title st1x">' . esc_html( $args[ 'title' ] ) . '</h2>';
			$template .= '</header>';
			$template .= '<div class="row-display grid-2">';
			while ( $query->have_posts() ) :
				$query->the_post();
				$thumb_class = has_post_thumbnail() ? ' has-thumbnail' : '';
				$template .= '<div class="col-6x">';
					$template .= neville_content_thumbnail( array(
						'w_before'  => '<figure class="entry-thumbnail">',
						'w_after'   => '</figure>',
						'size'      => 'neville-small-1x'
					), false );
					$template .= '<div class="entry-small-info' . $thumb_class . '">';
						$template .= neville_content_title( array(
							'before' => '<a href="' . esc_url( get_permalink() ) . '" class="entry-title t-small" rel="bookmark">',
							'after'  => '</a>'
						), 'related_posts', false );
						$template .= '<footer class="entry-meta">' . neville_em_time() . '</footer>';
					$template .= '</div>';
				$template .= '</div>';
			endwhile;
			wp_reset_postdata();
			$template .= '</div>';
		$template .= '</section>';
		endif;

		$output = apply_filters( 'neville_related_posts___tmpl', $template, $args, $query );

		/* Return or echo output */
		if( $echo ) {
			echo $output;
		} else {
			return $output;
		}
	}
}

if( ! function_exists( 'neville_post_nav' ) ) {
	/**
	 * A custom single post navigation
	 *
	 * @since  1.0.0
	 * @param  boolean $echo Echo or return the output
	 * @return string        HTML Output
	 */
	function neville_post_nav( $echo = true ) {
		$args   = apply_filters( 'neville_post_nav___args', [] );
		$output = get_the_post_navigation( $args );

		if( $echo ) {
			echo $output;
		} else {
			return $output;
		}
	}
}

	if( ! function_exists( 'neville_post_nav___wrapper_classes' ) ) {
		/**
		 * Adding some CSS class to the single post navigation wrapper using the `navigation_markup_template` filter
		 *
		 * @see    https://developer.wordpress.org/reference/functions/_navigation_markup/
		 * @since  1.0.0
		 * @param  string $template The default template.
		 * @param  string $class    The class passed by the calling function.
		 * @return string           Navigation template.
		 */
		function neville_post_nav___wrapper_classes( $template, $class ) {
			$new_classes = apply_filters( 'neville_post_nav___wrapper_classes', 'nav-links row-display grid-1' );
			$template    = str_replace( 'nav-links', esc_attr( $new_classes ), $template );
			return $template;
		}
	}
	add_filter( 'navigation_markup_template', 'neville_post_nav___wrapper_classes', 10, 2 );

	if( ! function_exists( 'neville_post_nav___thumbnail' ) ) {
		/**
		 * Post navigation button defaults
		 *
		 * @since  1.0.0
		 * @return array Some custom arguments and defaults for `get_the_post_thumbnail()`
		 */
		function neville_post_nav___thumbnail() {
			return apply_filters( 'neville_post_nav___thumbnail', array(
				'size'        => 'neville-gird1-2x-small',
				'placeholder' => get_template_directory_uri() . '/images/placeholder-2x-small.jpg',
				'palt'        => _x( 'Placeholder', 'Placeholder for Next Post button', 'neville' ),
				'pformat'     => '<img src="%1$s" alt="%2$s">',
				'next'        => _x( 'Next', 'Post navigation adjacent', 'neville' ),
				'prev'        => _x( 'Previous', 'Post navigation adjacent', 'neville' )
			) );
		}
	}

	// Change how the "Next Post" button looks
	if( ! function_exists( 'neville_post_nav___tmpl' ) ) {
		/**
		 * Change how the "Next", "Previous" post button looks. This will add post thumbnails
		 * to these buttons, or a simple plaholder image.
		 *
		 * @see    https://developer.wordpress.org/reference/functions/get_adjacent_post_link/
		 * @since  1.0.0
		 * @param  string  $output   The adjacent post link.
		 * @param  string  $format   Link anchor format.
		 * @param  string  $link     Link permalink format.
		 * @param  WP_Post $post     The adjacent post.
		 * @param  string  $adjacent Whether the post is previous or next.
		 * @return string            A custom link URL of the previous or next post in relation to the current post.
		 */
		function neville_post_nav___tmpl( $output, $format, $link, $post, $adjacent ) {

			if( ! is_object( $post ) ) return;

			/* Get the arguments needed to output a post thumbnail */
			$thumb     = neville_post_nav___thumbnail();
			$thumbnail = get_the_post_thumbnail( $post->ID, $thumb[ 'size' ] );

			/* Thumbnail HTML output */
			if( empty( $thumbnail ) ) {
				$thumbnail = sprintf(
					$thumb[ 'pformat' ],                // <img /> format
					esc_url( $thumb[ 'placeholder' ] ), // Placeholder image url
					esc_attr( $thumb[ 'palt' ] )        // Alternative text
				);
			}

			/* Check if it's a next or previous button */
			$direction = ( $adjacent === 'next' ) ? $thumb[ 'next' ] : $thumb[ 'prev' ];

			/* Full template output */
			$tmpl_start =
			'<figure class="img-has-overlay">' . $thumbnail . '
				<figcaption class="img-overlay simple-bg">
					<div class="img-entry-content-1x">
						<span class="adjacent">' . esc_html( $direction ) . '</span>
						<h3 class="entry-title t-1x">
							<a ';
			$tmpl_end = '</a></h3></div></figcaption></figure>';

			/* Add a CSS class based on direction */
			$class = ( $adjacent === 'next' ) ? 'nav-next' : 'nav-previous';

			/* Final template output */
			$output = str_replace( $class, $class . ' col-6x', $output );
			$output = str_replace( '<a', $tmpl_start, $output );
			$output = str_replace( '</a>', $tmpl_end, $output );

			/* Done, return it */
			return apply_filters( 'neville_post_nav___tmpl', $output, $thumbnail, $thumb, $adjacent );
		}
	}
	add_filter( 'next_post_link', 'neville_post_nav___tmpl', 10, 5 );
	add_filter( 'previous_post_link', 'neville_post_nav___tmpl', 10, 5 );

if( ! function_exists( 'neville_post_comments' ) ) {
	/**
	 * `comments_template()` wrapper with conditionals
	 *
	 * @since  1.0.0
	 * @return string Comments template
	 */
	function neville_post_comments( $echo = true ) {
		// If comments are open or we have at least one comment, load up the comment template.
		if ( comments_open() || get_comments_number() ) :
			comments_template();
		endif;
	}
}
