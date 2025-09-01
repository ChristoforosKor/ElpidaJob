<?php

defined( '_JEXEC' ) or die( 'Restricted access' );
require_once( dirname(__FILE__).'/jobspecialneedshelper.php' );
$data = JobSpecialNeedsHelper::getData();
require( JModuleHelper::getLayoutPath( 'mod_elgjobspecialneeds' ) );
