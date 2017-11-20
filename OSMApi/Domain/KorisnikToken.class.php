<?php

class KorisnikToken{
    var $sTableName;
    var $cSqli;
    
    function __construct($cSqli) {
        $this->setTableName("KorisnikToken");
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
    
    function createUserToken($iIDUser){
        $sTokenKorisnik = $this->cSqli->CreateUID();
        $sQuery =   " INSERT INTO ".$this->getTableName()." "
                .   " SET    IDKorisnik       = '$iIDUser',"
                .   "        TokenKorisnik    = '$sTokenKorisnik',"
                .   "        JeValidan        = 1";
        $cRes = $this->cSqli->sqlQuery($sQuery);
        if($cRes){
            return $sTokenKorisnik;
        }
        else{
            return false;
        }
    }
}

