<div class="clear"></div>
</div> <!-- #container -->
<?php do_action( 'bp_after_container' ); ?>
</div><!-- main -->
<?php do_action( 'bp_before_footer'   ); ?>

<footer>
<div id="footer-container">

<div class="footer-left">
<a href="<?php echo get_theme_mod( 'DD_footer_link', 'http://www.facebook.com' ); ?>" rel="nofollow"><img src="<?php if ( get_theme_mod( 'DD_footer_icon' ) ) : ?><?php echo get_theme_mod( 'DD_footer_icon' ); ?><?php else : ?><?php echo esc_attr( get_bloginfo( 'stylesheet_directory', 'display' ) ); ?>/images/fb.png<?php endif; ?>" /></a>
</div>

<div class="footer-right"><?php echo get_theme_mod( 'DD_copyright', 'All rights reserved by Cinematix' ); ?></div>

</div>
</footer>

<?php do_action( 'bp_after_footer' ); ?>
<?php wp_footer(); ?>

</body>

</html>