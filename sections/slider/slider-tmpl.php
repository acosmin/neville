<?php
/**
 * --------------------------------
 * Slider section template partials
 *
 * @package Neville
 * --------------------------------
 */

/**
 * Hook some template actions ;)
 *
 * @see https://developer.wordpress.org/reference/functions/add_action/
 */
add_action( 'neville__section_slider', 'neville__sec_tmpl_slider',  10 );
add_action( 'neville__section_slider', 'neville__sec_tmpl_statics', 20 );

add_action( 'neville__sec_tmpl_slider', 'neville__sec_tmpl_slider_start', 10 );
add_action( 'neville__sec_tmpl_slider', 'neville__sec_tmpl_slider_query', 20 );
add_action( 'neville__sec_tmpl_slider', 'neville__sec_tmpl_slider_end',   980 );
add_action( 'neville__sec_tmpl_slider', 'neville__sec_tmpl_slider_js',    999 );

add_action( 'neville__sec_tmpl_slider_post', 'neville__sec_tmpl_slider_post_start',         10 );
add_action( 'neville__sec_tmpl_slider_post', 'neville__sec_tmpl_slider_post_thumb',         20 );
add_action( 'neville__sec_tmpl_slider_post', 'neville__sec_tmpl_slider_post_overlay_start', 30 );
add_action( 'neville__sec_tmpl_slider_post', 'neville__sec_tmpl_slider_post_title',         40 );
add_action( 'neville__sec_tmpl_slider_post', 'neville__sec_tmpl_slider_post_meta',          50 );
add_action( 'neville__sec_tmpl_slider_post', 'neville__sec_tmpl_slider_post_overlay_end',   60 );
add_action( 'neville__sec_tmpl_slider_post', 'neville__sec_tmpl_slider_post_end',           999 );

add_action( 'neville__sec_tmpl_slider_post_meta', 'neville__sec_tmpl_slider_post_meta_start', 10 );
add_action( 'neville__sec_tmpl_slider_post_meta', 'neville__sec_tmpl_slider_post_meta_cat',   20 );
add_action( 'neville__sec_tmpl_slider_post_meta', 'neville__sec_tmpl_slider_post_meta_com',   30 );
add_action( 'neville__sec_tmpl_slider_post_meta', 'neville__sec_tmpl_slider_post_meta_end',   999 );

add_action( 'neville__sec_tmpl_statics', 'neville__sec_tmpl_statics_start', 10 );
add_action( 'neville__sec_tmpl_statics', 'neville__sec_tmpl_statics_query', 20 );
add_action( 'neville__sec_tmpl_statics', 'neville__sec_tmpl_statics_end',   999 );

/**
 * Called functions
 *
 * @see https://developer.wordpress.org/reference/functions/do_action/
 */

// Slider part
if( ! function_exists( 'neville__sec_tmpl_slider' ) ) {
	function neville__sec_tmpl_slider( $o ) {
		// Do nothing if the slider is disabled
		if( ! $o[ 'show_slider' ] ) return;

		/**
		 * Hooked
		 * neville__sec_tmpl_slider_start - 10
		 * neville__sec_tmpl_slider_query - 20
		 * neville__sec_tmpl_slider_end   - 980
		 * neville__sec_tmpl_slider_js    - 999
		 */
		do_action( 'neville__sec_tmpl_slider', $o );
	}
}

// Slider wrap start
if( ! function_exists( 'neville__sec_tmpl_slider_start' ) ) {
	function neville__sec_tmpl_slider_start( $o ) {
		$section   = $o[ 'widget' ];
		$slider_id = $section->id . '-js';
		?>
		<div class="container">
			<div class="row-display grid-1">
				<div class="col-12x">
					<div id="<?php echo esc_attr( $slider_id ); ?>" class="sec-featured-slider owl-carousel">
		<?php
	}
}

// Slider wrap end
if( ! function_exists( 'neville__sec_tmpl_slider_end' ) ) {
	function neville__sec_tmpl_slider_end( $o ) {
		?>
					</div><!-- sec-featured-1-slider -->
					<?php if( $o[ 'show_arrows' ] ) : ?>
					<a href="#" class="sec-arrow arrow-prev"><i class="nicon nicon-angle-left"></i></a>
					<a href="#" class="sec-arrow arrow-next"><i class="nicon nicon-angle-right"></i></a>
					<?php endif; ?>
				</div><!-- .col-12x -->
			</div><!-- .row-display -->
		</div><!-- .container -->
		<?php
	}
}

