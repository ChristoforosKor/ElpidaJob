<?php

defined( '_JEXEC' ) or die( 'Restricted access' );
use Joomla\CMS\Helper\ModuleHelper;
require_once( dirname(__FILE__).'/employerfilterhelper.php' );
$data = JobHoursHelper::getData();
require( ModuleHelper::getLayoutPath( 'mod_elgjobemployerfilter' ) );
