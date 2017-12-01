<?php
require_once dirname( __FILE__ ) . '/include.php';

class EventBookingAdmin {
  var $main, $path, $name, $url;

  public static function getVersion() {
    return "3.951";
  }

  public static function fixActivate() {
    EventBookingAdmin::activate();
  }

  function __construct($file) {
    $this->main = $file;
    $this->version = EventBookingAdmin::getVersion();
    $this->mobileBookingPage_title = 'Mobile Booking Page';
    $this->mobileBookingPage_name = 'Mobile-Booking-Page';
    $this->mobileBookingPage_desc = "DO NOT DELETE THIS PAGE! It is the booking page on mobile.";

    $this->minified = ""; //min.
    $this->JS_TAG = '20170802';

    EbpAddOnManager::includeRequiredFiles();
    $this->init();


    return $this;
  }

  function template_loader( $template ) {
    global $post;
    if ($post->ID == get_option('ebp_page_id')) return $this->path.'/mobileBookingPage.php';

    return $template;
  }

  function init() {
    $this->path = dirname( __FILE__ );
    $this->name = basename( $this->path );
    $this->url = plugins_url( "/{$this->name}/" );

    if (is_admin()) {

      register_activation_hook( $this->main , array(&$this, 'activate') );
      register_deactivation_hook( $this->main , array(&$this, 'deactivate') );

      // Register Ajax Calls
      add_action('admin_menu', array(&$this, 'admin_menu'));

      // Event
      add_action('wp_ajax_ebp_event_save', array(&$this, 'saveEvent'));

      add_action('wp_ajax_ebp_set_event_active', array(&$this, 'setEventActive'));
      add_action('wp_ajax_ebp_set_event_cancel', array(&$this, 'cancelEvent'));

      add_action('wp_ajax_ebp_get_operation_logs', array(&$this, 'getEventOperationLogs'));

      add_action('wp_ajax_ebp_get_event', array(&$this, 'getEventData'));
      add_action('wp_ajax_ebp_event_delete', array(&$this, 'deleteEvent'));

      add_action('wp_ajax_ebp_get_event_shortcodes', array(&$this, 'getEventShortCode'));

      // settings
      add_action('wp_ajax_ebp_get_settings', array(&$this, 'getSettingsByType'));
      add_action('wp_ajax_ebp_save_settings', array(&$this, 'saveSettingsByType'));
      add_action('wp_ajax_ebp_get_admin_app_settings', array(&$this, 'getAdminAppSettings'));
      add_action('wp_ajax_ebp_get_language_settings', array(&$this, 'getLanguageSettings'));
      add_action('wp_ajax_ebp_save_language_settings', array(&$this, 'saveLanguageSettings'));

      add_action('wp_ajax_ebp_restore_language_settings', array(&$this, 'restoreLanguageSettings'));



      // coupon
      add_action('wp_ajax_ebp_get_coupons_admin_page', array(&$this, 'getCouponsAdminPage'));
      add_action('wp_ajax_ebp_coupon_get', array(&$this, 'getCoupon'));
      add_action('wp_ajax_ebp_coupon_save', array(&$this, 'saveCoupon'));
      add_action('wp_ajax_ebp_coupon_delete', array(&$this, 'deleteCoupon'));
      add_action('wp_ajax_ebp_event_coupon_fetch', array(&$this, 'getEventCoupons'));
      add_action('wp_ajax_ebp_event_coupon_update', array(&$this, 'updateEventCoupon'));
      add_action('wp_ajax_ebp_check_coupon', array(&$this, 'checkCoupon'));
      add_action('wp_ajax_nopriv_ebp_check_coupon', array(&$this, 'checkCoupon'));

      add_action('wp_ajax_ebp_check_spots', array(&$this, 'ajax_checkSpots'));
      add_action('wp_ajax_nopriv_ebp_check_spots', array(&$this, 'ajax_checkSpots'));

      // categories
      add_action('wp_ajax_ebp_get_categories', array(&$this, 'getCategoriesAdminPage'));
      add_action('wp_ajax_ebp_get_category', array(&$this, 'getCategory'));
      add_action('wp_ajax_ebp_save_category', array(&$this, 'saveCategory'));
      add_action('wp_ajax_ebp_delete_category', array(&$this, 'deleteCategory'));
      add_action('wp_ajax_ebp_get_event_categories', array(&$this, 'getEventCategoriesAdminPage'));
      add_action('wp_ajax_ebp_event_categories_update', array(&$this, 'updateEventCategories'));


      // events list
      add_action('wp_ajax_ebp_get_events_list_data', array(&$this, 'getEventsListData'));
      add_action('wp_ajax_nopriv_ebp_get_events_list_data', array(&$this, 'getEventsListData'));

      // booking
      add_action('wp_ajax_ebp_get_booking_step', array(&$this, 'getBookingForm'));
      add_action('wp_ajax_nopriv_ebp_get_booking_step', array(&$this, 'getBookingForm'));

      add_action('wp_ajax_ebp_book_event', array(&$this, 'bookEvent'));
      add_action('wp_ajax_nopriv_ebp_book_event', array(&$this, 'bookEvent'));
      add_action('wp_ajax_update_booking_status', array(&$this, 'updateBookingStatus'));

      add_action('wp_ajax_ebp_booking_delete', array(&$this, 'deleteBooking'));
      // left for compatibility with analytics addon
      add_action('wp_ajax_booking_delete', array(&$this, 'deleteBooking_old'));

      add_action('wp_ajax_get_booking_by_id', array(&$this, 'getBookingById'));
      add_action('wp_ajax_save_booking', array(&$this, 'editBooking'));
      // left for compatibilty with analytics addon
      add_action('wp_ajax_booking_edit', array(&$this, 'editBooking'));

      add_action('wp_ajax_event_booking_main', array(&$this, 'getBookingsPageForEvent'));
      add_action('wp_ajax_event_booking_fetch', array(&$this, 'getBookingEcho'));

      //
      add_action('wp_ajax_event_get_forms', array(&$this, 'ajax_getForms'));

      // calendar data and ByDay Addon
      add_action('wp_ajax_get_calendar_translation', array(&$this, 'getCalendarTranslation'));
      add_action('wp_ajax_nopriv_get_calendar_translation', array(&$this, 'getCalendarTranslation'));

      add_action('wp_ajax_getCalData', array(&$this, 'getCalData'));
      add_action('wp_ajax_nopriv_getCalData', array(&$this, 'getCalData'));

      add_action('wp_ajax_getCalDayData', array(&$this, 'getCalDayData'));
      add_action('wp_ajax_nopriv_getCalDayData', array(&$this, 'getCalDayData'));

      add_action('wp_ajax_getDayEvents', array(&$this, 'getDayEvents'));
      add_action('wp_ajax_nopriv_getDayEvents', array(&$this, 'getDayEvents'));

      // email
      add_action('wp_ajax_testEmail', array(&$this, 'testEmail'));
      add_action('wp_ajax_resendEmail', array(&$this, 'resendEmail'));
      add_action('wp_ajax_get_email_default_template', array(&$this, 'ajax_getDefaultTemplate'));
      add_action('wp_ajax_get_owner_email_default_template', array(&$this, 'ajax_getDefaultOwnerTemplate'));


      // addons
      add_action('wp_ajax_checkAddons', array(&$this, 'checkAddons'));
      add_action('wp_ajax_event_get_addons_data', array(&$this, 'ajax_getAddonsData'));

      // utils
      add_action('wp_ajax_fix_mobile_page', array(&$this, 'setMobilePage'));
      add_action('wp_ajax_ebp_clean_occurences', array(&$this, 'cleanOccurences'));
      add_action('wp_ajax_ebp_set_collation', array(&$this, 'setCollation'));

      // share utils
      add_action('wp_ajax_ebp_ics_download', array(&$this, 'getICSDownload'));
      add_action('wp_ajax_nopriv_ebp_ics_download', array(&$this, 'getICSDownload'));

      // export csv
      add_action('wp_ajax_ebp_export_bookings_csv', array(&$this, 'exportBookingsToCSV'));
      add_action('wp_ajax_nopriv_ebp_export_bookings_csv', array(&$this, 'exportBookingsToCSV'));

    } else {
      //register shortcodes
      add_shortcode("eventBox", array(&$this, 'eventBoxShortCode'));
      add_shortcode("eventbox", array(&$this, 'eventBoxShortCode'));
      add_shortcode("eventButton", array(&$this, 'eventButtonShortCode'));
      add_shortcode("eventbutton", array(&$this, 'eventButtonShortCode'));
      add_shortcode("eventCalendar", array(&$this, 'calendarShortcode'));
      add_shortcode("eventcalendar", array(&$this, 'calendarShortcode'));
      add_shortcode("eventsList", array(&$this, 'eventsListShotcode'));
      add_shortcode("eventList", array(&$this, 'eventsListShotcode'));
      add_shortcode("eventslist", array(&$this, 'eventsListShotcode'));
      add_shortcode("eventlist", array(&$this, 'eventsListShotcode'));
      add_shortcode("eventCard", array(&$this, 'eventCardShortCode'));
      add_shortcode("eventcard", array(&$this, 'eventCardShortCode'));

      //call front end files
      add_action('wp', array(&$this, 'frontEndFiles'));
      add_filter( 'template_include', array( &$this, 'template_loader' ) );
    }

    add_action('wpml_loaded', array('EbpText', 'setLocale'));

    // to override language comment what is below
    // setlocale(LC_TIME, 'de_DE', 'de_DE.UTF-8');
    // Change de_De to your own language: http://red-route.org/code/php-international-language-and-locale-codes-demonstration
  }


