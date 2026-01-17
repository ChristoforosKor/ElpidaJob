<?php

defined( '_JEXEC' ) or die( 'Restricted access' );
require_once( dirname(__FILE__).'/typesfilterhelper.php' );
$data = TypesFilterHelper::getData();

require( JModuleHelper::getLayoutPath( 'mod_elgtypesfilter' ) );
