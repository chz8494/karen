<?php

/**
 * BuddyPress - Blogs Directory
 *
 * @package BuddyPress
 * @subpackage bp-default
 */

get_header( 'buddypress' ); ?>

	<div id="content">

	<?php do_action( 'bp_before_directory_blogs_page' ); ?>

		<div class="padder">

		<?php do_action( 'bp_before_directory_blogs' ); ?>

		<form action="" method="post" id="blogs-directory-form" class="dir-form">

			<?php if ( is_user_logged_in() && bp_blog_signup_enabled() ) : ?> &nbsp;<a class="color-button" id="create-a-site" href="<?php echo bp_get_root_domain() . '/' . bp_get_blogs_root_slug() . '/create/' ?>"><?php esc_html_e( 'Create a Site', 'buddypress' ); ?></a><?php endif; ?>

			<?php do_action( 'bp_before_directory_blogs_content' ); ?>

			<div id="blog-dir-search" class="dir-search" role="search">

				<?php bp_directory_blogs_search_form(); ?>

			</div><!-- #blog-dir-search -->

			<div id="object-nav" class="item-list-tabs" role="navigation">
			<ul>
				<li class="selected" id="blogs-all"><a href="<?php bp_root_domain(); ?>/<?php bp_blogs_root_slug(); ?>"><?php printf( esc_html__( 'All Sites %s', 'buddypress' ), '<span>' . bp_get_total_blog_count() . '</span>' ); ?></a></li>

				<?php if ( is_user_logged_in() && bp_get_total_blog_count_for_user( bp_loggedin_user_id() ) ) : ?>

					<li id="blogs-personal"><a href="<?php echo bp_loggedin_user_domain() . bp_get_blogs_slug(); ?>"><?php printf( esc_html__( 'My Sites %s', 'buddypress' ), '<span>' . bp_get_total_blog_count_for_user( bp_loggedin_user_id() ) . '</span>' ); ?></a></li>

				<?php endif; ?>

				<?php

				/**
				 * Fires inside the unordered list displaying blog types.
				 *
				 * @since 1.2.0
				 */
				do_action( 'bp_blogs_directory_blog_types' ); ?>

			</ul>
			</div><!-- .item-list-tabs -->
<br />
<div class="clear"></div>

			<div class="item-list-tabs" id="subnav" role="navigation">
				<ul>

					<?php do_action( 'bp_blogs_directory_blog_sub_types' ); ?>

					<li id="blogs-order-select" class="last filter">

						<label for="blogs-order-by"><?php esc_html_e( 'Order By:', 'buddypress' ); ?></label>
						<select id="blogs-order-by">
							<option value="active"><?php esc_html_e( 'Last Active', 'buddypress' ); ?></option>
							<option value="newest"><?php esc_html_e( 'Newest', 'buddypress' ); ?></option>
							<option value="alphabetical"><?php esc_html_e( 'Alphabetical', 'buddypress' ); ?></option>

							<?php do_action( 'bp_blogs_directory_order_options' ); ?>

						</select>
					</li>
				</ul>
			</div>

			<div id="blogs-dir-list" class="blogs dir-list">

				<?php locate_template( array( 'blogs/blogs-loop.php' ), true ); ?>

			</div><!-- #blogs-dir-list -->

			<?php do_action( 'bp_directory_blogs_content' ); ?>

			<?php wp_nonce_field( 'directory_blogs', '_wpnonce-blogs-filter' ); ?>

			<?php do_action( 'bp_after_directory_blogs_content' ); ?>

		</form><!-- #blogs-directory-form -->

		<?php do_action( 'bp_after_directory_blogs' ); ?>

		</div><!-- .padder -->
	</div><!-- #content -->

<?php do_action( 'bp_after_directory_blogs_page' ); ?>
<?php get_footer( 'buddypress' ); ?>
