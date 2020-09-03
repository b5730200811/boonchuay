<?php
date_default_timezone_set('asia/bangkok');

//$accesstoken = getenv('LINE_ACCESS_TOKEN');


$inputData = file_get_contents("php://input");
$inputJson = json_decode($inputData,true);

$outputJson = response($inputJson);

$count = 0;

$text = "test message";
$outputJson = add_text($outputJson,$count++,$text);

reply($accesstoken,$outputJson);