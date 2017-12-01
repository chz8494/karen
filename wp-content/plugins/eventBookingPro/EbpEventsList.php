<?php
require_once dirname( __FILE__ ) . '/include.php';

class EbpEventsList {

  public static function getEventsListHTML($events, $order, $type, $categories, $limit, $width, $months, $nextdays, $filter, $show_occurences_as_seperate) {
    $html = '<input name= "ajaxlink" value="'.site_url().'" type= "hidden"  />';
    $html .= '<div class="Ebp--EventsList Ebp--NotInited" data-events="'.$events.'" data-order="'.$order.'" data-type="'.$type.'" data-categories="'.$categories.'" data-limit="'.$limit.'" data-width="'.$width.'" data-months="'.$months.'" data-nextdays="'.$nextdays.'" data-filter="'.$filter.'" data-show_occurences_as_seperate="'.$show_occurences_as_seperate.'"></div>';

    return $html;
  }

  public static function getEventsListData($events, $order, $type, $categories, $limit, $width, $months, $nextdays, $filter, $show_occurences_as_seperate) {
    global $wpdb;

    $settingsOption = EventBookingHelpers::getStyling($width, 1);

    $eventsListHtml = self::getEventListData($settingsOption, $events, $order, $type, $categories, $limit, $width, $months, $nextdays, $show_occurences_as_seperate);

    $finalHtml = '';

    if ($eventsListHtml == '') {
      $finalHtml = $settingsOption["settings"]->NoEventsInList;
    } else {
      $finalHtml = '<div class="eventsGroup">';
        if ($filter == 'on') {
          $finalHtml .= self::getUsedCategoriesAsFilters($categories, $settingsOption["settings"]);
        }

        $finalHtml .= $eventsListHtml;
    }

    return $finalHtml;
  }

  public static function getUsedCategoriesAsFilters($categories, $settings) {
    $categoriesList = EbpCategories::getUsedCategories($categories);

    $catNames = '';
    foreach ($categoriesList as $category ) {
      $catNames .= '<a class="catFilter" href="#" data-cat-id="ebpCat_'.$category['id'].'">'.$category['name'].'</a>';
    }

    if ($catNames != '') {
      $catNames = '<a class="catFilter" href="#" data-cat-id="ebpCat_all">'.$settings->eventsListFilterLable.'</a>'.$catNames;
      $catNames = '<div class="filterTags">'.$catNames.'</div>';
    }

    return $catNames;
  }

  public static function getEventListData($settingsOption, $eventsType, $order, $displayType, $categories, $limit, $width,
   $months, $nextdays, $showOccurencesAsSeperate, $prefix = "", $suffix = "") {
    $finalHtml = "";
    $results = EbpEvent::getEvents($eventsType, $order, $categories, $limit, $months, $nextdays, $showOccurencesAsSeperate);

    foreach ($results as $result) {
      $id = $result->event;
      if ($displayType == "card") {
        $htmlTemp = EbpEventCard::getCard($id, $result->date_id, $width);
      } else if ($displayType == "cardExpand") {
        $htmlTemp = EbpEventCardExtended::getCard($id, $result->date_id, $width);
      } else {
        $htmlTemp = '<div class="eventDisplayCnt" data-init-width="'.$settingsOption['width'].'" style="'.$settingsOption["box"].'">';

          // to do, pass -1 to list
          $markUp = EbpEventBox::getEventMarkUp($id, $result->date_id, $result, $settingsOption);
          $htmlTemp .= $markUp["html"];
          $htmlTemp .= $markUp["modal"];
        $htmlTemp .= '</div>';
      }

      $finalHtml .= $prefix . $htmlTemp . $suffix;
    }

    return $finalHtml;
  }

}