  function deactivate() {
    $this->cleanMobilePage();
  }

  function activate() {
    if (!get_option("ebp_update_checker_show")) {
      add_option("ebp_update_checker", true);
      add_option("ebp_update_checker_show", true);
    }

    $this->setMobilePage();

    EbpDatabase::updateDatabase($this->version);

    // generate css
    EbpSettings::generateCSS();
  }

  function admin_page() {
    include_once($this->path . '/pages/admin.php');
  }

  function admin_menu() {
    $mainMenu = add_menu_page('EBP Events','EBP Events', 'manage_options', 'eventManagement', array(&$this, 'admin_page'),
      $this->url."/images/icon.png");
    add_action('load-'.$mainMenu, array(&$this, 'admin_menu_scripts'));
    add_action('load-'.$mainMenu, array(&$this, 'admin_menu_styles'));
  }

  function admin_menu_scripts() {
    wp_enqueue_script('underscore');
    wp_enqueue_script('ebp-tinymce-js', $this->url . 'adminjs/tinymce/tinymce.min.js', array('jquery'));
    wp_enqueue_script('ebp-table2CSV-js', $this->url . 'adminjs/table2CSV.min.js', array('jquery'));
    wp_enqueue_script('ebp-bootstrap-switch-js', $this->url . 'adminjs/bootstrap-switch.js' );
    wp_enqueue_script('ebp-ebpTimePicker-js', $this->url . 'adminjs/ebpTimePicker.js' );
    wp_enqueue_script('ebp-jquery-dynatable', $this->url . 'adminjs/jquery.dynatable.js', array('jquery'));

    wp_enqueue_media();
    wp_enqueue_script('jquery-ui-datepicker');
    wp_enqueue_script('wp-color-picker');
    wp_enqueue_script('thickbox');
    wp_enqueue_script('media-upload');
    wp_enqueue_script('ebp-uploader', $this->url . 'adminjs/uploader.js', array('thickbox','media-upload', 'jquery' ));
    wp_enqueue_script('ebp-modernizr-js', $this->url . 'adminjs/modernizr.custom.53451.js');
    wp_enqueue_script('ebp-jquery-dropDown', $this->url . 'adminjs/jquery.dropdown.min.js');

    wp_enqueue_script('ebp-admin-builder-js', $this->url . 'adminjs/adminBuilder.'.$this->minified.'js', array('ebp-tinymce-js', 'jquery'), $this->JS_TAG);
    wp_enqueue_script('ebp-admin-js', $this->url . 'adminjs/admin.'.$this->minified.'js', array('ebp-tinymce-js', 'ebp-admin-builder-js', 'jquery'), $this->JS_TAG);
  }

