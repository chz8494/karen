<?php
/*
 * EMAILING object for event tickets
 * @version 1.2
 */

class evotx_email{
	public function __construct(){}

	function get_ticket_email_body($args){
		global $eventon;

		$evoHelper = new evo_helper();
		// get email body content with eventon header and footer
		return $evoHelper->get_email_body_content($this->get_ticket_email_body_only($args));
	}		
	function get_ticket_email_body_only($args){
		global $eventon, $evotx;
		ob_start();
		
		// email body message
			/** path like: ../plugins/eventon-tickets/templates/email/ticket_confirmation_email.php	 */
			$file = 'ticket_confirmation_email';
			$path = $evotx->addon_data['plugin_path']."/templates/email/";	

			$args = array($args, true);
			$paths = array(
				0=> TEMPLATEPATH.'/'.$eventon->template_url.'templates/email/tickets/',
				1=> $path,
			);

			$file_name = $file.'.php';
			foreach($paths as $path_){	
				// /echo $path.$file_name.'<br/>';			
				if(file_exists($path_.$file_name) ){	
					$template = $path_.$file_name;	
					break;
				}
			}
			include($template);
		return ob_get_clean();
	}
	// reusable tickets HTML for an order -- not used anywhere
		function get_tickets($tix, $email=false){

			global $eventon, $evotx;
			/** path like: ../plugins/eventon-tickets/templates/email/ticket_confirmation_email.php */
			$file = 'ticket_confirmation_email';
			$path = $evotx->addon_data['plugin_path']."/templates/email/";

			$args = array($tix, $email);

			// GET email 
			$message = $eventon->get_email_body($file,$path, $args);
			return $message;
		}

	// EMAIL the ticket 
		public function send_ticket_email($order_id, $outter_shell = true, $initialSend = true, $toemail=''){
			// initials
				global $woocommerce, $evotx;
				$send_wp_mail = false;

			$order_meta = get_post_custom($order_id);

			// check if order contain event ticket data
			if(!empty($order_meta['_order_type'])){

				$evotx_opt = $evotx->evotx_opt;
				$order = new WC_Order( $order_id );
				$tickets = $order->get_items();

				// CHECK if any of the order items have ticket in it
					$_has_ticket = false;
					foreach($tickets as $item){
						$eid = get_post_meta( $item['product_id'], '_eventid', true);
						if(!empty($eid)){ $_has_ticket=true; break;}
					}
				
				// STOP if there arent any tickets in the order
					if(!$_has_ticket  )
						return;
					
				// include HTML email filter
					add_filter('wp_mail_content_type',create_function('', 'return "text/html";'));	

				if($order_meta['_customer_user'][0]==0){// no account created
					$__to_email = $order_meta['_billing_email'][0];
					$__customer_name = $order_meta['_billing_first_name'][0].' '.$order_meta['_billing_last_name'][0];
				}else{
					$usermeta = get_user_meta( $order_meta['_customer_user'][0] );
					$__to_email = $usermeta['billing_email'][0];
					$__customer_name = $usermeta['first_name'][0].' '.$usermeta['last_name'][0];
				}

				// update to email address if passed
					$__to_email = ($toemail)? $toemail: $__to_email;
				
				// arguments for email body
					$email_body_arguments = array(
						'orderid'=>$order_id,
						'tickets'=>$tickets, 
						'customer'=>$__customer_name,
						'email'=>'yes'
					);
				
				$from_email = $this->get_from_email();

				$subject = '[#'.$order_id.'] '.((!empty($evotx_opt['evotx_notfiesubjest']))? 
							htmlspecialchars_decode($evotx_opt['evotx_notfiesubjest']): 
							__('Event Ticket','eventon'));
				$headers = 'From: '.$from_email;	

				// get the email body				
				$body = ($outter_shell)? 
					$this->get_ticket_email_body($email_body_arguments): 
					$this->get_ticket_email_body_only($email_body_arguments);

				// check if initial attempt to send email and have the email already been sent
				if($initialSend){
					$emailSentAlready = (!empty($order_meta['_tixEmailSent']))? $order_meta['_tixEmailSent'][0]:false;
					if(!$emailSentAlready)
						$send_wp_mail = wp_mail($__to_email, $subject, $body, $headers);
				}else{
					$send_wp_mail = wp_mail($__to_email, $subject, $body, $headers);
				}

				// if initial sending ticket email record that
				if($initialSend ){
					($send_wp_mail)?
						update_post_meta($order_id,'_tixEmailSent',true):
						update_post_meta($order_id,'_tixEmailSent',false);
				}

				//echo $__to_email.' '.$headers;

				return $send_wp_mail;
			}
		}

		// emailing helpers
			function get_from_email(){
				global $evotx;
				$evotx_opt = $evotx->evotx_opt;

				$__from_email = (!empty($evotx_opt['evotx_notfiemailfrom']) )?
							htmlspecialchars_decode ($evotx_opt['evotx_notfiemailfrom'])
							:get_bloginfo('admin_email');
				$__from_email_name = (!empty($evotx_opt['evotx_notfiemailfromN']) )?
							($evotx_opt['evotx_notfiemailfromN'])
							:get_bloginfo('name');

					$from_email = (!empty($__from_email_name))? 
								$__from_email_name.' <'.$__from_email.'>' : $__from_email;
				return $from_email;
			}

}