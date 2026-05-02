<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
use Joomla\CMS\Helper\ModuleHelper;

require_once( dirname(__FILE__).'/helper.php' );
//Factory::getLanguage()->load('com_elgergasia');
$result = modElgErgasiaEmployersSpecialitiesHelper::getData();
$data = $result->data;
$Itemid = $result->Itemid;
require( ModuleHelper::getLayoutPath( 'mod_elgergasiaemployersspecialities' ) );
