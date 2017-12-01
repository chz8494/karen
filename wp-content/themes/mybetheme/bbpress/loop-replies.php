<?php do_action( 'bbp_template_before_replies_loop' ); ?>

<div id="topic-post-list" class="item-list" role="main">

<div class="forum-head-reply-tools"><?php bbp_user_subscribe_link('before=&nbsp;'); ?> <?php bbp_user_favorites_link(); ?></div>
<div class="clear"></div>

<ul>
		<?php while ( bbp_replies() ) : bbp_the_reply(); ?>

			<?php bbp_get_template_part( 'loop', 'single-reply' ); ?>

		<?php endwhile; ?>
</ul>
</div><!-- #topic-<?php bbp_topic_id(); ?>-replies -->

<?php do_action( 'bbp_template_after_replies_loop' ); ?>
