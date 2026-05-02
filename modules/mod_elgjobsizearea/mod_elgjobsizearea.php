<?php

defined( '_JEXEC' ) or die( 'Restricted access' );
use Joomla\CMS\Helper\ModuleHelper;
require_once( dirname(__FILE__).'/jobsizeareahelper.php' );
$data = JobSizeAreaHelper::getData();
require( ModuleHelper::getLayoutPath( 'mod_elgjobsizearea' ) );
