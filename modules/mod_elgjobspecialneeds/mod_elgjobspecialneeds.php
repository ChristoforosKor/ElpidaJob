<?php

defined( '_JEXEC' ) or die( 'Restricted access' );
use Joomla\CMS\Helper\ModuleHelper;
require_once( dirname(__FILE__).'/jobspecialneedshelper.php' );
$data = JobSpecialNeedsHelper::getData();
require( ModuleHelper::getLayoutPath( 'mod_elgjobspecialneeds' ) );
