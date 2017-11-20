<?php

class Korisnik{
    
    var $sTableName;
    var $cSqli;
    
    function __construct($cSqli) {
        $this->setTableName("Korisnik");
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
    
    function checkUsernamePassword($sUsername, $sPassword){
        $sQuery = "SELECT ID FROM Korisnik WHERE Korisnik.PlainPassword = '".$sPassword."' AND Korisnik.Username = '".$sUsername."'";
        $res    = $this->cSqli->sqlQuery($sQuery);
        if(!$res){
            return false;
        }
        $row = $res->fetch_object();
        return $row;
    }

}

