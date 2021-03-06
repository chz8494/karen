<?php

/**
 * BuddyPress - Members Directory
 *
 * @package BuddyPress
 * @subpackage bp-default
 */

get_header( 'buddypress' ); ?>

	<?php do_action( 'bp_before_directory_members_page' ); ?>

	<div id="content">

	<div class="page-title"><?php the_title(); ?></div>
		<div class="padder">

		<?php do_action( 'bp_before_directory_members' ); ?>

			<?php do_action( 'bp_before_directory_members_content' ); ?>


		<form action="" method="post" id="members-directory-form" class="dir-form">
			<?php do_action( 'bp_members_directory_member_sub_types' ); ?>

			<div class="members-sorting" role="navigation">

			<ul>
			<li id="members-order-select" class="last filter">

				<label for="members-order-by"><?php esc_html_e( 'Order By:', 'buddypress' ); ?></label>
				<select id="members-order-by">
					<option value="active"><?php esc_html_e( 'Last Active', 'buddypress' ); ?></option>
					<option value="newest"><?php esc_html_e( 'Newest Registered', 'buddypress' ); ?></option>

					<?php if ( bp_is_active( 'xprofile' ) ) : ?>

						<option value="alphabetical"><?php esc_html_e( 'Alphabetical', 'buddypress' ); ?></option>

					<?php endif; ?>

					<?php do_action( 'bp_members_directory_order_options' ); ?>

				</select>
			</li>
			</ul>

			</div>


			<div id="members-dir-search" class="dir-search" role="search">
				<?php bp_directory_members_search_form(); ?>
			</div><!-- #members-dir-search -->

			<div class="clear"></div>

		</form>

			<?php do_action( 'bp_before_directory_members_tabs' ); ?>

			<?php do_action( 'bp_before_directory_members_tabs' ); ?>

			<div id="members-dir-list" class="members dir-list">

				<?php locate_template( array( 'members/members-loop.php' ), true ); ?>

			</div><!-- #members-dir-list -->

			<?php do_action( 'bp_directory_members_content' ); ?>

			<?php wp_nonce_field( 'directory_members', '_wpnonce-member-filter' ); ?>

			<?php do_action( 'bp_after_directory_members_content' ); ?>


		<?php do_action( 'bp_after_directory_members' ); ?>

		</div><!-- .padder -->
	</div><!-- #content -->

	<?php do_action( 'bp_after_directory_members_page' ); ?>

<?php get_sidebar( 'buddypress' ); ?>
<?php get_footer( 'buddypress' ); ?>
