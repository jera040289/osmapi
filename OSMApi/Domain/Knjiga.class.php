<?php

class Knjiga{
    
    var $sTableName;
    var $cSqli;
    
    function __construct($cSqli) {
        $this->setTableName("Knjiga");
        $this->cSqli = $cSqli;
    }
    
    function getTableName(){
        return $this->sTableName;
    }
    
    function setTableName($sValue){
            $this->sTableName = $sValue;
    }
    
    function getcSqliObject(){
        return $this->cSqli;
    }
    
    function setSqliObject($cValue){
        $this->cSqli = $cValue;
    }
    
    function getAllKnjige(){
        $aKnjige = array();
        
        $sQuery = "SELECT * FROM ".$this->getTableName();
        $res    = $this->cSqli->sqlQuery($sQuery);
        if(!$res){
            return false;
        }
        while($row = $res->fetch_object()){
            $aKnjige[] = $row;
        }
        return $aKnjige;
    }
}

