<?php

defined( '_JEXEC' ) or die( 'Restricted access' );

require_once( dirname(__FILE__).'/helper.php' );
use Joomla\CMS\Helper\ModuleHelper;
use Joomla\CMS\Factory;
 
 Factory::getLanguage()->load('com_elgergasia');
$data = modElgErgasiaJobStatsHelper::getData();
require( ModuleHelper::getLayoutPath( 'mod_elgergasiastats' ) );
?>