<?php

namespace  ELG\Component\ElgJobs\Site\View\Employerlist;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\View\ListView;
use Joomla\CMS\Factory;
use ELG\Component\ElgJobs\Site\Model\ParamsFilters;
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
 * View for Jnbs
 * @since  0.0.1
 */
class HtmlView extends ListView {
    public function display($tpl = null)
    {
	$model = $this ->getModel();
        $countries = json_encode($model -> getCountries());
        $industries = json_encode($model -> getIndustries());
        $doc = Factory::getApplication() -> getDocument();
        $script = " let employerCountries = " . $countries . "; let employerIndustries = " . $industries . ";";
        $doc -> addScriptDeclaration(" let employerCountries = " . $countries . "; let employerIndustries = " . $industries . ";");
        
        parent::display($tpl);
    }
}