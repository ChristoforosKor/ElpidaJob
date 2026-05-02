<?php

defined( '_JEXEC' ) or die( 'Restricted access' );

use Joomla\CMS\Helper\ModuleHelper;
require_once( dirname(__FILE__).'/helper.php' );
 

$data = modElgErgasiaJobLastHelper::getData();
require( ModuleHelper::getLayoutPath( 'mod_elgergasiajoblast' ) );
?>