<?php
/**
 * Ticket Confirmation email Template
 * @version 1.2.4
 *
 * To customize: copy this file to your theme folder as below path
 * path: your-theme-dir/eventon/templates/email/tickets/
 */

	global $eventon, $evotx;

	// $args are passed to this page
	// These are required on this template page to get correct ticket values		
		$email = $args[1];
		$args = $args[0];
		
		$eotx = $evotx->evotx_opt;
		$evo_options = get_option('evcal_options_evcal_1');
		$evo_options_2 = $eo2 = get_option('evcal_options_evcal_2');

	// inline styles
		$__styles_button = "font-size:14px; background-color:#".( !empty($evo_options['evcal_gen_btn_bgc'])? $evo_options['evcal_gen_btn_bgc']: "237ebd")."; color:#".( !empty($evo_options['evcal_gen_btn_fc'])? $evo_options['evcal_gen_btn_fc']: "ffffff")."; padding: 5px 10px; text-decoration:none; border-radius:4px; display:inline-block;";
	// styles
		$styles = array(
			'000'=>'color:#474747; background-color:#fafafa; border:8px solid #cccccc; border-right:none; border-left:none;text-transform:uppercase; ',
			'001'=>"color:#1a77bf; font-size:18px; font-style:italic; font-family: 'open sans',arial; padding:0px; margin:0px; font-weight:bold;",
			'002'=>"font-size:36px; font-family: 'open sans',arial; padding:0px; margin:0px; font-weight:bold; line-height:100%;",
			'003'=>"color:#1a77bf; font-size:16px; font-style:italic; font-family: 'open sans',arial; padding:0px; margin:0px; font-weight:bold; line-height:100%;",
			'004'=>"color:#9e9e9e; font-size:12px; font-style:italic; font-family: 'open sans',arial; padding:0px; margin:0px; font-weight:normal; line-height:100%;",
			'005'=>"font-size:14px; font-style:italic; font-family: 'open sans',arial; padding:0px; margin:0px; font-weight:bold; line-height:100%; text-transform:none;",
			'006'=>"font-size:14px; font-style:italic; font-family: 'open sans',arial; padding:0px; margin:0px; font-weight:bold; line-height:100%;",
			'007'=>"color:#1a77bf; font-size:18px; font-family: 'open sans',arial; padding:0px; margin:0px; font-weight:bold; line-height:100%;",
			'008'=>"color:#a5a5a5; font-size:10px; font-family: 'open sans',arial; padding:0px; margin:0px; font-weight:normal; text-transform:none;",

			'100'=>"padding:15px 20px;",
			'101'=>"text-align:right;",
			'102'=>"margin:0px; padding:0px;",
			'103'=>"padding:10px 20px;",
			'104'=>"background-color:#fafafa;border:8px solid #cccccc; border-right:none;",
			'105'=>"background-color:#fafafa;border:8px solid #cccccc; border-left:none;",

			'p0'=>'padding:0px;',
			'pb5'=>'padding-bottom:5px;',
			'pb10'=>'padding-bottom:10px;',
			'pt10'=>'padding-top:10px;',
			'm0'=>'margin:0px;',
			'lh100'=>'line-height:100%;',
		);
?>
<table width='100%' style='width:100%; margin:0' cellspacing='0' cellpadding='0'>
<?php 
$count = 1;
	
if(empty($args['tickets'])) return;

// order items as ticket items - run through each
foreach($args['tickets'] as $ticket_item):

	// initiate ticket order item class
		$torderItem = new evotx_ticket_orderitem($ticket_item, $args['orderid']);

		$event_id = $torderItem->event_id();
		$e_pmv = get_post_custom($event_id);

	// verify only ticket items are in this email
		if(empty($event_id)) continue;
	
	// ticket item ID		
		$ticket_item_id = $torderItem->the_ticket_item_id;
		$ticket_pmv = get_post_custom($ticket_item_id);

	// location data
		$location = (!empty($e_pmv['evcal_location_name'])? $e_pmv['evcal_location_name'][0].' ': null).(!empty($e_pmv['evcal_location'])? $e_pmv['evcal_location'][0]:null);

	// organizer
		$organizer = (!empty($e_pmv['evcal_organizer'])? $e_pmv['evcal_organizer'][0]: false);

	// event time
		$repeat_interval = !empty($ticket_pmv['repeat_interval'])? $ticket_pmv['repeat_interval'][0]:0;
		$eventTime = $evotx->functions->get_event_time($e_pmv, $repeat_interval);
?>
	<tr><td colspan='3'>
		<p style="<?php echo $styles['102'].$styles['pb10'];?>"><a style='<?php echo $__styles_button;?>' href='<?php echo admin_url();?>admin-ajax.php?action=eventon_ics_download&event_id=<?php echo $event_id;?>&sunix=<?php echo $e_pmv['evcal_srow'][0];?>&eunix=<?php echo $e_pmv['evcal_erow'][0];?>' target='_blank'><?php echo evo_lang_get( 'evcal_evcard_addics', 'Add to calendar','',$eo2);?></a></p>
	</td></tr>
