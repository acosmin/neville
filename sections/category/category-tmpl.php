<?php
/**
 * ----------------------------------
 * Category section template partials
 *
 * @package Neville
 * ----------------------------------
 */

/**
 * Hook some template actions ;)
 *
 * @see https://developer.wordpress.org/reference/functions/add_action/
 */
add_action( 'neville__section_category', 'neville__sec_tmpl_category',  10 );

add_action( 'neville__sec_tmpl_category', 'neville__sec_tmpl_category_start',   10 );
add_action( 'neville__sec_tmpl_category', 'neville__sec_tmpl_category_header',  20 );
add_action( 'neville__sec_tmpl_category', 'neville__sec_tmpl_category_posts',   30 );
add_action( 'neville__sec_tmpl_category', 'neville__sec_tmpl_category_sidebar', 40 );
add_action( 'neville__sec_tmpl_category', 'neville__sec_tmpl_category_end',     999 );

add_action( 'neville__sec_tmpl_category_header', 'neville__sec_tmpl_category_header_start', 10 );
add_action( 'neville__sec_tmpl_category_header', 'neville__sec_tmpl_category_header_title', 20 );
add_action( 'neville__sec_tmpl_category_header', 'neville__sec_tmpl_category_header_desc',  30 );
add_action( 'neville__sec_tmpl_category_header', 'neville__sec_tmpl_category_header_links', 40 );
add_action( 'neville__sec_tmpl_category_header', 'neville__sec_tmpl_category_header_end',   999 );

add_action( 'neville__sec_tmpl_category_posts', 'neville__sec_tmpl_category_posts_start', 10 );
add_action( 'neville__sec_tmpl_category_posts', 'neville__sec_tmpl_category_posts_tmpl',  20 );
add_action( 'neville__sec_tmpl_category_posts', 'neville__sec_tmpl_category_posts_query', 30 );
add_action( 'neville__sec_tmpl_category_posts', 'neville__sec_tmpl_category_posts_end',   980 );
add_action( 'neville__sec_tmpl_category_posts', 'neville__sec_tmpl_category_posts_js',    999 );

add_action( 'neville__sec_tmpl_category_post', 'neville__sec_tmpl_category_post_start',  10 );
add_action( 'neville__sec_tmpl_category_post', 'neville__sec_tmpl_category_post_share',  20 );
add_action( 'neville__sec_tmpl_category_post', 'neville__sec_tmpl_category_post_figure', 30 );
add_action( 'neville__sec_tmpl_category_post', 'neville__sec_tmpl_category_post_entry',  40 );
add_action( 'neville__sec_tmpl_category_post', 'neville__sec_tmpl_category_post_end',    999 );

add_action( 'neville__sec_tmpl_category_post_figure', 'neville__sec_tmpl_category_post_figure_start',   10 );
add_action( 'neville__sec_tmpl_category_post_figure', 'neville__sec_tmpl_category_post_figure_image',   20 );
add_action( 'neville__sec_tmpl_category_post_figure', 'neville__sec_tmpl_category_post_figure_caption', 30 );
add_action( 'neville__sec_tmpl_category_post_figure', 'neville__sec_tmpl_category_post_figure_end',     999 );

add_action( 'neville__sec_tmpl_category_post_figure_caption', 'neville__sec_tmpl_category_post_caption_start', 10 );
add_action( 'neville__sec_tmpl_category_post_figure_caption', 'neville__sec_tmpl_category_post_caption_link',  20 );
add_action( 'neville__sec_tmpl_category_post_figure_caption', 'neville__sec_tmpl_category_post_caption_end',   999 );

