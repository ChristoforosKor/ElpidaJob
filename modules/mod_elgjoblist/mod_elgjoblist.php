<?php

defined( '_JEXEC' ) or die( 'Restricted access' );
use Joomla\CMS\Factory;
use Joomla\CMS\Helper\ModuleHelper;
require_once( dirname(__FILE__).'/joblisthelper.php' );
$data = JobListHelper::getData();
$idSelected = Factory::getApplication() -> input -> getInt('iid', 0);
require( ModuleHelper::getLayoutPath( 'mod_elgjoblist' ) );
