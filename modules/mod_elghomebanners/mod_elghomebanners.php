<?php


defined('_JEXEC') or die;
// Include the syndicate functions only once
require_once dirname(__FILE__) . '/homebannershelper.php';

$counts =  HomeBannersHelper::getCounts();
$specialities = HomeBannersHelper::getSpeciality();

// $countHouseHelp =  HomeBannersHelper::getHouseHelp();
// $countChildren =  HomeBannersHelper::getChildren();

require JModuleHelper::getLayoutPath('mod_elghomebanners');