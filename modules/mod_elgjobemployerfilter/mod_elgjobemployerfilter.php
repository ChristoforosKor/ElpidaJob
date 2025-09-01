<?php

defined( '_JEXEC' ) or die( 'Restricted access' );

require_once( dirname(__FILE__).'/employerfilterhelper.php' );
$data = JobHoursHelper::getData();
require( JModuleHelper::getLayoutPath( 'mod_elgjobemployerfilter' ) );
