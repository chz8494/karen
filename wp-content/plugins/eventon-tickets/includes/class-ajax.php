<?php
/**
 * Event Tickets Ajax Handletx
 *
 * Handles AJAX requests via wp_ajax hook (both admin and front-end events)
 *
 * @author 		AJDE
 * @category 	Core
 * @package 	EventON-TX/classes/AJAX
 * @vetxion     1.2.5
 */

class evo_tix_ajax{
	/**
	 * Hook into ajax events
	 */
	public function __construct(){
		$ajax_events = array(
			'the_ajax_evotx_a1'=>'evotx_get_attendees',
			'the_ajax_evotx_a5'=>'evoTX_checkin_',
			'the_ajax_evotx_a3'=>'generate_csv',
			'evotx_woocommerce_add_to_cart'=>'evotx_woocommerce_ajax_add_to_cart',
			'the_ajax_evotx_a55'=>'admin_resend_confirmation',
			'evoTX_ajax_06'=>'evoTX_ajax_06',
			'evoTX_ajax_07'=>'evoTX_ajax_07',
			'evoTX_ajax_08'=>'evoTX_ajax_08',
		);
		foreach ( $ajax_events as $ajax_event => $class ) {
			add_action( 'wp_ajax_'.  $ajax_event, array( $this, $class ) );
			add_action( 'wp_ajax_nopriv_'.  $ajax_event, array( $this, $class ) );
		}
	}

	// submit inqurry form
		function evoTX_ajax_06(){

			$evoOpt = get_evoOPT_array(1);

			$event_id = $_POST['event_id'];
			$ri = $_POST['ri'];

			add_filter('wp_mail_content_type',create_function('', 'return "text/html";'));	
			$_event_pmv = get_post_custom($event_id);
			
			// get email address
			$_to_mail = (!empty($_event_pmv['_tx_inq_email']))? $_event_pmv['_tx_inq_email'][0]:
				( !empty($evoOpt['evotx_tix_inquiries_def_email'])? $evoOpt['evotx_tix_inquiries_def_email']:
					get_option('admin_email'));
			// get subject
			$subject = (!empty($_event_pmv['_tx_inq_subject']))? $_event_pmv['_tx_inq_subject'][0]:
				( !empty($evoOpt['evotx_tix_inquiries_def_subject'])? $evoOpt['evotx_tix_inquiries_def_subject']:'New Ticket Sale Inquery');

			$headers = 'From: '.$_POST['email'];	

			ob_start();?>
				<p>Event: <br/><?php echo get_the_title( $event_id ); ?></p>
				<p>From: <br/><?php echo $_POST['name'].' <'.$_POST['email'].'>';?></p>
				<p>Message: <br/><?php echo $_POST['message'];?></p>
			<?php
			$body = ob_get_clean();

			$send_wp_mail = wp_mail($_to_mail, $subject, $body, $headers);

		}

