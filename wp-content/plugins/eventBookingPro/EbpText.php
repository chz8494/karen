<?php
require_once dirname( __FILE__ ) . '/include.php';

class EbpText {
  const DEFAULT_CODE = 'default';
  private static function getDataModel() {
    return [
      (Object) ['name'=>'language', 'type'=>'VARCHAR(10)', 'default'=> EbpText::DEFAULT_CODE],
      (Object) ['name'=>'passedTxt', 'type'=>'VARCHAR(100)', 'default'=> 'Event Passed'],
      (Object) ['name'=>'bookingStartsTxts', 'type'=>'VARCHAR(100)', 'default'=> 'Booking starts on %date% @ %time%'],
      (Object) ['name'=>'bookingEndedTxt', 'type'=>'VARCHAR(100)', 'default'=> 'Booking ended'],
      (Object) ['name'=>'bookedTxt', 'type'=>'VARCHAR(100)', 'default'=> 'No spots left'],
      (Object) ['name'=>'btnTxt', 'type'=>'VARCHAR(100)', 'default'=> 'Book'],
      (Object) ['name'=>'moreDateTxt', 'type'=>'VARCHAR(100)', 'default'=> 'More Dates'],
      (Object) ['name'=>'infoExpandText', 'type'=>'VARCHAR(50)', 'default'=> 'more'],
      (Object) ['name'=>'modalNameTxt', 'type'=>'VARCHAR(100)', 'default'=> 'Full Name'],
      (Object) ['name'=>'modalEmailTxt', 'type'=>'VARCHAR(100)', 'default'=> 'Email Address'],
      (Object) ['name'=>'modalPhoneTxt', 'type'=>'VARCHAR(100)', 'default'=> 'Phone Number'],
      (Object) ['name'=>'modalAddressTxt', 'type'=>'VARCHAR(100)', 'default'=> 'Your Address'],
      (Object) ['name'=>'modalBookText', 'type'=>'VARCHAR(100)', 'default'=> 'Pay Later'],
      (Object) ['name'=>'paypalBtnTxt', 'type'=>'VARCHAR(100)', 'default'=> 'Pay Now'],
      (Object) ['name'=>'endsOnTxt', 'type'=>'VARCHAR(255)', 'default'=> 'Ends On:'],
      (Object) ['name'=>'statsOnTxt', 'type'=>'VARCHAR(255)', 'default'=> 'Starts On:'],
      (Object) ['name'=>'modalSpotsLeftTxt', 'type'=>'VARCHAR(255)', 'default'=> 'Spots left:'],
      (Object) ['name'=>'modalQuantityTxt', 'type'=>'VARCHAR(255)', 'default'=> 'Quantity'],
      (Object) ['name'=>'modalSingleCostTxt', 'type'=>'VARCHAR(255)', 'default'=> 'Single Cost'],
      (Object) ['name'=>'modalTotalCostTxt', 'type'=>'VARCHAR(255)', 'default'=> 'Total Cost'],
      (Object) ['name'=>'eventBookedTxt', 'type'=>'VARCHAR(255)', 'default'=> 'Event Booked!'],
      (Object) ['name'=>'bookingTxt', 'type'=>'VARCHAR(255)', 'default'=> 'Booking Event ...'],
      (Object) ['name'=>'ExpandTextTxt', 'type'=>'VARCHAR(255)', 'default'=> 'Expand'],
      (Object) ['name'=>'closeTextTxt', 'type'=>'VARCHAR(255)', 'default'=> 'Close'],
      (Object) ['name' => 'spotsLeftTxt', 'type' => 'VARCHAR(255)', 'default' => 'left'],
      (Object) ['name' => 'freeTxt', 'type' => 'VARCHAR(100)', 'default' => 'Free'],
      (Object) ['name' => 'applyTxt', 'type' => 'VARCHAR(100)', 'default' => 'Apply'],
      (Object) ['name' => 'couponTxt', 'type' => 'VARCHAR(100)', 'default' => 'Coupon'],
      (Object) ['name'=>'termsLink', 'type'=>'VARCHAR(255)', 'default'=> 'terms'],
      (Object) ['name'=>'addToCalendarText ', 'type'=>'VARCHAR(50)', 'default'=> '+GoogleCal'],
      (Object) ['name'=>'doAfterSuccessTitle', 'type'=>'VARCHAR(255)', 'default'=> 'Success!'],
      (Object) ['name'=>'doAfterSuccessMessage', 'type'=>'VARCHAR(255)', 'default'=> 'Thank you for reserving a spot. Looking forward to seeing you!'],
      (Object) ['name'=>'eventDescriptionTitle', 'type'=>'VARCHAR(255)', 'default'=> 'Event Information'],
      (Object) ['name'=>'bookingLimitText', 'type'=>'VARCHAR(255)', 'default'=> 'You have %left% tickets left!'],
      (Object) ['name'=>'bookingLimitTimeText', 'type'=>'VARCHAR(255)', 'default'=> 'You can only book %left% time!'],
      (Object) ['name'=>'NoEventsInList', 'type'=>'VARCHAR(255)', 'default'=> 'No current events.'],
      (Object) ['name'=>'passedOccurencesText', 'type'=>'VARCHAR(255)', 'default'=> 'Passed Dates:'],
      (Object) ['name'=>'upcomingOccurencesText', 'type'=>'VARCHAR(255)', 'default'=> 'Upcoming Dates:'],
      (Object) ['name'=>'eventsListFilterLable', 'type'=>'VARCHAR(100)', 'default'=> 'Show All'],
      (Object) ['name'=>'duplicateOnQuantityText', 'type'=>'VARCHAR(255)', 'default'=> 'Person %x% information %name_group%- (%name%)%name_group%'],
      (Object) ['name'=>'coupon_expired_msg', 'type'=>'VARCHAR(255)', 'default'=> 'Coupon has expired.'],
      (Object) ['name'=>'coupon_not_found_msg', 'type'=>'VARCHAR(255)', 'default'=> 'Coupon not found.'],
      (Object) ['name'=>'coupon_msg', 'type'=>'VARCHAR(255)', 'default'=> '%name% - Discount of %amount%'],
      (Object) ['name'=>'cal_weeks', 'type'=>'VARCHAR(255)', 'default'=> 'Sunday, Monday, Tuesday, Wednesday, Thursday, Friday, Saturday'],
      (Object) ['name'=>'cal_weekabbrs', 'type'=>'VARCHAR(255)', 'default'=> 'Sun, Mon, Tue, Wed, Thu, Fri, Sat'],
      (Object) ['name'=>'cal_months', 'type'=>'VARCHAR(255)', 'default'=> 'January, February, March, April, May, June, July, August, September, October, November, December'],
      (Object) ['name'=>'cal_monthabbrs', 'type'=>'VARCHAR(255)', 'default'=> 'Jan, Feb, Mar, Apr, May, Jun, Jul, Aug, Sept, Oct, Nov, Dec'],
      (Object) ['name'=>'eventCancelledTxt', 'type'=>'VARCHAR(255)', 'default'=> 'Booking is closed at this moment'],
      (Object) ['name'=>'icsCalendarTxt', 'type'=>'VARCHAR(255)', 'default'=> 'Calendar'],
      (Object) ['name'=>'bookingFormErrosTxt', 'type'=>'VARCHAR(255)', 'default'=> "Please fix all errors before booking!"]
    ];
  }