<?php

	// all event tickets in the order
	$ticketids = $torderItem->ticket_ids();
	$evoTickets = is_array($ticketids)? $ticketids: array($ticketids=>'');

	// Ticket holder name and email
	$ticketHolderName = (!empty($ticket_pmv['name'])? $ticket_pmv['name'][0]:'').' '.
		(!empty($ticket_pmv['email'])? $ticket_pmv['email'][0]:'');
	
	foreach($evoTickets as $ticketnumber=>$v):
		$tixNum = str_replace('-', '.', $ticketnumber);
?>
 <tr>
 	<td valign='middle' width='14px' style="<?php echo $styles['104'];?>"><img src='<?php echo $evotx->plugin_url;?>/assets/tix_l.png'/></td>

 	<td>
	<table style="<?php echo $styles['000'];?> width:100%;" >
	<tr>
	<td style="<?php echo $styles['100'];?>">
		<p style="<?php echo $styles['001'];?>"><?php echo evo_lang_get( 'evotxem_001', 'Your Ticket for','',$eo2);?></p>
		<p style="<?php echo $styles['002'].$styles['pb10'];?>"><?php echo $ticket_item['name'];?></p>

		<div style=''>
			<p style="<?php echo $styles['003'].$styles['pb5'];?>"><?php echo $eventTime;?></p>
			<p style="<?php echo $styles['004'].$styles['pb5'];?>"><?php echo evo_lang_get( 'evotxem_002', 'Date','',$eo2);?></p>
		</div>

		<?php if(!empty($ticketHolderName)):?>
		<div style=''>
			<p style="<?php echo $styles['005'].$styles['pb5'];?>"><?php echo $ticketHolderName;?></p>
			<p style="<?php echo $styles['004'].$styles['pb5'];?>"><?php echo evo_lang_get( 'evoTX_004', 'Primary Ticket Holder','',$eo2);?></p>
		</div>
		<?php endif;?>

		<?php if(!empty($location)):?>
		<div style=''>
			<p style="<?php echo $styles['005'].$styles['pb5'].$styles['pt10'];?>"><?php echo $location;?></p>
			<p style="<?php echo $styles['004'].$styles['pb5'];?>"><?php echo evo_lang_get( 'evcal_lang_location', 'Location','',$eo2);?></p>
		</div><?php endif;?>

		<?php if($organizer):?>
		<div style=''>
			<p style="<?php echo $styles['005'].$styles['pb5'].$styles['pt10'];?>"><?php echo $organizer;?></p>
			<p style="<?php echo $styles['004'].$styles['pb5'];?>"><?php echo evo_lang_get( 'evcal_evcard_org', 'Organizer','',$eo2);?></p>
		</div><?php endif;?>

		<?php 
		// ticket product variations for the ticket order item
		if(!empty($ticket_item['variation_id'])):
		$_product = new WC_Product_Variation($ticket_item['variation_id'] );
		$hh= $_product->get_variation_attributes( );

			foreach($hh as $f=>$v):
				if(empty($v)) continue;
		?>
			<p style='<?php echo $__styles_03;?>'><span style='<?php echo $__styles_02a;?>'><?php echo evo_lang_get( 'evoTX_006', 'Type', '', $eo2);?>:</span> <?php echo $v;?></p>
		<?php endforeach; endif;?>
	</td><td style="<?php echo $styles['100'].$styles['101'];?>">		
		<p style="<?php echo $styles['007'];?>"><?php echo apply_filters('evotx_email_tixid_list', $ticketnumber);?></p>
		<p style="<?php echo $styles['004'].$styles['pb5'];?>"><?php echo evo_lang_get( 'evotxem_003', 'Ticket Number','',$eo2);?></p>
		<p style="<?php echo $styles['004'];?>"><?php echo evo_lang_get( 'evoTX_005b', 'Qty.','',$eo2);?> 1</p>
	</td>
	</tr>

	<?php
	// terms and conditions
	if(!empty($eotx['evotx_termsc'])):
	?>	
		<tr><td colspan='2' style="<?php echo $styles['103'];?>">
			<p style="<?php echo $styles['008'];?>"><?php echo $eotx['evotx_termsc'];?></p>
		</td></tr>
	<?php endif;?>
	</table>
	</td>

	<td valign='middle' width='14px' style="<?php echo $styles['105'];?>"><img src='<?php echo $evotx->plugin_url;?>/assets/tix_r.png'/></td>
 </tr>

 <tr><td colspan='3' style='padding-top:3px;'></td></tr>
<?php	endforeach; // each Event tickets in the order ?>
<?php 	endforeach;?>
<?php if($email):?>
	<tr>
		<td colspan='3' style='padding:20px; text-align:left;border-top:1px dashed #d1d1d1; font-style:italic; color:#ADADAD'>
			<?php
				$__link = (!empty($eotx['evotx_conlink']))? $eotx['evotx_conlink']:site_url();
			?>
			<p style='<?php echo $styles['lh100'].$styles['m0'];?>'><?php echo evo_lang_get( 'evoTX_007', 'We look forward to seeing you!','', $eo2)?></p>
			<p style='<?php echo $styles['lh100'].$styles['m0'];?>'><a style='' href='<?php echo $__link;?>'><?php echo evo_lang_get('evoTX_008', 'Contact Us for questions and concerns','', $eo2)?></a></p>
		</td>
	</tr>
<?php endif;?>
</table>