<?php

class EbpShare {
  private static function formatTimeUTC($time, $timeZone) {
    $tempStart = strtotime($time . " ". $timeZone);
    return date('Ymd\THis\Z', $tempStart);
  }

   public static function createGoogleCalLink($eventTitle, $desc, $eventLocation, $startDateTime, $endDateTime, $timeZoneParam, $linkText) {
    $date = new DateTime(null, new DateTimeZone($timeZoneParam));
    $tz = $date->getTimezone();
    $timeZone = $tz->getName();

    $eventStartTime = self::formatTimeUTC($startDateTime, $timeZone);
    $eventEndTime = self::formatTimeUTC($endDateTime, $timeZone);

    return '<a title="Add to My Google Calendar" class="EBP--SocialLink" target="_blank" href="http://www.google.com/calendar/event?action=TEMPLATE&text='.$eventTitle.'&dates='.$eventStartTime.'/'.$eventEndTime.'&location='.$eventLocation.'&details='.self::handleDesc($desc).'&trp=true">'.$linkText.'</a>';
  }

  public static function handleDesc($desc) {
    if(!empty($desc)){
      $desc = strip_tags($desc);
      $desc = str_replace(']]>', ']]&gt;', $desc);
      $desc = wp_trim_words($desc, 50, ' [..]');
    }

    return $desc;
  }

  public static function createICSCalendarLink($eventId, $occurId, $linkText) {
    $icsLink = admin_url('admin-ajax.php').'?action=ebp_ics_download&amp;event_id='.$eventId.'&amp;date_id='.$occurId;

    return '<a title="Download event as ics calendar" class="EBP--SocialLink" target="_blank" href="'.$icsLink.'">'.$linkText.'</a>';
  }

  public static function safeText($str='' ) {
    $str = str_replace("\\", "", $str);
    $str = str_replace("\r", "\r\n ", $str);
    $str = str_replace("\n", "\r\n ", $str);
    $str = str_replace(",", "\, ", $str);
    $str = htmlspecialchars_decode($str);

    return $str;
  }

  public static function getICS($eventId, $occurId){
    $eventData = EbpEvent::getEventById($eventId);
    $occurrenceData = EbpEventOccurrence::getOccurrence($occurId, "start_time, end_time, start_date, end_date");

    // start and end time
    $timeZone = EbpSettings::getTimeZone();

    $eventStartTime = self::formatTimeUTC($occurrenceData->start_date.' '.$occurrenceData->start_time, $timeZone);
    $eventEndTime = self::formatTimeUTC($occurrenceData->end_date.' '.$occurrenceData->end_time, $timeZone);

    $name = $summary = $eventData->name;

    $summary = (!empty($eventData->info))? $eventData->info:'';
    $summary = self::handleDesc($summary);

    $uid = uniqid();
    $fileName = $eventData->name;
    // Address information
    $location_name = !empty($eventData->address) ? $eventData->address : false;
    $location_address = !empty($eventData->mapAddress) ? $eventData->mapAddress : false;
    $location = ($location_name ? $location_name . ' ' : '') . ($location_address ? $location_address : '');
    $location = self::safeText($location);


    header("Content-Type: text/Calendar; charset=utf-8");
    header("Content-Disposition: inline; filename={$fileName}.ics");
    echo "BEGIN:VCALENDAR\n";
    echo "VERSION:2.0\n";
    echo "PRODID:-//EBP NONSGML v1.0//EN\n";
    //echo "METHOD:REQUEST\n"; // required by Outlook
    echo "BEGIN:VEVENT\n";
    echo "UID:{$uid}\n"; // for Outlook
    echo "DTSTAMP:".date_i18n('Ymd').'T'.date_i18n('His')."\n"; // for Outlook
    echo "DTSTART:{$eventStartTime}\n";
    echo "DTEND:{$eventEndTime}\n";
    echo "LOCATION:{$location}\n";
    echo "SUMMARY:".html_entity_decode($name)."\n";
    echo "DESCRIPTION: ".$summary."\n";
    echo "END:VEVENT\n";
    echo "END:VCALENDAR";
    exit;
  }

}
?>
