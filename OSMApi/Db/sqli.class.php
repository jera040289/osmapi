<?php

class sqli {
    
    var $sServer    = "localhost";
    var $sBaza      = "osmapi";      
    var $sUser      = "root";
    var $sPass      = ""; 
    var $connection;
             
    function __construct($sServer = "", $sBaza = "", $sUser = "", $sPass = "") {
        if($sServer != ""){
            $this->sServer = $sServer;
        }
        if($sBaza != ""){
            $this->sBaza = $sBaza;
        }
        if($sUser != ""){
            $this->sUser = $sUser;
        }
        if($this->sPass != ""){
            $this->sPass    = $sPass;
        }
    }
    
    function dbConnect(){
        $connection = new mysqli();
        $connection->connect($this->sServer, $this->sUser, $this->sPass, $this->sBaza);
        if($connection->connect_errno){
            //hendlovati drugacije
            printf("Connect failed: %s\n", $connection->connect_error);
            exit();
        }
        else{
            $connection->set_charset("utf8");
            $this->connection = $connection;
        }
    }

    function sqlQuery($sSQLQuery = ""){
        if(!$res=$this->connection->query($sSQLQuery)){
            return false;
        }
        else{
            return $res;
        }
    }

    function CreateUID(){
        $sQuery = "SELECT UUID()";
        $cRes = $this->sqlQuery($sQuery);
        $aRow = $cRes->fetch_array();
        return $aRow[0];
    }



}

