<?php

/**
 * BuddyPress - Groups Directory
 *
 * @package BuddyPress
 * @subpackage bp-default
 */

get_header( 'buddypress' ); ?>

<div id="content">

<div class="page-title-bold"><?php esc_html_e( 'All Groups', 'cinematix' ); ?></div>

<?php do_action( 'bp_before_directory_groups_page' ); ?>

		<?php do_action( 'bp_before_directory_groups' ); ?>

		<form action="" method="post" id="groups-directory-form" class="dir-form">

			<?php if ( is_user_logged_in() && bp_user_can_create_groups() ) : ?><a class="button" id="create-group-button" href="<?php echo trailingslashit( bp_get_root_domain() . '/' . bp_get_groups_root_slug() . '/create' ); ?>"><?php esc_html_e( 'Create a Group', 'buddypress' ); ?></a><div class="clear"></div><?php endif; ?>

			<?php do_action( 'bp_before_directory_groups_content' ); ?>

			<?php do_action( 'template_notices' ); ?>





			<div id="groups-dir-list" class="groups dir-list">

				<?php locate_template( array( 'groups/groups-loop.php' ), true ); ?>

			</div><!-- #groups-dir-list -->

			<?php do_action( 'bp_directory_groups_content' ); ?>

			<?php wp_nonce_field( 'directory_groups', '_wpnonce-groups-filter' ); ?>

			<?php do_action( 'bp_after_directory_groups_content' ); ?>

		</form><!-- #groups-directory-form -->

		<?php do_action( 'bp_after_directory_groups' ); ?>
<?php do_action( 'bp_after_directory_groups_page' ); ?>
	</div><!-- #content -->

<?php get_footer( 'buddypress' ); ?>