// Slider JS script for Customizer
if( ! function_exists( 'neville__sec_tmpl_slider_js' ) ) {
	function neville__sec_tmpl_slider_js( $o ) {
		if( ! is_customize_preview() ) return;
		if( ! is_page_template( 'template-frontpage.php' ) ) return;

		$o[ 'widget_id' ] = $o[ 'widget' ]->id;

		echo '<script type="text/javascript">' . neville_sections_slider_script( $o ) . '</script>';
	}
}

// Slider query
if( ! function_exists( 'neville__sec_tmpl_slider_query' ) ) {
	function neville__sec_tmpl_slider_query( $o ) {
		// Count posts
		$count = 0;

		// Query arguments
		$args = apply_filters( 'neville___sec_tmpl_slider_query_args', array(
			'posts_per_page'      => intval( $o[ 'slides' ] ),
			'meta_key'            => 'neville_meta_featured_article',
			'meta_value'          => 1,
			'ignore_sticky_posts' => 1
		), $o );

		// Add block template options
		$o[ 'tmpl_block' ] = apply_filters( 'neville___sec_tmpl_slider_slide_block', array(
			'type'  => 'slider',
			'class' => [
				'wrap'    => 'img-slider',
				'caption' => 'img-overlay col-center col-middle',
				'entry'   => 'img-entry-content-4x',
				'title'   => 'entry-title t-4x'
			],
			'thumb' => 'neville-full-4x'
		), $o );

		// Set-up query
		$query = new WP_Query( $args );

		if( $query->have_posts() ) :
			while ( $query->have_posts() ) :
				$query->the_post();
				$count++;

				/**
				 * Output the post template with different CSS classes
				 *
				 * @see neville__sec_tmpl_slider_post()
				 */
				neville__sec_tmpl_slider_post( $o );
			endwhile;
			// Reset
			wp_reset_postdata();
		else:

			/**
			 * Show this message if no featured posts are found
			 */
			if( current_user_can( 'edit_theme_options' ) ) {
				printf( '<p class="msgNotice" style="max-width: 50rem;">%s</p>', __( 'You need to add some featured posts before using this section. When you edit a post, click on <b>Featured article</b> in the <b>Post Options</b> metabox (somewhere in the top-right corner). To use only the slider you will need 2 featured articles. To use this section at full capacity, you need 12.', 'neville' ) );
			}

		endif;
	}
}

	if( ! function_exists( 'neville__sec_tmpl_slider_post' ) ) {
		/**
		 * Output the post template with different CSS classes
		 *
		 * @since  1.0.0
		 * @param  array $o       Widget options
		 * @param  array $options Template options
		 * @return void           HTML template
		 */
		function neville__sec_tmpl_slider_post( $o ) {
			// Setup some defaults
			$defaults = array(
				'type'  => 'default',
				'class' => [
					'wrap'    => 'img-slider',
					'caption' => 'img-overlay col-center col-middle',
					'entry'   => 'img-entry-content-4x',
					'title'   => 'entry-title t-4x'
				],
				'thumb' => 'neville-full-4x'
			);

			// Parse options
			$o[ 'tmpl_block' ] = wp_parse_args( $o[ 'tmpl_block' ], $defaults );

			/**
			 * Hooked:
			 * neville__sec_tmpl_slider_post_start         - 10
			 * neville__sec_tmpl_slider_post_thumb         - 20
			 * neville__sec_tmpl_slider_post_overlay_start - 30
			 * neville__sec_tmpl_slider_post_title         - 40
			 * neville__sec_tmpl_slider_post_meta          - 50
			 * neville__sec_tmpl_slider_post_overlay_end   - 60
			 * neville__sec_tmpl_slider_post_end           - 999
			 */
			do_action( 'neville__sec_tmpl_slider_post', $o );
		}
	}

	// Slider post start
	if( ! function_exists( 'neville__sec_tmpl_slider_post_start' ) ) {
		function neville__sec_tmpl_slider_post_start( $o ) {
			$options = $o[ 'tmpl_block' ];
			?>
			<div class="<?php echo esc_attr( $options[ 'class' ][ 'wrap' ] ); ?>">
				<figure class="img-has-overlay">
			<?php
		}
	}

	// Slider post end
	if( ! function_exists( 'neville__sec_tmpl_slider_post_end' ) ) {
		function neville__sec_tmpl_slider_post_end( $o ) {
			?>
				</figure>
			</div>
			<?php
		}
	}

		// Slider post thumb
		if( ! function_exists( 'neville__sec_tmpl_slider_post_thumb' ) ) {
			function neville__sec_tmpl_slider_post_thumb( $o ) {
				// Options
				$options = $o[ 'tmpl_block' ];
				$size    = sanitize_key( $options[ 'thumb' ] );
				$thumb   = apply_filters( 'neville___sec_tmpl_slider_post_thumb', $size, $o );

				// Output thumbnail
				if( has_post_thumbnail() ) {
					the_post_thumbnail( $thumb );
				} else {
					// Placeholder
					$format = '<img src="%1$s" alt="%2$s" />';
					$link   = get_template_directory_uri() . '/images/ph-' . $size . '.jpg';
					$output = sprintf( $format, $link, the_title_attribute( 'echo=0') );
					$output = apply_filters( 'neville___sec_tmpl_slider_placeholder', $output, $o, $format, $link );

					// Output
					echo $output;
				}
			}
		}

		// Slider post thumb overlay start
		if( ! function_exists( 'neville__sec_tmpl_slider_post_overlay_start' ) ) {
			function neville__sec_tmpl_slider_post_overlay_start( $o ) {
				$options = $o[ 'tmpl_block' ];
				?>
				<figcaption class="<?php echo esc_attr( $options[ 'class' ][ 'caption' ] ); ?>">
					<div class="<?php echo esc_attr( $options[ 'class' ][ 'entry' ] ); ?>">
				<?php
			}
		}

		// Slider post thumb overlay end
		if( ! function_exists( 'neville__sec_tmpl_slider_post_overlay_end' ) ) {
			function neville__sec_tmpl_slider_post_overlay_end( $o ) {
				?>
					</div>
					<a href="<?php the_permalink() ?>" title="<?php the_title_attribute() ?>" class="img-link-to" rel="nofollow"></a>
				</figcaption>
				<?php
			}
		}

			// Slider post title
			if( ! function_exists( 'neville__sec_tmpl_slider_post_title' ) ) {
				function neville__sec_tmpl_slider_post_title( $o ) {
					// Options
					$options = $o[ 'tmpl_block' ];

					// Show hide title
					if( ! $o[ 'show_title' ] ) return;

					// Title CSS class
					$css  = $options[ 'class' ][ 'title' ];
					$type = sanitize_key( $options[ 'type' ] );

					// Display title
					neville_content_title( array(
						'before' => '<h3 class="' . esc_attr( $css ) . '"><a title="' . the_title_attribute( 'echo=0' ) . '" href="' . esc_url( get_permalink() ) . '" rel="bookmark">',
						'after'  => '</a></h3>'
					), $type );
				}
			}

			// Slider post meta
			if( ! function_exists( 'neville__sec_tmpl_slider_post_meta' ) ) {
				function neville__sec_tmpl_slider_post_meta( $o ) {
					// Do nothing if comments and category are not displayed
					if( ! $o[ 'show_category' ] &&  ! $o[ 'show_comments' ] ) return;

					/**
					 * Hooked:
					 * neville__sec_tmpl_slider_post_meta_start - 10
					 * neville__sec_tmpl_slider_post_meta_cat   - 20
					 * neville__sec_tmpl_slider_post_meta_com   - 30
					 * neville__sec_tmpl_slider_post_meta_end   - 999
					 */
					do_action( 'neville__sec_tmpl_slider_post_meta', $o );
				}
			}

				// Slider post meta start
				if( ! function_exists( 'neville__sec_tmpl_slider_post_meta_start' ) ) {
					function neville__sec_tmpl_slider_post_meta_start( $o ) {
						?>
						<footer class="entry-meta">
						<?php
					}
				}

				// Slider post meta end
				if( ! function_exists( 'neville__sec_tmpl_slider_post_meta_end' ) ) {
					function neville__sec_tmpl_slider_post_meta_end( $o ) {
						?>
						</footer>
						<?php
					}
				}

				// Slider post meta category
				if( ! function_exists( 'neville__sec_tmpl_slider_post_meta_cat' ) ) {
					function neville__sec_tmpl_slider_post_meta_cat( $o ) {
						// Show or hide
						if( ! $o[ 'show_category' ] ) return;

						// Output first category
						neville_em_single_cat( array(
							'class' => 'category-link sty1',
						), true );
					}
				}

				// Slider post meta comments number
				if( ! function_exists( 'neville__sec_tmpl_slider_post_meta_com' ) ) {
					function neville__sec_tmpl_slider_post_meta_com( $o ) {
						// Show or hide
						if( ! $o[ 'show_comments' ] ) return;

						// Output comments number
						echo neville_em_comments();
					}
				}

