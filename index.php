<?php
date_default_timezone_set('asia/bangkok');

include "container.php";
include "ptt.php";
include "tmd.php";

$accesstoken = getenv('LINE_ACCESS_TOKEN');
$tmdAccesstoken = getenv('TMD_ACCESS_TOKEN');


$inputData = file_get_contents("php://input");
$inputJson = json_decode($inputData, true);

$output = response($inputJson);

$count = 0;

$eventType = get_event_type($inputJson);

if ($eventType == "follow") 
{
    $output = add_text($output,$count++, "บุญช่วยรายงานตัว");
}
else if ($eventType == "message") 
{
    // $output = add_text($output,$count++, get_message_type($inputJson));

    $messageType = get_message_type($inputJson);
    $messageText = get_message_text($inputJson);

    if ($messageType == "location") {
        $lat = $lon = 0;
        array($lat,$lon) = get_location($inputJson);
        $output = add_text($output,$count++, json_encode(array($lat,$lon));
        $output = add_text($output,$count++, json_encode(getWeather(strval($lat),strval($lon))));
    }
    if ($messageText == "!oil") {
        $output = add_text($output,$count++, getOilPrice());
    }
}



reply($accesstoken,$output);

$text = getOilPrice();
echo var_dump($text);