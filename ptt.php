<?php
date_default_timezone_set('asia/bangkok'); 

function getOilPrice() {
    $thai_months = ["มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม"];

    $client = new SoapClient("https://www.pttor.com/OilPrice.asmx?WSDL", // URL ของ webservice
        array(
        "trace"      => 1,   // enable trace to view what is happening
        "exceptions" => 0,   // disable exceptions
        "cache_wsdl" => 0)   // disable any caching on the wsdl, encase you alter the wsdl server
    );

    $params = array(
        'Language' => "th",
        'DD' => date('d'),
        'MM' => date('m'),
        'YYYY' => date('Y')
    );

    $data = $client->GetOilPrice($params);

    $ob = $data->GetOilPriceResult;
    echo $thai_months[9];
    $xml = new SimpleXMLElement($ob);
    $text_ptt = "ราคาน้ำมัน วันที่ ".date('j').' '.$thai_months[intval(date('n'))-1].' '.(date('Y')+543)." เวลา".date("H:i:s");
    foreach ($xml  as  $key =>$val) {   
        if($val->PRICE != ''){
            $text_ptt .= "\n".$val->PRODUCT." ".$val->PRICE." บาท";
        }
    }
    return $text_ptt;
}
?>