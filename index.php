<?php
date_default_timezone_set('asia/bangkok');

include "container.php";

$accesstoken = getenv('LINE_ACCESS_TOKEN');


$inputData = file_get_contents("php://input");
$inputJson = json_decode($inputData,true);

$output = response($inputJson);

$count = 0;

$eventType = show_event_type($inputJson);

$text = $eventType;
$output = add_text($output,$count++,json_encode($inputJson));

reply($accesstoken,$output);