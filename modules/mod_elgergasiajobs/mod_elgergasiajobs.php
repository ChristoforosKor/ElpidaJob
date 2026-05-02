<?php

defined( '_JEXEC' ) or die( 'Restricted access' );
use Joomla\CMS\Helper\ModuleHelper;
require_once( dirname(__FILE__).'/helper.php' );
 
$idSpeciality = $params->get('idSpeciality', '0');
$data = modHelloWorldHelper::getData($idSpeciality);
require( ModuleHelper::getLayoutPath( 'mod_elgergasiajobs' ) );
?>