<?php


defined('_JEXEC') or die;
// Include the syndicate functions only once
require_once dirname(__FILE__) . '/homecandidateshelper.php';

$data =  HomeCandidatesHelper::getData();
require JModuleHelper::getLayoutPath('mod_elghomecandidates');