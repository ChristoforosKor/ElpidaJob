<?php

defined( '_JEXEC' ) or die( 'Restricted access' );
use Joomla\CMS\Helper\ModuleHelper;
require_once( dirname(__FILE__).'/typesfilterhelper.php' );
$data = TypesFilterHelper::getData();

require( ModuleHelper::getLayoutPath( 'mod_elgtypesfilter' ) );
