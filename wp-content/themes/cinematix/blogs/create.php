<?php

/**
 * BuddyPress - Create Blog
 *
 * @package BuddyPress
 * @subpackage bp-default
 */

get_header( 'buddypress' ); ?>


	<div id="content">
		<div class="padder" role="main">

		<?php do_action( 'bp_before_create_blog_content_template' ); ?>

		<?php do_action( 'template_notices' ); ?>


			<div class="page-title-bold"><?php esc_html_e( 'Create a Site', 'buddypress' ); ?></div>


		<?php do_action( 'bp_before_create_blog_content' ); ?>

		<?php if ( bp_blog_signup_enabled() ) : ?>

			<?php bp_show_blog_signup_form(); ?>

		<?php else: ?>

			<div id="message" class="info">
				<p><?php esc_html_e( 'Site registration is currently disabled', 'buddypress' ); ?></p>
			</div>

		<?php endif; ?>

		<?php do_action( 'bp_after_create_blog_content' ); ?>

		<?php do_action( 'bp_after_create_blog_content_template' ); ?>

		</div><!-- .padder -->
	</div><!-- #content -->

	<?php do_action( 'bp_after_directory_blogs_content' ); ?>

<?php get_footer( 'buddypress' ); ?>

