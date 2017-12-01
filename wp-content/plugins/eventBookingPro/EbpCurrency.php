<?php

class EbpCurrency {
  public static function getCurrencies() {
    return array(
      'EUR' => array('name' => "Euro", 'symbol' => "€", 'ASCII' => "&#128;"),
      'USD' => array('name' => "U.S. Dollar", 'symbol' => "$", 'ASCII' => "&#36;"),
      'GBP' => array('name' => "Pound Sterling", 'symbol' => "£", 'ASCII' => "&#163;"),
      'CHF' => array('name' => "Swiss Franc", 'symbol' => "CHF", 'ASCII' => ""),
      'LBP' => array('name' => "Lebanese Pounds", 'symbol' => "L.L.", 'ASCII' => ""),
      'RUB' => array('name' => "Russian ruble", 'symbol' => "руб", 'ASCII' => ""),
      'AUD' => array('name' => "Australian Dollar", 'symbol' => "A$", 'ASCII' => "A&#36;"),
      'CAD' => array('name' => "Canadian Dollar", 'symbol' => "$", 'ASCII' => "&#36;"),
      'CZK' => array('name' => "Czech Koruna", 'symbol' => "Kč", 'ASCII' => ""),
      'DKK' => array('name' => "Danish Krone", 'symbol' => "Kr", 'ASCII' => ""),
      'HKD' => array('name' => "Hong Kong Dollar", 'symbol' => "$", 'ASCII' => "&#36;"),
      'HUF' => array('name' => "Hungarian Forint", 'symbol' => "Ft", 'ASCII' => ""),
      'ILS' => array('name' => "Israeli New Sheqel", 'symbol' => "₪", 'ASCII' => "&#8361;"),
      'JPY' => array('name' => "Japanese Yen", 'symbol' => "¥", 'ASCII' => "&#165;"),
      'MXN' => array('name' => "Mexican Peso", 'symbol' => "$", 'ASCII' => "&#36;"),
      'NOK' => array('name' => "Norwegian Krone", 'symbol' => "Kr", 'ASCII' => ""),
      'NZD' => array('name' => "New Zealand Dollar", 'symbol' => "$", 'ASCII' => "&#36;"),
      'PHP' => array('name' => "Philippine Peso", 'symbol' => "₱", 'ASCII' => ""),
      'PLN' => array('name' => "Polish Zloty", 'symbol' => "zł", 'ASCII' => ""),
      'SGD' => array('name' => "Singapore Dollar", 'symbol' => "$", 'ASCII' => "&#36;"),
      'SEK' => array('name' => "Swedish Krona", 'symbol' => "kr", 'ASCII' => ""),
      'TWD' => array('name' => "Taiwan New Dollar", 'symbol' => "NT$", 'ASCII' => "NT&#36;"),
      'THB' => array('name' => "Thai Baht", 'symbol' => "฿", 'ASCII' => "&#3647;"),
      'TLR' => array('name' => "Turkish Lira (TLR)", 'symbol' => "₺", 'ASCII' => "&#8378;"),
      'TRY' => array('name' => "Turkish Lira (TRY)", 'symbol' => "₺", 'ASCII' => "&#8378;"),
      'MYR' => array('name' => "Malaysia Ringgit", 'symbol' => "RM", 'ASCII' => ""),
      'BRL' => array('name' => "Brazilian Rea", 'symbol' => "BRL", 'ASCII' => ""),
      'LEM' => array('name' => "Lempira", 'symbol' => "L.", 'ASCII' => ""),
      'IND' => array('name' => "Indonesian (Rp)", 'symbol' => "Rp", 'ASCII' => ""),
      'LTL' => array('name' => "Lithuanian Litas", 'symbol' => "Ltl", 'ASCII' => ""),
      'INR' => array('name' => "Indian Rupee", 'symbol' => "₹", 'ASCII' => ""),
      'ZAR' => array('name' => "South African", 'symbol' => "R", 'ASCII' => ""),
      'VEF' => array('name' => "Venezuelan Bolívar", 'symbol' => "Bs.", 'ASCII' => ""),
      'KRW' => array('name' => "Korea Won", 'symbol' => "&#65510;", 'ASCII' => "&#65510;"),
      'VND' => array('name' => "Vietnam", 'symbol' => "đ", 'ASCII' => ""),
      'GHC' => array('name' => "Ghana Cedis", 'symbol' => "GH¢", 'ASCII' => ""),
      'RWF' => array('name' => "Rwandan Franc", 'symbol' => "RWF", 'ASCII' => ""),
      'CRC' => array('name' => "Costa Rican Colon", 'symbol' => "₡", 'ASCII' => ""),
      'XOF' => array('name' => "CFA franc", 'symbol' => "F", 'ASCII' => ""),
      'COP' => array('name' => "Colombian Peso", "symbol" => "COP", 'ASCII' => "")
      );
  }

  public static function getSymbol($code = 'USD') {
    return (string) self::getCurrencies()[$code]['symbol'];
  }

  public static function getAsOptions() {
    $curr = array();

    foreach (self::getCurrencies() as $key => $value) {
      array_push($curr, (object) ['name' => $value['name'], 'value' => $key]);
    }

    return $curr;
  }

  public static function getCurrencyCodeForEvent($event, $default) {
    return ($event->currency != '') ? $event->currency : $default;
  }

  public static function getCurrencyForEvent($event, $default) {
    if ($event->currency != '') {
      // should also check if currency is valid
      return EbpCurrency::getSymbol($event->currency);
    }

    return EbpCurrency::getSymbol($default);
  }

}
