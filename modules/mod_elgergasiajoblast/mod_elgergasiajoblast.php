<?php

defined( '_JEXEC' ) or die( 'Restricted access' );

require_once( dirname(__FILE__).'/helper.php' );
 

$data = modElgErgasiaJobLastHelper::getData();
require( JModuleHelper::getLayoutPath( 'mod_elgergasiajoblast' ) );
?>