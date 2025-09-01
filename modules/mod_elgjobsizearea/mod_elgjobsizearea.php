<?php

defined( '_JEXEC' ) or die( 'Restricted access' );

require_once( dirname(__FILE__).'/jobsizeareahelper.php' );
$data = JobSizeAreaHelper::getData();
require( JModuleHelper::getLayoutPath( 'mod_elgjobsizearea' ) );
