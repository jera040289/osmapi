<?php

class BaseWSHelper{
    
    var $serviceType;
    
    function __construct() {
        
    }
    
    function getServiceType(){
        return $this->serviceType;
    }
    function setServiceType($sValue){
        $this->serviceType = $sValue;
    }
    
    function getRequestHeaderContentType(){
        $aHeaders = getallheaders();
        return $aHeaders["Content-Type"];
    }
    
    function getResposneType(){
        $sRequestContentType = $this->getRequestHeaderContentType();
        if($sRequestContentType == null){
            return false;
        }
        if($sRequestContentType == "application/xml"){
            $this->serviceType = "xml";
            return $this->serviceType;
        }
        if($sRequestContentType == "application/json"){
            $this->serviceType = "json";
            return $this->serviceType;
        }
        return false;
    }
    
    function setResponseHeaderStatusCode($iStatusCode){
        header("HTTP/".$_SERVER["SERVER_PROTOCOL"]." $iStatusCode");
    }
    
    function parseXMLDataString($sData){
        try {
            $cXML = new SimpleXMLElement($sData, LIBXML_NOCDATA);
            return $cXML;
        } 
        catch (Exception $exc) {
            return false;
        }
    }
    
    function parseJSONDataString($sData){
        $cJSON = json_decode($sData);
        if($cJSON == null){
            return false;
        }
        return $cJSON;
    }
    
}

