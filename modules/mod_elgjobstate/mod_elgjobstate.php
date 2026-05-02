<?php

defined( '_JEXEC' ) or die( 'Restricted access' );
use Joomla\CMS\Form\Form;
use Joomla\CMS\Factory;
use Joomla\CMS\Helper\ModuleHelper;

require_once( dirname(__FILE__).'/helper.php' );
//$data = JobStateHelper::getData();
$form = Form::getInstance('mod_elgjobstate.form', __DIR__ . '/forms/states.xml');
$stateField = $form->getField('jobState', 'filter');
$app = Factory::getApplication();
$filters = $app->input->get('filter');
$stateValue = isset($filters['jobState']) ? $filters['jobState'] : ""; 
$stateField->setValue($stateValue);
require( ModuleHelper::getLayoutPath( 'mod_elgjobstate' ) );
