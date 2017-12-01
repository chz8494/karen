<?php get_header(); ?>

	<div id="content">

		<?php do_action( 'bp_before_blog_search' ); ?>

		<div class="page" id="blog-search" role="main">
		<div class="page-title-bold"><?php esc_html_e('Search Results', 'cinematix'); ?>:</div>

			<?php if (have_posts()) : ?>


				<?php while (have_posts()) : the_post(); ?>

				<h3><a href="<?php the_permalink() ?>" rel="bookmark" title="Fixed link <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>

				<?php endwhile; ?>

<div class="clear"></div>
<br /><br /><br />
<div class="inline">
<div class="older-entries"><?php next_posts_link( esc_html__( '&larr; Previous Entries', 'cinematix' ) ); ?></div>
<div class="newer-entries"><?php previous_posts_link( esc_html__( 'Next Entries &rarr;', 'cinematix' ) ); ?></div>
</div>

			<?php else : ?>

				<h2 class="center"><?php esc_html_e( 'No posts found. Try a different search?', 'cinematix' ); ?></h2>

			<?php endif; ?>

		</div>

		<?php do_action( 'bp_after_blog_search' ); ?>

	</div><!-- #content -->


<div id="sidebar">
<?php if ( is_active_sidebar( 'sidebar-blog' ) ) { ?>
	<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('sidebar-blog')) : ?><?php endif; ?>
<?php } ?>
</div><!--sidebar ends-->

<?php get_footer(); ?>
