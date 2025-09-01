<?php

defined( '_JEXEC' ) or die( 'Restricted access' );
require_once( dirname(__FILE__).'/jobbannerhelper.php' );
$data = JobBannerHelper::getData();
require( JModuleHelper::getLayoutPath( 'mod_elgjobbanner' ) );
