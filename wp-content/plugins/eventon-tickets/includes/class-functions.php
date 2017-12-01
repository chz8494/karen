<?php
/**
 * TIcket frontend supporting functions
 * @version 1.2.5
 */
class evotx_functions{
	private $evohelper;
	function __construct(){
		$this->EH = new evo_helper();
	}

	// ORDER Related
		// get order status from order ID
			function get_order_status($orderid){
				$order = new WC_Order( $orderid );
				return $order->status;
			}
			function is_order_complete($orderid){
				return ($this->get_order_status($orderid)=='completed')? true: false;
			}
	// CHECKING TICKET STATUS related
		// get proper ticket status name I18N
			function get_checkin_status($status, $lang=''){
				global $evotx;
				$evopt = $evotx->opt2;
				$lang = (!empty($lang))? $lang : 'L1';

				if($status=='check-in'){
					return (!empty($evopt[$lang]['evoTX_003x']))? $evopt[$lang]['evoTX_003x']: 'check-in';
				}else{
					return (!empty($evopt[$lang]['evoTX_003y']))? $evopt[$lang]['evoTX_003y']: 'checked';
				}
			}
			function get_statuses_lang($lang=''){
				global $evotx;
				$evopt = $evotx->opt2;
				$lang = (!empty($lang))? $lang : 'L1';

				return array(
					'check-in'=> ((!empty($evopt[$lang]['evoTX_003x']))? $evopt[$lang]['evoTX_003x']: 'check-in'),
					'checked'=> ((!empty($evopt[$lang]['evoTX_003y']))? $evopt[$lang]['evoTX_003y']: 'checked'),
				);
			}

		// check if an order have event tickets
			public function does_order_have_tickets($order_id){
				$meta = get_post_meta($order_id, '_tixids', true);
				return (!empty($meta))? true: false;
			}		

