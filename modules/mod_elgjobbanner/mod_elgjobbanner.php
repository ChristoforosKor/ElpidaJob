<?php

defined( '_JEXEC' ) or die( 'Restricted access' );
require_once( dirname(__FILE__).'/jobbannerhelper.php' );
use Joomla\CMS\Helper\ModuleHelper;
$data = JobBannerHelper::getData();


require( ModuleHelper::getLayoutPath( 'mod_elgjobbanner' ) );
