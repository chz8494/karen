<?php
	if ( post_password_required() ) {
		echo '<h3 class="comments-header">' . get_theme_mod( 'DD_translate_7', 'Password Protected' ) . '</h3>';
		echo '<p class="alert password-protected">' . get_theme_mod( 'DD_translate_8', 'Enter the password to view comments.' ) . '</p>';
		return;
	}

	if ( is_page() && !have_comments() && !comments_open() && !pings_open() )
		return;

	if ( have_comments() ) :
		$num_comments = 0;
		$num_trackbacks = 0;
		foreach ( (array) $comments as $comment ) {
			if ( 'comment' != get_comment_type() )
				$num_trackbacks++;
			else
				$num_comments++;
		}
?>
	<div id="comments">


		<?php do_action( 'bp_before_blog_comment_list' ); ?>

		<div id="comments-number"><?php comments_number(esc_html__( 'No Responses', 'cinematix'), esc_html__('One Response', 'cinematix'), esc_html__('% Responses', 'cinematix'));?></div>

		<ol class="commentlist">
			<?php wp_list_comments( array( 'callback' => 'DD_theme_blog_comments', 'type' => 'comment' ) ); ?>
		</ol><!-- .comment-list -->

		<?php do_action( 'bp_after_blog_comment_list' ); ?>

		<?php if ( get_option( 'page_comments' ) ) : ?>
			<div class="comment-navigation paged-navigation">
				<?php paginate_comments_links(); ?>
			</div>
		<?php endif; ?>

	</div><!-- #comments -->
<?php else : ?>

	<?php if ( pings_open() && !comments_open() && ( is_single() || is_page() ) ) : ?>
		<p class="comments-closed pings-open">
			<?php
			printf( wp_kses( __( 'Comments are closed, but <a href="%1$s" title="Trackback URL for this post">trackbacks</a> and pingbacks are open.', 'cinematix' ), $allowed_html_array ), trackback_url( '0' ) );
			?>
		</p>
	<?php elseif ( !comments_open() && ( is_single() || is_page() ) ) : ?>
		<p class="comments-closed">
			<?php echo get_theme_mod( 'Comments are closed.', 'cinematix' ); ?>
		</p>
	<?php endif; ?>

<?php endif; ?>

<?php if ( comments_open() ) : ?>
	<div id="container-comment-form"><?php comment_form(); ?></div><!-- container-comment-form -->
<?php endif; ?>

<?php if ( !empty( $num_trackbacks ) ) : ?>
	<div id="trackbacks">
		<h3><?php printf( _n( '1 trackback', '%d trackbacks', $num_trackbacks, 'buddypress' ), number_format_i18n( $num_trackbacks ) ); ?></h3>

		<ul id="trackbacklist">
			<?php foreach ( (array) $comments as $comment ) : ?>

				<?php if ( 'comment' != get_comment_type() ) : ?>
					<li>
						<h5><?php comment_author_link(); ?></h5>
						<em>on <?php comment_date(); ?></em>
					</li>
 				<?php endif; ?>

			<?php endforeach; ?>
		</ul>

	</div>
<?php endif; ?>