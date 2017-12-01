<?php

/**
 * BuddyPress Delete Account
 *
 * @package BuddyPress
 * @subpackage bp-default
 */
?>

<?php get_header( 'buddypress' ); ?>


	<div id="content">

			<?php do_action( 'bp_before_member_settings_template' ); ?>

			<div id="item-header">

				<?php locate_template( array( 'members/single/member-header.php' ), true ); ?>

			</div><!-- #item-header -->

			<div id="item-body" role="main">

			<div id="item-nav">
				<div class="item-list-tabs no-ajax" id="object-nav" role="navigation">
					<ul>

						<?php bp_get_displayed_user_nav(); ?>

						<?php do_action( 'bp_member_options_nav' ); ?>

					</ul>
				</div>
			</div><!-- #item-nav -->


				<?php do_action( 'bp_before_member_body' ); ?>

				<div class="item-list-tabs no-ajax" id="subnav">
					<ul>

						<?php bp_get_options_nav(); ?>

						<?php do_action( 'bp_member_plugin_options_nav' ); ?>

					</ul>
				</div><!-- .item-list-tabs -->

<div id="item-body-padding">

				<h3><?php esc_html_e( 'Delete Account', 'buddypress' ); ?></h3>

				<div id="message" class="info">

					<?php if ( bp_is_my_profile() ) : ?>

						<p><?php esc_html_e( 'Deleting your account will delete all of the content you have created. It will be completely irrecoverable.', 'buddypress' ); ?></p>

					<?php else : ?>

						<p><?php esc_html_e( 'Deleting this account will delete all of the content it has created. It will be completely irrecoverable.', 'buddypress' ); ?></p>

					<?php endif; ?>

				</div>

				<form action="<?php echo bp_displayed_user_domain() . bp_get_settings_slug() . '/delete-account'; ?>" name="account-delete-form" id="account-delete-form" class="standard-form" method="post">

					<?php do_action( 'bp_members_delete_account_before_submit' ); ?>

					<label for="delete-account-understand">
						<input type="checkbox" name="delete-account-understand" id="delete-account-understand" value="1" onclick="if(this.checked) { document.getElementById('delete-account-button').disabled = ''; } else { document.getElementById('delete-account-button').disabled = 'disabled'; }" />
						 <?php esc_html_e( 'I understand the consequences.', 'buddypress' ); ?>
					</label>

					<div class="submit">
						<input type="submit" disabled="disabled" value="<?php esc_html_e( 'Delete Account', 'buddypress' ); ?>" id="delete-account-button" name="delete-account-button" />
					</div>

					<?php do_action( 'bp_members_delete_account_after_submit' ); ?>

					<?php wp_nonce_field( 'delete-account' ); ?>

				</form>

				<?php do_action( 'bp_after_member_body' ); ?>
</div>

			</div><!-- #item-body -->

			<?php do_action( 'bp_after_member_settings_template' ); ?>

	</div><!-- #content -->

<?php get_sidebar( 'buddypress' ); ?>

<?php get_footer( 'buddypress' ); ?>