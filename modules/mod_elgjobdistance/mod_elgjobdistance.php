<?php

defined( '_JEXEC' ) or die( 'Restricted access' );

require_once( dirname(__FILE__).'/jobdistancehelper.php' );
$data = JobDistanceHelper::getData();
require( JModuleHelper::getLayoutPath( 'mod_elgjobdistance' ) );
