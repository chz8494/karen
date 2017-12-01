<?php
/*
Template Name: Blog Full Width
*/
?>

<?php get_header(); ?>

		<?php do_action( 'bp_after_header' ) ?>
		<?php do_action( 'bp_before_container' ) ?>

<div id="content">

<?php
$temp = $wp_query;
$wp_query= null;
$wp_query = new WP_Query();
$wp_query->query('posts_per_page=4'.'&paged='.$paged);
while ($wp_query->have_posts()) : $wp_query->the_post();
?>

<div class="blog-post">

<div class="post-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Fixed link <?php the_title_attribute(); ?>"><?php the_title(); ?></a></div><!--post-title-->

<div class="post-details">
	<div class="post-details-category"><?php the_category(' ') ?></div><div class="post-details-spacer"></div>
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

<?php
global $more;
$more = 0;
the_content();
?>

</div><!--text-->

<div class="clear"></div>
<a class="more" href="<?php the_permalink() ?>"><?php echo get_theme_mod( 'DD_translate_4', 'Read more' ); ?></a>

</div><!--blog-post-->

<?php endwhile; // end of loop
 ?>

<div class="inline">
<div class="older-entries"><?php next_posts_link( esc_html__( '&larr; Previous Entries', 'cinematix' ) ); ?></div>
<div class="newer-entries"><?php previous_posts_link( esc_html__( 'Next Entries &rarr;', 'cinematix' ) ); ?></div>
</div>

<?php $wp_query = null; $wp_query = $temp;?>

</div>

<?php get_footer(); ?>