<?php

$sRootStaza = $_SERVER['DOCUMENT_ROOT']."/OSMApi/";
require_once($sRootStaza . "dbConfig.php");
require_once($sRootStaza . "Db/sqli.class.php");
ini_set("display_errors", "0");

$cSqli = new sqli($sServer, $sBaza, $sUser, $sPass);
$cSqli->dbConnect();