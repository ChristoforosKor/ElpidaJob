<?php

defined( '_JEXEC' ) or die( 'Restricted access' );
use Joomla\CMS\Helper\ModuleHelper;
require_once( dirname(__FILE__).'/jobdistancehelper.php' );
$data = JobDistanceHelper::getData();
require( ModuleHelper::getLayoutPath( 'mod_elgjobdistance' ) );
