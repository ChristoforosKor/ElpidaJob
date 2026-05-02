<?php


defined('_JEXEC') or die;
// Include the syndicate functions only once
require_once dirname(__FILE__) . '/homebannershelper.php';
use Joomla\CMS\Helper\ModuleHelper;
$counts =  HomeBannersHelper::getCounts();
$specialities = HomeBannersHelper::getSpeciality();

// $countHouseHelp =  HomeBannersHelper::getHouseHelp();
// $countChildren =  HomeBannersHelper::getChildren();

require ModuleHelper::getLayoutPath('mod_elghomebanners');