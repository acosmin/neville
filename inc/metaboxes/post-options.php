<?php
/**
 * -------------------
 * Post meta boxes
 *
 * @package Neville
 * -------------------
 */

if ( ! function_exists( 'neville_add_post_options_box' ) ) {
	/**
	 * Add a metabox to display options
	 *
	 * @since  1.0.0
	 * @return void
	 */
	function neville_add_post_options_box() {
		add_meta_box(
			'neville_post_options_metabox',
			__( 'Post Options:', 'neville' ),
			'neville_post_options_box',
			'post',
			'side',
			'high'
		);
	}
}
add_action( 'admin_menu', 'neville_add_post_options_box' );

if ( ! function_exists( 'neville_post_options_box' ) ) {
	/**
	 * Metabox output
	 *
	 * @since  1.0.0
	 * @return void HTML output
	 */
	function neville_post_options_box() {
		global $post;

		// Do nothing
		if( ! is_object( $post ) ) return;

		// Get some info
		$featured_article = get_post_meta(
			$post->ID,
			'neville_meta_featured_article',
			true
		);

		$drop_cap = get_post_meta(
			$post->ID,
			'neville_meta_drop_cap',
			true
		);

		// Nonce
		wp_nonce_field( 'neville_meta_featured_article_nonce', 'neville_meta_featured_article_nonce' );
		wp_nonce_field( 'neville_meta_drop_cap_nonce', 'neville_meta_drop_cap_nonce' );

		do_action( 'neville_meta_f_a__action_before', $post );

		?>
		<p>
			<label for="neville_meta_featured_article">
				<input type="checkbox" class="checkbox" id="neville_meta_featured_article" name="neville_meta_featured_article" <?php checked( $featured_article, 1 ); ?> />
				<?php _e( 'Featured article', 'neville' ) ?> &mdash; <em><?php _e( 'This is used for sliders, featured areas.', 'neville' ) ?></em>
			</label>
		</p>
		<p>
			<label for="neville_meta_drop_cap">
				<input type="checkbox" class="checkbox" id="neville_meta_drop_cap" name="neville_meta_drop_cap" <?php checked( $drop_cap, 1 ); ?> />
				<?php _e( 'Add drop cap', 'neville' ) ?> &mdash; <em><?php _e( 'On the first paragraph. The first character needs to be a letter. Shows up only on the frontend.', 'neville' ) ?></em>
			</label>
		</p>
		<?php

		do_action( 'neville_meta_f_a__action_after', $post );
	}
}

if ( ! function_exists( 'neville_post_options_save' ) ) {
	/**
	 * Save meta info
	 *
	 * @since  1.0.0
	 * @return void
	 */
	function neville_post_options_save() {
		global $post;

		// Do nothing
		if( ! is_object( $post ) ) return;

		// Verify some credentials
		if (
			! isset( $_POST[ 'neville_meta_featured_article_nonce' ] ) ||
			! wp_verify_nonce( $_POST[ 'neville_meta_featured_article_nonce' ], 'neville_meta_featured_article_nonce' ) ||
			! isset( $_POST[ 'neville_meta_drop_cap_nonce' ] ) ||
			! wp_verify_nonce( $_POST[ 'neville_meta_drop_cap_nonce' ], 'neville_meta_drop_cap_nonce' ) )
			return;

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
			return;

		if ( ! current_user_can( 'edit_post', $post->ID ) )
			return;

		// Check defaults
		$featured_article = ! empty( $_POST[ 'neville_meta_featured_article' ] ) ? 1 : 0;
		$drop_cap         = ! empty( $_POST[ 'neville_meta_drop_cap' ] ) ? 1 : 0;

		// Update meta info
		update_post_meta( $post->ID, 'neville_meta_featured_article', absint( $featured_article ) );
		update_post_meta( $post->ID, 'neville_meta_drop_cap', absint( $drop_cap ) );

		do_action( 'neville_meta_f_a__save_action', $post );

	}
}
add_action( 'save_post', 'neville_post_options_save' );