  public static function filterDataModelArr($array) {
    $settingDefArr = array_map(function ($object) { return $object->name; }, self::getDataModel());

    $matchedKeys = array_filter(array_keys($array), function ($key) use ($settingDefArr) {
      return in_array($key, $settingDefArr);
    });
    return array_intersect_key($array, array_flip($matchedKeys));
  }

  public static function getTablesSQL() {
    $textTable = EbpDatabase::getTableName("text");

    $settingsDef = self::getDataModel();

    $settingsSQL = "CREATE TABLE " . $textTable ." (
        id INT NOT NULL AUTO_INCREMENT,
        ";

    foreach ($settingsDef as $settingObj) {
      $settingsSQL .= $settingObj->name . ' ' . $settingObj->type;
      if ($settingObj->default != '') {
         $settingsSQL .= " default '". $settingObj->default . "'";
      }

      $settingsSQL .= ',
        ';
    }

    $settingsSQL .= "PRIMARY KEY (id)
      );";

    return array($settingsSQL);
  }

  public static function textTableCheckAndFix() {
    global $wpdb;
    $table = EbpDatabase::getTableName("text");
    $default = EbpText::DEFAULT_CODE;
    $available = $wpdb->get_var("select COUNT(*) from ". $table . ' where language="$default"');

    // create default record
    if ($available < 1) {
      $wpdb->insert($table, array('language'=>$default));

      return false;
    }

    return true;
  }

  public static function migrate($old) {
    global $wpdb;
    $table = EbpDatabase::getTableName("text");
    return $wpdb->update($table, self::filterDataModelArr($old), array('language'=> EbpText::DEFAULT_CODE));
  }

  public static function getTextSettings($textSel="*") {
    global $wpdb;
    $table = EbpDatabase::getTableName("text");

    $currentLang = self::getActiveLanguage();
    // check if not there and default
    $isAvilable = $wpdb->get_var( "select COUNT(id) from " . EbpDatabase::getTableName("text") ." where language='$currentLang'");
    if (!$isAvilable) {
      $currentLang = EbpText::DEFAULT_CODE;
    }

    return $wpdb->get_row("select " . $textSel . " from ". $table." where language='$currentLang'", ARRAY_A);
  }

  public static function getByLanguage($language) {
    global $wpdb;
    $table = EbpDatabase::getTableName("text");

    $result = $wpdb->get_row("select * from ". $table." where language='$language'");

    if ($result == null) {
      $default = EbpText::DEFAULT_CODE;
      $result = $wpdb->get_row("select * from ". $table." where language='$default'");
      $result->language = $language;
    }

    return $result;
  }

  public static function restoreLanguageSettings($language) {
    global $wpdb;
    $default = EbpText::DEFAULT_CODE;
    $wpdb->delete(EbpDatabase::getTableName("text"), array('language'=> $language));
    $newSettings = $wpdb->get_row("select * from ". EbpDatabase::getTableName("text") ." where language='$default'", ARRAY_A);
    unset($newSettings['id']);
    $newSettings['language'] = $language;
    $wpdb->insert(EbpDatabase::getTableName("text"), $newSettings);

    return array('error'=>null);
  }

  public static function saveSettingsByLanguage($postVars) {
    global $wpdb;

    $languageCode = $postVars['languageCode'];

    $dataToSave = self::filterDataModelArr($postVars);

    $isAvilable = $wpdb->get_var( "select COUNT(*) from " . EbpDatabase::getTableName("text") ." where language='$languageCode'");

    if ($isAvilable) {
      $wpdb->update(EbpDatabase::getTableName("text"), $dataToSave, array('language'=> $languageCode));
    } else {
      $dataToSave['language'] = $languageCode;
      $wpdb->insert(EbpDatabase::getTableName("text"), $dataToSave);
    }

    return array('error'=>null);
  }

  public static function getTextFromLangJson($str) {
    $texts = json_decode($str, true);

    $activeLang = self::hasWPML() ? self::getActiveLanguage() : EbpText::DEFAULT_CODE;

    if (array_key_exists($activeLang, $texts)) {
      return $texts[$activeLang];
    } else {
      return $texts[EbpText::DEFAULT_CODE];
    }
  }

  public static function getAvilableTranslationsList() {
    global $wpdb;
    $table = EbpDatabase::getTableName("text");

    return $wpdb->get_results("select id, language from ". $table);
  }

  public static function hasWPML() {
    return defined('ICL_LANGUAGE_CODE');
  }

  public static function getAllLanguages() {
    return self::hasWPML() ? icl_get_languages('skip_missing=0&orderby=code') : array();
  }

  public static function getActiveLanguage() {
    return self::hasWPML() ? ICL_LANGUAGE_CODE : EbpText::DEFAULT_CODE;
  }

  public static function setLocale() {
    if (!self::hasWPML()) return;

    $locale = EbpText::getAllLanguages()[EbpText::getActiveLanguage()]['default_locale'];

    setlocale(LC_TIME, $locale, $locale.'.UTF-8');
  }
}
