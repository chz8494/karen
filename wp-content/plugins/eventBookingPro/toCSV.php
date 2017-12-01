<?php

define( 'SHORTINIT', true );
require_once( '../../../wp-load.php' );
require_once dirname( __FILE__ ) . '/include.php';

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

arrayToCsvDownload($data->csv, $fileName, $delimiter);

function arrayToCsvDownload($array, $filename, $delimiter = ",") {
    $f = fopen('php://memory', 'w');
    foreach ($array as $line) {
        fputcsv($f, $line, $delimiter);
    }
    // reset the file pointer to the start of the file
    fseek($f, 0);
    header('Content-Encoding: UTF-8');
    header('Content-type: text/csv; charset=UTF-8');
    header('Content-Disposition: attachment; filename="'.$filename.'";');
    // hack for UTF-8
    // echo "\xEF\xBB\xBF"; // UTF-8 BOM
    // make php send the generated csv lines to the browser
    fpassthru($f);
}
?>
