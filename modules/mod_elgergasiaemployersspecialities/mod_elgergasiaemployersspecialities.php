<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
require_once( dirname(__FILE__).'/helper.php' );
//JFactory::getLanguage()->load('com_elgergasia');
$result = modElgErgasiaEmployersSpecialitiesHelper::getData();
$data = $result->data;
$Itemid = $result->Itemid;
require( JModuleHelper::getLayoutPath( 'mod_elgergasiaemployersspecialities' ) );
