<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
require_once( dirname(__FILE__).'/helper.php' );
//JFactory::getLanguage()->load('com_elgergasia');
$results = modElgErgasiaSpecialitiesHelper::getData();
$data = $results->data;
$Itemid = $results->Itemid;
require( JModuleHelper::getLayoutPath( 'mod_elgergasiaspecialities' ) );
?>