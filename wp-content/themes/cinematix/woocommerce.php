<?php
/*
Template Name: Woocommerce
*/
?>

<?php get_header(); ?>

	<div id="content">

	<div class="page-title"><?php woocommerce_page_title(); ?></div>

	<div id="content-white">

		<div class="page" role="main">

		<?php woocommerce_content(); ?>

		</div><!-- .page -->


	</div><!-- #content-white -->

	</div><!-- #content -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>
