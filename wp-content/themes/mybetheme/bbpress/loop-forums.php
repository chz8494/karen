<?php do_action( 'bbp_template_before_forums_loop' ); ?>

<table id="topic-post-list" class="item-list" role="main">

	<tbody>

		<?php while ( bbp_forums() ) : bbp_the_forum(); ?>

			<?php bbp_get_template_part( 'loop', 'single-forum' ); ?>

		<?php endwhile; ?>

	</tbody>

</table>

<?php do_action( 'bbp_template_after_forums_loop' ); ?>