	// GET attendee list view for event
		function evotx_get_attendees(){	
			global $evotx;

			$nonce = $_POST['postnonce'];
			$status = 0;
			$message = $content = '';

			if(! wp_verify_nonce( $nonce, 'evotx_nonce' ) ){
				$status = 1;	$message ='Invalid Nonce';
			}else{

				ob_start();

				$ri = (!empty($_POST['ri']) || (!empty($_POST['ri']) && $_POST['ri']==0 ))? $_POST['ri']:'all'; // repeat interval

				$customer_ = $evotx->functions->get_customer_ticket_list($_POST['eid'], $_POST['wcid'], $ri);

				// customers with completed orders
				if($customer_){
					echo "<div class='evotx'>";
					echo "<p class='header'>".__('Attendee Name','eventon')." <span class='txcount'>".__('Ticket Count','eventon')."</span></p>";	

					// each customer
					
					echo "<div class='eventedit_tix_attendee_list'>";
					foreach($customer_ as $event_time=>$tickets){
						echo "<p class='attendee'>";
						echo "<span class='event_time'>".__('Event Start:','eventon').' '.$event_time."</span>";					
						$index = 1;
						// each ticket item
						foreach($tickets as $ticketItem_){
							echo "<span class='evotx_ticketitem_customer'>";
							echo "<span class='evotx_ticketitem_header'>"
								.'<b>'.__('CUSTOMER','eventon').':</b> '.$ticketItem_['name']." ({$ticketItem_['email']}) ".( !empty($ticketItem_['type'])? "- <b>{$ticketItem_['type']}</b>":''). 
								( !empty($ticketItem_['order_status'])? " <b class='orderStutus status_{$ticketItem_['order_status']}'>{$ticketItem_['order_status']}</b>":'') ."</span>";
							echo "<span class='evotx_ticketItem'><span class='txcount'>{$ticketItem_['qty']}<em>".__('Tickets','eventon')."</em></span>";

							$tid = $ticketItem_['tids']; // ticket ID array with status

							echo "<span class='tixid'>";
							
							// for each ticket ID
							foreach($tid as $id=>$_status){
								$langStatus = $evotx->functions->get_checkin_status($_status);
								echo "<span class='evotx_ticket'>".$id."<span class='evotx_status {$_status}' data-tid='{$id}' data-status='{$_status}' data-tiid='{$ticketItem_['tiid']}'>".$langStatus."</span></span>";
							}
							echo "<span class='clear'></span><em class='orderdate'>".__('Ordered Date','eventon').': '.$ticketItem_['postdata']."</em>";
							echo "</span></span>";
							echo "</span>";
							$index++;
						}
						echo "</p>";					
					}
					echo "</div>";
					echo "</div>";
				}else{
					echo "<div class='evotx'>";
					echo "<p class='header nada'>".__('Could not find attendees with completed orders.','eventon')."</p>";	
					echo "</div>";
				}
				
				$content = ob_get_clean();
			}
					
			$return_content = array(
				'message'=> $message,
				'status'=>$status,
				'content'=>$content,
			);
			
			echo json_encode($return_content);		
			exit;
		}

	// for evo-tix post page and from event edit page
		function evoTX_checkin_(){
			global $evotx;

			$ticketNumber = $_POST['tid'];

			// split ticket number
			$tixNum = explode('-', $ticketNumber);
			$OrderComplete = $evotx->functions->is_order_complete($tixNum[1]);
			$CheckinLang = $evotx->functions->get_statuses_lang(); // get both check status lang

			// order is not complete
			if($OrderComplete){
				$tixID = $tixNum[0];

				$current_status = $_POST['status'];

				$ticketItem = new evotx_TicketItem($tixID);

				$other_status = $ticketItem->get_other_status($current_status);
				$ticketItem->change_ticket_status($other_status[0], $ticketNumber, $tixID);

				$newTixStaus = $other_status[0];

			}else{
				$newTixStaus = $_POST['status'];
			}			

			$return_content = array(
				'new_status'=>$newTixStaus,
				'new_status_lang'=>$CheckinLang[$newTixStaus],
			);
			
			echo json_encode($return_content);		
			exit;
		}

