<?php
/*
 * Plugin Name: EventON - Event Tickets
 * Plugin URI: http://www.myeventon.com/
 * Description: Sell Event Tickets using Woocommerce
 * Author: Ashan Jay
 * Version: 1.2.6
 * Author URI: http://www.ashanjay.com/
 * Requires at least: 3.8
 * Tested up to: 4.4.1
 *
 * Text Domain: eventon
 * Domain Path: /lang/
 *
 * @package event ticket
 * @Author AJDE
 */

if ( ! defined( 'ABSPATH' ) ) exit;

//Event tickets main class
if ( ! class_exists( 'evotx' ) ):
class evotx{	
	public $version='1.2.6';
	public $eventon_version = '2.3.19';
	public $name = 'Tickets';
			
	public $addon_data = array();
	public $slug, $plugin_slug , $plugin_url , $plugin_path ;
	private $urls;
	public $template_url ;

	public $evotx_opt;
	public $opt2;
	
	public $evotx_args;
	
	// Construct
		public function __construct(){			
			$this->super_init();

			include_once( $this->plugin_path . '/includes/admin/class-admin_check.php' );
			$this->check = new addon_check($this->addon_data);
			$check = $this->check->initial_check();
			
			if($check){
				$this->addon = new evo_addon($this->addon_data);
				add_action('plugins_loaded', array($this, 'plugin_init'));			
			}
		}

	// INIT
		function plugin_init(){
			if(class_exists('WooCommerce')){
				add_action( 'init', array( $this, 'init' ), 0 );

				$this->includes();
				$this->load_plugin_textdomain();

				// settings link in plugins page
				add_filter("plugin_action_links_".$this->plugin_slug, array($this,'eventon_plugin_links' ));
			}else{
				add_action('admin_notices', array($this, '_wc_eventon_warning'));
			}
		}
	
	// SUPER init
		function super_init(){
			// PLUGIN SLUGS			
			$this->addon_data['plugin_url'] = path_join(WP_PLUGIN_URL, basename(dirname(__FILE__)));
			$this->addon_data['plugin_slug'] = plugin_basename(__FILE__);
			list ($t1, $t2) = explode('/', $this->addon_data['plugin_slug'] );
	        $this->addon_data['slug'] = $t1;
	        $this->addon_data['plugin_path'] = dirname( __FILE__ );
	        $this->addon_data['evo_version'] = $this->eventon_version;
	        $this->addon_data['version'] = $this->version;
	        $this->addon_data['name'] = $this->name;

	        $this->plugin_url = $this->addon_data['plugin_url'];
	        $this->plugin_slug = $this->addon_data['plugin_slug'];
	        $this->slug = $this->addon_data['slug'];
	        $this->plugin_path = $this->addon_data['plugin_path'];
		}

	// INITIATE please
		function init(){	
			// Activation
			$this->activate();	
			
			// Deactivation
			register_deactivation_hook( __FILE__, array($this,'deactivate'));
			
			$this->evotx_opt = get_option('evcal_options_evcal_tx');
			$this->opt2 = get_option('evcal_options_evcal_2');

			// RUN addon updater only in dedicated pages
			if ( is_admin() ){
				$this->addon->updater();
			}
		}
	
	/** Include required core files. */
		function includes(){			
			// both front and admin
			include_once( $this->plugin_path . '/includes/class-post-types.php' );
			include_once( $this->plugin_path . '/includes/class-email.php' );
			include_once( $this->plugin_path . '/includes/class-ticket-orderitem.php' );
			include_once( $this->plugin_path . '/includes/class-ticket-item.php' );			
			include_once( $this->plugin_path . '/includes/class-bothends.php' );
			$this->bothends = new evotx_bothends();		

			include_once($this->plugin_path . '/includes/class-functions.php');
			$this->functions = new evotx_functions();

			if ( is_admin() ){
				include_once( $this->plugin_path . '/includes/admin/class-admin.php' );				
			}
			//frontend includes
			if ( ! is_admin() || defined('DOING_AJAX') ){
				include_once( $this->plugin_path . '/includes/class-frontend.php' );
				$this->frontend = new evotx_front();
			}
			if ( defined('DOING_AJAX') ){
				include_once( $this->plugin_path . '/includes/class-ajax.php' );
			}
		}	
	
	// Load localisation files
		function load_plugin_textdomain(){		
			/**
			 * Admin Locale. Looks in:
			 * eventon-tickets/lang/
			 */
			if ( is_admin() ) {
				$locale = apply_filters( 'plugin_locale', get_locale(), 'eventon' );				
				load_plugin_textdomain( 'eventon', false, plugin_basename( dirname( __FILE__ ) ) . "/lang" );
			}			
		}

	// SECONDARY FUNCTIONS			
		function eventon_plugin_links($links){
			$settings_link = '<a href="admin.php?page=eventon&tab=evcal_tx">Settings</a>'; 
			array_unshift($links, $settings_link); 
	 		return $links; 	
		}
		function activate(){
			// add actionUser addon to eventon addons list
			$this->addon->activate();
		}		

	    function _wc_eventon_warning(){
	        ?>
	        <div class="message error"><p><?php _e('Eventon Tickets need woocommerce plugin to function properly. Please install woocommerce', 'eventon'); ?></p></div>
	        <?php
	    }	   
	
		// Deactivate addon
		function deactivate(){
			$this->addon->remove_addon();
		}	
}
// Initiate this addon within the plugin
$GLOBALS['evotx'] = new evotx();
endif;
?>