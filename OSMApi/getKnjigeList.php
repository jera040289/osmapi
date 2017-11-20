<?php

require($_SERVER['DOCUMENT_ROOT']."/OSMApi/common.php");
require($_SERVER['DOCUMENT_ROOT']."/OSMApi/Domain/Knjiga.class.php");
require($_SERVER['DOCUMENT_ROOT']."/OSMApi/Domain/Autor.class.php");
require($_SERVER['DOCUMENT_ROOT']."/OSMApi/Helper/BaseWSHelper.class.php");

$cBaseWSHelper = new BaseWSHelper();

$sResponseType = $cBaseWSHelper->getResposneType();
if(!$sResponseType){
    $cBaseWSHelper->setResponseHeaderStatusCode(400);
    exit();
}

$cKnjiga    = new Knjiga($cSqli);
$aKnjige    = $cKnjiga->getAllKnjige();
$cAutor     = new Autor($cSqli);

$sXML = "<root>";
foreach($aKnjige as $cKnjiga){
    $iID            = intval($cKnjiga->ID);
    $iIDAutor       = intval($cKnjiga->IDAutor);
    $iIDKorisnik    = intval($cKnjiga->IDKorisnik);
    
    $cKnjgaAutor    = $cAutor->load(intval($iIDAutor));
    $iIDAutor       = intval($cKnjgaAutor->ID);

    $iTimeIzdavanja     = strtotime($cKnjiga->GodinaIzdavanja);
    $sGodinaIzdavanja   = date('Y.',$iTimeIzdavanja);
    
    $iTimeGodRodj       = strtotime($cKnjgaAutor->DatumRodjenja);
    $sAutorGodRodj      = date('d.m.Y.',$iTimeGodRodj);
    
    $sXML .= "<Knjiga>";
    $sXML   .= "<ID>$iID</ID>";
    $sXML   .= "<Naziv><![CDATA[$cKnjiga->Naziv]]></Naziv>";
    $sXML   .= "<GodinaIzdavanja><![CDATA[$sGodinaIzdavanja]]></GodinaIzdavanja>";
    $sXML   .= "<Jezik><![CDATA[$cKnjiga->Jezik]]></Jezik>";
    $sXML   .= "<OriginalniJezik><![CDATA[$cKnjiga->OriginalniJezik]]></OriginalniJezik>";
    $sXML   .= "<Autor>";
    $sXML       .= "<ID>$iIDAutor</ID>";
    $sXML       .= "<Ime><![CDATA[$cKnjgaAutor->Ime]]></Ime>";
    $sXML       .= "<Prezime><![CDATA[$cKnjgaAutor->Prezime]]></Prezime>";
    $sXML       .= "<DatumRodjenja><![CDATA[$sAutorGodRodj]]></DatumRodjenja>";
    $sXML   .= "</Autor>";
    $sXML   .= "<IDKorisnik>$iIDKorisnik</IDKorisnik>";
    $sXML .= "</Knjiga>";
}
$sXML .= "</root>";

if($sResponseType == "xml"){
    header("Content-Type: application/xml");
    $cBaseWSHelper->setResponseHeaderStatusCode(200);
    echo $sXML;
    exit();
}
if($sResponseType == 'json'){
    header("Content-Type: application/json");
    $cBaseWSHelper->setResponseHeaderStatusCode(200);
    $cXML = new SimpleXMLElement($sXML, LIBXML_NOCDATA);
    $sJson = json_encode($cXML);
    echo $sJson;
    exit();
}


