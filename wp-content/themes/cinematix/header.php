<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
		<meta http-equiv="Content-Type" content="<?php bloginfo( 'html_type' ) ?>; charset=<?php bloginfo( 'charset' ) ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
		<?php do_action( 'bp_head' ) ?>
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ) ?>" />

		<?php wp_head(); ?>

</head>

<body <?php body_class() ?> id="buddypress">

<?php do_action( 'bp_before_header' ) ?>

<header>

<div id="header-container">
<div id="header-left">
<div id="logo">
<?php if ( get_theme_mod( 'DD_logo' ) ) : ?>
        <a href='<?php echo esc_url( home_url( '/' ) ); ?>' title='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>' rel='home'><img src='<?php echo esc_url( get_theme_mod( 'DD_logo' ) ); ?>' alt='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>'></a>
<?php else : ?>
		<a href="<?php echo home_url(); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"><img src="<?php echo esc_attr( get_bloginfo( 'stylesheet_directory', 'display' ) ); ?>/images/logo.png" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" /></a>
<?php endif; ?>
</div>
</div><!-- #header-left -->

<div id="header-right">
	<a class="tile tile-contact" href="<?php echo home_url(); ?>/<?php echo get_theme_mod( 'DD_menu_link_6', 'contact' ); ?>"><span class="tile-title"><?php echo get_theme_mod( 'DD_menu_title_6', 'CONTACT' ); ?></span></a>
	<a class="tile tile-members" href="<?php echo home_url(); ?>/<?php echo get_theme_mod( 'DD_menu_link_5', 'members' ); ?>"><span class="tile-title"><?php echo get_theme_mod( 'DD_menu_title_5', 'MEMBERS' ); ?></span></a>
	<a class="tile tile-groups" href="<?php echo home_url(); ?>/<?php echo get_theme_mod( 'DD_menu_link_4', 'groups' ); ?>"><span class="tile-title"><?php echo get_theme_mod( 'DD_menu_title_4', 'GROUPS' ); ?></span></a>
	<a class="tile tile-forums" href="<?php echo home_url(); ?>/<?php echo get_theme_mod( 'DD_menu_link_3', 'forums' ); ?>"><span class="tile-title"><?php echo get_theme_mod( 'DD_menu_title_3', 'FORUMS' ); ?></span></a>
	<a class="tile tile-blog" href="<?php echo home_url(); ?>/<?php echo get_theme_mod( 'DD_menu_link_2', 'blog' ); ?>"><span class="tile-title"><?php echo get_theme_mod( 'DD_menu_title_2', 'BLOG' ); ?></span></a>
	<a class="tile tile-activity" href="<?php echo home_url(); ?>/<?php echo get_theme_mod( 'DD_menu_link_1', 'activity' ); ?>"><span class="tile-title"><?php echo get_theme_mod( 'DD_menu_title_1', 'ACTIVITY' ); ?></span></a>
</div><!-- #header-right -->

<?php do_action( 'bp_header' ) ?>
</div><!-- #header-container -->

</header>

<div id="header-bar">
<div id="header-bar-container">
	<nav>
			<?php
			wp_nav_menu( array(
			 'container' =>false,
			 'theme_location' => 'primary-menu',
			 'menu_class' => 'nav',
			 'echo' => true,
			 'before' => '',
			 'after' => '',
			 'link_before' => '',
			 'link_after' => '',
			 'depth' => 0,)
			);
			 ?>
	</nav>

	<div id="navigation-400">
	<form name="site-menu" action="#" method="post">
		<?php
		wp_nav_menu_select(
    		array(
       			'theme_location' => 'select-menu'
    			)
		);
		?>
	</form>
	</div>

<div id="login-register-links"><a class="login-register-links-1" href="<?php echo home_url(); ?>/login"><?php esc_html_e('Login', 'cinematix'); ?></a> <a class="login-register-links-2" href="<?php echo home_url(); ?>/register"><?php esc_html_e('Register', 'cinematix'); ?></a></div>

	<div id="bar-right">
	 	<?php get_search_form(); ?>
        	</div><!--bar-right ends-->

</div><!-- #header-bar-container -->
</div><!-- #header-bar -->

<div class="clear"></div>

<div id="main">

<div id="container">