add_action( 'neville__sec_tmpl_category_post_entry', 'neville__sec_tmpl_category_post_entry_start',   10 );
add_action( 'neville__sec_tmpl_category_post_entry', 'neville__sec_tmpl_category_post_entry_title',   20 );
add_action( 'neville__sec_tmpl_category_post_entry', 'neville__sec_tmpl_category_post_entry_excerpt', 30 );
add_action( 'neville__sec_tmpl_category_post_entry', 'neville__sec_tmpl_category_post_entry_meta',    40 );
add_action( 'neville__sec_tmpl_category_post_entry', 'neville__sec_tmpl_category_post_entry_end',     999 );

add_action( 'neville__sec_tmpl_category_post_entry_meta', 'neville__sec_tmpl_category_post_meta_start', 10 );
add_action( 'neville__sec_tmpl_category_post_entry_meta', 'neville__sec_tmpl_category_post_meta_com',   20 );
add_action( 'neville__sec_tmpl_category_post_entry_meta', 'neville__sec_tmpl_category_post_meta_share', 30 );
add_action( 'neville__sec_tmpl_category_post_entry_meta', 'neville__sec_tmpl_category_post_meta_time',  40 );
add_action( 'neville__sec_tmpl_category_post_entry_meta', 'neville__sec_tmpl_category_post_meta_end',   999 );

add_action( 'neville__sec_tmpl_category_sidebar', 'neville__sec_tmpl_cat_side_start',   10 );
add_action( 'neville__sec_tmpl_category_sidebar', 'neville__sec_tmpl_cat_side_widgets', 20 );
add_action( 'neville__sec_tmpl_category_sidebar', 'neville__sec_tmpl_cat_side_end',     980 );
add_action( 'neville__sec_tmpl_category_sidebar', 'neville__sec_tmpl_cat_side_js',      999 );

add_action( 'neville__sec_tmpl_cat_side_widgets', 'neville__sec_tmpl_cat_side_wid_posts', 10 );
add_action( 'neville__sec_tmpl_cat_side_widgets', 'neville__sec_tmpl_cat_side_wid_btns',  20 );

add_action( 'neville__sec_tmpl_cat_side_wid_btns', 'neville__sec_tmpl_cat_side_wid_btns_more', 10 );
add_action( 'neville__sec_tmpl_cat_side_wid_btns', 'neville__sec_tmpl_cat_side_wid_btns_rss',  20 );

add_action( 'neville__sec_tmpl_cat_side_wid_posts', 'neville__sec_tmpl_cat_side_wid_posts_start',  10 );
add_action( 'neville__sec_tmpl_cat_side_wid_posts', 'neville__sec_tmpl_cat_side_wid_posts_header', 20 );
add_action( 'neville__sec_tmpl_cat_side_wid_posts', 'neville__sec_tmpl_cat_side_wid_posts_query',  30 );
add_action( 'neville__sec_tmpl_cat_side_wid_posts', 'neville__sec_tmpl_cat_side_wid_posts_end',    999 );

/**
 * Called functions
 *
 * @see https://developer.wordpress.org/reference/functions/do_action/
 */

