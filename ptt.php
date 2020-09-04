<?php
date_default_timezone_set('asia/bangkok'); 

function getOilPrice() {
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

    $xml = new SimpleXMLElement($ob);

    $text_ptt = "ราคาน้ำมันปัจจุบัน";
    foreach ($xml  as  $key =>$val) {   
        if($val->PRICE != ''){
        echo $val->PRODUCT .'  '.$val->PRICE.' บาท<br>';
        $text_ptt .= $val->PRODUCT." ".$val->PRICE."บาท\n";
        }
    }
    return $text_ptt;
}
?>