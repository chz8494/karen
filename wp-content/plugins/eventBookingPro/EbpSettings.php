<?php

require_once dirname( __FILE__ ) . '/include.php';

class EbpSettings {

  private static function getDataModel() {
    return [
      (Object) ['name' => 'paypalAccount', 'type' => 'VARCHAR(100)', 'default' => ' '],
      (Object) ['name' => 'sandbox', 'type' => 'VARCHAR(6)', 'default' => 'false'],
      (Object) ['name' => 'force_ssl_v3', 'type' => 'VARCHAR(6)', 'default' => 'true'],
      (Object) ['name' => 'currency', 'type' => 'VARCHAR(10)', 'default' => 'USD'],
      (Object) ['name' => 'couponsEnabled', 'type' => 'VARCHAR(6)', 'default' => 'true'],
      (Object) ['name' => 'multipleBookings', 'type' => 'VARCHAR(6)', 'default' => 'true'],
      (Object) ['name' => 'SMTP_NAME', 'type' => 'VARCHAR(100)', 'default' => 'Name in Email'],
      (Object) ['name' => 'SMTP_EMAIL', 'type' => 'VARCHAR(255)', 'default' => 'youremail@host.com'],
      (Object) ['name' => 'SMTP_PASS', 'type' => 'VARCHAR(255)', 'default' => 'password'],
      (Object) ['name' => 'SMTP_HOST', 'type' => 'VARCHAR(255)', 'default' => 'main.domain.com'],
      (Object) ['name' => 'SMTP_PORT', 'type' => 'int(10)', 'default' => '587'],
      (Object) ['name' => 'emailTitle', 'type' => 'VARCHAR(255)', 'default' => ' '],
      (Object) ['name' => 'emailSignature', 'type' => 'VARCHAR(255)', 'default' => ' '],
      (Object) ['name' => 'emailMsg', 'type' => 'text NOT NULL'],
      (Object) ['name' => 'cpp_header_image', 'type' => 'VARCHAR(255)', 'default' => ' '],
      (Object) ['name' => 'cpp_headerback_color', 'type' => 'VARCHAR(7)', 'default' => '#FFFFFF'],
      (Object) ['name' => 'cpp_headerborder_color', 'type' => 'VARCHAR(7)', 'default' => '#FFFFFF'],
      (Object) ['name' => 'cpp_logo_image', 'type' => 'VARCHAR(255)', 'default' => ' '],
      (Object) ['name' => 'cpp_payflow_color', 'type' => 'VARCHAR(7)', 'default' => '#FFFFFF'],
      (Object) ['name' => 'cal_displayWeekAbbr', 'type' => 'VARCHAR(5)', 'default' => 'true'],
      (Object) ['name' => 'cal_displayMonthAbbr', 'type' => 'VARCHAR(5)', 'default' => 'false'],
      (Object) ['name' => 'cal_startIn', 'type' => 'int(1)', 'default' => '1'],
      (Object) ['name' => 'cal_width', 'type' => 'int', 'default' => '600'],
      (Object) ['name' => 'cal_color', 'type' => 'VARCHAR(7)', 'default' => '#2ecc71'],
      (Object) ['name' => 'cal_bgColor', 'type' => 'VARCHAR(7)', 'default' => '#f6f6f6'],
      (Object) ['name' => 'cal_titleBgColor', 'type' => 'VARCHAR(7)', 'default' => '#ffffff'],
      (Object) ['name' => 'cal_dateColor', 'type' => 'VARCHAR(7)', 'default' => '#686a6e'],
      (Object) ['name' => 'cal_boxColor', 'type' => 'VARCHAR(7)', 'default' => '#ffffff'],
      (Object) ['name' => 'cal_topBorder', 'type' => 'int', 'default' => '5'],
      (Object) ['name' => 'cal_topBorderColor', 'type' => 'VARCHAR(7)', 'default' => '#2ecc71'],
      (Object) ['name' => 'cal_bottomBorder', 'type' => 'int', 'default' => '0'],
      (Object) ['name' => 'cal_bottomBorderColor', 'type' => 'VARCHAR(7)', 'default' => '#eeeeee'],
      (Object) ['name' => 'cal_sideBorder', 'type' => 'int', 'default' => '0'],
      (Object) ['name' => 'cal_sideBorderColor', 'type' => 'VARCHAR(7)', 'default' => ' '],
      (Object) ['name' => 'cal_paddingSides', 'type' => 'int', 'default' => '20'],
      (Object) ['name' => 'showPrice', 'type' => 'VARCHAR(5)', 'default' => 'false'],
      (Object) ['name' => 'showSpots', 'type' => 'VARCHAR(7)', 'default' => 'true'],
      (Object) ['name' => 'includeEndsOn', 'type' => 'VARCHAR(5)', 'default' => 'true'],
      (Object) ['name' => 'imageMarginSides', 'type' => 'int', 'default' => '0'],
      (Object) ['name' => 'imageCrop', 'type' => 'VARCHAR(5)', 'default' => 'true'],
      (Object) ['name' => 'imageHeight', 'type' => 'int', 'default' => '150'],
      (Object) ['name' => 'imageMarginTop', 'type' => 'int', 'default' => '0'],
      (Object) ['name' => 'imageMarginBottom', 'type' => 'int', 'default' => '0'],
      (Object) ['name' => 'btnColor', 'type' => 'VARCHAR(7)', 'default' => '#FFFFFF'],
      (Object) ['name' => 'btnBgColor', 'type' => 'VARCHAR(7)', 'default' => '#2ecc71'],
      (Object) ['name' => 'btnFontSize', 'type' => 'int', 'default' => '18'],
      (Object) ['name' => 'btnFontType', 'type' => 'VARCHAR(6)', 'default' => 'normal'],
      (Object) ['name' => 'btnLineHeight', 'type' => 'int', 'default' => '18'],
      (Object) ['name' => 'btnSidePadding', 'type' => 'int', 'default' => '40'],
      (Object) ['name' => 'btnTopPadding', 'type' => 'int', 'default' => '12'],
      (Object) ['name' => 'btnBorder', 'type' => 'int', 'default' => '0'],
      (Object) ['name' => 'btnBorderColor', 'type' => 'VARCHAR(7)', 'default' => '#FFF'],
      (Object) ['name' => 'btnBorderRadius', 'type' => 'int', 'default' => '25'],
      (Object) ['name' => 'btnMarginTop', 'type' => 'int', 'default' => '10'],
      (Object) ['name' => 'btnMarginBottom', 'type' => 'int', 'default' => '20'],
      (Object) ['name' => 'boxWidth', 'type' => 'int', 'default' => '400'],
      (Object) ['name' => 'boxPaddingSides', 'type' => 'int', 'default' => '0'],
      (Object) ['name' => 'boxPaddingTop', 'type' => 'int', 'default' => '0'],
      (Object) ['name' => 'boxPaddingBottom', 'type' => 'int', 'default' => '20'],
      (Object) ['name' => 'boxMarginSides', 'type' => 'int', 'default' => '0'],
      (Object) ['name' => 'boxMarginBottom', 'type' => 'int', 'default' => '20'],
      (Object) ['name' => 'boxAlign', 'type' => 'VARCHAR(5)', 'default' => 'true'],
      (Object) ['name' => 'boxMarginTop', 'type' => 'int', 'default' => '0'],
      (Object) ['name' => 'boxBgColor', 'type' => 'VARCHAR(7)', 'default' => '#FFF'],
      (Object) ['name' => 'boxBorder', 'type' => 'int', 'default' => '0'],
      (Object) ['name' => 'boxBorderColor', 'type' => 'VARCHAR(7)', 'default' => '#F2F2F2'],
      (Object) ['name' => 'boxBorderRadius', 'type' => 'int', 'default' => '5'],
      (Object) ['name' => 'titleColor', 'type' => 'VARCHAR(7)', 'default' => '#495468'],
      (Object) ['name' => 'titleFontSize', 'type' => 'int', 'default' => '24'],
      (Object) ['name' => 'titleLineHeight', 'type' => 'int', 'default' => '36'],
      (Object) ['name' => 'titleTextAlign', 'type' => 'VARCHAR(6)', 'default' => 'center'],
      (Object) ['name' => 'titleFontStyle', 'type' => 'VARCHAR(6)', 'default' => 'normal'],
      (Object) ['name' => 'titlePaddingSides', 'type' => 'int', 'default' => '0'],
      (Object) ['name' => 'titlePaddingTop', 'type' => 'int', 'default' => '10'],
      (Object) ['name' => 'titlePaddingBottom', 'type' => 'int', 'default' => '10'],
      (Object) ['name' => 'titleMarginTop', 'type' => 'int', 'default' => '0'],
      (Object) ['name' => 'titleMarginBottom', 'type' => 'int', 'default' => '0'],
      (Object) ['name' => 'titleBottomBorder', 'type' => 'int', 'default' => '0'],
      (Object) ['name' => 'titleBottomBorderColor', 'type' => 'VARCHAR(7)', 'default' => '#EEEEEE'],
      (Object) ['name' => 'dateTextAlign', 'type' => 'VARCHAR(6)', 'default' => 'center'],
      (Object) ['name' => 'datePaddingTop', 'type' => 'int', 'default' => '10'],
      (Object) ['name' => 'datePaddingBottom', 'type' => 'int', 'default' => '10'],
      (Object) ['name' => 'datePaddingSides', 'type' => 'int', 'default' => '0'],
      (Object) ['name' => 'dateMarginTop', 'type' => 'int', 'default' => '0'],
      (Object) ['name' => 'dateMarginBottom', 'type' => 'int', 'default' => '0'],
      (Object) ['name' => 'dateColor', 'type' => 'VARCHAR(7)', 'default' => '#999'],
      (Object) ['name' => 'dateLableColor', 'type' => 'VARCHAR(7)', 'default' => '#666666'],
      (Object) ['name' => 'dateLableSize', 'type' => 'int', 'default' => '12'],
      (Object) ['name' => 'dateLabelLineHeight', 'type' => 'int', 'default' => '16'],
      (Object) ['name' => 'dateLabelStyle', 'type' => 'VARCHAR(6)', 'default' => 'normal'],
      (Object) ['name' => 'dateFontSize', 'type' => 'int', 'default' => '14'],
      (Object) ['name' => 'dateFontLineHeight', 'type' => 'int', 'default' => '16'],
      (Object) ['name' => 'dateFontStyle', 'type' => 'VARCHAR(6)', 'default' => 'normal'],
      (Object) ['name' => 'dateBorderColor', 'type' => 'VARCHAR(7)', 'default' => '#EEEEEE'],
      (Object) ['name' => 'dateBorderSize', 'type' => 'int', 'default' => '1'],
      (Object) ['name' => 'moreDateTextAlign', 'type' => 'VARCHAR(6)', 'default' => 'center'],
      (Object) ['name' => 'moreDateColor', 'type' => 'VARCHAR(7)', 'default' => '#999'],
      (Object) ['name' => 'moreDateSize', 'type' => 'int', 'default' => '12'],
      (Object) ['name' => 'moreDateLineHeight', 'type' => 'int', 'default' => '12'],
      (Object) ['name' => 'moreDateMarginTop', 'type' => 'int', 'default' => '10'],
      (Object) ['name' => 'moreDateFontStyle', 'type' => 'VARCHAR(6)', 'default' => 'normal'],
      (Object) ['name' => 'moreDateHoverColor', 'type' => 'VARCHAR(7)', 'default' => '#2ecc71'],
      (Object) ['name' => 'moreDateOn', 'type' => 'VARCHAR(5)', 'default' => 'true'],
      (Object) ['name' => 'moreDatePassed', 'type' => 'VARCHAR(5)', 'default' => 'true'],
      (Object) ['name' => 'moreDateUpcoming', 'type' => 'VARCHAR(5)', 'default' => 'true'],
      (Object) ['name' => 'moreDateSectionMarginBottom', 'type' => 'VARCHAR(6)', 'default' => '30'],
      (Object) ['name' => 'modal_dateTitleTextAlign', 'type' => 'VARCHAR(6)', 'default' => 'center'],
      (Object) ['name' => 'modal_dateTitlePaddingSides', 'type' => 'int', 'default' => '0'],
      (Object) ['name' => 'modal_dateTitleMarginBottom', 'type' => 'int', 'default' => '5'],
      (Object) ['name' => 'modal_dateTitleColor', 'type' => 'VARCHAR(7)', 'default' => '#000000'],
      (Object) ['name' => 'modal_dateTitleFontSize', 'type' => 'int', 'default' => '28'],
      (Object) ['name' => 'modal_dateTitleFontLineHeight', 'type' => 'int', 'default' => '30'],
      (Object) ['name' => 'modal_dateTitleFontStyle', 'type' => 'VARCHAR(6)', 'default' => 'italic'],
      (Object) ['name' => 'modal_dateTextAlign', 'type' => 'VARCHAR(6)', 'default' => 'left'],
      (Object) ['name' => 'modal_datePaddingTop', 'type' => 'int', 'default' => '0'],
      (Object) ['name' => 'modal_datePaddingBottom', 'type' => 'int', 'default' => '0'],
      (Object) ['name' => 'modal_datePaddingSides', 'type' => 'int', 'default' => '20'],
      (Object) ['name' => 'modal_dateMarginTop', 'type' => 'int', 'default' => '10'],
      (Object) ['name' => 'modal_dateMarginBottom', 'type' => 'int', 'default' => '10'],
      (Object) ['name' => 'modal_dateColor', 'type' => 'VARCHAR(7)', 'default' => '#999'],
      (Object) ['name' => 'modal_dateLableColor', 'type' => 'VARCHAR(7)', 'default' => '#f2f2f2'],
      (Object) ['name' => 'modal_dateLableSize', 'type' => 'int', 'default' => '12'],
      (Object) ['name' => 'modal_dateLabelLineHeight', 'type' => 'int', 'default' => '16'],
      (Object) ['name' => 'modal_dateLabelStyle', 'type' => 'VARCHAR(6)', 'default' => 'normal'],
      (Object) ['name' => 'modal_dateFontSize', 'type' => 'int', 'default' => '14'],
      (Object) ['name' => 'modal_dateFontLineHeight', 'type' => 'int', 'default' => '16'],
      (Object) ['name' => 'modal_dateFontStyle', 'type' => 'VARCHAR(6)', 'default' => 'normal'],
      (Object) ['name' => 'detailsPaddingTop', 'type' => 'int', 'default' => '10'],
      (Object) ['name' => 'detailsPaddingBottom', 'type' => 'int', 'default' => '10'],
      (Object) ['name' => 'detailsPaddingSides', 'type' => 'int', 'default' => '20'],
      (Object) ['name' => 'detailsMarginTop', 'type' => 'int', 'default' => '10'],
      (Object) ['name' => 'detailsMarginBottom', 'type' => 'int', 'default' => '0'],
      (Object) ['name' => 'detailsColor', 'type' => 'VARCHAR(7)', 'default' => '#999'],
      (Object) ['name' => 'detailsLableColor', 'type' => 'VARCHAR(7)', 'default' => '#CCC'],
      (Object) ['name' => 'detailsLableSize', 'type' => 'int', 'default' => '14'],
      (Object) ['name' => 'detailsLabelLineHeight', 'type' => 'int', 'default' => '32'],
      (Object) ['name' => 'detailsLabelStyle', 'type' => 'VARCHAR(6)', 'default' => 'normal'],
      (Object) ['name' => 'detailsFontSize', 'type' => 'int', 'default' => '32'],
      (Object) ['name' => 'detailsFontLineHeight', 'type' => 'int', 'default' => '32'],
      (Object) ['name' => 'detailsFontStyle', 'type' => 'VARCHAR(6)', 'default' => 'normal'],
      (Object) ['name' => 'detailsBorderColor', 'type' => 'VARCHAR(7)', 'default' => '#EEE'],
      (Object) ['name' => 'detailsBorderSize', 'type' => 'int', 'default' => '0'],
      (Object) ['name' => 'detailsBorderSide', 'type' => 'int', 'default' => '0'],
      (Object) ['name' => 'infoMaxHeight', 'type' => 'int', 'default' => '100'],
      (Object) ['name' => 'locationTextAlign', 'type' => 'VARCHAR(6)', 'default' => 'left'],
      (Object) ['name' => 'locationColor', 'type' => 'VARCHAR(7)', 'default' => '#a5a5a5'],
      (Object) ['name' => 'locationFontSize', 'type' => 'int', 'default' => '12'],
      (Object) ['name' => 'locationLineHeight', 'type' => 'int', 'default' => '14'],
      (Object) ['name' => 'locationFontStyle', 'type' => 'VARCHAR(6)', 'default' => 'normal'],
      (Object) ['name' => 'infoTextAlign', 'type' => 'VARCHAR(6)', 'default' => 'left'],
      (Object) ['name' => 'infoColor', 'type' => 'VARCHAR(7)', 'default' => '#a5a5a5'],
      (Object) ['name' => 'infoFontSize', 'type' => 'int', 'default' => '12'],
      (Object) ['name' => 'infoLineHeight', 'type' => 'int', 'default' => '14'],
      (Object) ['name' => 'infoFontStyle', 'type' => 'VARCHAR(6)', 'default' => 'normal'],
      (Object) ['name' => 'infoPaddingSides', 'type' => 'int', 'default' => '10'],
      (Object) ['name' => 'infoPaddingTop', 'type' => 'int', 'default' => '10'],
      (Object) ['name' => 'infoPaddingBottom', 'type' => 'int', 'default' => '10'],
      (Object) ['name' => 'infoMarginTop', 'type' => 'int', 'default' => '0'],
      (Object) ['name' => 'infoMarginBottom', 'type' => 'int', 'default' => '0'],
      (Object) ['name' => 'infoBorderColor', 'type' => 'VARCHAR(7)', 'default' => '#eeeeee'],
      (Object) ['name' => 'infoBorderSize', 'type' => 'int', 'default' => '1'],
      (Object) ['name' => 'calBorderColor', 'type' => 'VARCHAR(7)', 'default' => '#eeeeee'],
      (Object) ['name' => 'calBorderSize', 'type' => 'int', 'default' => '1'],
      (Object) ['name' => 'modalMainColor', 'type' => 'VARCHAR(7)', 'default' => '#2ecc71'],
      (Object) ['name' => 'modal_btnTxtColor', 'type' => 'VARCHAR(7)', 'default' => '#FFF'],
      (Object) ['name' => 'modal_btnFontSize', 'type' => 'int', 'default' => '16'],
      (Object) ['name' => 'modal_btnLineHeight', 'type' => 'int', 'default' => '16'],
      (Object) ['name' => 'modal_btnFontType', 'type' => 'VARCHAR(6)', 'default' => 'normal'],
      (Object) ['name' => 'modal_btnTopPadding', 'type' => 'int', 'default' => '15'],
      (Object) ['name' => 'modal_btnSidePadding', 'type' => 'int', 'default' => '35'],
      (Object) ['name' => 'modal_btnMarginTop', 'type' => 'int', 'default' => '30'],
      (Object) ['name' => 'modal_btnBorderRadius', 'type' => 'int', 'default' => '6'],
      (Object) ['name' => 'modal_titleSize', 'type' => 'int', 'default' => '48'],
      (Object) ['name' => 'modal_titleLineHeight', 'type' => 'int', 'default' => '48'],
      (Object) ['name' => 'modal_titleFontType', 'type' => 'VARCHAR(6)', 'default' => 'normal'],
      (Object) ['name' => 'modal_titleMarginBottom', 'type' => 'int', 'default' => '40'],
      (Object) ['name' => 'modal_input_fontSize', 'type' => 'int', 'default' => '16'],
      (Object) ['name' => 'modal_input_lineHeight', 'type' => 'int', 'default' => '20'],
      (Object) ['name' => 'modal_input_topPadding', 'type' => 'int', 'default' => '12'],
      (Object) ['name' => 'modal_input_space', 'type' => 'int', 'default' => '10'],
      (Object) ['name' => 'requirePhone', 'type' => 'VARCHAR(6)', 'default' => 'true'],
      (Object) ['name' => 'requireAddress', 'type' => 'VARCHAR(6)', 'default' => 'true'],
      (Object) ['name' => 'modal_txtColor', 'type' => 'VARCHAR(7)', 'default' => '#FFF'],
      (Object) ['name' => 'dateFormat', 'type' => 'VARCHAR(20)', 'default' => 'F jS, Y'],
      (Object) ['name' => 'timeFormat', 'type' => 'VARCHAR(20)', 'default' => 'g:i A'],
      (Object) ['name' => 'mapAddressType', 'type' => 'VARCHAR(20)', 'default' => 'address'],
      (Object) ['name' => 'mapAddress', 'type' => 'VARCHAR(255)', 'default' => ''],
      (Object) ['name' => 'mapZoom', 'type' => 'int', 'default' => '16'],
      (Object) ['name' => 'mapType', 'type' => 'VARCHAR(15)', 'default' => 'ROADMAP'],
      (Object) ['name' => 'modal_input_txtColor', 'type' => 'VARCHAR(7)', 'default' => '#FFFFFF'],
      (Object) ['name' => 'modal_inputHover_txtColor', 'type' => 'VARCHAR(7)', 'default' => '#000000'],
      (Object) ['name' => 'modal_input_bgColor', 'type' => 'VARCHAR(7)', 'default' => '#FFFFFF'],
      (Object) ['name' => 'modal_inputHover_bgColorHover', 'type' => 'VARCHAR(7)', 'default' => '#FFFFFF'],
      (Object) ['name' => 'modal_input_bgColorAlpha', 'type' => 'int', 'default' => '20'],
      (Object) ['name' => 'modal_inputHover_bgColorAlpha', 'type' => 'int', 'default' => '60'],
      (Object) ['name' => 'modal_selectHoverColor', 'type' => 'VARCHAR(7)', 'default' => '#208F4F'],
      (Object) ['name' => 'modal_selectTxtHoverColor', 'type' => 'VARCHAR(7)', 'default' => '#FFFFFF'],
      (Object) ['name' => 'modal_selectLabelAsNoneOption', 'type' => 'VARCHAR(7)', 'default' => 'true'],
      (Object) ['name' => 'modal_selectNoneOption', 'type' => 'VARCHAR(50)', 'default' => '-- select --'],
      (Object) ['name' => 'currencyBefore', 'type' => 'VARCHAR(7)', 'default' => 'true'],
      (Object) ['name' => 'emailSubject', 'type' => 'VARCHAR(255)', 'default' => 'Event Booking Information'],
      (Object) ['name' => 'refundEmailSubject', 'type' => 'VARCHAR(255)', 'default' => 'Booking refunded'],
      (Object) ['name' => 'emailSSL', 'type' => 'VARCHAR(6)', 'default' => 'false'],
      (Object) ['name' => 'emailTemplate', 'type' => 'TEXT NOT NULL'],
      (Object) ['name' => 'refundEmailTemplate', 'type' => 'TEXT NOT NULL'],
      (Object) ['name' => 'refundOwnerEmailTemplate', 'type' => 'TEXT NOT NULL'],
      (Object) ['name' => 'mapHeight', 'type' => 'int', 'default' => '120'],
      (Object) ['name' => 'checkBoxMarginBottom', 'type' => 'int', 'default' => '20'],
      (Object) ['name' => 'checkBoxMarginTop', 'type' => 'int', 'default' => '20'],
      (Object) ['name' => 'checkBoxTextColor', 'type' => 'VARCHAR(7)', 'default' => '#EEE'],
      (Object) ['name' => 'checkBoxColor', 'type' => 'VARCHAR(7)', 'default' => '#111'],
      (Object) ['name' => 'cal_height', 'type' => 'int', 'default' => '400'],
      (Object) ['name' => 'popupOverlayAlpha', 'type' => 'int', 'default' => '100'],
      (Object) ['name' => 'modalOverlayColor', 'type' => 'VARCHAR(7)', 'default' => '#2ECC71'],
      (Object) ['name' => 'return_same_page', 'type' => 'VARCHAR(7)', 'default' => 'true'],
      (Object) ['name' => 'return_page_url', 'type' => 'VARCHAR(255)', 'default' => ''],
      (Object) ['name' => 'infoNoButton', 'type' => 'VARCHAR(7)', 'default' => 'true'],
      (Object) ['name' => 'calEventDayColor', 'type' => 'VARCHAR(7)', 'default' => '#FFFFFF'],
      (Object) ['name' => 'calEventDayColorHover', 'type' => 'VARCHAR(7)', 'default' => '#FFFFFF'],
      (Object) ['name' => 'calTodayColor', 'type' => 'VARCHAR(7)', 'default' => '#2eCC71'],
      (Object) ['name' => 'calEventDayDotColorHover', 'type' => 'VARCHAR(7)', 'default' => '#2ecc71'],
      (Object) ['name' => 'calEventDayDotColor', 'type' => 'VARCHAR(7)', 'default' => '#DDDDDD'],
      (Object) ['name' => 'modal_includeTime', 'type' => 'VARCHAR(7)', 'default' => 'false'],
      (Object) ['name' => 'email_mode', 'type' => 'VARCHAR(7)', 'default' => '3'],
      (Object) ['name' => 'ticketsOrder', 'type' => 'int', 'default' => '1'],
      (Object) ['name' => 'permenantMoreButton', 'type' => 'VARCHAR(7)', 'default' => 'false'],
      (Object) ['name' => 'ownerEmailTemplate', 'type' => 'TEXT NOT NULL'],
      (Object) ['name' => 'addToCalendar', 'type' => 'VARCHAR(7)', 'default' => 'false'],
      (Object) ['name' => 'addToCalendarTextColor', 'type' => 'VARCHAR(7)', 'default' => '#ADADAD'],
      (Object) ['name' => 'addToCalendarTextHoverColor', 'type' => 'VARCHAR(7)', 'default' => '#CCC'],
      (Object) ['name' => 'addToCalendarTextFontSize', 'type' => 'int', 'default' => '12'],
      (Object) ['name' => 'addToCalendarTextFontStyle', 'type' => 'VARCHAR(50)', 'default' => 'italic'],
      (Object) ['name' => 'addToCalendarMarginSide', 'type' => 'int', 'default' => '5'],
      (Object) ['name' => 'addToCalendarMarginBottom', 'type' => 'int', 'default' => '5'],
      (Object) ['name' => 'addToCalendarAlign', 'type' => 'VARCHAR(10)', 'default' => 'left'],
      (Object) ['name' => 'doAfterSuccess', 'type' => 'VARCHAR(15)', 'default' => 'popup'],
      (Object) ['name' => 'doAfterSuccessRedirectURL', 'type' => 'VARCHAR(255)', 'default' => ''],
      (Object) ['name' => 'priceDecimalCount', 'type' => 'int', 'default' => '2'],
      (Object) ['name' => 'priceDecPoint', 'type' => 'VARCHAR(2)', 'default' => '.'],
      (Object) ['name' => 'priceThousandsSep', 'type' => 'VARCHAR(2)', 'default' => ','],
      (Object) ['name' => 'eventCardShowImage', 'type' => 'VARCHAR(7)', 'default' => 'true'],
      (Object) ['name' => 'infoTitleFontSize', 'type' => 'int', 'default' => '18'],
      (Object) ['name' => 'infoTitleColor', 'type' => 'VARCHAR(7)', 'default' => '#111111'],
      (Object) ['name' => 'cardDescriptionBackColor', 'type' => 'VARCHAR(7)', 'default' => '#f1f1f1'],
      (Object) ['name' => 'spotsLeftStrict', 'type' => 'VARCHAR(7)', 'default' => 'false'],
      (Object) ['name' => 'limitBookingPerEmail', 'type' => 'VARCHAR(7)', 'default' => 'false'],
      (Object) ['name' => 'limitBookingPerEmailCount', 'type' => 'int', 'default' => '1'],
      (Object) ['name' => 'limitBookingPerTime', 'type' => 'VARCHAR(7)', 'default' => 'false'],
      (Object) ['name' => 'limitBookingPerTimeCount', 'type' => 'int', 'default' => '1'],
      (Object) ['name' => 'showAllTickets', 'type' => 'VARCHAR(7)', 'default' => 'false'],
      (Object) ['name' => 'eventsListFilterColor', 'type' => 'VARCHAR(7)', 'default' => '#1abc9c'],
      (Object) ['name' => 'eventsListFilterTextColor', 'type' => 'VARCHAR(7)', 'default' => '#FFFFFF'],
      (Object) ['name' => 'eventsListFilterBorderRadius', 'type' => 'int', 'default' => '4'],
      (Object) ['name' => 'eventsListFilterFontSize', 'type' => 'int', 'default' => '16'],
      (Object) ['name' => 'eventsListFilterPaddingSides', 'type' => 'int', 'default' => '13'],
      (Object) ['name' => 'eventsListFilterPaddingVertical', 'type' => 'int', 'default' => '8'],
      (Object) ['name' => 'eventCardShowThumbnail', 'type' => 'VARCHAR(7)', 'default' => 'true'],
      (Object) ['name' => 'eventCardExpandThumbnailWidth', 'type' => 'VARCHAR(4)', 'default' => '15%'],
      (Object) ['name' => 'eventCardThumbnailWidth', 'type' => 'VARCHAR(4)', 'default' => '35%'],
      (Object) ['name' => 'eventCardImageAsBackground', 'type' => 'VARCHAR(7)', 'default' => 'false'],
      (Object) ['name' => 'calendarImageAsBackground', 'type' => 'VARCHAR(7)', 'default' => 'false'],
      (Object) ['name' => 'sendEmailToAdmin', 'type' => 'VARCHAR(7)', 'default' => 'true'],
      (Object) ['name' => 'sendEmailToCustomer', 'type' => 'VARCHAR(7)', 'default' => 'true'],
      (Object) ['name' => 'cal_hasBoxShadow', 'type' => 'VARCHAR(7)', 'default' => 'false'],
      (Object) ['name' => 'box_hasBoxShadow', 'type' => 'VARCHAR(7)', 'default' => 'false'],
      (Object) ['name' => 'email_utf8', 'type' => 'VARCHAR(7)', 'default' => 'false'],
      (Object) ['name' => 'tax_rate', 'type' => 'DECIMAL(10,2)', 'default' => '0.0'],
      (Object) ['name' => 'showTaxInBookingForm', 'type' => 'VARCHAR(7)', 'default' => 'false'],
      (Object) ['name' => 'emailRulesEnabled', 'type' => 'VARCHAR(7)', 'default' => 'false'],
      (Object) ['name' => 'emailRule_afterForCameOnly', 'type' => 'VARCHAR(7)', 'default' => 'false'],
      (Object) ['name' => 'emailBookingCanceled', 'type' => 'VARCHAR(7)', 'default' => 'false'],
      (Object) ['name' => 'emailBookingCanceledTemplate', 'type' => 'int', 'default' => '-1'],
      (Object) ['name' => 'googleMapsEnabled', 'type' => 'VARCHAR(7)', 'default' => 'true'],
      (Object) ['name' => 'googleMapsLoadLib', 'type' => 'VARCHAR(7)', 'default' => 'true'],
      (Object) ['name' => 'googleMapsAPIKey', 'type' => 'VARCHAR(255)', 'default' => ''],
      (Object) ['name' => 'emailOccurenceDeleted', 'type' => 'VARCHAR(7)', 'default' => 'false'],
      (Object) ['name' => 'emailOccurenceCanceledTemplate', 'type' => 'int', 'default' => '-1'],
      (Object) ['name' => 'eventBoxIncludeAddress', 'type' => 'VARCHAR(6)', 'default' => 'false'],
      (Object) ['name' => 'emailEventCanceled', 'type' => 'VARCHAR(7)', 'default' => 'false'],
      (Object) ['name' => 'emailEventCanceledTemplate', 'type' => 'int', 'default' => '-1'],
      (Object) ['name' => 'bookingFormTicketCntShowPrice', 'type' => 'VARCHAR(7)', 'default' => 'true'],
      (Object) ['name' => 'mobileSeperatePage', 'type' => 'VARCHAR(7)', 'default' => 'false'],
      (Object) ['name' => 'bookingFormBoxRadius', 'type' => 'int', 'default' => '5'],
      (Object) ['name' => 'useGeneratedCSS', 'type' => 'VARCHAR(7)', 'default' => 'false'],
      (Object) ['name' => 'customCSS', 'type' => 'TEXT'],
      (Object) ['name' => 'phonePreferredCountries', 'type' => 'TEXT'],
      (Object) ['name' => 'phoneOnlyCountries', 'type' => 'TEXT'],
      (Object) ['name' => 'phoneInitialCountry', 'type' => 'VARCHAR(7)', 'default' => ''],
      (Object) ['name' => 'timeZone', 'type' => 'VARCHAR(100)', 'default' => 'Europe/Zurich'],
      (Object) ['name' => 'icsCalendar', 'type' => 'VARCHAR(7)', 'default' => 'false'],
      (Object) ['name'=>'emailRule_validStatus', 'type'=>'VARCHAR(255)', 'default'=> 'paid, not paid, success, successful, completed'],
      (Object) ['name'=>'statusesCountedAsCompleted', 'type'=>'VARCHAR(255)', 'default'=> 'paid, not paid, ok, completed, successful, success'],
      // byDay
      (Object) ['name' => 'dayCal_bgColor', 'type' => 'VARCHAR(7)', 'default' => '#F4F4F4'],
      (Object) ['name' => 'dayCal_borderColor', 'type' => 'VARCHAR(7)', 'default' => '#dddddd'],
      (Object) ['name' => 'dayCal_mainColor', 'type' => 'VARCHAR(7)', 'default' => '#2ECC71'],
      (Object) ['name' => 'dayCal_subColor', 'type' => 'VARCHAR(7)', 'default' => '#CCCCCC'],
      (Object) ['name' => 'dayCal_monthColor', 'type' => 'VARCHAR(7)', 'default' => '#495468'],
      (Object) ['name' => 'dayCal_daysColor', 'type' => 'VARCHAR(7)', 'default' => '#919191'],
      (Object) ['name' => 'dayCal_bordersOff', 'type' => 'VARCHAR(7)', 'default' => 'false'],
      // slider
      (Object) ['name' => 'slider_main_color', 'type' => 'VARCHAR(7)', 'default' => '#2ECC71'],
      (Object) ['name' => 'slider_width', 'type' => 'int', 'default' => '800'],
      (Object) ['name' => 'slider_height', 'type' => 'int', 'default' => '250'],
      (Object) ['name' => 'slider_thumb_width', 'type' => 'int', 'default' => '35'],
      (Object) ['name' => 'slider_thumb_height', 'type' => 'int', 'default' => '50'],
      (Object) ['name' => 'slider_vertical_padding', 'type' => 'int', 'default' => '0'],
      (Object) ['name' => 'slider_side_padding', 'type' => 'int', 'default' => '0'],
      // cards
      (Object) ['name' => 'card_bg_effect_color', 'type' => 'VARCHAR(7)', 'default' => '#000000'],
      (Object) ['name' => 'card_bg_effect_alpha', 'type' => 'int', 'default' => '30'],
      (Object) ['name' => 'card_bg_effect_alpha_hover', 'type' => 'int', 'default' => '5']
    ];
  }

