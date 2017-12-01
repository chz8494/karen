<?php
/*
Template Name: Full Width
*/
?>

<?php get_header(); ?>

	<div id="content">

	<div class="page-title-bold"><?php the_title(); ?></div>

		<?php do_action( 'bp_before_blog_page' ); ?>

		<div class="page">

			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>


				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

					<div class="entry">

						<?php the_content( esc_html__( 'Read the rest of this page &rarr;, 'cinematix' ) ); ?>

						<?php wp_link_pages( array( 'before' => '<div class="page-link"><p>' . esc_html__( 'Pages: ', 'cinematix' ), 'after' => '</p></div>', 'next_or_number' => 'number' ) ); ?>

					</div>

				</div>

			<?php endwhile; endif; ?>

		</div><!-- .page -->

		<?php do_action( 'bp_after_blog_page' ); ?>

	<?php comments_template(); ?>

	</div><!-- #content -->

<?php get_footer(); ?>