	// TICKET related
		// create tickets for an order
			function create_tickets($order_id){
				$order = new WC_Order( $order_id );	
			    $items = $order->get_items();

			    $evtix_update = false;
			    
			    // for each order item
			    foreach ($items as $item) {	

			    	$tixids = array();
			    	$eid = get_post_meta( $item['product_id'], '_eventid', true);  	

			    	// Make sure these are indeed ticket sales
			    	//$terms = wp_get_post_terms($item['product_id'], 'product_cat', array('fields'=>'names'));  			    	

			    	// Check if these order items are event ticket items
			    	if(!empty($eid) ){

			    		// get order post meta array
					    $order_meta = get_post_custom($order_id, true);	    	    
					    $user_id_ = $order_meta['_customer_user'][0];			    

			    		// Specify order type only for ticket sale
				    	if(!$evtix_update) 
				    		update_post_meta($order_id, '_order_type','evotix');	
				    		$evtix_update = true;    		

			    		// get repeat interval for order item
					    	$item_meta = (!empty($item['Event-Time'])? $item['Event-Time']: false);
					    	$ri = 0;
					    	if($item_meta){
					    		if(strpos($item_meta, '[RI')!== false){
					    			$ri__ = explode('[RI', $item_meta);
							    	$ri_ = explode(']', $ri__[1]);
							    	$ri = $ri_[0];
					    		}
					    	}
					    // Get customer information
					    	if($user_id_ == 0){	// checkout without creating account
					    		$_user = array(
			    					'name'=>$order_meta['_billing_first_name'][0].' '.$order_meta['_billing_last_name'][0],
			    					'email'=>$order_meta['_billing_email'][0]
			    				);
					    	}else{
					    		// get the logged in user information
					    		$usermeta = get_user_meta( $user_id_ );
					    		$fname = !empty($usermeta['first_name'][0])? $usermeta['first_name'][0]: $order_meta['_billing_first_name'][0];
					    		$lname = !empty($usermeta['last_name'][0])? $usermeta['last_name'][0]: $order_meta['_billing_last_name'][0];
			    				
			    				$_user = array(
			    					'name'=>$fname.' '.$lname,
			    					'email'=>$usermeta['billing_email'][0]
			    				);
					    	}
			    		
			        	// create new event ticket post
			        	if($created_tix_id = $this->EH->create_posts(array(
							'post_type'=>'evo-tix',
							'post_status'=>'publish',
							'post_title'=>'TICKET '.date('M d Y @ h:i:sa', time()),
							'post_content'=>''
						))){

							$ticket_ids = $ticket_ids_ = array();
							
							// variation product
								if(!empty($item['variation_id'])){
									$_product = new WC_Product_Variation($item['variation_id'] );
				        			$hh= $_product->get_variation_attributes( );

				        			foreach($hh as $f=>$v){
				        				$type = $v;
				        			}
				        		}else{ $type = 'Normal'; }

				        	// ticket ID(s)
					        	$tid = $created_tix_id.'-'.$order_id.'-'.( !empty($item['variation_id'])? $item['variation_id']: $item['product_id']);
								if($item['qty']>1){
									$_tid='';
									$str = 'A';
									for($x=0; $x<$item['qty']; $x++){ // each ticket in item
										$strng = ($x==0)? $str: ++$str;
										$ticket_ids[$tid.$strng] = 'check-in';
										$ticket_ids_[] = $tid.$strng;
									}
								}else{ // just one ticket
									$ticket_ids[$tid] = 'check-in';
									$ticket_ids_[] = $tid;
								}
		        	
							// save ticket data	
								$this->EH->create_custom_meta($created_tix_id, 'name', $_user['name']);
								$this->EH->create_custom_meta($created_tix_id, 'email', $_user['email']);
								$this->EH->create_custom_meta($created_tix_id, 'qty', $item['qty']);				
								$this->EH->create_custom_meta($created_tix_id, 'cost', $order->get_line_subtotal($item) );	
								$this->EH->create_custom_meta($created_tix_id, 'type', $type);
								$this->EH->create_custom_meta($created_tix_id, 'ticket_ids', $ticket_ids);
								$this->EH->create_custom_meta($created_tix_id, 'wcid', $item['product_id']);
								$this->EH->create_custom_meta($created_tix_id, 'tix_status', 'none');
								$this->EH->create_custom_meta($created_tix_id, 'status', 'check-in');
								$this->EH->create_custom_meta($created_tix_id, '_eventid', $eid);
								$this->EH->create_custom_meta($created_tix_id, '_orderid', $order_id);
								$this->EH->create_custom_meta($created_tix_id, '_customerid', $user_id_);
								$this->EH->create_custom_meta($created_tix_id, 'repeat_interval', $ri);

								// save event ticket id to order id
									$tixids = get_post_meta($order_id, '_tixids', true);

									if(is_array($tixids)){ // if previously saved tixid array
										$tixids_ = array_merge($tixids, $ticket_ids_);
									}else{ // empty of saved as string
										$tixids_ = $ticket_ids_;
									}
									// save ticket ids as array
									update_post_meta($order_id, '_tixids', $tixids_);
								
								// update product capacity if repeat interval capacity is set 
								// seperately per individual repeat interval
									$emeta = get_post_meta($eid);

									if(	evo_check_yn($emeta,'_manage_repeat_cap') &&
										evo_check_yn($emeta,'evcal_repeat') &&
										!empty($emeta['repeat_intervals']) && 
										!empty($emeta['ri_capacity'])
									){
										
										// repeat capacity values for this event
										$ri_capacity = unserialize($emeta['ri_capacity'][0]);

										// repeat capacity for this repeat  interval
										$capacity_for_this_event = $ri_capacity[$ri];
										$new_capacity = $capacity_for_this_event-$item['qty'];

										$ri_capacity[$ri] = ($new_capacity>=0)? $new_capacity:0;

										// save the adjusted repeat capacity
										update_post_meta($eid, 'ri_capacity',$ri_capacity);
									}
						}
					}
				}// END FOREEACH
			}

		// alter initial WC order if they are event ticket orders
			function alt_initial_event_order($order_id){
				$order = new WC_Order( $order_id );	
			    $items = $order->get_items();

			    $evtix_update = false;
			    foreach ($items as $item) {	
			    	$eid = get_post_meta( $item['product_id'], '_eventid', true);  	
			    	if(empty($eid)) continue;

			    	if(!$evtix_update){
			    		update_post_meta($order_id, '_order_type','evotix');
			    		$evtix_update = true;	
			    	}
			    	  
			    }
			}
		
		// get ticket item id from ticket id
			function get_tiid($ticket_id){
				$tix = explode('-', $ticket_id);
				return $tix[0];
			}
		