	// Download csv list of attendees
		function generate_csv(){

			$e_id = $_REQUEST['e_id'];
			$event = get_post($e_id, ARRAY_A);

			header("Content-type: text/csv");
			header("Content-Disposition: attachment; filename=".$event['post_name']."_".date("d-m-y").".csv");
			header("Pragma: no-cache");
			header("Expires: 0");


			global $evotx;
			$customers = $evotx->functions->get_customer_ticket_list($e_id, $_REQUEST['pid'], 'all');

			if($customers){
				//$fp = fopen('file.csv', 'w');

				$csv_header = apply_filters('evotx_csv_headers',array(
					'Name','Email Address','Address','Phone','Ticket IDs',
					'Quantity','Ticket Type','Event Time','Order Status'
				));
				$csv_head = implode(',', $csv_header);
				echo $csv_head."\n";
				
				// each customer
				foreach($customers as $eventtime=>$cus){
					// each ticket item
					foreach($cus as $ticketItem_){
						
						$tid = $ticketItem_['tids']; // ticket ID array with status
						
						// for each ticket ID
						foreach($tid as $id=>$_status){						
							$langStatus = $evotx->functions->get_checkin_status($_status);

							$csv_data = apply_filters('evotx_csv_row',array(
								$ticketItem_['name'],
								$ticketItem_['email'],
								$ticketItem_['address'],
								$ticketItem_['phone'],
								$id,
								'1',
								$ticketItem_['type'],
								'"'.$eventtime.'"',
								$ticketItem_['order_status']
							));

							$csv_dt = implode(",", $csv_data);
							echo $csv_dt."\n";
						}			
					}
					
				}
			}

		}

	// ADD to cart for variable items
		function evotx_woocommerce_ajax_add_to_cart() {
			global $woocommerce;
			 
			// Initial values
				$product_id        = apply_filters( 'woocommerce_add_to_cart_product_id', absint( $_POST['product_id'] ) );
				$variation_id     = apply_filters( 'woocommerce_add_to_cart_variation_id', absint( $_POST['variation_id'] ) );
				$quantity  = empty( $_POST['quantity'] ) ? 1 : apply_filters( 'woocommerce_stock_amount', $_POST['quantity'] );
				$passed_validation = apply_filters( 'woocommerce_add_to_cart_validation', true, $product_id, $quantity );
				
			// if variations are sent
				if(isset($_POST['variations'])){
					$att=array();
					foreach($_POST['variations'] as $varF=>$varV){
						$att[$varF]=$varV;
					}
				}
			

			if($passed_validation && !empty($variation_id)){
				$cart_item_key = WC()->cart->add_to_cart( $product_id, $quantity, $variation_id ,$att);
				do_action( 'woocommerce_ajax_added_to_cart', $product_id );

				$frags = new WC_AJAX( );
	        	$frags->get_refreshed_fragments( );
			}

			/*
				// if variation ID is given
				if(!empty($variation_id) && $variation_id > 0){
					
					$cart_item_key = $woocommerce->cart->add_to_cart( $product_id, $quantity, $variation_id ,$att);
					 
					do_action( 'woocommerce_ajax_added_to_cart', $product_id ,$quantity, $variation_id ,$variation);

					// Return fragments
					//$frags = new WC_AJAX( );
		        	//$frags->get_refreshed_fragments( );


					// if WC settings set to redirect after adding to cart
					if ( get_option( 'woocommerce_cart_redirect_after_add' ) == 'yes' ) {
						// show cart notification
					 	wc_add_to_cart_message( $product_id );
					 	$woocommerce->set_messages();
					}
				}else{
				 
					if ( $passed_validation && $woocommerce->cart->add_to_cart( $product_id, $quantity) ) {
						do_action( 'woocommerce_ajax_added_to_cart', $product_id );
						 
						if ( get_option( 'woocommerce_cart_redirect_after_add' ) == 'yes' ) {
						 	woocommerce_add_to_cart_message( $product_id );
						 	$woocommerce->set_messages();
						}
						 
						// Return fragments
						// $frags = new WC_AJAX( );
		        		// $frags->get_refreshed_fragments( );
					 
					} else {
					 
						header( 'Content-Type: application/json; charset=utf-8' );
						 
						// If there was an error adding to the cart, redirect to the product page to show any errors
						$data = array(
						 	'error' => true,
						 	'product_url' => apply_filters( 'woocommerce_cart_redirect_after_error', get_permalink( $product_id ), $product_id )
						);
						 
						$woocommerce->set_messages();
						 
						echo json_encode( $data );
					 
					}
					die();
				} // endif
			
			*/
		
			$output = array(
				'key'=>$cart_item_key,
				'variation'=>WC()->cart->cart_contents_total
			);
			echo json_encode( $output );
		 }

