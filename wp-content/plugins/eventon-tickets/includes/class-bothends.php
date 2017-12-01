<?php
/**
 * Tickets addon functions for both front and backend
 * @version 0.1
 */
class evotx_bothends{
	public function __construct(){
		$this->eotx = get_option('evcal_options_evcal_tx');
		// actionuser intergration
		add_filter('evoau_form_fields', array($this, 'actionuser_fields'), 10, 1);

		// send ticket email
		if(empty($this->eotx['evotx_tix_email']) || $this->eotx['evotx_tix_email']!='yes'){
			add_action('woocommerce_order_status_completed', array($this, 'send_ticket_email'), 10, 1);	
		}

		// when orders were cancelled, failed, or refunded
		add_action('woocommerce_order_status_cancelled', array($this, 'update_ticket_qty'), 10,1);
		add_action('woocommerce_order_status_refunded', array($this, 'update_ticket_qty'), 10,1);

		$customfield = false;
		if($customfield):
			// show additional fields in checkout
			add_filter( 'woocommerce_checkout_fields', array($this,'filter_checkout_fields') );
			add_action( 'woocommerce_checkout_after_customer_details' ,array($this,'extra_checkout_fields') );

			// save extra information
			add_action( 'woocommerce_checkout_update_order_meta', array($this,'save_extra_checkout_fields') );

			// display in wp-admin
			add_action( 'woocommerce_admin_order_data_after_order_details', array($this,'display_order_data_in_admin') );
		endif;
	}

	// BETA Feature
		function filter_checkout_fields($fields){
		    $fields['evotx_field'] = array(
		            'some_field' => array(
		                'type' => 'text',
		                'required'      => false,
		                'label' => __( 'Some field' )
		                ),
		            );

		    return $fields;
		}
		function extra_checkout_fields(){ 

		    $checkout = WC()->checkout(); 	    
		    
		    // there will only be one item in this array
		    foreach ( $checkout->checkout_fields['evotx_field'] as $key => $field ) : 
		    	
		    	global $woocommerce;
		    	$items = $woocommerce->cart->get_cart();

		    	$output = '';

		    	// foreach item in the cart
		        foreach($items as $item => $values) { 
		        	$_product = $values['data']->post; 
		        	$eventID = get_post_meta($_product->ID,'_eventid',true);

		        	if(!$eventID) continue;

		        	$output.= "<p>".__('Event Name: ').$_product->post_title."</p>";
		        	if($values['quantity']>0){
		        		for($x=0; $x<$values['quantity']; $x++){
		        			$output.= "<p class='form-row form-row validate-required'><label>".__('Full Name of the Ticket Holder')." #".($x+1)."</label>";
		        			$output.= "<input name='tixholders[$eventID][]' type='text' class='input-text' name=''/>";
		        			$output.= "</p>";
		        		}
		        	}	            
		        } 

		        echo !empty($output)? "<div class='extra-fields'><h3>".__( 'Additional Ticket Information','eventon' )."</h3>".$output . ' </div>':'';

		    endforeach; ?>	   

		<?php }

		function save_extra_checkout_fields( $order_id ){
			if( isset( $_POST['tixholders'] ) ) {
		    	update_post_meta( $order_id, '_tixholders',  $_POST['tixholders']  );
		    }
		}
		function display_order_data_in_admin( $order ){

			$tixHolders = get_post_meta( $order->id, '_tixholders', true );
			if(empty($tixHolders)) return $order;
		?>
		    <div class="order_data_column">
		        <h4><?php _e( 'List of Event Ticket Holders', 'eventon' ); ?></h4>
		        <?php 

		        	if(!empty($tixHolders) && is_array($tixHolders)){
		        		foreach($tixHolders as $eventid=>$names){
		        			echo "<p>";
		        			echo implode(', ', $names);
		        			echo "</p>";
		        		}
		        	}
		        ?>
		    </div>
		<?php }

	// Auto re-stock tickets
		function update_ticket_qty($orderid){
			global $evotx;
			$evotx->functions->restock_tickets($orderid);
		}

	// EMAILING
		function send_ticket_email($order_id){
			$email = new evotx_email();
			// initial ticket email
			$email->send_ticket_email($order_id, false, true);
		}

	// ActionUser
		function actionuser_fields($array){
			$array['evotx']=array('Ticket Fields', 'evotx', 'evotx','custom','');
			return $array;
		}
}