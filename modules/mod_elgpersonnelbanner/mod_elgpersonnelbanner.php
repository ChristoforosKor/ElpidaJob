<?php

defined( '_JEXEC' ) or die( 'Restricted access' );
require_once( dirname(__FILE__).'/personnelbannerhelper.php' );
$data = PersonnelBannerHelper::getData();
require( JModuleHelper::getLayoutPath( 'mod_elgpersonnelbanner' ) );