		// corrected ticket IDs
			function correct_tix_ids($t_pmv, $ticket_item_id){
				$tix = explode(',', $t_pmv['tid'][0]);
				foreach($tix as $tt){
					$ticket_ids[$tt] = 'check-in';
				}				
				update_post_meta($ticket_item_id, 'ticket_ids',$ticket_ids);
			}
		// add ticket quantity back to stock
			function restock_tickets($order_id){
				global $evotx;
				// if set to auto restock
				if(!empty($evotx->evotx_opt['evotx_restock']) && $evotx->evotx_opt['evotx_restock']=='yes'){
					$order = new WC_Order( $order_id );	
			    	$items = $order->get_items();
			    	$index = 1;

			    	// each order item in the order
			    	foreach ($items as $item) {
			    		$eid = get_post_meta( $item['product_id'], '_eventid', true);  

			    		if(empty($eid)) continue; // skip non ticket items

			    		$current_stock = get_post_meta($item['product_id'], '_stock', true);
			    		$new_capacity = $current_stock + $item['qty'];

			    		update_post_meta($item['product_id'], '_stock',$new_capacity);
			    	}

			    	// mark woocommerce product back in stock
			    	update_post_meta($item['product_id'], '_stock_status','instock');
				}
			}

	// return customer tickets array by event id and product id
		function get_customer_ticket_list($event_id, $wcid, $ri=''){
			
			$customer_ = array();

			$e_pmv = get_post_custom($event_id);
			$w_pmv = get_post_custom($wcid);
			$ri_count_active = $this->is_ri_count_active($e_pmv, $w_pmv);

			// get all ticket items matching product id and event id
			$ticketItems = new WP_Query(array(
				'posts_per_page'=>-1,
				'post_type'=>'evo-tix',
				'meta_query' => array(
					'relation' => 'AND',
					array('key' => 'wcid','value' => $wcid,'compare' => '=',	),
					array('key' => '_eventid','value' => $event_id,'compare' => '=',	),
				)
			));
			if($ticketItems->have_posts()):
				while($ticketItems->have_posts()): $ticketItems->the_post();
					$tiid = $ticketItems->post->ID;
					$tii_meta = get_post_custom($tiid);

					$order_id = !empty($tii_meta['_orderid'])? $tii_meta['_orderid']: false;
					$orderOK = false; $order_status = $billing_address = $phone = 'n/a';				

					if(
						(
							$ri_count_active && 
							((!empty($tii_meta['repeat_interval']) && $tii_meta['repeat_interval'][0]==$ri)
								|| ( empty($tii_meta['repeat_interval']) && $ri==0)
							)
						)
						|| !$ri_count_active 
						|| $ri=='all'
					){
						if($order_id){
							$order = new WC_Order( $order_id[0] );
							$order_status = $order->status;
							$orderOK = ($order_status=='completed')? true:false;
							$billing_address = '"'.$order->billing_address_1.' '.
								$order->billing_address_2.' '.
								$order->billing_city.' '.
								$order->billing_state.' '.
								$order->billing_postcode.' '.
								$order->billing_country.'"';
							$phone = $order->billing_phone;
						}

						// event time for the ticket
						$event_time = $this->get_event_time($e_pmv, (!empty($tii_meta['repeat_interval'])? $tii_meta['repeat_interval'][0]:0));
						$event_time = $event_time;

						$ticket_item = new evotx_TicketItem($tiid, $tii_meta);
						$ticketids = $ticket_item->ticket_ids();

						$customer_[$event_time][$tiid] = array(
							'name'=>$tii_meta['name'][0],
							'tiid'=>$tiid,
							'tids'=>$ticketids,
							'email'=>$tii_meta['email'][0],						
							'type'=>$tii_meta['type'][0],					
							'qty'=>$tii_meta['qty'][0],	
							'order_status' =>	$order_status,
							'address'=>$billing_address	,
							'phone'=>$phone,
							'postdata'=>get_the_date('Y-m-d')
						);
					}
				endwhile;
			endif;

			return (count($customer_)>0)? $customer_: false;
		}

