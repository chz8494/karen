<?php get_header(); ?>

		<?php do_action( 'bp_after_header' ) ?>
		<?php do_action( 'bp_before_container' ) ?>

<div id="content">

			<?php do_action( 'bp_before_blog_single_post' ); ?>


			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<div class="blog-post">

<div class="post-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></div><!--post-title-->

<div class="post-details">
	<div class="post-details-category"><?php the_category(', ') ?></div><div class="post-details-spacer"></div>
	<div class="post-details-author"><a href="<?php echo get_author_posts_url(get_the_author_meta( 'ID' )); ?>"><?php the_author_meta('display_name'); ?></a></div><div class="post-details-spacer"></div>
	<div class="post-details-date"><?php the_time('F j, Y') ?></div><div class="post-details-spacer"></div>
	<div class="post-details-comments"><?php comments_number('0', '1', '%'); ?></div><div class="post-details-spacer"></div>
</div>

<?php
if ( has_post_thumbnail() ) { ?>
	<div class="thumbnail">
		<?php the_post_thumbnail('post-thumbnail');
		          DD_the_post_thumbnail_caption(); ?>
	</div>
<?php } else {
	// no thumbnail
}
?>

<div class="text">

<?php
$subtitle = get_post_meta ($post->ID, 'subtitle', $single = true);
if($subtitle !== '') {
echo '<div class="subtitle">';
echo $subtitle;
echo '</div>';
}
?>
		<div class="entry">
			<?php the_content( esc_html__( 'Read the rest of this entry &rarr;', 'cinematix' ) ); ?>

			<?php wp_link_pages( array( 'before' => '<div class="page-link"><p>' . esc_html__( 'Pages: ', 'cinematix' ), 'after' => '</p></div>', 'next_or_number' => 'number' ) ); ?>
		</div>

	<?php if ( has_tag() ) { ?>
		<div class="post-details-tags"><?php the_tags('', ', ', '  '); ?></div>
	<?php } ?>

	<div class="clear"></div>


    <?php $orig_post = $post;
    global $post;
    $tags = wp_get_post_tags($post->ID);
    if ($tags) {
    $tag_ids = array();
    foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;
    $args=array(
    'tag__in' => $tag_ids,
    'post__not_in' => array($post->ID),
    'posts_per_page'=>5, // Number of related posts that will be shown.
    'ignore_sticky_posts'=>1
    );
    $my_query = new wp_query( $args );
    if( $my_query->have_posts() ) { ?>

    <div id="relatedposts"><div id="relatedposts-title"><?php esc_html_e('Related Posts', 'cinematix') ?>:</div>

    <?php
    while( $my_query->have_posts() ) {
    $my_query->the_post(); ?>

    <a href="<?php the_permalink()?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a><br /><br />
    <?php }
    echo '</div>';
    }
    }
    $post = $orig_post;
    wp_reset_postdata(); ?>


	</div><!--text-->

	</div><!--blog-post-->

	<div class="clear"> </div>

			<?php endwhile; else: ?>

				<p><?php esc_html_e( 'Sorry, no posts matched your criteria.', 'cinematix' ); ?></p>

			<?php endif; ?>


		<?php do_action( 'bp_after_blog_single_post' ); ?>

<?php comments_template(); ?>

</div><!-- #content -->

<div id="sidebar">
<div id="sidebar-spacer"></div>
<?php if ( is_active_sidebar( 'sidebar-single' ) ) { ?>
	<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('sidebar-single')) : ?><?php endif; ?>
<?php } ?>
</div><!--sidebar ends-->

<?php get_footer(); ?>