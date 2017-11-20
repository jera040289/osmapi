<?php
require($_SERVER['DOCUMENT_ROOT']."/OSMApi/common.php");
require($_SERVER['DOCUMENT_ROOT']."/OSMApi/Helper/BaseWSHelper.class.php");

$cBaseWSHelper = new BaseWSHelper();

$sResponseType = $cBaseWSHelper->getResposneType();
if(!$sResponseType){
    $cBaseWSHelper->setResponseHeaderStatusCode(400);
    exit();
}

$sXML =     "<root>";
$sXML .=    "<message><![CDATA[Not Found]]></message>";
$sXML .=    "<status>404</status>";
$sXML .=    "</root>";

if($sResponseType == "xml"){
    header("Content-Type: application/xml");
    $cBaseWSHelper->setResponseHeaderStatusCode(404);
    echo $sXML;
    exit();
}
if($sResponseType == 'json'){
    header("Content-Type: application/json");
    $cBaseWSHelper->setResponseHeaderStatusCode(404);
    $cXML = new SimpleXMLElement($sXML, LIBXML_NOCDATA);
    $sJson = json_encode($cXML);
    echo $sJson;
    exit();
}