// Category template
if( ! function_exists( 'neville__sec_tmpl_category' ) ) {
	function neville__sec_tmpl_category( $o ) {
		/**
		 * Hooked
		 * neville__sec_tmpl_category_start   - 10
		 * neville__sec_tmpl_category_header  - 20
		 * neville__sec_tmpl_category_posts   - 30
		 * neville__sec_tmpl_category_sidebar - 40
		 * neville__sec_tmpl_category_end     - 999
		 */
		do_action( 'neville__sec_tmpl_category', $o );
	}
}

	// Category wrap start
	if( ! function_exists( 'neville__sec_tmpl_category_start' ) ) {
		function neville__sec_tmpl_category_start( $o ) {
			?>
			<div class="container">
				<div class="row-display grid-2">
			<?php
		}
	}

	// Category wrap end
	if( ! function_exists( 'neville__sec_tmpl_category_end' ) ) {
		function neville__sec_tmpl_category_end( $o ) {
			?>
				</div>
			</div><!-- .container -->
			<?php
		}
	}

	// Category header
	if( ! function_exists( 'neville__sec_tmpl_category_header' ) ) {
		function neville__sec_tmpl_category_header( $o ) {
			// Disabled
			if( ! $o[ 'header' ] ) return;

			/**
			 * Hooked:
			 * neville__sec_tmpl_category_header_start - 10
			 * neville__sec_tmpl_category_header_title - 20
			 * neville__sec_tmpl_category_header_desc  - 30
			 * neville__sec_tmpl_category_header_links - 40
			 * neville__sec_tmpl_category_header_end   - 999
			 */
			do_action( 'neville__sec_tmpl_category_header', $o );
		}
	}

		// Category header start
		if( ! function_exists( 'neville__sec_tmpl_category_header_start' ) ) {
			function neville__sec_tmpl_category_header_start( $o ) {
				?>
				<div class="col-12x">
					<header class="section-header sh2x">
				<?php
			}
		}

		// Category header title
		if( ! function_exists( 'neville__sec_tmpl_category_header_title' ) ) {
			function neville__sec_tmpl_category_header_title( $o ) {
				// Do nothing if not selected
				if( $o[ 'category' ] === 0 ) return;

				// Some variables
				$name   = get_the_category_by_ID( $o[ 'category' ] );
				$link   = get_category_link( $o[ 'category' ] );
				$before = $o[ 'link' ] ? '<a href="' . esc_url( $link ) . '">' : '';
				$after  = $o[ 'link' ] ? '</a>' : '';
				$format = apply_filters( 'neville___sec_tmpl_category_header_title', '<h2 class="section-title st2x">%s</h2>', $o );

				// Output title
				printf(
					$format,
					$before . $name . $after
				);
			}
		}

		// Category header description
		if( ! function_exists( 'neville__sec_tmpl_category_header_desc' ) ) {
			function neville__sec_tmpl_category_header_desc( $o ) {
				// Do nothing if not selected
				if( $o[ 'category' ] === 0 ) return;

				// Some variables
				$desc   = strip_tags( category_description( $o[ 'category' ] ) );
				$format = '<p class="section-description">%s</p>';
				$output = sprintf( $format, $desc );
				$output = apply_filters( 'neville___sec_tmpl_category_header_desc', $output, $o, $format );

				// Do nothing if we don't have a description
				if( ! isset( $desc ) ) return;

				// Output
				echo $output;
			}
		}

		// Category header links
		if( ! function_exists( 'neville__sec_tmpl_category_header_links' ) ) {
			function neville__sec_tmpl_category_header_links( $o ) {
				// Selected navigation
				$selected = $o[ 'nav' ];

				// Do nothing if it's not selected
				if( $selected == '' ) return;

				// Navigation args
				$nav_menu_args = array(
					'menu'        => $selected,
					'fallback_cb' => '',
					'container'   => 'ul',
					'menu_class'  => 'small-nav section-subcats',
					'depth'       => 1
				);

				// Output navigation menu
				wp_nav_menu( apply_filters( 'neville___sec_tmpl_category_header_links', $nav_menu_args, $o ) );
			}
		}

		// Category header end
		if( ! function_exists( 'neville__sec_tmpl_category_header_end' ) ) {
			function neville__sec_tmpl_category_header_end( $o ) {
				?>
					</header>
				</div>
				<?php
			}
		}

	if( ! function_exists( 'neville__sec_tmpl_category_posts' ) ) {
		function neville__sec_tmpl_category_posts( $o ) {
			/**
			 * Hooked:
			 * neville__sec_tmpl_category_posts_start - 10
			 * neville__sec_tmpl_category_posts_tmpl  - 20
			 * neville__sec_tmpl_category_posts_query - 30
			 * neville__sec_tmpl_category_posts_end   - 980
			 * neville__sec_tmpl_category_posts_js    - 999
			 */
			do_action( 'neville__sec_tmpl_category_posts', $o );
		}
	}

		// Category posts start
		if( ! function_exists( 'neville__sec_tmpl_category_posts_start' ) ) {
			function neville__sec_tmpl_category_posts_start( $o ) {
				// Variables
				$widget = $o[ 'widget' ];
				$type   = $o[ 'side' ] ? 'col-8x' : 'col-12x list-articles';
				$type2  = $o[ 'side' ] ? 'masonry-2cols-halfs' : 'masonry-3cols-halfs';
				$format = '<div class="%1$s"><div class="masonry-grid-%2$s masonry-display %3$s">';

				// Output format
				$output = sprintf( $format, $type, absint( $widget->number ), $type2 );
				$output = apply_filters( 'neville___sec_tmpl_category_posts_start', $output, $o, $type, $type2, $format );

				// Output
				echo $output;
			}
		}

		// Category posts end
		if( ! function_exists( 'neville__sec_tmpl_category_posts_end' ) ) {
			function neville__sec_tmpl_category_posts_end( $o ) {
				?>
					</div>
				</div>
				<?php
			}
		}

		// Category posts sizing templates
		if( ! function_exists( 'neville__sec_tmpl_category_posts_tmpl' ) ) {
			function neville__sec_tmpl_category_posts_tmpl( $o ) {
				?>
				<div class="masonry-sizer"></div>
				<div class="masonry-gutter"></div>
				<?php
			}
		}

		// Category posts query
		if( ! function_exists( 'neville__sec_tmpl_category_posts_query' ) ) {
			function neville__sec_tmpl_category_posts_query( $o ) {
				// Some vars
				$count = 0;
				$args  = [];
				$cat   = $o[ 'category' ];

				// Exclude posts from child categories
				if( $o[ 'no_child'] ) {
					$args[ 'category__in' ] = intval( $cat );
				} else {
					$args[ 'cat' ] = intval( $cat );
				}

				$args = array_merge(
					$args,
					[
						'posts_per_page'      => intval( $o[ 'qty' ] ),
						'ignore_sticky_posts' => 1
					]
				);

				// Query arguments
				$args = apply_filters( 'neville___sec_tmpl_category_query_args', $args, $o );

				// Set-up query
				$query = new WP_Query( $args );

				if( $query->have_posts() ) :
					while ( $query->have_posts() ) :
						$query->the_post();

						// Add count
						$count++;
						$o[ 'tmpl_count' ] = $count;

						// Exclude posts without thumbnails
						if( ! has_post_thumbnail() && $o[ 'nothumbs' ] ) continue;

						/**
						 * Hooked:
						 * neville__sec_tmpl_category_post_start  - 10
						 * neville__sec_tmpl_category_post_share  - 20
						 * neville__sec_tmpl_category_post_figure - 30
						 * neville__sec_tmpl_category_post_entry  - 40
						 * neville__sec_tmpl_category_post_end    - 999
						 */
						do_action( 'neville__sec_tmpl_category_post', $o );
					endwhile;
					// Reset
					wp_reset_postdata();
				else:

					/**
					 * Show this message if no featured posts are found
					 */
					if( current_user_can( 'edit_theme_options' ) ) {
						printf( '<p class="msgNotice" style="max-width: 50rem;">%s</p>', __( 'There are no posts in this category to display. Please add some!', 'neville' ) );
					}

				endif;
			}
		}

		// Category posts Javascript
		if( ! function_exists( 'neville__sec_tmpl_category_posts_js' ) ) {
			function neville__sec_tmpl_category_posts_js( $o ) {
				if( ! is_customize_preview() ) return;
				if( ! is_page_template( 'template-frontpage.php' ) ) return;

				$o[ 'widget_id' ] = $o[ 'widget' ]->id;

				echo '<script type="text/javascript">' . neville_sections_category_script( $o ) . '</script>';
			}
		}

			// Category post start
			if( ! function_exists( 'neville__sec_tmpl_category_post_start' ) ) {
				function neville__sec_tmpl_category_post_start( $o ) {
					?><div class="masonry-item"><?php
				}
			}

			// Category post end
			if( ! function_exists( 'neville__sec_tmpl_category_post_end' ) ) {
				function neville__sec_tmpl_category_post_end( $o ) {
					?></div><?php
				}
			}

			// Category post share
			if( ! function_exists( 'neville__sec_tmpl_category_post_share' ) ) {
				function neville__sec_tmpl_category_post_share( $o ) {
					neville_share_display( true );
				}
			}

			// Category post figure
			if( ! function_exists( 'neville__sec_tmpl_category_post_figure' ) ) {
				function neville__sec_tmpl_category_post_figure( $o ) {
					// Check if it has a thumbnail. If not don't show it.
					if( ! has_post_thumbnail() || ! $o[ 'thumbs' ] ) return;

					/**
					 * Hooked:
					 * neville__sec_tmpl_category_post_figure_start   - 10
					 * neville__sec_tmpl_category_post_figure_image   - 20
					 * neville__sec_tmpl_category_post_figure_caption - 30
					 * neville__sec_tmpl_category_post_figure_end     - 999
					 */
					do_action( 'neville__sec_tmpl_category_post_figure', $o );
				}
			}

				// Category post figure start
				if( ! function_exists( 'neville__sec_tmpl_category_post_figure_start' ) ) {
					function neville__sec_tmpl_category_post_figure_start( $o ) {
						?><figure class="img-has-overlay"><?php
					}
				}

				// Category post figure end
				if( ! function_exists( 'neville__sec_tmpl_category_post_figure_end' ) ) {
					function neville__sec_tmpl_category_post_figure_end( $o ) {
						?></figure><?php
					}
				}

				// Category post figure image
				if( ! function_exists( 'neville__sec_tmpl_category_post_figure_image' ) ) {
					function neville__sec_tmpl_category_post_figure_image( $o ) {
						$size  = 'neville-gird2-2x-auto';
						$thumb = apply_filters( 'neville___sec_tmpl_category_post_figure_image', $size, $o );
						the_post_thumbnail( $thumb );
					}
				}

				// Category post figure caption
				if( ! function_exists( 'neville__sec_tmpl_category_post_figure_caption' ) ) {
					function neville__sec_tmpl_category_post_figure_caption( $o ) {
						/**
						 * Hooked:
						 * neville__sec_tmpl_category_post_caption_start - 10
						 * neville__sec_tmpl_category_post_caption_link  - 20
						 * neville__sec_tmpl_category_post_caption_end   - 999
						 */
						do_action( 'neville__sec_tmpl_category_post_figure_caption', $o );
					}
				}

					// Category post caption
					if( ! function_exists( 'neville__sec_tmpl_category_post_caption_start' ) ) {
						function neville__sec_tmpl_category_post_caption_start( $o ) {
							$overlay = $o[ 'othumb' ] ? '' : ' no-gradient';
							printf( '<figcaption class="img-overlay empty-caption%s">', $overlay );
						}
					}

					// Category post figure end
					if( ! function_exists( 'neville__sec_tmpl_category_post_caption_end' ) ) {
						function neville__sec_tmpl_category_post_caption_end( $o ) {
							?></figcaption><?php
						}
					}

					// Category post figure link
					if( ! function_exists( 'neville__sec_tmpl_category_post_caption_link' ) ) {
						function neville__sec_tmpl_category_post_caption_link( $o ) {
							// Disabled?
							if( ! $o[ 'lthumb' ] ) return;
							?>
							<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="img-link-to" rel="nofollow"></a>
							<?php
						}
					}

			// Category post entry
			if( ! function_exists( 'neville__sec_tmpl_category_post_entry' ) ) {
				function neville__sec_tmpl_category_post_entry( $o ) {
					/**
					 * Hooked:
					 * neville__sec_tmpl_category_post_entry_start   - 10
					 * neville__sec_tmpl_category_post_entry_title   - 20
					 * neville__sec_tmpl_category_post_entry_excerpt - 30
					 * neville__sec_tmpl_category_post_entry_meta    - 40
					 * neville__sec_tmpl_category_post_entry_end     - 999
					 */
					do_action( 'neville__sec_tmpl_category_post_entry', $o );
				}
			}

				// Category post entry start
				if( ! function_exists( 'neville__sec_tmpl_category_post_entry_start' ) ) {
					function neville__sec_tmpl_category_post_entry_start( $o ) {
						?><div class="entry-content"><?php
					}
				}

				// Category post entry end
				if( ! function_exists( 'neville__sec_tmpl_category_post_entry_end' ) ) {
					function neville__sec_tmpl_category_post_entry_end( $o ) {
						?></div><?php
					}
				}

				// Category post entry title
				if( ! function_exists( 'neville__sec_tmpl_category_post_entry_title' ) ) {
					function neville__sec_tmpl_category_post_entry_title( $o ) {
						// Disabled
						if( ! $o[ 'ptitle' ] ) return;

						// Display title
						neville_content_title( array(
							'before' => '<h3 class="entry-title t-1x"><a title="' . the_title_attribute( 'echo=0' ) . '" href="' . esc_url( get_permalink() ) . '" rel="bookmark">',
							'after'  => '</a></h3>'
						), 'category_sec_small' );
					}
				}

				// Category post entry excerpt
				if( ! function_exists( 'neville__sec_tmpl_category_post_entry_excerpt' ) ) {
					function neville__sec_tmpl_category_post_entry_excerpt( $o ) {
						// Disabled
						if( ! $o[ 'excerpt' ] ) return;

						// Size
						$num = $o[ 'excpts' ];

						// Arguments
						$args = [ 'num' => $num ];
						$args = apply_filters( 'neville___sec_tmpl_category_post_entry_excerpt', $args, $o );

						// Output
						neville_excerpt( $args );
					}
				}

				// Category post entry meta
				if( ! function_exists( 'neville__sec_tmpl_category_post_entry_meta' ) ) {
					function neville__sec_tmpl_category_post_entry_meta( $o ) {
						// Vars
						$disable = $o[ 'meta' ];
						$com     = $o[ 'com' ];
						$share   = $o[ 'share' ];
						$date    = $o[ 'date' ];

						// Disabled
						if( ! $o[ 'meta' ] || ( ! $com && ! $share && ! $date ) ) return;

						/**
						 * Hooked:
						 * neville__sec_tmpl_category_post_meta_start - 10
						 * neville__sec_tmpl_category_post_meta_com   - 20
						 * neville__sec_tmpl_category_post_meta_share - 30
						 * neville__sec_tmpl_category_post_meta_time  - 40
						 * neville__sec_tmpl_category_post_meta_end   - 999
						 */
						do_action( 'neville__sec_tmpl_category_post_entry_meta', $o );
					}
				}

					// Category post meta start
					if( ! function_exists( 'neville__sec_tmpl_category_post_meta_start' ) ) {
						function neville__sec_tmpl_category_post_meta_start( $o ) {
							?><footer class="entry-meta"><?php
						}
					}

					// Category post meta end
					if( ! function_exists( 'neville__sec_tmpl_category_post_meta_end' ) ) {
						function neville__sec_tmpl_category_post_meta_end( $o ) {
							?></footer><?php
						}
					}

					// Category post meta comments
					if( ! function_exists( 'neville__sec_tmpl_category_post_meta_com' ) ) {
						function neville__sec_tmpl_category_post_meta_com( $o ) {
							// Disabled
							if( ! $o[ 'com' ] ) return;

							// Output
							echo neville_em_comments();
						}
					}

					// Category post meta share
					if( ! function_exists( 'neville__sec_tmpl_category_post_meta_share' ) ) {
						function neville__sec_tmpl_category_post_meta_share( $o ) {
							// Disabled
							if( ! $o[ 'share' ] ) return;

							// Before text
							$text = apply_filters( 'neville___sec_tmpl_category_post_meta_share', '', $o );

							// Output
							echo neville_em_share( $text );
						}
					}

					// Category post meta time
					if( ! function_exists( 'neville__sec_tmpl_category_post_meta_time' ) ) {
						function neville__sec_tmpl_category_post_meta_time( $o ) {
							// Disabled
							if( ! $o[ 'date' ] ) return;

							echo neville_em_time();
						}
					}

	// Category sidebar
	if( ! function_exists( 'neville__sec_tmpl_category_sidebar' ) ) {
		function neville__sec_tmpl_category_sidebar( $o ) {
			// Don't show if disabled
			if( ! $o[ 'side' ] ) return;

			/**
			 * Hooked:
			 * neville__sec_tmpl_cat_side_start - 10
			 * neville__sec_tmpl_cat_side_end   - 980
			 * neville__sec_tmpl_cat_side_js    - 999
			 */
			do_action( 'neville__sec_tmpl_category_sidebar', $o );
		}
	}

		// Category sidebar start
		if( ! function_exists( 'neville__sec_tmpl_cat_side_start' ) ) {
			function neville__sec_tmpl_cat_side_start( $o ) {
				$widget = $o[ 'widget' ];
				$nr     = $widget->number;
				?>
				<div class="col-4x">
					<aside id="sec-category-<?php echo absint( $nr ); ?>-sidebar" class="sidebar" role="complementary">
						<div class="sticky-sidebar-ac">
				<?php
			}
		}

		// Category sidebar end
		if( ! function_exists( 'neville__sec_tmpl_cat_side_end' ) ) {
			function neville__sec_tmpl_cat_side_end( $o ) {
				?>
						</div>
					</aside>
				</div>
				<?php
			}
		}

		// Category sidebar js
		if( ! function_exists( 'neville__sec_tmpl_cat_side_js' ) ) {
			function neville__sec_tmpl_cat_side_js( $o ) {
				if( ! is_customize_preview() ) return;
				if( ! is_page_template( 'template-frontpage.php' ) ) return;

				$o[ 'widget_id' ] = $o[ 'widget' ]->id;

				echo '<script type="text/javascript">' . neville_sections_category_side_script( $o ) . '</script>';
			}
		}

		// Category widgets
		if( ! function_exists( 'neville__sec_tmpl_cat_side_widgets' ) ) {
			function neville__sec_tmpl_cat_side_widgets( $o ) {
				/**
				 * Hooked:
				 * neville__sec_tmpl_cat_side_wid_posts - 10
				 * neville__sec_tmpl_cat_side_wid_btns  - 20
				 */
				do_action( 'neville__sec_tmpl_cat_side_widgets', $o );
			}
		}

			// Category posts widget
			if( ! function_exists( 'neville__sec_tmpl_cat_side_wid_posts' ) ) {
				function neville__sec_tmpl_cat_side_wid_posts( $o ) {
					/**
					 * Hooked:
					 * neville__sec_tmpl_cat_side_wid_posts_start  - 10
					 * neville__sec_tmpl_cat_side_wid_posts_header - 20
					 * neville__sec_tmpl_cat_side_wid_posts_query  - 30
					 * neville__sec_tmpl_cat_side_wid_posts_end    - 999
					 */
					do_action( 'neville__sec_tmpl_cat_side_wid_posts', $o );
				}
			}

				// Category posts widget start
				if( ! function_exists( 'neville__sec_tmpl_cat_side_wid_posts_start' ) ) {
					function neville__sec_tmpl_cat_side_wid_posts_start( $o ) {
						?>
						<section class="widget">
							<div class="widget-content">
						<?php
					}
				}

				// Category posts widget end
				if( ! function_exists( 'neville__sec_tmpl_cat_side_wid_posts_end' ) ) {
					function neville__sec_tmpl_cat_side_wid_posts_end( $o ) {
						?>
							</div>
						</section>
						<?php
					}
				}

				// Category posts widget header
				if( ! function_exists( 'neville__sec_tmpl_cat_side_wid_posts_header' ) ) {
					function neville__sec_tmpl_cat_side_wid_posts_header( $o ) {
						// Variables
						$format = '<h2 class="widget-title"><span>%s</span></h2>';
						$title  = sprintf( $format, esc_html( $o[ 'side_t' ] ) );
						$wrap   = '<header class="widget-title-wrap">%s</header>';
						$output = sprintf( $wrap, $title );

						// Filter
						$output = apply_filters( 'neville___sec_tmpl_cat_side_wid_posts_header', $output, $o, $wrap, $format, $title );

						// Output
						echo $output;
					}
				}

				// Category posts widget query
				if( ! function_exists( 'neville__sec_tmpl_cat_side_wid_posts_query' ) ) {
					function neville__sec_tmpl_cat_side_wid_posts_query( $o ) {
						// Variables
						$selected = $o[ 'side_q' ];
						$args     = [];
						$cat      = $o[ 'category' ];

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

						// Exclude posts from child categories
						if( $o[ 'no_child'] ) {
							$args[ 'category__in' ] = intval( $cat );
						} else {
							$args[ 'cat' ] = intval( $cat );
						}

						// Filter args
						$args = apply_filters( 'neville___sec_tmpl_cat_side_wid_posts_query', $args, $o );

						// Query posts or do something else
						if( array_key_exists( 'not_query', $o ) && $o[ 'not_query' ] ) {
							/**
							 * Make sure we can hook via companion and do something else
							 *
							 * @param array $o    Widget options
							 * @param mixed $args It can be an array or something else if filtered
							 */
							do_action( 'neville__sec_tmpl_cat_side_wid_not_query', $o, $args );
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

							$format = apply_filters( 'neville___sec_tmpl_cat_side_wid_posts_tmpls', [
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

			// Category buttons
			if( ! function_exists( 'neville__sec_tmpl_cat_side_wid_btns' ) ) {
				function neville__sec_tmpl_cat_side_wid_btns( $o ) {
					if( ! $o[ 'side_btn' ] ) return;
					?>
					<section class="widget wid-big-buttons">
						<?php
						/**
						 * Hooked:
						 * neville__sec_tmpl_cat_side_wid_btns_more - 10
						 * neville__sec_tmpl_cat_side_wid_btns_rss  - 20
						 */
						do_action( 'neville__sec_tmpl_cat_side_wid_btns', $o );
						?>
					</section>
					<?php
				}
			}

				// Category archive button
				if( ! function_exists( 'neville__sec_tmpl_cat_side_wid_btns_more' ) ) {
					function neville__sec_tmpl_cat_side_wid_btns_more( $o ) {
						$link = $o[ 'category' ] === 0 ? '#' : get_category_link( $o[ 'category' ] );

						printf(
							'<a href="%1$s" class="wid-big-button"><span>%2$s</span></a>',
							$link,
							__( 'More Articles', 'neville' )
						);
					}
				}

				// Category subscribe button
				if( ! function_exists( 'neville__sec_tmpl_cat_side_wid_btns_rss' ) ) {
					function neville__sec_tmpl_cat_side_wid_btns_rss( $o ) {
						printf(
							'<a href="%1$s" class="wid-big-button"><span>%2$s</span></a>',
							get_category_feed_link( $o[ 'category' ] ),
							'<i class="nicon nicon-feed"></i> ' . __( 'Subscribe', 'neville' )
						);
					}
				}
