<?php

/**
 * Template Name: BuddyPress - Activity Directory
 *
 * @package BuddyPress
 * @subpackage Theme
 */

get_header( 'buddypress' ); ?>

	<?php do_action( 'bp_before_directory_activity_page' ); ?>

	<div id="content">

	<div class="page-title-bold"><?php the_title(); ?></div>

		<div class="padder">

			<?php do_action( 'bp_before_directory_activity' ); ?>

			<?php if ( !is_user_logged_in() ) : ?>

			<div class="activity-pg-desc"><?php esc_html_e('You can browse all activities here. Use menu below if you want to browse only specific activities like Group Memberships, New Topics, New Members ...', 'cinematix'); ?></div>

			<?php endif; ?>

			<?php do_action( 'bp_before_directory_activity_content' ); ?>

			<?php if ( is_user_logged_in() ) : ?>

				<?php bp_get_template_part( 'activity/post-form' ); ?>

			<?php endif; ?>

			<?php do_action( 'template_notices' ); ?>

			<div id="item-body">

			<div class="item-list-tabs activity-type-tabs" id="object-nav" role="navigation">
				<ul>
					<?php do_action( 'bp_before_activity_type_tab_all' ); ?>

					<li class="selected" id="activity-all"><a href="<?php bp_activity_directory_permalink(); ?>" title="<?php esc_attr_e( 'The public activity for everyone on this site.', 'buddypress' ); ?>"><?php printf( esc_html__( 'All Members %s', 'buddypress' ), '<span>' . bp_get_total_member_count() . '</span>' ); ?></a></li>

					<?php if ( is_user_logged_in() ) : ?>

						<?php do_action( 'bp_before_activity_type_tab_friends' ); ?>

						<?php if ( bp_is_active( 'friends' ) ) : ?>

							<?php if ( bp_get_total_friend_count( bp_loggedin_user_id() ) ) : ?>

							<li id="activity-friends"><a href="<?php echo bp_loggedin_user_domain() . bp_get_activity_slug() . '/' . bp_get_friends_slug() . '/'; ?>" title="<?php esc_attr_e( 'The activity of my friends only.', 'buddypress' ); ?>"><?php printf( esc_html__( 'My Friends %s', 'buddypress' ), '<span>' . bp_get_total_friend_count( bp_loggedin_user_id() ) . '</span>' ); ?></a></li>

							<?php endif; ?>

						<?php endif; ?>

						<?php do_action( 'bp_before_activity_type_tab_groups' ); ?>

						<?php if ( bp_is_active( 'groups' ) ) : ?>

							<?php if ( bp_get_total_group_count_for_user( bp_loggedin_user_id() ) ) : ?>

								<li id="activity-groups"><a href="<?php echo bp_loggedin_user_domain() . bp_get_activity_slug() . '/' . bp_get_groups_slug() . '/'; ?>" title="<?php esc_attr_e( 'The activity of groups I am a member of.', 'buddypress' ); ?>"><?php printf( esc_html__( 'My Groups %s', 'buddypress' ), '<span>' . bp_get_total_group_count_for_user( bp_loggedin_user_id() ) . '</span>' ); ?></a></li>

							<?php endif; ?>

						<?php endif; ?>

						<?php do_action( 'bp_before_activity_type_tab_favorites' ); ?>

						<?php if ( bp_get_total_favorite_count_for_user( bp_loggedin_user_id() ) ) : ?>

							<li id="activity-favorites"><a href="<?php echo bp_loggedin_user_domain() . bp_get_activity_slug() . '/favorites/'; ?>" title="<?php esc_attr_e( "The activity I've marked as a favorite.", 'buddypress' ); ?>"><?php printf( esc_html__( 'My Favorites %s', 'buddypress' ), '<span>' . bp_get_total_favorite_count_for_user( bp_loggedin_user_id() ) . '</span>' ); ?></a></li>

						<?php endif; ?>

						<?php if ( bp_activity_do_mentions() ) : ?>


							<?php do_action( 'bp_before_activity_type_tab_mentions' ); ?>


							<li id="activity-mentions"><a href="<?php echo bp_loggedin_user_domain() . bp_get_activity_slug() . '/mentions/'; ?>" title="<?php esc_html_e( 'Activity that I have been mentioned in.', 'buddypress' ); ?>"><?php esc_html_e( 'Mentions', 'buddypress' ); ?><?php if ( bp_get_total_mention_count_for_user( bp_loggedin_user_id() ) ) : ?> <strong><span><?php printf( _nx( '%s new', '%s new', bp_get_total_mention_count_for_user( bp_loggedin_user_id() ), 'Number of new activity mentions', 'buddypress' ), bp_get_total_mention_count_for_user( bp_loggedin_user_id() ) ); ?></span></strong><?php endif; ?></a></li>


						<?php endif; ?>
					<?php endif; ?>

					<?php do_action( 'bp_activity_type_tabs' ); ?>
				</ul>
			</div><!-- .item-list-tabs -->

			<div class="item-list-tabs no-ajax" id="subnav" role="navigation">
				<ul>
					<li class="feed"><a href="<?php bp_sitewide_activity_feed_link(); ?>" title="<?php esc_html_e( 'RSS Feed', 'buddypress' ); ?>"><?php esc_html_e( 'RSS', 'buddypress' ); ?></a></li>

					<?php do_action( 'bp_activity_syndication_options' ); ?>

					<li id="activity-filter-select" class="last">
						<label for="activity-filter-by"><?php esc_html_e( 'Show:', 'buddypress' ); ?></label>
				<select id="activity-filter-by">
					<option value="-1"><?php esc_html_e( '&mdash; Everything &mdash;', 'buddypress' ); ?></option>

					<?php bp_activity_show_filters(); ?>

					<?php do_action( 'bp_activity_filter_options' ); ?>

				</select>
					</li>
				</ul>
			</div><!-- .item-list-tabs -->

			<?php do_action( 'bp_before_directory_activity_list' ); ?>

			<div class="activity" role="main">

				<?php bp_get_template_part( 'activity/activity-loop' ); ?>

			</div><!-- .activity -->

			<?php do_action( 'bp_after_directory_activity_list' ); ?>

			<?php do_action( 'bp_directory_activity_content' ); ?>

			<?php do_action( 'bp_after_directory_activity_content' ); ?>

			<?php do_action( 'bp_after_directory_activity' ); ?>
			</div><!-- #item-body -->
		</div><!-- .padder -->
	</div><!-- #content -->

	<?php do_action( 'bp_after_directory_activity_page' ); ?>

<?php get_sidebar( 'buddypress' ); ?>
<?php get_footer( 'buddypress' ); ?>
