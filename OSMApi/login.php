<?php

require($_SERVER['DOCUMENT_ROOT']."/OSMApi/common.php");
require($_SERVER['DOCUMENT_ROOT']."/OSMApi/Helper/BaseWSHelper.class.php");
require($_SERVER['DOCUMENT_ROOT']."/OSMApi/Domain/Korisnik.class.php");
require($_SERVER['DOCUMENT_ROOT']."/OSMApi/Domain/KorisnikToken.class.php");

$cBaseWSHelper = new BaseWSHelper();
$sResponseType = $cBaseWSHelper->getResposneType();
if(!$sResponseType){
    $cBaseWSHelper->setResponseHeaderStatusCode(400);
    exit();
}
$sDataPOST          = file_get_contents('php://input');
if($sResponseType == "xml"){
    
    $cXML = $cBaseWSHelper->parseXMLDataString($sDataPOST);
    if(!$cXML){
        $cBaseWSHelper->setResponseHeaderStatusCode(400);
        header("Content-Type: application/xml");
        $sXML =     "<root>";
        $sXML .=    "<message><![CDATA[Bad Request]]></message>";
        $sXML .=    "<status>400</status>";
        $sXML .=    "</root>";
        echo $sXML;
        exit();
    }
    
    $sUsername = filter_var($cXML->Username, FILTER_SANITIZE_STRING);
    $sPassword = filter_var($cXML->PlainPassword, FILTER_SANITIZE_STRING);
    
    $cKorisnik          = new Korisnik($cSqli);
    $cstdIDKorisnik     = $cKorisnik->checkUsernamePassword($sUsername, $sPassword);
    $iIDKorisnik        = intval($cstdIDKorisnik->ID);
    if($iIDKorisnik == null){
        $cBaseWSHelper->setResponseHeaderStatusCode(400);
        header("Content-Type: application/xml");
        $sXML =     "<root>";
        $sXML .=    "<message><![CDATA[Not Found, Username or Password are wrong]]></message>";
        $sXML .=    "<status>404</status>";
        $sXML .=    "</root>";
        echo $sXML;
        exit();
    }
    
    $cKorisnikToken = new KorisnikToken($cSqli);
    
    $sTokenKorisnik = $cKorisnikToken->createUserToken($iIDKorisnik);
    if(!$sTokenKorisnik){
        $cBaseWSHelper->setResponseHeaderStatusCode(500);
        header("Content-Type: application/xml");
        $sXML =     "<root>";
        $sXML .=    "<message><![CDATA[Internal Server Error]]></message>";
        $sXML .=    "<status>500</status>";
        $sXML .=    "</root>";
        echo $sXML;
        exit();
    }
    
    $sXML =     "<root>";
    $sXML .=    "<TokenKorisnik><![CDATA[$sTokenKorisnik]]></TokenKorisnik>";
    $sXML .=    "</root>";
    $cBaseWSHelper->setResponseHeaderStatusCode(500);
    header("Content-Type: application/xml");
    echo $sXML;
    exit();
}
if($sResponseType == "json"){
    $cJSON = $cBaseWSHelper->parseJSONDataString($sDataPOST);
    if($cJSON == false){
        $cBaseWSHelper->setResponseHeaderStatusCode(400);
        header("Content-Type: application/json");
        $sJSON = '{"message": "Bad Request", "status": "400"}';
        echo $sJSON;
        exit();
    }
    
    
    
}