  function admin_menu_styles() {
    wp_enqueue_style('thickbox' );
    wp_enqueue_style('wp-color-picker');
    wp_enqueue_style('ebp-admin-css', $this->url . 'css/admin.css', $this->JS_TAG);
    wp_enqueue_style('jquery-ui-datepicker', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/themes/smoothness/jquery-ui.css');
  }

  function frontEndFiles() {
    global $wpdb;
    $settings = EbpSettings::getSettingsById(1, "useGeneratedCSS, googleMapsEnabled, googleMapsLoadLib, googleMapsAPIKey", "");

    wp_enqueue_style('ebp_style', plugins_url( '/css/frontend.css', __FILE__ ), array(), $this->JS_TAG, 'all');

    if ($settings->useGeneratedCSS == 'true') {
      $cssFile =  plugins_url( '/css/generated.css', __FILE__ );
    } else {
      $cssFile =  plugins_url( '/css/frontend-style.php', __FILE__ );
    }
    wp_enqueue_style('ebp_frontend-style', $cssFile, array(), $this->JS_TAG, 'all');

    wp_enqueue_script('ebp-helpers-js', $this->url . 'js/helpers.js', array('jquery'), $this->JS_TAG, true);

    wp_enqueue_script('ebp-helpers-dropdown-js', $this->url . 'js/jquery.dropdown.js', array('jquery', 'ebp-helpers-js'), $this->JS_TAG, true);

    wp_enqueue_script('ebp-jquery-ebpFullCalendar', $this->url . 'js/jquery.ebpFullCalendar.js', array('jquery','ebp-helpers-js' ), $this->JS_TAG, true);
    wp_enqueue_script('ebp-EbpUtil-js', $this->url . 'js/EbpUtil.'.$this->minified.'js', array(), $this->JS_TAG, true);

    wp_enqueue_script('ebp-qtip', $this->url . 'js/jquery.qtip.min.js', array('jquery'), false, true);

    wp_enqueue_script('ebp-frontend-scroll-js', $this->url . 'js/scroll/jquery.scrollbar.js', 'jquery' , $this->JS_TAG, true);

    wp_enqueue_style('ebp-frontend-scroll-css', plugins_url( 'js/scroll/jquery.scrollbar.css', __FILE__ ), array(), $this->JS_TAG, 'all');
    wp_enqueue_script('ebp-forms-cards-js', $this->url . 'js/card/jquery.card.js', 'jquery' , $this->JS_TAG, true);

    $scriptRequireArr = array('jquery', 'ebp-helpers-js', 'ebp-jquery-ebpFullCalendar', 'ebp-EbpUtil-js', 'ebp-qtip', 'ebp-frontend-scroll-js', 'ebp-forms-cards-js');

    if ($settings->googleMapsEnabled == 'true' && $settings->googleMapsLoadLib == 'true') {
      $MAPS_JS_KEY = 'ebp-gmap-js';

      $link = "https://maps.googleapis.com/maps/api/js?v=3.exp";
      if ($settings->googleMapsAPIKey != '') {
        $link .= '&key='.$settings->googleMapsAPIKey;
      }

      wp_enqueue_script($MAPS_JS_KEY, $link);
      array_push($scriptRequireArr, $MAPS_JS_KEY);
    }


    wp_enqueue_script('ebp-frontend-js', $this->url . 'js/frontend.'.$this->minified.'js', $scriptRequireArr , $this->JS_TAG, true);
  }


  // ==== Settings functions

  function getAdminAppSettings() {
    $result = EbpSettings::getAdminAppSettings();

    die(json_encode($result));
  }


  function getSettingsByType() {
    $type = $_POST['type'];
    $result = EbpSettings::getSettingsByType($type);

    if ($type === 'EMAIL_RULES') {
      // also load the emailTempates
      $emailTemplatesData = self::getEmailAddonData(null);
      $result->emailTemplates = $emailTemplatesData->emailTemplates;
      $result->hasEmailTemplates = $emailTemplatesData->hasEmailTemplates;
    }

    $result = json_encode($result);

    die($result);
  }

  function saveSettingsByType() {
    $response = EbpSettings::saveSettingsByType($_POST);

    die(json_encode($response));
  }

  function getLanguageSettings() {
    $response = EbpText::getByLanguage($_POST['language']);

    die(json_encode($response));
  }

  function restoreLanguageSettings() {
    $response = EbpText::restoreLanguageSettings($_POST['language']);

    die(json_encode($response));
  }


  function saveLanguageSettings() {
    $response = EbpText::saveSettingsByLanguage($_POST);

    die(json_encode($response));
  }



  //  CALENDARS
  function getCalendarTranslation() {
    die(json_encode(EbpCalendar::getCalendarTranslation()));
  }

  function getDayEvents() {
    $displayType = $_POST['displayType'];
    $currentDay = $_POST['currentDay'];
    $categories = $_POST['categories'];
    $width = intval($_POST['width']);

    die(EbpCalendar::getDayEvents($displayType, $currentDay, $categories, $width));
  }

  function getCalData() {

    die(json_encode(EbpCalendar::getCalData($_POST)));

  }

  function getCalDayData() {
    $dateIdList = $_POST['dateIds'];
    $width = intval($_POST['width']);
    die(json_encode(EbpCalendar::getCalDayData($dateIdList, $width)));
  }

  function calendarShortcode($atts, $content = NULL) {
    $shortcodeParams = array(
      'width'=> NULL,
      'categories'=> NULL,
      'height'=> NULL,
      'loadall'=> "false",
      'tooltip'=> "on",
      'show_events_directly'=> 'off',
      'show_spots_left'=>'off',
      'display_mode'=>'tooltip'
      );

    extract(shortcode_atts($shortcodeParams, $atts));

    return EbpCalendar::getCalendarHTML($width, $categories, $height, $loadall, $tooltip, $show_events_directly, $show_spots_left, $display_mode);
  }

  // EVENTS LIST
  function eventsListShotcode($atts, $content = NULL) {
    $shortcodeParams = array(
      'events'=> 'all',
      'order'=> 'asc',
      'type'=> 'box',
      'categories' => NULL,
      'limit'=> 100,
      'width'=> NULL,
      'months'=> NULL,
      'nextdays' => NULL,
      'filter' => 'off',
      'show_occurences_as_seperate' => 'off'
      );

    extract(shortcode_atts($shortcodeParams, $atts));

    return EbpEventsList::getEventsListHTML($events, $order, $type, $categories, $limit, $width, $months, $nextdays, $filter, $show_occurences_as_seperate);
  }

  function getEventsListData() {
    $events = $_POST['events'];
    $order = $_POST['order'];
    $type = $_POST['type'];
    $categories = $_POST['categories'];
    $limit = $_POST['limit'];
    $width = $_POST['width'];
    $months = $_POST['months'];
    $nextdays = $_POST['nextdays'];
    $filter = $_POST['filter'];
    $show_occurences_as_seperate = $_POST['show_occurences_as_seperate'];

    die(EbpEventsList::getEventsListData($events, $order, $type, $categories, $limit, $width, $months, $nextdays, $filter, $show_occurences_as_seperate));
  }


  // EVENT BUTTON
  function eventButtonShortCode($atts, $content = NULL) {
    extract(shortcode_atts(array('id'=> '1', 'date_id'=> -1, 'include_price'=>false), $atts));

    return EbpEventButton::getEventButtonHTML($id, $date_id, $include_price, $content);
  }

  // EVENT CARD
  function eventCardShortCode($atts, $content = NULL) {
    extract(shortcode_atts( array('id'=> '1', 'date_id'=> -1, 'width'=> NULL, 'expand'=> 'on'), $atts));

    if ($expand == "off") {
      $html = EbpEventCard::getCard($id, $date_id, $width);
    } else {
      $html = EbpEventCardExtended::getCard($id, $date_id, $width);
    }

    return $html;
  }

  // EVENT BOX
  function eventBoxShortCode($atts, $content = NULL) {
    extract(shortcode_atts(array('id'=> '1','date_id'=> -1, 'show_all_tickets'=>NULL, 'width'=> NULL), $atts ) );

    return EbpEventBox::getEventBoxHTML($id, $date_id, $show_all_tickets, $width);
  }


  // ==== Event Functions
  function getEventData() {
    die(EbpEvent::getEventData($_POST['event-id']));
  }

  function saveEvent() {
    die(EbpEvent::saveEvent($_POST));
  }

  function setEventActive() {
    $id = $_POST['id'];
    $eventStatus = (string) $_POST['eventStatus'];

    die(EbpEvent::setEventActive($id, $eventStatus));
  }

  function cancelEvent() {
    die(EbpEvent::cancelEvent($_POST['id']));
  }

  function getEventOperationLogs() {
    $result = LogsService::getOperationLogsForEvent($_POST['id']);

    die(json_encode($result));
  }


  function deleteEvent() {
    global $wpdb;

    die(EbpEvent::deleteEvent($_POST['id']));
  }

  function getEventShortCode() {
    global $wpdb;
    $id = $_POST['event-id'];
    $result = json_encode(EbpEventOccurrence::getEventOccurence($id));
    die($result);
  }

  // ==== spots functions
  function ajax_checkSpots() {
    $date_id = $_POST['date_id'];
    $ticket = $_POST['ticket'];
    $result = EbpEvent::checkSpots($date_id, $ticket);
    die($result."");
  }

  // ==== Booking wrapper functions

  function getBookingsPageForEvent() {
    $html = EbpBooking::getBookingsPageForEvent($_POST['event-id']);

    die($html);
  }

  function getBookingEcho() {
    $result = EbpBooking::getBookingForDate($_POST['id']);
    die($result);
  }


  function updateBookingStatus () {
    $result = EbpBooking::updateBookingStatus($_POST['id']);
    die($result);
  }


  function doDeleteBooking($id) {


    if (EbpAddOnManager::usesEmailRules()) {
      global $wpdb;
      $settings = EbpSettings::getSettingsById(1, "emailBookingCanceled, emailBookingCanceledTemplate", "");

      if ($settings->emailBookingCanceled == 'true') {
        $templateId = $settings->emailBookingCanceledTemplate;
        EmailService::sendCustomEmail($id, $templateId);
      }
    }

    $result = EbpBooking::deleteBooking($id);
    return $result;
  }

  function deleteBooking() {
    $id = $_POST['id'];

    $result = (Object) array('id'=>$this->doDeleteBooking($id));
    die(json_encode($result));
  }

  function deleteBooking_old() {
    $id = $_POST['id'];
    $result = $this->doDeleteBooking($id);

    die($result);
  }

  function editBooking_old() {
    $id = $_POST['id'];

    $info = $_POST['info'];
    $data = explode('|', $info);

    $result = EbpBooking::editBooking_old($id, $data);
    die($result);
  }

  function editBooking() {
    $id = $_POST['id'];

    $result = EbpBooking::editBooking($id, (object) json_decode(stripslashes($_POST['booking']), true));
    die($result);
  }

  function getBookingById() {
    $id = $_POST['id'];

    $result = EbpBooking::getBookingById($id);
    die(json_encode($result));
  }

  function getBookingForm() {
    die(json_encode(EBP_FE_Modal::getBookingStepPage($_POST)));
  }

  function bookEvent () {
    $eventId = $_POST['eventid'];
    $ticket = $_POST['ticket'];
    $dateid = $_POST['dateid'];
    $coupon = $_POST['coupon'];
    $couponID = $_POST['couponID'];
    $amount = $_POST['amount'];
    $bookName = $_POST['bookName'];
    $bookEmail = $_POST['bookEmail'];
    $quantity = $_POST['quantity'];
    $bookingDetails =  $_POST['bookingDetails'];
    $currentPage =  $_POST['currentPage'];
    $eventName =  $_POST['eventName'];
    $bookingType = $_POST['bookingType'];
    $taxRate = $_POST['taxRate'];
    $amountTaxed = $_POST['amountTaxed'];

    $couponAmountUsed = $_POST['couponAmountUsed'];
    $couponType = $_POST['couponType'];

    $result = EbpBooking::bookEvent($eventId, $ticket, $dateid, $coupon, $couponID, $couponAmountUsed, $couponType, $amount, $bookName,
      $bookEmail, $quantity, $bookingDetails, $currentPage, $eventName, $bookingType, $taxRate, $amountTaxed);

    die(json_encode($result));
  }


  // ==== Email wrapper functions
  function resendEmail() {
    $status = EmailService::createEmailAndSend($_POST['id'], "", null, true, true);
    die($status);
  }

  function testEmail() {
    $msg = EmailService::testEmail();

    if ($msg == EmailService::SENT_SUCCESS) {
      $msg = "No problems occured, You should receive an email to your inbox!";
    }

    die($msg);
  }

  function ajax_getDefaultOwnerTemplate() {
    $result = EmailService::getDefaultOwnerEmailTemplate();
    die($result);
  }

  function ajax_getDefaultTemplate() {
    $result = EmailService::getDefaultEmailTemplate();
    die($result);
  }

  // ==== Coupons functions
  function getCouponsAdminPage() {
    die(EbpCoupon::getCouponsAdminPage());
  }

  function getCoupon() {
    $result = EbpCoupon::getCoupon($_POST['id']);

    die(json_encode($result));
  }

  function saveCoupon() {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $amount = $_POST['amount'];
    $code = $_POST['code'];
    $type = $_POST['type'];
    $maxAllowed = $_POST['maxAllowed'];
    $isActive = $_POST['isActive'];

    $result = EbpCoupon::saveCoupon($id, $name, $amount, $code, $type, $maxAllowed, $isActive);
    die(json_encode($result));
  }

  function deleteCoupon() {
    die(EbpCoupon::deleteCoupon($_POST['id']));
  }

  function getEventCoupons() {
    die(EbpCoupon::getEventCoupons($_POST['event-id']));
  }

  function updateEventCoupon() {
    die(EbpCoupon::updateEventCoupon($_POST));
  }

  function checkCoupon() {
    $code = $_POST['code'];
    // check internal coupons
    $result = EbpCoupon::checkCoupon($_POST['event'], $code);

    // check giftcards
    if ($result['code'] == EbpCoupon::COUPON_NOT_FOUND && EbpAddOnManager::usesGiftCardAddon()) {
      $giftCardResult = EventBookingProGiftCardClass::checkGiftCard($code);

      if ($giftCardResult['code'] != EventBookingProGiftCardClass::GIFT_CARD_NOT_FOUND) {
        $result = $giftCardResult;
      }
    }

    die(json_encode($result));
  }

  // ==== Categories functions

  function getCategoriesAdminPage() {
    die(EbpCategories::getCategoriesAdminPage());
  }

  function getCategory() {
    $result = EbpCategories::getCategory($_POST['id']);
    die(json_encode($result));
  }

  function saveCategory() {
    $result = EbpCategories::saveCategory($_POST['id'], $_POST['name']);
    die(json_encode($result));
  }

  function deleteCategory() {
    die(EbpCategories::deleteCategory($_POST['id']));
  }

  function getEventCategoriesAdminPage() {
    die(EbpCategories::getEventCategoriesAdminPage($_POST['event-id']));
  }

  function updateEventCategories() {
    die(EbpCategories::updateEventCategories($_POST));
  }

  // ==== Addons functions

  function checkAddons() {
    $result = EbpAddOnManager::getAddonsPage();
    die($result);
  }

  // used for compatibility with old email addon.
  public function getEmailTemplatesData() {
    return self::getEmailTemplates();
  }

  public static function getEmailTemplates() {
    if (method_exists('eventBookingProEmailsClass', 'getEmailTemplatesData')) {
      return eventBookingProEmailsClass::getEmailTemplatesData();
    }

    global $wpdb;
    $results = $wpdb->get_results( "SELECT * FROM " . EventBookingHelpers::getTableName("emailTemplates"));

    $emailTemplates = '-1,Default Email Template|';
    foreach($results as $result) {
      $emailTemplates .= $result->id;
      $emailTemplates .= ",".$result->name;
      $emailTemplates .= "|";
    }

    return rtrim($emailTemplates, "|");
  }


  public static function getForms() {
    if (!EbpAddOnManager::hasFormAddOn()) {
      $data = array ( 'forms'=> '','hasForms'=> 'false');
    } else {
      global $wpdb;
      $formsArray = $wpdb->get_results( "SELECT id, name FROM " . EbpDatabase::getTableName("forms"));

      $defaultForm = new stdClass();
      $defaultForm->id = '-1';
      $defaultForm->name = 'Default Form';

      $array = array_unshift($formsArray, $defaultForm);


      $data = array (
        'forms'=> $formsArray,
        'hasForms'=> 'true'
      );

    }
    return (object) $data;
  }


  public static function getEmailAddonData($event) {
    if (!EbpAddOnManager::hasEmailTemplatesAddOn()) {
      $data = array (
        'emailTemplates'=> '',
        'hasEmailTemplates'=> 'false',
        "hasEmailRules"=> "false"
      );
    } else {
      $data = array (
       'emailTemplates'=> self::getEmailTemplates(),
       'hasEmailTemplates'=> 'true',
       'hasEmailRules'=> (EbpAddOnManager::usesEmailRules() ? 'true' : 'false'),
      );

      if (EbpAddOnManager::usesEmailRules() && $event != null) {
        $data['emailRules'] = eventBookingProEmailsClass::getEventEmailRules($event);
      }

    }

    return (object) $data;
  }

  function ajax_getAddonsData() {
    $data = new stdClass();
    $data->formsData = self::getForms();
    $data->emailsData = self::getEmailAddonData(null);
    $result = json_encode($data);

    die($result);
  }

  function ajax_getForms() {
    $data = self::getForms();
    $result = json_encode($data);

    die($result);
  }

  public static function getGateways($activeGateways) {
    global $wpdb;

    if ($activeGateways == NULL) $activeGateways = "";

    $pattern = '/[%=]/';
    $activeGatewaysArr = preg_split($pattern,$activeGateways);

    $finalGateways= $activeGateways;
    $gatewayList = $wpdb->get_results("SELECT * FROM " . EbpDatabase::getTableName("gateways")." where active= '1' ");

    foreach ($gatewayList as $gateway ) {
      if (!in_array($gateway->name, $activeGatewaysArr)) {
        $finalGateways.= "%".$gateway->name."=false";
      }
    }

    if (strlen($finalGateways) > 0 && $finalGateways[0] == "%") {
      $finalGateways = substr($finalGateways, 1, strlen($finalGateways));
    }

    return $finalGateways;
  }

  // SHARE
  function getICSDownload() {
    EbpShare::getICS($_GET['event_id'], $_GET['date_id']);
    exit;
  }

  // ==== Utils functions

  function setCollation () {
    die(EbpDatabase::setCollation());
  }

  function cleanOccurences() {
    global $wpdb;
    $sql = 'DELETE FROM '.EbpDatabase::getTableName("eventDates").' WHERE event not in (SELECT id FROM '.EbpDatabase::getTableName("events").')';
    $wpdb->get_results($sql);
    die($wpdb->num_rows);
  }

  function cleanMobilePage() {
    //remove booking page
    $the_page_id = get_option( 'ebp_page_id' );
    if ($the_page_id) {
      wp_delete_post( $the_page_id ); // this will trash, not delete
    }

    delete_option("ebp_page_title");
    delete_option("ebp_page_name");
  }
  function setMobilePage() {
    delete_option("ebp_page_title");
    add_option("ebp_page_title", $this->mobileBookingPage_title, '','yes');

    delete_option("ebp_page_name");
    add_option("ebp_page_name", $this->mobileBookingPage_name, '','yes');

    // Create post object
    $_p = array();
    $_p['post_title'] = $this->mobileBookingPage_title;
    $_p['post_content'] = $this->mobileBookingPage_desc;
    $_p['post_status'] = 'publish';
    $_p['post_type'] = 'page';
    $_p['comment_status'] = 'closed';
    $_p['ping_status'] = 'closed';
    $_p['post_category'] = array(1); // the default 'Uncatrgorised'

    // Insert the post into the database
    $mobileBookingPage_id = wp_insert_post( $_p );

    delete_option('ebp_page_id');
    add_option( 'ebp_page_id', $mobileBookingPage_id);
  }

  // export bookings to csv
  function exportBookingsToCSV() {
    if (!isset($_GET['dateid'])) {
        die ('You should not be here');
    }

    $dateid = $_GET['dateid'];

    $data = EbpBooking::bookingsToCSV($dateid);

    $delimiter = (isset($_GET['delimiter'])) ? $_GET['delimiter'] : ',';


    if (!isset($_GET['name'])) {
        $fileName = $data->filename.".csv";
    } else {
        $fileName = $_GET['name'].".csv";
    }

    $f = fopen('php://memory', 'w');
    foreach ($data->csv as $line) {
        fputcsv($f, $line, $delimiter);
    }
    // reset the file pointer to the start of the file
    fseek($f, 0);
    header('Content-Encoding: UTF-8');
    header('Content-type: text/csv; charset=UTF-8');
    header('Content-Disposition: attachment; filename="'.$fileName.'";');
    // hack for UTF-8
    echo "\xEF\xBB\xBF"; // UTF-8 BOM
    // make php send the generated csv lines to the browser
    fpassthru($f);
  }
}


?>
