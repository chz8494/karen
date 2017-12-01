<?php

/**
 * BuddyPress - Users Groups
 *
 * @package BuddyPress
 * @subpackage bp-legacy
 */

?>

<div class="item-list-tabs no-ajax" id="subnav" role="navigation">
	<ul>
		<?php if ( bp_is_my_profile() ) bp_get_options_nav(); ?>

		<?php if ( !bp_is_current_action( 'invites' ) ) : ?>

			<li id="groups-order-select" class="last filter">

				<label for="groups-order-by"><?php esc_html_e( 'Order By:', 'buddypress' ); ?></label>
				<select id="groups-order-by">
					<option value="active"><?php esc_html_e( 'Last Active', 'buddypress' ); ?></option>
					<option value="popular"><?php esc_html_e( 'Most Members', 'buddypress' ); ?></option>
					<option value="newest"><?php esc_html_e( 'Newly Created', 'buddypress' ); ?></option>
					<option value="alphabetical"><?php esc_html_e( 'Alphabetical', 'buddypress' ); ?></option>

					<?php do_action( 'bp_member_group_order_options' ); ?>

				</select>
			</li>

		<?php endif; ?>

	</ul>
</div><!-- .item-list-tabs -->

<?php

switch ( bp_current_action() ) :

	// Home/My Groups
	case 'my-groups' :
		do_action( 'bp_before_member_groups_content' ); ?>

		<div class="groups mygroups">

			<?php bp_get_template_part( 'groups/groups-loop' ); ?>

		</div>

		<?php do_action( 'bp_after_member_groups_content' );
		break;

	// Group Invitations
	case 'invites' :
		bp_get_template_part( 'members/single/groups/invites' );
		break;

	// Any other
	default :
		bp_get_template_part( 'members/single/plugins' );
		break;
endswitch;