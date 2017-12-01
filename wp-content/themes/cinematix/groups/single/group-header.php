<?php

do_action( 'bp_before_group_header' );

?>


<div id="item-header-avatar">

	<div class="single-group-box-image-container">
		<a href="<?php bp_group_permalink(); ?>" title="<?php bp_group_name(); ?>"><?php bp_group_avatar(); ?></a>
	</div>

</div><!-- #item-header-avatar -->

<div id="item-header-content">

	<?php do_action( 'bp_before_group_header_meta' ); ?>

<h2><?php bp_group_name(); ?></h2>

<div class="single-group-meta"><?php bp_group_type(); ?>, <?php bp_group_member_count(); ?>, <?php printf( esc_html__( 'active %s', 'buddypress' ), bp_get_group_last_active() ); ?></div>

		<?php bp_group_description(); ?>

<?php if ( bp_group_is_visible() ) : ?>

<div id="admins-moderators">
<div id="admins">

		<div class="mods-title"><?php esc_html_e( 'Group Admins', 'buddypress' ); ?></div>

		<?php bp_group_list_admins();

		do_action( 'bp_after_group_menu_admins' ); ?>
</div>

		<?php if ( bp_group_has_moderators() ) : ?>
<div id="moderators">
			<?php do_action( 'bp_before_group_menu_mods' ); ?>

			<div class="mods-title"><?php esc_html_e( 'Group Mods' , 'buddypress' ); ?></div>

			<?php bp_group_list_mods(); ?>

			<?php do_action( 'bp_after_group_menu_mods' ); ?>
</div>
		<?php endif; ?>
</div>
	<?php endif; ?>


		<?php do_action( 'bp_group_header_meta' ); ?>

	<div id="item-buttons">
		<?php do_action( 'bp_group_header_actions' ); ?>
	</div><!-- #item-buttons -->

</div><!-- #item-header-content -->


<?php
do_action( 'bp_after_group_header' );
do_action( 'template_notices' );
?>