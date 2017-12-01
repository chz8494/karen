<?php
/**
 * Memberlite Theme Customizer
 *
 * @package Memberlite
 */

 /**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
class memberlite_Customize {
	public static function register ( $wp_customize ) {
		global $memberlite_defaults;
		$wp_customize->add_section(
			'memberlite_theme_options', 
			array(
				'title' => __( 'Memberlite Options', 'memberlite' ),
				'priority' => 35,
				'capability' => 'edit_theme_options',
				'description' => __('Allows you to customize settings for Memberlite.', 'memberlite'),
			) 
		);
		$wp_customize->add_setting(
			'memberlite_webfonts',
			array(
				'default' => $memberlite_defaults['memberlite_webfonts'],
				'santize_callback' => 'sanitize_text_field',
				'sanitize_js_callback' => array('memberlite_Customize', 'memberlite_sanitize_js_callback'),
			)
		);
		$wp_customize->add_control(
			'memberlite_webfonts',
			array(
				'label' => 'Google Webfonts',
				'section' => 'memberlite_theme_options',
				'type'       => 'select',
				'choices'    => array(
					'Lato_Lato'  => 'Lato',
					'PT-Sans_PT-Serif'  => 'PT Sans and PT Serif',
					'Fjalla-One_Noto-Sans'  => 'Fjalla One and Noto Sans',
					'Pathway-Gothic-One_Source-Sans-Pro' => 'Pathway Gothic One and Source Sans Pro',
					'Oswald_Lato' => 'Oswald and Lato',
					'Ubuntu_Open-Sans' => 'Ubuntu and Open Sans',
					'Lato_Source-Sans-Pro' => 'Lato and Source Sans Pro',
					'Roboto-Slab_Roboto'  => 'Roboto Slab and Roboto',
					'Lato_Merriweather'  => 'Lato and Merriweather',
					'Playfair-Display_Open-Sans'  => 'Playfair Display and Open Sans',
					'Oswald_Quattrocento'  => 'Oswald and Quattrocento',
					'Abril-Fatface_Open-Sans'  => 'Abril Fatface and Open Sans',
					'Open-Sans_Gentium-Book-Basic' => 'Open Sans and Gentium Book Basic',
					'Oswald_PT-Mono' => 'Oswald and PT Mono'
				),
				'priority' => 10
			)
		);
		$wp_customize->add_setting(
			'meta_login',
			array(
				'default' => false,
				'santize_callback' => 'memberlite_sanitize_checkbox',
				'santize_js_callback' => array('memberlite_Customize', 'memberlite_sanitize_js_callback'),
			)
		);
		$wp_customize->add_control(
			'meta_login', 
			array(
				'type' => 'checkbox',
				'label' => 'Show Login/Member Info in Header', 
				'section' => 'memberlite_theme_options',
				'priority' => '15'
			)
		);
		$wp_customize->add_setting(
			'nav_menu_search',
			array(
				'default' => false,
				'santize_callback' => 'memberlite_sanitize_checkbox',
				'santize_js_callback' => array('memberlite_Customize', 'memberlite_sanitize_js_callback'),
			)
		);
		$wp_customize->add_control(
			'nav_menu_search', 
			array(
				'type' => 'checkbox',
				'label' => 'Show Search Form After Main Nav', 
				'section' => 'memberlite_theme_options',
				'priority' => '20'
			)
		);
		$wp_customize->add_setting(
			'columns_ratio_header',
			array(
				'default' => $memberlite_defaults['columns_ratio_header'],
				'type' => 'theme_mod',
				'capability' => 'edit_theme_options',
				'santize_callback' => 'sanitize_text_field',
				'sanitize_js_callback' => array('memberlite_Customize', 'memberlite_sanitize_js_callback'),
				'transport' => 'refresh',
			)
		);
		$wp_customize->add_control(
			'columns_ratio_header',
			array(
				'label' => 'Columns Ratio - Header',
				'section' => 'memberlite_theme_options',
				'type'       => 'select',
				'choices'    => array(
					'1-11' => '1x11',
					'2-10' => '2x10',
					'3-9' => '3x9',
					'4-8' => '4x8',
					'5-7' => '5x7',
					'6-6' => '6x6',
					'7-5' => '7x5',
					'8-4' => '8x4',
					'9-3' => '9x3',
					'10-2' => '10x2',
					'11-1' => '11x1',
				),
				'priority' => 23
			)
		);
		$wp_customize->add_setting(
			'columns_ratio',
			array(
				'default' => $memberlite_defaults['columns_ratio'],
				'type' => 'theme_mod',
				'capability' => 'edit_theme_options',
				'santize_callback' => 'sanitize_text_field',
				'sanitize_js_callback' => array('memberlite_Customize', 'memberlite_sanitize_js_callback'),
				'transport' => 'refresh',
			)
		);
		$wp_customize->add_control(
			'columns_ratio',
			array(
				'label' => 'Columns Ratio - Primary',
				'section' => 'memberlite_theme_options',
				'type'       => 'select',
				'choices'    => array(
					'6-6' => '6x6',
					'7-5' => '7x5',
					'8-4' => '8x4',
					'9-3' => '9x3',
					'10-2' => '10x2',
					'11-1' => '11x1',
				),
				'priority' => 24
			)
		);
		$wp_customize->add_setting(
			'sidebar_location',
			array(
				'default' => $memberlite_defaults['sidebar_location'],
				'santize_callback' => 'sanitize_text_field',
				'sanitize_js_callback' => array('memberlite_Customize', 'memberlite_sanitize_js_callback'),
			)
		);
		$wp_customize->add_control(
			'sidebar_location',
			array(
				'label' => 'Default Layout',
				'section' => 'memberlite_theme_options',
				'type'       => 'radio',
					'choices'    => array(
						'sidebar-right'  => 'Right Sidebar',
						'sidebar-left'   => 'Left Sidebar',
					),
				'priority' => 25
			)
		);
		$wp_customize->add_setting(
			'sidebar_location_blog',
			array(
				'default' => $memberlite_defaults['sidebar_location_blog'],
				'santize_callback' => 'sanitize_text_field',
				'sanitize_js_callback' => array('memberlite_Customize', 'memberlite_sanitize_js_callback'),
			)
		);
		$wp_customize->add_control(
			'sidebar_location_blog',
			array(
				'label' => 'Layout for Blog, Archive, Posts',
				'section' => 'memberlite_theme_options',
				'type'       => 'radio',
					'choices'    => array(
						'sidebar-blog-right'  => 'Right Sidebar',
						'sidebar-blog-left'   => 'Left Sidebar',
					),
				'priority' => 30
			)
		);
		$wp_customize->add_setting(
			'content_archives',
			array(
				'default' => $memberlite_defaults['content_archives'],
				'santize_callback' => 'sanitize_text_field',
				'sanitize_js_callback' => array('memberlite_Customize', 'memberlite_sanitize_js_callback'),
			)
		);
		$wp_customize->add_control(
			'content_archives',
			array(
				'label' => 'Content Archives',
				'section' => 'memberlite_theme_options',
				'type'       => 'radio',
					'choices'    => array(
						'content'  => 'Show Post Content',
						'excerpt'   => 'Show Post Excerpts',
					),
				'priority' => 40
			)
		);
		
		$memberlite_breadcrumbs = array();
		
		$memberlite_breadcrumbs[] = array(
			'slug'=>'page_breadcrumbs', 
			'label' => __('Breadcrumbs on Pages', 'memberlite'),
			'priority' => 51
		);
		$memberlite_breadcrumbs[] = array(
			'slug'=>'post_breadcrumbs', 
			'label' => __('Breadcrumbs on Posts', 'memberlite'),
			'priority' => 52
		);
		$memberlite_breadcrumbs[] = array(
			'slug'=>'archive_breadcrumbs', 
			'label' => __('Breadcrumbs on Archives', 'memberlite'),
			'priority' => 53
		);
		$memberlite_breadcrumbs[] = array(
			'slug'=>'attachment_breadcrumbs', 
			'label' => __('Breadcrumbs on Attachments', 'memberlite'),
			'priority' => 54
		);
		$memberlite_breadcrumbs[] = array(
			'slug'=>'search_breadcrumbs', 
			'label' => __('Breadcrumbs on Search Results', 'memberlite'),
			'priority' => 55
		);
		$memberlite_breadcrumbs[] = array(
			'slug'=>'profile_breadcrumbs', 
			'label' => __('Breadcrumbs on Profiles', 'memberlite'),
			'priority' => 56
		);
		foreach( $memberlite_breadcrumbs as $memberlite_breadcrumb ) {
			// SETTINGS
			$wp_customize->add_setting(
				$memberlite_breadcrumb['slug'],
				array(
					'default' => false,
					'santize_callback' => 'memberlite_sanitize_checkbox',
					'santize_js_callback' => array('memberlite_Customize', 'memberlite_sanitize_js_callback'),
				)
			);
			// CONTROLS
			$wp_customize->add_control(
				$memberlite_breadcrumb['slug'], 
				array(
					'type' => 'checkbox',
					'label' => $memberlite_breadcrumb['label'], 
					'section' => 'memberlite_theme_options',
					'priority' => $memberlite_breadcrumb['priority']
				)
			);
		};
		$wp_customize->add_setting(
			'memberlite_post_nav',
			array(
				'default' => true,
				'santize_callback' => 'memberlite_sanitize_checkbox',
				'santize_js_callback' => array('memberlite_Customize', 'memberlite_sanitize_js_callback'),
			)
		);
		$wp_customize->add_control(
			'memberlite_post_nav', 
			array(
				'type' => 'checkbox',
				'label' => 'Show Prev/Next on Single Posts', 
				'section' => 'memberlite_theme_options',
				'priority' => '60'
			)
		);
		$wp_customize->add_setting(
			'memberlite_page_nav',
			array(
				'default' => true,
				'santize_callback' => 'memberlite_sanitize_checkbox',
				'santize_js_callback' => array('memberlite_Customize', 'memberlite_sanitize_js_callback'),
			)
		);
		$wp_customize->add_control(
			'memberlite_page_nav', 
			array(
				'type' => 'checkbox',
				'label' => 'Show Prev/Next on Single Pages', 
				'section' => 'memberlite_theme_options',
				'priority' => '61'
			)
		);
		$wp_customize->add_setting(
			'memberlite_loop_images',
			array(
				'default' => $memberlite_defaults['memberlite_loop_images'],
				'type' => 'theme_mod',
				'capability' => 'edit_theme_options',
				'santize_callback' => 'sanitize_text_field',
				'sanitize_js_callback' => array('memberlite_Customize', 'memberlite_sanitize_js_callback'),
				'transport' => 'refresh',
			)
		);
		$wp_customize->add_control(
			'memberlite_loop_images',
			array(
				'label' => 'Featured Images on Index/Archives',
				'section' => 'memberlite_theme_options',
				'type'       => 'select',
				'choices'    => array(
					'show_both' => 'Show Banner or Thumbnail',
					'show_banner' => 'Show Banner Only',
					'show_thumbnail' => 'Show Thumbnail Only',
					'show_none'  => 'Do Not Show Featured Images',
				),
				'priority' => 70
			)
		);
		$wp_customize->add_setting(
			'posts_entry_meta_before',
			array(
				'default' => $memberlite_defaults['posts_entry_meta_before'],
				'type' => 'theme_mod',
				'capability' => 'edit_theme_options',
				'santize_callback' => 'sanitize_text_field',
				'sanitize_js_callback' => array('memberlite_Customize', 'memberlite_sanitize_js_callback'),
				'transport' => 'postMessage',
			)
		);
		$wp_customize->add_control(
			'posts_entry_meta_before',
			array(
				'label' => 'Post Entry Meta (before)',
				'section' => 'memberlite_theme_options',
				'type' => 'text',
				'priority' => 80
			)
		);
		$wp_customize->add_setting(
			'posts_entry_meta_after',
			array(
				'default' => $memberlite_defaults['posts_entry_meta_after'],
				'type' => 'theme_mod',
				'capability' => 'edit_theme_options',
				'santize_callback' => 'sanitize_text_field',
				'sanitize_js_callback' => array('memberlite_Customize', 'memberlite_sanitize_js_callback'),
				'transport' => 'postMessage',
			)
		);
		$wp_customize->add_control(
			'posts_entry_meta_after',
			array(
				'label' => 'Post Entry Meta (after)',
				'section' => 'memberlite_theme_options',
				'type' => 'text',
				'priority' => 90
			)
		);
		$wp_customize->add_setting(
			'memberlite_footerwidgets',
			array(
				'default' => $memberlite_defaults['memberlite_footerwidgets'],
				'santize_callback' => 'intval_base10',
				'santize_js_callback' => array('memberlite_Customize', 'memberlite_sanitize_js_callback'),
			)
		);
		$wp_customize->add_control(
			'memberlite_footerwidgets',
			array(
				'label' => 'Footer Widgets',
				'section' => 'memberlite_theme_options',
				'type'       => 'select',
				'choices'    => array(
					'2' => '2',
					'3' => '3',
					'4' => '4',
					'6' => '6'
				),
				'priority' => 100
			)
		);
		$wp_customize->add_setting(
			'delimiter',
			array(
				'default' => $memberlite_defaults['delimiter'],
				'type' => 'theme_mod',
				'capability' => 'edit_theme_options',
				'santize_callback' => 'sanitize_text_field',
				'sanitize_js_callback' => array('memberlite_Customize', 'memberlite_sanitize_js_callback'),
				'transport' => 'postMessage',
			)
		);
		$wp_customize->add_control(
			'delimiter',
			array(
				'label' => 'Breadcrumb Delimiter',
				'section' => 'memberlite_theme_options',
				'type' => 'text',
				'priority' => 110
			)
		);
		$wp_customize->add_setting(
			'copyright_textbox',
			array(
				'default' => $memberlite_defaults['copyright_textbox'],
				'type' => 'theme_mod',
				'capability' => 'edit_theme_options',
				'santize_callback' => array('memberlite_Customize', 'sanitize_text_with_links'),
				'sanitize_js_callback' => array('memberlite_Customize', 'sanitize_js_text_with_links'),
				'transport' => 'postMessage',
			)
		);
		$wp_customize->add_control(
			'copyright_textbox',
			array(
				'label' => 'Copyright Text',
				'section' => 'memberlite_theme_options',
				'type' => 'text',
				'priority' => 120
			)
		);
		$wp_customize->add_setting(
			'memberlite_back_to_top',
			array(
				'default' => true,
				'santize_callback' => 'memberlite_sanitize_checkbox',
				'santize_js_callback' => array('memberlite_Customize', 'memberlite_sanitize_js_callback'),
			)
		);
		$wp_customize->add_control(
			'memberlite_back_to_top', 
			array(
				'type' => 'checkbox',
				'label' => 'Show Back to Top Link', 
				'section' => 'memberlite_theme_options',
				'priority' => '130'
			)
		);
		$wp_customize->add_setting(
			'memberlite_color_scheme',
			array(
				'default' => $memberlite_defaults['memberlite_color_scheme'],
				'sanitize_callback' => array('memberlite_Customize', 'sanitize_color_scheme'),
				'sanitize_js_callback' => array('memberlite_Customize', 'sanitize_js_color_scheme'),
				'type' => 'theme_mod',
				'capability' => 'edit_theme_options',
				'transport' => 'postMessage',
			)
		);
		$wp_customize->add_control(
			'memberlite_color_scheme',
			array(
				'label' => 'Color Scheme',
				'section' => 'colors',
				'type'       => 'select',
				'choices'    => array_merge(memberlite_Customize::get_color_scheme_choices(), array('custom'=>'Custom')),
				'priority' => 1
			)
		);
		$wp_customize->add_setting(
			'memberlite_darkcss',
			array(
				'default' => false,
				'santize_callback' => 'memberlite_sanitize_checkbox',
				'santize_js_callback' => array('memberlite_Customize', 'memberlite_sanitize_js_callback'),
			)
		);
		$wp_customize->add_control(
			'memberlite_darkcss', 
			array(
				'type' => 'checkbox',
				'label' => 'Use Dark Background/Inverted Scheme', 
				'section' => 'colors',
				'priority' => '2'
			)
		);
		$wp_customize->add_setting(
			'bgcolor_site_navigation',
			array(
				'default' => $memberlite_defaults['bgcolor_site_navigation'],
				'santize_callback' => 'sanitize_hex_field',
				'sanitize_js_callback' => 'maybe_hash_hex_color',
				'type' => 'theme_mod',
				'capability' => 'edit_theme_options',
				'transport' => 'postMessage',
			) 
		);
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize,
			'memberlite_bgcolor_site_navigation',
				array(
				'label' => __( 'Primary Navigation Background Color', 'memberlite' ),
				'section' => 'colors',
				'settings' => 'bgcolor_site_navigation',
				'priority' => 10,
				) 
		));
		$wp_customize->add_setting(
			'color_site_navigation',
			array(
				'default' => $memberlite_defaults['color_site_navigation'],
				'santize_callback' => 'sanitize_hex_field',
				'sanitize_js_callback' => 'maybe_hash_hex_color',
				'type' => 'theme_mod',
				'capability' => 'edit_theme_options',
				'transport' => 'postMessage',
			) 
		);
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize,
			'memberlite_color_site_navigation',
				array(
				'label' => __( 'Primary Navigation Color', 'memberlite' ),
				'section' => 'colors',
				'settings' => 'color_site_navigation',
				'priority' => 20,
				) 
		));
		$wp_customize->add_setting(
			'color_link',
			array(
				'default' => $memberlite_defaults['color_link'],
				'santize_callback' => 'sanitize_hex_field',
				'sanitize_js_callback' => 'maybe_hash_hex_color',
				'type' => 'theme_mod',
				'capability' => 'edit_theme_options',
				'transport' => 'postMessage',
			) 
		);
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize,
			'memberlite_color_link',
				array(
				'label' => __( 'Link Color', 'memberlite' ),
				'section' => 'colors',
				'settings' => 'color_link',
				'priority' => 30,
				) 
		));
		$wp_customize->add_setting(
			'color_meta_link',
			array(
				'default' => $memberlite_defaults['color_meta_link'],
				'santize_callback' => 'sanitize_hex_field',
				'sanitize_js_callback' => 'maybe_hash_hex_color',
				'type' => 'theme_mod',
				'capability' => 'edit_theme_options',
				'transport' => 'postMessage',
			) 
		);
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize,
			'memberlite_color_meta_link',
				array(
				'label' => __( 'Meta Link Color', 'memberlite' ),
				'section' => 'colors',
				'settings' => 'color_meta_link',
				'priority' => 40,
				) 
		));
		$wp_customize->add_setting(
			'color_primary',
			array(
				'default' => $memberlite_defaults['color_primary'],
				'santize_callback' => 'sanitize_hex_field',
				'sanitize_js_callback' => 'maybe_hash_hex_color',
				'type' => 'theme_mod',
				'capability' => 'edit_theme_options',
				'transport' => 'postMessage',
			) 
		);
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize,
			'memberlite_color_primary',
				array(
				'label' => __( 'Primary Color', 'memberlite' ),
				'section' => 'colors',
				'settings' => 'color_primary',
				'priority' => 50,
				) 
		));
		$wp_customize->add_setting(
			'color_secondary',
			array(
				'default' => $memberlite_defaults['color_secondary'],
				'santize_callback' => 'sanitize_hex_field',
				'sanitize_js_callback' => 'maybe_hash_hex_color',
				'type' => 'theme_mod',
				'capability' => 'edit_theme_options',
				'transport' => 'postMessage',
			) 
		);
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize,
			'memberlite_color_secondary',
				array(
				'label' => __( 'Secondary Color', 'memberlite' ),
				'section' => 'colors',
				'settings' => 'color_secondary',
				'priority' => 60,
				) 
		));
		$wp_customize->add_setting(
			'color_action',
			array(
				'default' => $memberlite_defaults['color_action'],
				'santize_callback' => 'sanitize_hex_field',
				'sanitize_js_callback' => 'maybe_hash_hex_color',
				'type' => 'theme_mod',
				'capability' => 'edit_theme_options',
				'transport' => 'postMessage',
			) 
		);
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize,
			'memberlite_color_action',
				array(
				'label' => __( 'Action Color', 'memberlite' ),
				'section' => 'colors',
				'settings' => 'color_action',
				'priority' => 70,
				) 
		));		
		
		$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
		$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
	
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector' => '.site-title a',
			'render_callback' => function() {
				bloginfo( 'name' );
			},
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector' => '.site-description',
			'render_callback' => function() {
				bloginfo( 'description' );
			},
		) );
		$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';	
		$wp_customize->get_setting( 'background_color' )->transport = 'postMessage';
		$wp_customize->get_setting( 'posts_entry_meta_before' )->transport = 'postMessage';
		$wp_customize->get_setting( 'posts_entry_meta_after' )->transport = 'postMessage';
		$wp_customize->get_setting( 'delimiter' )->transport = 'postMessage';
		
		// Rename the label to "Site Title & Tagline Color".
		$wp_customize->get_control( 'header_textcolor' )->label = __( 'Site Title &amp; Tagline Color', 'memberlite' );
	
		// Rename the label to "Display Site Title & Tagline" for clarity.
		$wp_customize->get_control( 'display_header_text' )->label = __( 'Display Site Title &amp; Tagline', 'memberlite' );
		
	}

	public static function header_output() {
		global $memberlite_defaults;
		?>
		<!--Customizer CSS--> 
		<style type="text/css">
			<?php self::generate_css($memberlite_defaults['bgcolor_site_navigation_elements'], 'background', 'bgcolor_site_navigation'); ?>
			<?php self::generate_css($memberlite_defaults['color_site_navigation_elements'], 'color', 'color_site_navigation'); ?>
			<?php self::generate_css($memberlite_defaults['color_link_color_elements'], 'color', 'color_link'); ?>
			<?php self::generate_css($memberlite_defaults['color_meta_link_color_elements'], 'color', 'color_meta_link'); ?>
			<?php self::generate_css($memberlite_defaults['color_primary_background_elements'], 'background', 'color_primary'); ?> 
			<?php self::generate_css($memberlite_defaults['color_primary_color_elements'], 'color', 'color_primary'); ?>
			<?php self::generate_css($memberlite_defaults['color_secondary_background_elements'], 'background', 'color_secondary'); ?> 
			<?php self::generate_css($memberlite_defaults['color_secondary_border_elements'], 'border-top-color', 'color_secondary'); ?>
			<?php self::generate_css($memberlite_defaults['color_secondary_border_elements'], 'border-bottom-color', 'color_secondary'); ?>
			<?php self::generate_css($memberlite_defaults['color_secondary_border_left_elements'], 'border-left-color', 'color_secondary'); ?>
			<?php self::generate_css($memberlite_defaults['color_secondary_border_right_elements'], 'border-right-color', 'color_secondary'); ?>
			<?php self::generate_css($memberlite_defaults['color_secondary_color_elements'], 'color', 'color_secondary'); ?>
			<?php self::generate_css($memberlite_defaults['color_action_background_elements'], 'background', 'color_action'); ?>
			<?php self::generate_css($memberlite_defaults['color_action_color_elements'], 'color', 'color_action'); ?>
						
			<?php 
				//hover styles
				$color_primary = get_theme_mod('color_primary');
				if(empty($color_primary))
					$color_primary = $memberlite_defaults['color_primary'];
				$color_primary_rgb = self::hex2rgb($color_primary);
				$color_primary_hover = vsprintf('rgba( %1$s, %2$s, %3$s, 0.7)', $color_primary_rgb);
				echo $memberlite_defaults['color_primary_background_hover_elements'] . " {background: " . $color_primary_hover . "}";
				echo $memberlite_defaults['color_primary_color_hover_elements'] . " {color: " . $color_primary_hover . "}";				

				$color_secondary = get_theme_mod('color_secondary');
				if(empty($color_secondary))
					$color_secondary = $memberlite_defaults['color_secondary'];
				$color_secondary_rgb = self::hex2rgb($color_secondary);
				$color_secondary_hover = vsprintf('rgba( %1$s, %2$s, %3$s, 0.7)', $color_secondary_rgb);
				echo $memberlite_defaults['color_secondary_background_hover_elements'] . " {background: " . $color_secondary_hover . "}";
			
				$color_action = get_theme_mod('color_action');
				if(empty($color_action))
					$color_action = $memberlite_defaults['color_action'];
				$color_action_rgb = self::hex2rgb($color_action);
				$color_action_hover = vsprintf('rgba( %1$s, %2$s, %3$s, 0.7)', $color_action_rgb);
				echo $memberlite_defaults['color_action_background_hover_elements'] . ' {background: ' . $color_action_hover . '}';
			
				$color_link = get_theme_mod('color_link');
				if(empty($color_link))
					$color_link = $memberlite_defaults['color_link'];
				$color_link_rgb = self::hex2rgb($color_link);
				$color_link_hover = vsprintf('rgba( %1$s, %2$s, %3$s, 0.7)', $color_link_rgb);
				echo $memberlite_defaults['color_link_hover_elements'] . ' {color: ' . $color_link_hover . '}';
				
				$color_site_navigation = get_theme_mod('color_site_navigation');
				if(empty($color_site_navigation))
					$color_site_navigation = $memberlite_defaults['color_site_navigation'];
				$color_site_navigation_rgb = self::hex2rgb($color_site_navigation);
				$color_site_navigation_hover = vsprintf('rgba( %1$s, %2$s, %3$s, 0.7)', $color_site_navigation_rgb);
				echo $memberlite_defaults['color_site_navigation_hover_elements'] . ' {color: ' . $color_site_navigation_hover . '}';
			?>
			
			<?php self::generate_css('.site-title a, .site-header .site-description', 'color', 'header_textcolor', '#'); ?>
			<?php self::generate_css('body, .banner_body', 'background-color', 'background_color', '#'); ?> 
			<?php 
				$fonts_string = get_theme_mod('memberlite_webfonts');
				if(empty($fonts_string))
				{
					global $memberlite_defaults;
					$fonts_string = $memberlite_defaults['memberlite_webfonts'];
				}
				$fonts = explode("_", $fonts_string);
				$header_font = str_replace("-", " ", $fonts[0]);
				$body_font = str_replace("-", " ", $fonts[1]);	
			?>
			<?php echo 'body, button, input[type="button"], input[type="reset"], input[type="submit"], .btn, a.comment-reply-link, a.pmpro_btn, input[type="submit"].pmpro_btn, .woocommerce #content input.button, .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce-page #content input.button, .woocommerce-page #respond input#submit, .woocommerce-page a.button, .woocommerce-page button.button, .woocommerce-page input.button, .woocommerce #content input.button.alt, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .woocommerce-page #content input.button.alt, .woocommerce-page #respond input#submit.alt, .woocommerce-page a.button.alt, .woocommerce-page button.button.alt, .woocommerce-page input.button.alt, form.pmpro_form thead th span.pmpro_thead-msg {font-family: "' . $body_font . '", sans-serif; }'; ?>
			<?php echo 'h1, h2, h3, h4, h5, h6, label, .navigation, th, .pmpro_checkout thead th, #pmpro_account .pmpro_box h3, #meta-member .user, #bbpress-forums li.bbp-header, #bbpress-forums li.bbp-footer, #bbpress-forums fieldset.bbp-form legend {font-family: "' . $header_font . '", sans-serif; }'; ?>
		</style> 
		<!--/Customizer CSS-->
		<?php
	}
	
	public static function live_preview() {
		global $memberlite_defaults;
		wp_register_script(
			'memberlite_customizer',
			get_template_directory_uri() . '/js/customizer.js',
			array(  'jquery', 'customize-preview' ),
			'20140902',
			true
		);
		// Localize the script with new data
		wp_localize_script( 'memberlite_customizer', 'memberlite_defaults', $memberlite_defaults );
		wp_enqueue_script('memberlite_customizer');
	}

	public static function generate_css( $selector, $style, $mod_name, $prefix='', $postfix='', $echo=true ) {
      $return = '';
      $mod = get_theme_mod($mod_name);
      	  
	  if ( ! empty( $mod ) ) {
         $return = sprintf('%s { %s:%s; }',
            $selector,
            $style,
            $prefix.$mod.$postfix
         );
         if ( $echo ) {
            echo $return;
         }
      }
      return $return;
    }		
	
	/**
	 * Register color schemes for Memberlite.
	 * Based on code from the Twentyfifteen theme. (https://themes.svn.wordpress.org/twentyfifteen/1.2/inc/customizer.php)
	 *
	 * Can be filtered with {@see 'memberlite_color_schemes'}.
	 *
	 * The order of colors in a colors array:
	 * 1. Header Text Color
	 * 2. Background Color
	 * 3. Primary Navigation Background Color
	 * 4. Primary Navigation Link Color
	 * 5. Link Color
	 * 6. Meta Link Color
	 * 7. Primary Color
	 * 8. Secondary Color
	 * 9. Action Color
	 *
	 * @since Twenty Fifteen 1.0
	 *
	 * @return array An associative array of color scheme options.
	 */
	public static function get_color_schemes() {
		return apply_filters( 'memberlite_color_schemes', array(
			'default' => array(
				'label'  => __( 'Default', 'memberlite' ),
				'colors' => array(
					'#2c3e50',
					'#ffffff',
					'#FAFAFA',
					'#777777',
					'#2C3E50',
					'#2C3E50',
					'#2C3E50',
					'#18BC9C',
					'#F39C12',
				),
			),
			'education'   => array(
				'label'  => __( 'Education', 'memberlite' ),
				'colors' => array(
					'#3a9ad9',
					'#f4efea',
					'#e2ded9',
					'#354458',
					'#3a9ad9',
					'#3a9ad9',
					'#354458',
					'#eb7260',
					'#29aba4',
				),
			),
			'modern_teal'  => array(
				'label'  => __( 'Modern Teal', 'memberlite' ),
				'colors' => array(
					'#424242',
					'#efefef',
					'#424242',
					'#efefef',
					'#00ccd6',
					'#00ccd6',
					'#00ccd6',
					'#424242',
					'#ffd900',
				),
			),
			'mono_blue'  => array(
				'label'  => __( 'Mono Blue', 'memberlite' ),
				'colors' => array(
					'#00aeef',
					'#ffffff',
					'#00aeef',
					'#ffffff',
					'#00aeef',
					'#00aeef',
					'#333333',
					'#555555',
					'#00aeef',
				),
			),
			'mono_green'  => array(
				'label'  => __( 'Mono Green', 'memberlite' ),
				'colors' => array(
					'#00a651',
					'#ffffff',
					'#00a651',
					'#ffffff',
					'#00a651',
					'#00a651',
					'#333333',
					'#555555',
					'#00a651',
				),
			),
			'mono_orange'  => array(
				'label'  => __( 'Mono Orange', 'memberlite' ),
				'colors' => array(
					'#f39c12',
					'#ffffff',
					'#f39c12',
					'#ffffff',
					'#f39c12',
					'#f39c12',
					'#333333',
					'#555555',
					'#f39c12',
				),
			),
			'mono_pink'  => array(
				'label'  => __( 'Mono Pink', 'memberlite' ),
				'colors' => array(
					'#ed0977',
					'#ffffff',
					'#ed0977',
					'#ffffff',
					'#ed0977',
					'#ed0977',
					'#333333',
					'#555555',
					'#ed0977',
				),
			),
			'pop'   => array(
				'label'  => __( 'Pop!', 'memberlite' ),
				'colors' => array(
					'#53bbf4',
					'#FFFFFF',
					'#b1eb00',
					'#666666',
					'#b1eb00',
					'#b1eb00',
					'#53bbf4',
					'#ffac00',
					'#ff85cb',
				),
			),
			'primary'   => array(
				'label'  => __( 'Not So Primary', 'memberlite' ),
				'colors' => array(
					'#1352a2',
					'#f0f1ee',
					'#ffffff',
					'#555555',
					'#fb6964',
					'#fb6964',
					'#1352a2',
					'#fb6964',
					'#ffd464',
				),
			),
			'raspberry_lime'    => array(
				'label'  => __( 'Raspberry Lime', 'memberlite' ),
				'colors' => array(
					'#aa2159',
					'#ffffff',
					'#700035',
					'#efefef',
					'#009d97',
					'#aa2159',
					'#aa2159',
					'#009d97',
					'#bcc747',
				),
			),
			'slate_blue'  => array(
				'label'  => __( 'Slate Blue', 'memberlite' ),
				'colors' => array(
					'#6991ac',
					'#f5f5f5',
					'#ffffff',
					'#67727a',
					'#6991ac',
					'#6991ac',
					'#67727a',
					'#6991ac',
					'#d75c37',
				),
			),
			'watermelon'   => array(
				'label'  => __( 'Watermelon Seed', 'memberlite' ),
				'colors' => array(
					'#363635',
					'#f9f9f7',
					'#363635',
					'#ffffff',
					'#83bf17',
					'#83bf17',
					'#83bf17',
					'#363635',
					'#f15d58',
				),
			),
		) );
	}
			
	/**
	 * Returns an array of color scheme choices registered for Memberlite.
	 *
	 * @since Memberlite 2.0
	 *
	 * @return array Array of color schemes.
	 */
	public static function get_color_scheme_choices() {
		$color_schemes                = memberlite_Customize::get_color_schemes();
		$color_scheme_control_options = array();
		foreach ( $color_schemes as $color_scheme => $value ) {
			$color_scheme_control_options[ $color_scheme ] = $value['label'];
		}
		return $color_scheme_control_options;
	}	
	
	/**
	 * Sanitize Checkbox input values
	 * 
	 * @since Memberlite 3.0
	 */
	public static function memberlite_sanitize_checkbox( $input ) {
		if ( $input ) {
			$output = '1';
		} else {
			$output = false;
		}
		return $output;
	}
	
	/**
	 * Sanitize Text input values
	 * 
	 * @since Memberlite 3.0
	 */
	public static function memberlite_sanitize_js_callback( $value ) {
		$value = esc_js( $value );
		return $value;
	}

	/**
	 * Sanitization callback for color schemes.
	 *
	 * @since Memberlite 2.0
	 *
	 * @param string $value Color scheme name value.
	 * @return string Color scheme name.
	 */
	public static function sanitize_color_scheme( $value ) {
		$color_schemes = memberlite_Customize::get_color_scheme_choices();
		if ( ! array_key_exists( $value, $color_schemes ) ) {
			$value = 'default';
		}
		return $value;
	}
	
	public static function sanitize_js_color_scheme( $value ) {
		$color_schemes = memberlite_Customize::get_color_scheme_choices();
		if ( ! array_key_exists( $value, $color_schemes ) ) {
			$value = 'default';
		}
		return esc_js($value);
	}
	
	/**
	 * Sanitization callback text that may contain links
	 *
	 * @since Memberlite 2.0
	 *
	 * @param string $value string to sanitize.
	 * @return string sanitized string.
	 */
	public static function sanitize_text_with_links( $value ) {
		$allowed_html = array(
			'a' => array(
				'class' => array(),
				'href' => array(),
				'title' => array(),
			),
		);		
		return wp_kses($value, $allowed_html);
	}
	
	public static function sanitize_js_text_with_links( $value ) {
		$allowed_html = array(
			'a' => array(
				'class' => array(),
				'href' => array(),
				'title' => array(),
			),
		);
		return esc_js(wp_kses($value, $allowed_html));
	}
	
	/**
	 * Binds JS listener to make Customizer color_scheme control.
	 *
	 * Passes color scheme data as colorScheme global.
	 *
	 * @since Twenty Fifteen 1.0
	 */
	public static function customizer_controls_js() {
		wp_enqueue_script( 'memberlite_customizer-controls', get_template_directory_uri() . '/js/customizer-controls.js', array( 'customize-controls', 'iris', 'underscore', 'wp-util' ), MEMBERLITE_VERSION, true );
		wp_localize_script( 'memberlite_customizer-controls', 'colorSchemes', memberlite_Customize::get_color_schemes() );
	}
	
	/**
	 * Convert HEX to RGB.
	 *
	 * Borrowed from Twentyfifteen: https://github.com/WordPress/WordPress/blob/master/wp-content/themes/twentyfifteen/inc/customizer.php
	 * 
	 * @since Memberlite 2.0.4
	 *
	 * @param string $color The original color, in 3- or 6-digit hexadecimal form.
	 * @return array Array containing RGB (red, green, and blue) values for the given
	 *               HEX code, empty array otherwise.
	 */
	public static function hex2rgb( $color ) {
		$color = trim( $color, '#' );
		if ( strlen( $color ) == 3 ) {
			$r = hexdec( substr( $color, 0, 1 ).substr( $color, 0, 1 ) );
			$g = hexdec( substr( $color, 1, 1 ).substr( $color, 1, 1 ) );
			$b = hexdec( substr( $color, 2, 1 ).substr( $color, 2, 1 ) );
		} else if ( strlen( $color ) == 6 ) {
			$r = hexdec( substr( $color, 0, 2 ) );
			$g = hexdec( substr( $color, 2, 2 ) );
			$b = hexdec( substr( $color, 4, 2 ) );
		} else {
			return array();
		}
		return array( 'red' => $r, 'green' => $g, 'blue' => $b );
	}
}

// Setup the Theme Customizer settings and controls...
add_action( 'customize_register' , array( 'memberlite_Customize' , 'register' ) );
add_action( 'customize_controls_enqueue_scripts', array('memberlite_Customize', 'customizer_controls_js' ));

// Output custom CSS to live site
add_action( 'wp_head' , array( 'memberlite_Customize' , 'header_output' ) );

// Enqueue live preview javascript in Theme Customizer admin screen
add_action( 'customize_preview_init' , array( 'memberlite_Customize' , 'live_preview' ) );

