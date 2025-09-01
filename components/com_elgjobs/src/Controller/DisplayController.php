<?php

namespace  ELG\Component\ElgJobs\Site\Controller;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Controller\BaseController;
use Joomla\CMS\Form\Form;
use ELG\Component\ElgJobs\Site\Controller\EmployerController;

/**
 * @package     ELG.Job.Site
 * @subpackage  com_elgjob
 *
 * 
 * @copyright   Copyright (C) 2022 E-Logism. All rights reserved.
 * @license     E-Logism Propriatery Licence. 
 * 
 */

/**
 * ELG Job Controller
 * @since  0.0.1
 */
class DisplayController extends BaseController {
    
    public function display($cachable = false, $urlparams = array()) {        
        Form::addFieldPath(JPATH_COMPONENT_ADMINISTRATOR . "/fields");
       
        parent::display($cachable = false, $urlparams = array());
    }
    
    
    
    
}