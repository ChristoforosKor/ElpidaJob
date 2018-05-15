<?php

defined( '_JEXEC' ) or die( 'Restricted access' );

require_once( dirname(__FILE__).'/helper.php' );
 
$idSpeciality = $params->get('idSpeciality', '0');
$results = modElgErgasiaCandidatesHelper::getData($idSpeciality);
$data = $results->data;
$Itemid = $results->Itemid;
require( JModuleHelper::getLayoutPath( 'mod_elgergasiacandidates' ) );
?>