<?php do_action( 'bbp_template_before_topics_loop' ); ?>

<div class="rounder">
<table class="forum-table">

 <tbody>

<tr class="row-spacer"></tr>

		<?php while ( bbp_topics() ) : bbp_the_topic(); ?>

			<?php bbp_get_template_part( 'loop', 'single-topic' ); ?>

		<?php endwhile; ?>

</table>
</div>

<?php do_action( 'bbp_template_after_topics_loop' ); ?>
