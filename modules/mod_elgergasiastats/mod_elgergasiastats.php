<?php

defined( '_JEXEC' ) or die( 'Restricted access' );

require_once( dirname(__FILE__).'/helper.php' );
 
JFactory::getLanguage()->load('com_elgergasia');
$data = modElgErgasiaJobStatsHelper::getData();
require( JModuleHelper::getLayoutPath( 'mod_elgergasiastats' ) );
?>