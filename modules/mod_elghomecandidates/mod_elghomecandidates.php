<?php


defined('_JEXEC') or die;
// Include the syndicate functions only once
require_once dirname(__FILE__) . '/homecandidateshelper.php';
use Joomla\CMS\Helper\ModuleHelper;
$data =  HomeCandidatesHelper::getData();
require ModuleHelper::getLayoutPath('mod_elghomecandidates');