	// Resend Ticket Email
		function admin_resend_confirmation(){
			global $evotx;
			$order_id = false;

			// get order ID
			$order_id = (!empty($_POST['orderid']))? $_POST['orderid']:false;			
			
			if($order_id){

				// check if custom email is passed
				$customemail = !empty($_POST['email'])? $_POST['email']: false;

				$email = new evotx_email();
				$send_mail = $email->send_ticket_email($order_id, false, false, $customemail);
			}else{
				$send_mail =$order_id;
			}		
			
			// return the results
			$return_content = array('status'=> ( $send_mail?'good':'bad'));
			
			echo json_encode($return_content);		
			exit;
		}
	
	// get information for a ticket number
		function evoTX_ajax_07(){

			$tickernumber = $_POST['tickernumber'];
			$tixNum = explode('-', $tickernumber);
			$AJAXstatus = 'bad';

			// if ticket post exists
			if(get_post_status($tixNum[0])){
				$tixPMV = get_post_custom($tixNum[0]);

				ob_start();

				$ticketItem = new evotx_TicketItem($tixNum[0]);

				$tixPOST = get_post($tixNum[0]);
				$orderStatus = get_post_status($tixPMV['_orderid'][0]);
					$orderStatus = str_replace('wc-', '', $orderStatus);

				$ticketStatus = $ticketItem->get_ticket_status($tickernumber);

				echo "<p><em>Primary Ticket Holder:</em> {$tixPMV['name'][0]}</p>
					<p><em>Email Address:</em> {$tixPMV['email'][0]}</p>
					<p><em>Event:</em> ".get_the_title($tixPMV['_eventid'][0])."</p>
					<p><em>Purchase Date:</em> ".$tixPOST->post_date."</p>
					<p><em>Ticket Status:</em> <span class='tix_status {$ticketStatus}' data-tiid='{$tixNum[0]}' data-tid='{$tickernumber}' data-status='{$ticketStatus}'>{$ticketStatus}</span></p>
					<p><em>WC Order Status:</em> {$orderStatus}</p>";

					// other tickets in the same order
					$otherTickets = $ticketItem->get_other_tix_order($tickernumber);

					if(is_array($otherTickets) && count($otherTickets)>0){
						echo "<p style='padding-top:10px;'>Other Tickets in the same Order</p>";
						foreach($otherTickets as $num=>$status){
							echo "<p><em>Ticekt Number:</em> ".$num."</p>";
							echo "<p style='padding-bottom:10px;'><em>Ticekt Status:</em> <span class='tix_status {$status}' data-tiid='{$tixNum[0]}' data-tid='{$num}' data-status='{$status}'>{$status}</span></p>";
						}
					}

				$AJAXstatus = 'good';
			}

			$data = ob_get_clean();
			$return_content = array(
				'content'=>$data,
				'status'=>$AJAXstatus,
			);
			
			echo json_encode($return_content);		
			exit;

		}

	// make sure proper amount of tickets are created for all past shop_orders
		function evoTX_ajax_08(){
			$shop_orders = new WP_Query(array(
				'post_type'=>'shop_order',
				'posts_per_page'=>-1,				
			));

			if($shop_orders->have_posts()):
				while($shop_orders->have_posts()): $shop_orders->the_post();
					if($shop_orders->post->post_status!='wc-completed') continue;

					$orderPMV = get_post_custom($shop_orders->post->ID);

					if(!empty($orderPMV['_tixids'])){
						$ticketnumbers = unserialize($orderPMV['_tixids'][0]);
						if(is_array($ticketnumbers)){

						}else{
							$ticketnumbers;
						}
					}else{
						// create tickets
					}
				endwhile;
			endif;
			wp_reset_postdata();
		}


}
new evo_tix_ajax();


?>