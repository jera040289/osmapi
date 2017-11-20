<?php

class Autor {
    
    var $sTableName;
    var $cSqli;
    
    function __construct($cSqli) {
        $this->setTableName("Autor");
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
    
    function load($id){
        $sQuery = "SELECT * FROM ".$this->getTableName()." WHERE ID = $id";
        $res    = $this->cSqli->sqlQuery($sQuery);
        if(!$res){
            return false;
        }
        $row = $res->fetch_object();
        $cAutor = $row;
        return $cAutor;
    }
}

