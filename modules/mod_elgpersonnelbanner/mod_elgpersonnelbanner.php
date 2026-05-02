<?php

defined( '_JEXEC' ) or die( 'Restricted access' );
use Joomla\CMS\Helper\ModuleHelper;
require_once( dirname(__FILE__).'/personnelbannerhelper.php' );
$data = PersonnelBannerHelper::getData();
require( ModuleHelper::getLayoutPath( 'mod_elgpersonnelbanner' ) );
