<?php
/*
Template Name: Contact Form
*/
?>

<?php get_header(); ?>


	<div id="content">

	<div class="page-title"><?php the_title(); ?></div>

		<?php do_action( 'bp_before_blog_page' ); ?>

		<div class="page" id="blog-page" role="main">

			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>


				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

					<div class="entry">

						<?php the_content( esc_html__( 'Read the rest of this page &rarr;', 'cinematix' ) ); ?>

						<?php wp_link_pages( array( 'before' => '<div class="page-link"><p>' . esc_html__( 'Pages: ', 'cinematix' ), 'after' => '</p></div>', 'next_or_number' => 'number' ) ); ?>

					</div>

				</div>

			<?php endwhile; endif; ?>

		</div><!-- .page -->

		<?php do_action( 'bp_after_blog_page' ); ?>

	</div><!-- #content -->

<div id="sidebar">
	<div id="sidebar-spacer"></div>
	<?php if ( is_active_sidebar( 'sidebar-contact' ) ) { ?>
	<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('sidebar-contact')) : ?><?php endif; ?>
	<?php } ?>
</div><!--sidebar ends-->

<div class="clear"></div>

<?php comments_template(); ?>

<?php get_footer(); ?>
