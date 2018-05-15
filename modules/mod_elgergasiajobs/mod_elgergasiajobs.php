<?php

defined( '_JEXEC' ) or die( 'Restricted access' );

require_once( dirname(__FILE__).'/helper.php' );
 
$idSpeciality = $params->get('idSpeciality', '0');
$data = modHelloWorldHelper::getData($idSpeciality);
require( JModuleHelper::getLayoutPath( 'mod_elgergasiajobs' ) );
?>