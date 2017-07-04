<?php
/**
 * Templates and functions used to display post meta
 */

// Content single entry tags
if( ! function_exists( 'neville_entry_tags_list' ) ) {
	function neville_entry_tags_list( $args = [] ) {
		$defaults = apply_filters( 'neville___entry_tags_list', [
			'before'      => '<div class="single-metainfo"><span class="list-title">' . __( 'Tags: ', 'neville' ) . '</span>',
			'after'       => '</div>',
			'sep'         => _x( ' ', 'single tags seperator', 'neville' ),
			'location'    => 'single',
			'show'        => true,
			'echo'        => true
		] );

		$args = wp_parse_args( $args, $defaults );

		if( ! $args[ 'show' ] ) return;

		if( $args[ 'echo' ] ) {
			the_tags( $args[ 'before' ], $args[ 'sep' ], $args[ 'after' ] );
		} else {
			$the_tags = get_the_tag_list( $args[ 'before' ], $args[ 'sep' ], $args[ 'after' ] );

 			return ! is_wp_error( $the_tags ) ? $the_tags : false;
		}
	}
}

// Content single entry categories
if( ! function_exists( 'neville_entry_categories_list' ) ) {
	function neville_entry_categories_list( $args = [] ) {
		$defaults = apply_filters( 'neville___entry_categories_list', [
			'before'      => '<div class="single-metainfo"><span class="list-title">' . __( 'Categories: ', 'neville' ) . '</span>',
			'after'       => '</div>',
			'sep'         => _x( ' ', 'single categories seperator', 'neville' ),
			'format'      => '%1$s%2$s%3$s',
			'location'    => 'single',
			'show'        => true,
			'echo'        => true,
		] );

		$args = wp_parse_args( $args, $defaults );

		if( ! $args[ 'show' ] ) return;

		if( $args[ 'echo' ] ) {
			printf(
				$args[ 'format' ],
				$args[ 'before' ],
				get_the_category_list( $args[ 'sep' ] ),
				$args[ 'after' ]
			);
		} else {
			return sprintf(
				$args[ 'format' ],
				$args[ 'before' ],
				get_the_category_list( $args[ 'sep' ] ),
				$args[ 'after' ]
			);
		}
	}
}

if( ! function_exists( 'neville_entry_meta' ) ) {
	function neville_entry_meta( $args = array(), $echo = true ) {
		$defaults = apply_filters( 'neville_entry_meta___defaults', array(
			'wrapper'  => true,
			'tag'      => 'footer',
			'class'    => 'entry-meta',
			'category' => false,
			'author'   => true,
			'comments' => true,
			'time'     => true,
			'share'    => true,
		) );

		$args = wp_parse_args( $args, $defaults );

		$template  = $args['wrapper']  ? sprintf( '<%1$s class="%2$s">', esc_attr( $args['tag'] ), esc_attr( $args['class'] ) ) : '';
		$template .= $args['category'] ? neville_em_single_cat() : '';
		$template .= $args['author']   ? neville_em_author() : '';
		$template .= $args['comments'] ? neville_em_comments() : '';
		$template .= $args['time']     ? neville_em_time() : '';
		$template .= $args['share']    ? neville_em_share() : '';
		$template .= $args['wrapper']  ? sprintf( '</%s>', esc_attr( $args['tag'] ) ) : '';

		$output = apply_filters( 'neville_entry_meta___output', $template, $args, $defaults );

		if( $echo ) {
			echo $output;
		} else {
			return $output;
		}
	}
}

if( ! function_exists( 'neville_em_author' ) ) {
	function neville_em_author() {
		$author = get_the_author();
		$format = '<span class="article-author"><i class="nicon nicon-user"></i> <em>%s</em></span>';
		$output = sprintf( $format, esc_html( $author ) );

		return apply_filters( 'neville_em_author___tmpl', $output, $format, $author );
	}
}

if( ! function_exists( 'neville_em_comments' ) ) {
	function neville_em_comments() {
		$link   = get_comments_link();
		$number = get_comments_number();
		$format = '<a href="%1$s" class="comments-count"><i class="nicon nicon-bubble"></i> %2$d</a>';
		$output = sprintf( $format, esc_url( $link ), absint( $number ) );

		return apply_filters( 'neville_em_comments___tmpl', $output, $format, $link, $number );
	}
}

if( ! function_exists( 'neville_em_time' ) ) {
	function neville_em_time() {
		$date   = get_the_date();
		$format = '<time>%s</time>';
		$output = sprintf( $format, esc_html( $date ) );

		return apply_filters( 'neville_em_time___tmpl', $output, $format, $date );
	}
}

if( ! function_exists( 'neville_em_sticky_tag' ) ) {
	function neville_em_sticky_tag() {
		if( ! is_sticky() ) return;

		return sprintf(
			'<span class="sticky-tag">%s</span>',
			apply_filters( 'neville___sticky_tag', __( 'Sticky', 'neville' ) )
		);
	}
}

if( ! function_exists( 'neville_em_share' ) ) {
	function neville_em_share( $text = '' ) {
		$where = neville_check_sharing_show( 'index' );

		if( ! $where ) return;

		$format = '<a href="#" class="jp-share-init"><i class="nicon nicon-share-alt"></i>%s</a>';
		//$format = '<a href="#" class="jp-share-init"><i class="nicon nicon-facebook-square"></i> <i class="nicon nicon-twitter-square"></i> %s</a>';
		$output = sprintf( $format, esc_html( $text ) );

		return apply_filters( 'neville_em_share___tmpl', $output, $format, $text );
	}
}

