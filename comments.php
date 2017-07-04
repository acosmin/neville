<?php
/**
 * The template for displaying comments.
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Neville
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}

/**
 * Check if avatars are enabled, if not add a class
 */
$neville_show_avatars = ( get_option( 'show_avatars' ) ) ? '' : ' no-avatars';
?>

<div id="comments" class="comments-area<?php echo $neville_show_avatars ?>">

	<?php
	// You can start editing here -- including this comment!
	if ( have_comments() ) : ?>
	<header class="section-header sh1x with-margin">
		<h2 class="section-title st1x comments-title">
			<?php
				$comments_number = get_comments_number();
				if ( '1' === $comments_number ) {
					_ex( 'One comment', 'comments title', 'neville' );
				} else {
					printf(
						/* translators: 1: number of comments */
						_nx(
							'%s Comment',
							'%s Comments',
							$comments_number,
							'comments title',
							'neville'
						),
						number_format_i18n( $comments_number )
					);
				}
			?>
		</h2>
		<p class="section-description">
			<?php the_title(); ?>
		</p>
	</header>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
		<nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
			<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'neville' ); ?></h2>
			<div class="nav-links">

				<div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'neville' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'neville' ) ); ?></div>

			</div><!-- .nav-links -->
		</nav><!-- #comment-nav-above -->
		<?php endif; // Check for comment navigation. ?>

		<ol class="comment-list">
			<?php
				wp_list_comments( array(
					'style'       => 'ol',
					'short_ping'  => true,
					'avatar_size' => 70,
				) );
			?>
		</ol><!-- .comment-list -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
		<nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
			<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'neville' ); ?></h2>
			<div class="nav-links">

				<div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'neville' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'neville' ) ); ?></div>

			</div><!-- .nav-links -->
		</nav><!-- #comment-nav-below -->
		<?php
		endif; // Check for comment navigation.

	endif; // Check for have_comments().


	// If comments are closed and there are comments, let's leave a little note, shall we?
	if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>

		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'neville' ); ?></p>
	<?php
	endif;

	comment_form();
	?>

</div><!-- #comments -->