	// EVENT TIMES
		function get_event_time($event_pmv='', $repeat_interval=0, $event_id=''){
			$event_pmv = (!empty($event_pmv))? $event_pmv : 
				(!empty($event_id)? get_post_custom($event_id): false );

			$datetime = new evo_datetime();

			// get unix start and end for correct interval
			$unixtime = $datetime->get_correct_event_repeat_time($event_pmv, $repeat_interval);

			return $datetime->get_formatted_smart_time($unixtime['start'], $unixtime['end'],$event_pmv);

			//return $datetime->get_correct_formatted_event_repeat_time($event_pmv,$repeat_interval );
			// return array(start, end)
		}
		function get_unix_times($epmv, $ri=0){
			$datetime = new evo_datetime();
			return $datetime->get_correct_event_repeat_time($epmv,$ri );
		}
		function _event_date($pmv, $start_unix, $end_unix){
			global $eventon;
			$evcal_lang_allday = eventon_get_custom_language( '','evcal_lang_allday', 'All Day');
			$date_array = $eventon->evo_generator->generate_time_('','', $pmv, $evcal_lang_allday,'','',$start_unix,$end_unix);	
			return $date_array;
		}
		// return true if the event is a current event and not a past event
		function is_currentEvent($eventPMV,$ri=0, $cutoff = 'end'){
			date_default_timezone_set('UTC');	
			$current_time = current_time('timestamp');
			$evodate = new evo_datetime();
			$event_time = $evodate->get_int_correct_event_time($eventPMV,$ri,$cutoff);
			return $event_time>$current_time? true: false;
		}

	// CHECK functions
		// check if repeat interval is activate
			function is_ri_count_active($event_pmv, $woometa=''){
				 return (
					!empty($woometa['_manage_stock']) && $woometa['_manage_stock'][0]=='yes'
					&& !empty($event_pmv['_manage_repeat_cap']) && $event_pmv['_manage_repeat_cap'][0]=='yes'
					&& !empty($event_pmv['evcal_repeat']) && $event_pmv['evcal_repeat'][0] == 'yes' 
					&& !empty($event_pmv['ri_capacity']) 
				)? true:false;
			}
		// check if event have ticket left
			function event_has_tickets($eventPMV, $woometa, $repeat_interval=0){
				// if tickets set to out of stock 
				if(!empty($woometa['_stock_status']) && $woometa['_stock_status'][0]=='outofstock') return false;

				
				// if manage capacity separate for Repeats
				$ri_count_active = $this->is_ri_count_active($eventPMV, $woometa);
				if($ri_count_active){
					$ri_capacity = unserialize($eventPMV['ri_capacity'][0]);
						$capacity_of_this_repeat = 
							(isset($ri_capacity[ $repeat_interval ]) )? 
								$ri_capacity[ $repeat_interval ]
								:0;
						return ($capacity_of_this_repeat==0)? false : $capacity_of_this_repeat;
				}else{
					// check if overall capacity for ticket is more than 0
					$manage_stock = (!empty($woometa['_manage_stock']) && $woometa['_manage_stock'][0]=='yes')? true:false;
					$stock_count = (!empty($woometa['_stock']) && $woometa['_stock'][0]>0)? $woometa['_stock'][0]: false;
					
					// return correct
					if($manage_stock && !$stock_count){
						return false;
					}elseif($manage_stock && $stock_count){	return $stock_count;
					}elseif(!$manage_stock){ return true;}
				}
			}
		// check if the event tickets is set to stop selling X minuted before it closes
			function stop_selling_now($eventPMV,$ri=0){

				if(!empty($eventPMV['_xmin_stopsell']) && is_int($eventPMV['_xmin_stopsell'][0])){
					date_default_timezone_set('UTC');	
					$current_time = current_time('timestamp');
					$evodate = new evo_datetime();
					$event_time = $evodate->get_int_correct_event_time($eventPMV,$ri,'start');
					$cutoffTime = $current_time-($eventPMV['_xmin_stopsell'][0]*60);

					return ($cutoffTime>$event_time)? true: false;
				}else{
					return false;
				}
			}

	// SUPPORTIVE
		function get_author_id() {
			$current_user = wp_get_current_user();
	        return (($current_user instanceof WP_User)) ? $current_user->ID : 0;
	    }	
	    function get_event_post_date() {
	        return date('Y-m-d H:i:s', time());        
	    }
}