  public static function getTablesSQL() {
    $settingsTable = EbpDatabase::getTableName("settings");
    $settingsDef = self::getDataModel();

    $settings_sql = "CREATE TABLE " . $settingsTable ." (
        id INT NOT NULL AUTO_INCREMENT,
        ";

    foreach ($settingsDef as $settingObj) {
      $settings_sql .= $settingObj->name . ' ' . $settingObj->type;
      if (property_exists($settingObj, 'default') && $settingObj->default != '') {
         $settings_sql .= " default '". $settingObj->default . "'";
      }

      $settings_sql .= ',
        ';
    }

    $settings_sql .= "PRIMARY KEY (id)
      );";

    return array($settings_sql);
  }

  public static function filterDataModelArr($array) {
    $settingDefArr = array_map(function ($object) { return $object->name; }, self::getDataModel());

    $matchedKeys = array_filter(array_keys($array), function ($key) use ($settingDefArr) {
      return in_array($key, $settingDefArr);
    });
    return array_intersect_key($array, array_flip($matchedKeys));
  }


  // MIGRATION FUNCTIONS .. pre assumptions taken
  public static function getAndDeleteTextValues() {
    global $wpdb;
    $textSettings = array('passedTxt', 'bookingStartsTxts', 'bookingEndedTxt', 'bookedTxt', 'btnTxt', 'moreDateTxt', 'infoExpandText', 'modalNameTxt', 'modalEmailTxt', 'modalPhoneTxt', 'modalAddressTxt', 'modalBookText', 'paypalBtnTxt', 'endsOnTxt', 'statsOnTxt', 'modalSpotsLeftTxt', 'modalQuantityTxt', 'modalSingleCostTxt', 'modalTotalCostTxt', 'eventBookedTxt', 'bookingTxt', 'ExpandTextTxt', 'closeTextTxt', 'spotsLeftTxt', 'freeTxt', 'applyTxt', 'couponTxt', 'termsLink', 'addToCalendarText ', 'doAfterSuccessTitle', 'doAfterSuccessMessage', 'eventDescriptionTitle', 'bookingLimitText', 'bookingLimitTimeText', 'NoEventsInList', 'passedOccurencesText', 'upcomingOccurencesText', 'eventsListFilterLable', 'duplicateOnQuantityText', 'coupon_expired_msg', 'coupon_not_found_msg', 'coupon_msg', 'cal_weeks', 'cal_weekabbrs', 'cal_months', 'cal_monthabbrs', 'eventCancelledTxt', 'icsCalendarTxt');

    $oldSettings = $wpdb->get_row("SELECT * FROM " . EbpDatabase::getTableName("settings")." where id='1'", ARRAY_A);
    // $wpdb->query("ALTER TABLE ". EbpDatabase::getTableName("settings") . " DROP " . implode (", DROP ", $textSettings));

    return $oldSettings;
  }
  // END MIGRATION FUNCTIONS


  public static function getTimeZone() {
    global $wpdb;
    return $wpdb->get_var("SELECT timeZone FROM " . EbpDatabase::getTableName("settings")." where id='1'");
  }

  public static function getAdminAppSettings() {
    global $wpdb;
    $result = $wpdb->get_row("SELECT emailEventCanceled, emailRulesEnabled, googleMapsEnabled, emailBookingCanceled FROM " . EbpDatabase::getTableName("settings")." where id='1'");
    $result->currencies = EbpCurrency::getAsOptions();

    return $result;
  }

  public static function generateCSS() {
    ob_start();
    require  dirname( __FILE__ ).'/css/localFrontendStyleProvider.php';
    $css = ob_get_contents();
    ob_end_clean();
    file_put_contents(dirname( __FILE__ ).'/css/generated.css', $css);
  }

  public static function getSettingsById($id, $sel='*', $textSel="*") {
    global $wpdb;

    if ($textSel == "") {
      return $wpdb->get_row("SELECT " . $sel . " FROM " . EbpDatabase::getTableName("settings")." where id='$id'");
    }

    if ($sel != "") {
      $settings = $wpdb->get_row("SELECT " . $sel . " FROM " . EbpDatabase::getTableName("settings")." where id='$id'", ARRAY_A);
    } else {
      $settings = array();
    }

    if ($textSel != "") {
      $textSettings = EbpText::getTextSettings($textSel);
    } else {
      $textSettings = array();
    }

    $settings = (Object) array_merge($settings, $textSettings);

    return $settings;
  }


  public static function getSettingsByType($type) {
    global $wpdb;

     if ($type == 'TEXTS') {
      $result = (Object) [
        'hasWPML' => EbpText::hasWPML(),
        'languages' => EbpText::getAllLanguages(),
        'records' => EbpText::getAvilableTranslationsList()
      ];
     } else {
      $settingId = ($type == 'EVENT_CARD') ? 3 : 1;
      $result = $wpdb->get_row("SELECT * FROM " . EbpDatabase::getTableName("settings")." where id='$settingId'");
     }

    $result->hasDayListCalendar = EbpAddOnManager::usesDayCalAddOn();
    $result->hasEmailRules = EbpAddOnManager::usesEmailRules();
    $result->hasSliderAddon = EbpAddOnManager::useSliderAddon();

    return $result;
  }

  public static function saveSettingsByType($postVars) {
    global $wpdb;
    $dataArra =  array();
    $type = $postVars['type'];

    $dataToSave = self::filterDataModelArr($postVars);

    if ($type == 'EMAIL_RULES') {
      if (EbpAddOnManager::usesEmailRules()) {
        eventBookingProEmailsClass::enableCron($postVars['emailRulesEnabled'] == 'true');
      }
    }

    if ($type == 'TEXTS') {

    } else if ($type == 'EVENT_CARD') {
      $wpdb->update(EbpDatabase::getTableName("settings"), $dataToSave, array('id'=> 3));
    } else if ($type == 'EVENT_SLIDER') {
      $wpdb->update(EbpDatabase::getTableName("settings"), $dataToSave, array('id'=> 3));
      $wpdb->update(EbpDatabase::getTableName("settings"), $dataToSave, array('id'=> 1));
    } else {
      $wpdb->update(EbpDatabase::getTableName("settings"), $dataToSave, array('id'=> 1));
    }

    EbpSettings::generateCSS();
    return array('error'=>null);
  }

}