if( ! function_exists( 'neville_share_display' ) ) {
	function neville_share_display( $echo = false ) {
		$share = apply_filters( 'neville_share_display_index', '' );

		if( $share === '' ) return;

		$output = apply_filters( 'neville_share_display', '
			<div class="jp-share-display">
				%s
				<a href="#" class="jp-share-close">&#120;</a>
			</div>
		', $share );

		if( $echo ) {
			printf( $output, $share );
		} else {
			return sprintf( $output, $share );
		}
	}
}

if( ! function_exists( 'neville_em_single_cat' ) ) {
	/**
	 * Get the first category
	 *
	 * Function forked from University Hub theme & modified for our needs.
	 * Original author: WEN Themes
	 * Author URI: http://wenthemes.com/
	 * License: GPLv2
	 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
	 */
	function neville_em_single_cat( $args = array(), $echo = false ) {
		$defaults = array(
			'taxonomy' => 'category',
			'class'    => 'category-link sty2',
			'post_id'  => false,
			'before'   => '',
			'after'    => ''
		);

		$args = wp_parse_args( $args, $defaults);

		// Bail if post is not related to taxonomy.
		if ( ! is_object_in_taxonomy( get_post_type( $args[ 'post_id' ] ), $args[ 'taxonomy' ] ) ) {
			return;
		}

		$post = get_post( $args[ 'post_id' ] );

		// Bail if not valid post.
		if ( ! is_a( $post, 'WP_Post' ) ) {
			return;
		}

		$terms = wp_get_post_terms( $post->ID, $args[ 'taxonomy' ] );

		// Bail if no terms available.
		if ( empty( $terms ) ) {
			return;
		}

		// Sort the terms by ID and get the first category.
		if ( function_exists( 'wp_list_sort' ) ) {
			$terms = wp_list_sort( $terms, 'term_id' );
		}
		else {
			usort( $terms, '_usort_terms_by_ID' );
		}

		$term = array_shift( $terms );

		$format = '<a href="%1$s" class="%2$s">%3$s</a>';
		$category = sprintf( $format, esc_url( get_term_link( $term ) ), esc_attr( $args[ 'class' ] ), esc_html( $term->name ) );

		$output = $args[ 'before' ] . apply_filters( 'neville_em_single_cat___output', $category, $args, $format, $term ) . $args[ 'after' ];

		if( $echo ) {
			echo $output;
		} else {
			return $output;
		}
	}
}

if( ! function_exists( 'neville_content_cat' ) ) {
	function neville_content_cat() {
		$args = apply_filters( 'neville_content_cat', array(
			'before' => '<div class="entry-meta">',
			'after'  => '</div>'
		) );
		neville_em_single_cat( $args, true );
	}
}

if( ! function_exists( 'neville_excerpt' ) ) {
	function neville_excerpt( $args = array(), $echo = true ) {
		$defaults = apply_filters( 'neville_excerpt___defaults', array(
			'wrap'   => true,
			'before' => '<p class="entry-excerpt">',
			'after'  => '</p>',
			'text'   => get_the_excerpt(),
			'num'    => 20,
			'more'   => _x( '&hellip;', 'excerpt ending dots', 'neville' ),
		) );

		$args   = wp_parse_args( $args, $defaults );
		$before = $args[ 'wrap' ] ? $args[ 'before' ] : '';
		$after  = $args[ 'wrap' ] ? $args[ 'after' ] : '';
		$output = $before . wp_trim_words( $args[ 'text' ], absint( $args[ 'num' ] ), esc_html( $args[ 'more' ] ) ) . $after;

		if( $echo ) {
			echo $output;
		} else {
			return $output;
		}
	}
}

if( ! function_exists( 'neville_content_thumbnail' ) ) {
	function neville_content_thumbnail( $args = array(), $echo = true ) {
		global $post;

		if( ! is_object( $post ) ) return;

		$defaults = apply_filters( 'neville_content_thumbnail___defaults', array(
			'wrap'      => true,
			'overlay'   => true,
			'link'      => true,
			'w_before'  => '<figure class="img-has-overlay post-thumbnail">',
			'w_after'   => '</figure>',
			'o_before'  => '<figcaption class="img-overlay empty-caption no-gradient">',
			'o_after'   => '</figcaption>',
			'size'      => 'post-thumbnail',
			'link_tmpl' => '<a href="' . esc_url( get_the_permalink() ) . '" class="img-link-to" rel="nofollow"></a>',
		) );

		$args = wp_parse_args( $args, $defaults );

		$wrap_before    = $args[ 'wrap' ] ? $args[ 'w_before' ] : '';
		$wrap_after     = $args[ 'wrap' ] ? $args[ 'w_after' ] : '';
		$overlay_before = $args[ 'overlay' ] ? $args[ 'o_before' ] : '';
		$overlay_after  = $args[ 'overlay' ] ? $args[ 'o_after' ] : '';
		$link           = $args[ 'link' ] ? $args[ 'link_tmpl' ] : '';

		$template  = $wrap_before;
		$template .= get_the_post_thumbnail( $post, $args[ 'size' ] );
		$template .= $overlay_before;
		$template .= $link;
		$template .= $overlay_after;
		$template .= $wrap_after;

		$template  = apply_filters( 'neville_content_thumbnail___tmpl', $template, $args, $defaults );

		if( has_post_thumbnail() ) {
			if( $echo ) {
				echo $template;
			} else {
				return $template;
			}
		}
	}
}
