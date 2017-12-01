<?php

class EbpPayPal {
  public static function getPayPalForm($id, $desc, $cost, $quantity, $taxRate, $returnPage, $currentPage, $extraOption=null) {
    global $wpdb;
    $cost = number_format($cost, 2, ".", "");
    $settings = EbpSettings::getSettingsById(1, "return_same_page, cpp_payflow_color, cpp_logo_image, cpp_headerborder_color, cpp_headerback_color, cpp_header_image, sandbox, currency, paypalAccount, dateFormat, timeFormat, email_utf8, tax_rate", "");

    $paypalAccount = trim($settings->paypalAccount);

    $event = EbpBooking::getEventOfPayment($id, 'id, currency');

    $curr = EbpCurrency::getCurrencyCodeForEvent($event, $settings->currency);

    $sandbox = $settings->sandbox;
    $cpp_header_image = $settings->cpp_header_image;
    $cpp_headerback_color = $settings->cpp_headerback_color;
    $cpp_headerborder_color = $settings->cpp_headerborder_color;
    $cpp_logo_image = $settings->cpp_logo_image;
    $cpp_payflow_color = $settings->cpp_payflow_color;
    $return_page_url = ($settings->return_same_page == "false") ? $returnPage : $currentPage;
    $utf8 = $settings->email_utf8;

    // get paypal url
    $uri = ($sandbox == "true") ? 'https://www.sandbox.paypal.com/cgi-bin/webscr' : 'https://www.paypal.com/cgi-bin/webscr';

    $custom = $id;
    if ($extraOption != null) {
      foreach ($extraOption as $key =>$value) {
        $custom .= '&'.$key.'='.$value;
      }
    }

    // generate form html
    $form = '<form id="paypalForm" action="'.$uri.'" method="post" style="display:none;">';
    $form .= '<input type="hidden" name="business" value="'.$paypalAccount.'">';
    $form .= '<input type="hidden" name="cmd" value="_xclick">';
    $form .= '<input type="hidden" name="custom"  id="custom" value="'.$custom.'">';
    $form .= '<input type="hidden" name="notify_url" value="'.site_url().'/paypal/paypalScript.php">';
    $form .= '<input type="hidden" name="cpp_header_image" value="'.$cpp_header_image.'"> ';
    $form .= '<input type="hidden" name="cpp_headerback_color" value="'.$cpp_headerback_color.'"> ';
    $form .= '<input type="hidden" name="cpp_headerborder_color" value="'.$cpp_headerborder_color.'"> ';
    $form .= '<input type="hidden" name="image_url" value="'.$cpp_logo_image.'"> ';
    $form .= '<input type="hidden" name="cpp_payflow_color" value="'.$cpp_payflow_color.'"> ';
    $form .= '<input type="hidden" name="quantity" value="'.$quantity.'">';
    $form .= '<input type="hidden" name="item_name" value="'.$desc.'">';
    $form .= '<input type="hidden" name="amount" value="'.$cost.'"> ';
    $form .= '<input type="hidden" name="currency_code" value="'.$curr.'">';
    $form .= '<input type="hidden" name="return" value="'.$return_page_url.'">';



    if ($taxRate > 0) {
      $form .= ' <input type="hidden" name="tax_rate" value="'.$taxRate.' ">';
    }

    if ($utf8 == "true") {
      $form .= ' <input type="hidden" name="charset" value="utf-8">';
    }

    $form .= '</form>';

    return $form;
  }

}