// Statics part
if( ! function_exists( 'neville__sec_tmpl_statics' ) ) {
	function neville__sec_tmpl_statics( $o ) {
		// Do nothing if the statics is disabled
		if( ! $o[ 'show_statics' ] ) return;

		/**
		 * Hooked
		 * neville__sec_tmpl_statics_start - 10
		 * neville__sec_tmpl_statics_query - 20
		 * neville__sec_tmpl_statics_end   - 999
		 */
		do_action( 'neville__sec_tmpl_statics', $o );
	}
}

	// Statics start
	if( ! function_exists( 'neville__sec_tmpl_statics_start' ) ) {
		function neville__sec_tmpl_statics_start( $o ) {
			$section   = $o[ 'widget' ];
			$slider_id = $section->id . '-st';
			?>
			<div class="container">
				<div id="<?php echo esc_attr( $slider_id ); ?>" class="row-display grid-1 sec-featured-extra">
			<?php
		}
	}

	// Statics end
	if( ! function_exists( 'neville__sec_tmpl_statics_end' ) ) {
		function neville__sec_tmpl_statics_end( $o ) {
			$section   = $o[ 'widget' ];
			$slider_id = $section->id . '-st';
			?>
				</div><!-- #<?php echo esc_html( $slider_id ); ?> -->
			</div><!-- .container -->
			<?php
		}
	}

	// Statics query
	if( ! function_exists( 'neville__sec_tmpl_statics_query' ) ) {
		function neville__sec_tmpl_statics_query( $o ) {
			// Count posts
			$count = 0;

			// Big block template options
			$big = apply_filters( 'neville___sec_tmpl_statics_big_block', array(
				'type'  => 'statics-big',
				'class' => [
					'wrap'    => 'col-6x img-tall',
					'caption' => 'img-overlay',
					'entry'   => 'img-entry-content-2x',
					'title'   => 'entry-title t-2x'
				],
				'thumb' => 'neville-gird1-2x-tall'
			), $o );

			// Small block template options
			$small = apply_filters( 'neville___sec_tmpl_statics_small_block', array(
				'type'  => 'statics-small',
				'class' => [
					'wrap'    => 'col-3x img-tall',
					'caption' => 'img-overlay',
					'entry'   => 'img-entry-content-1x',
					'title'   => 'entry-title t-1x'
				],
				'thumb' => 'neville-gird1-1x-tall'
			), $o );

			// Offset
			$offset = $o[ 'offset_more' ] ? $o[ 'slides' ] + 3 : $o[ 'slides' ];

			// Query arguments
			$args = apply_filters( 'neville__sec_tmpl_statics_query_args', array(
				'posts_per_page'      => intval( $o[ 'statics' ] ),
				'meta_key'            => 'neville_meta_featured_article',
				'meta_value'          => 1,
				'offset'              => intval( $offset ),
				'ignore_sticky_posts' => 1
			), $o, $offset );

			// Set-up query
			$query = new WP_Query( $args );

			if( $query->have_posts() ) :
				while ( $query->have_posts() ) :
					$query->the_post();
					$count++;

					// What type of block is this?
					switch( $count ) {
						// Big blocks
						case 1:
						case 6:
							/**
							 * Output the post template with different CSS classes
							 */
							$o[ 'tmpl_block' ] = $big;
							neville__sec_tmpl_slider_post( $o );
							break;

						// Small blocks
						case 2:
						case 3:
						case 4:
						case 5:
							/**
							 * Output the post template with different CSS classes
							 */
							$o[ 'tmpl_block' ] = $small;
							neville__sec_tmpl_slider_post( $o );
							break;
					}
				endwhile;
				// Reset
				wp_reset_postdata();
			endif;
		}
	}
