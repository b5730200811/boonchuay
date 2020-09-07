<?php
date_default_timezone_set('asia/bangkok');

include "container.php";
include "ptt.php";

$accesstoken = getenv('LINE_ACCESS_TOKEN');
$tmdAccesstoken = getenv('TMD_ACCESS_TOKEN');


$inputData = file_get_contents("php://input");
$inputJson = json_decode($inputData, true);

$output = response($inputJson);

$count = 0;

$eventType = show_event_type($inputJson);

if ($eventType == "follow") 
{

    $text = "บุญช่วยรายงานตัว";
    $output = add_text($output,$count++, $text);

    // $text = $eventType;
    // $output = add_text($output,$count++, json_encode($inputJson));
}
else if ($eventType == "message") 
{
    $output = add_text($output,$count++, show_message_type($inputJson));
    $textInput = $inputJson["events"][0]["message"]["text"];
    if ($textInput == "!oil") {
        $text = getOilPrice();
        $output = add_text($output,$count++, $text);
    }
}



reply($accesstoken,$output);

$text = getOilPrice();
echo var_dump($text);